<?php
/**
 * Dynamic ACF Featured Projects / Case Studies Section
 * Pulls from 'case_study' CPT and 'case_study_category' taxonomy with fallback defaults.
 *
 * @package HelloElementorChildCI360ACF
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'ci360_get_fp_val' ) ) {
    function ci360_get_fp_val( $field_name, $default = '' ) {
        if ( function_exists( 'get_field' ) ) {
            $val = get_field( $field_name );
            if ( ! empty( $val ) ) {
                return $val;
            }
            $opt_val = get_field( $field_name, 'option' );
            if ( ! empty( $opt_val ) ) {
                return $opt_val;
            }
        }
        return $default;
    }
}

// Section Headings & Text from ACF
$fp_badge_text    = ci360_get_fp_val( 'fp_badge_text', 'Case Studies' );
$fp_title_main    = ci360_get_fp_val( 'fp_title_main', 'Featured Projects' );
$fp_description   = ci360_get_fp_val( 'fp_description', 'Transforming ambitious brands into category leaders with data-driven strategy and precision design.' );
$fp_view_all_text = ci360_get_fp_val( 'fp_view_all_text', 'View All Projects' );
$fp_view_all_url  = ci360_get_fp_val( 'fp_view_all_url', home_url( '/case-studies/' ) );

// Fetch dynamic Case Studies from CPT if available
$args = array(
    'post_type'      => 'case_study',
    'posts_per_page' => 4,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'DESC',
);
$cs_query = new WP_Query( $args );

$projects = array();

if ( $cs_query->have_posts() ) {
    while ( $cs_query->have_posts() ) {
        $cs_query->the_post();
        $post_id   = get_the_ID();
        $thumb_url = get_the_post_thumbnail_url( $post_id, 'large' );
        if ( ! $thumb_url ) {
            $thumb_url = 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=1200&auto=format&fit=crop';
        }

        // Get taxonomy terms
        $terms = get_the_terms( $post_id, 'case_study_category' );
        $cat_name = 'Featured';
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $cat_name = $terms[0]->name;
        }

        $client_name = function_exists( 'get_field' ) ? get_field( 'client_name', $post_id ) : '';
        $card_cat_label = $client_name ? ( $cat_name . ' • Client: ' . $client_name ) : $cat_name;

        $excerpt = get_the_excerpt();
        if ( empty( $excerpt ) ) {
            $excerpt = wp_trim_words( get_the_content(), 18, '...' );
        }

        $projects[] = array(
            'id'       => $post_id,
            'title'    => get_the_title(),
            'cat'      => $card_cat_label,
            'badge'    => $cat_name,
            'excerpt'  => $excerpt,
            'image'    => $thumb_url,
            'url'      => get_permalink(),
        );
    }
    wp_reset_postdata();
}

// Fallback high-impact projects if CPT has fewer than 4 posts
$fallback_projects = array(
    array(
        'title'    => 'LEOZ: Art of Ambiance & Architectural Illumination',
        'cat'      => 'Reality • Client: Leoz',
        'badge'    => 'Featured Project',
        'excerpt'  => 'Sensory ambient lighting catalogs, 3D architectural illumination renders, and high-end interior designer partnerships.',
        'image'    => 'https://lightcyan-dinosaur-747226.hostingersite.com/wp-content/themes/hello-elementor-child-ci360/assets/images/leoz-featured.jpg',
        'url'      => home_url( '/case-studies/leoz/' ),
    ),
    array(
        'title'    => 'Ananta Aspen Centre: High-Level Track-II Diplomacy & Leadership',
        'cat'      => 'Public Policy • Client: Ananta Aspen Centre',
        'badge'    => 'Public Policy',
        'excerpt'  => 'International bilateral summit digital stage graphics, track-two diplomacy identity, and policy research monographs.',
        'image'    => 'https://lightcyan-dinosaur-747226.hostingersite.com/wp-content/themes/hello-elementor-child-ci360/assets/images/ananta-featured.jpg',
        'url'      => home_url( '/case-studies/ananta-centre-aspen/' ),
    ),
    array(
        'title'    => 'Chaitanya School Gandhinagar: Academic Pedagogy & Campus Admissions',
        'cat'      => 'Education • Client: Chaitanya School Gandhinagar',
        'badge'    => 'Education',
        'excerpt'  => 'Campus life documentary cinematography, value-based curriculum branding, and 100% capacity student admissions scaling.',
        'image'    => 'https://lightcyan-dinosaur-747226.hostingersite.com/wp-content/themes/hello-elementor-child-ci360/assets/images/chaitanya-featured.jpg',
        'url'      => home_url( '/case-studies/chaitanya-school-gandhinagar/' ),
    ),
    array(
        'title'    => 'Station Satcom: B2B Satellite Telecom Modernization',
        'cat'      => 'Satcom • Client: Station Satcom',
        'badge'    => 'Satcom',
        'excerpt'  => 'Global brand repositioning and Next.js portal for maritime, defense, and enterprise satellite connectivity.',
        'image'    => 'https://lightcyan-dinosaur-747226.hostingersite.com/wp-content/themes/hello-elementor-child-ci360/assets/images/ss-2.jpeg',
        'url'      => home_url( '/case-studies/station-satcom/' ),
    ),
);

// Merge: use CPT items first, fill remaining slots from fallback
$final_projects = array();
for ( $i = 0; $i < 4; $i++ ) {
    if ( isset( $projects[ $i ] ) ) {
        $final_projects[ $i ] = $projects[ $i ];
    } else {
        $final_projects[ $i ] = $fallback_projects[ $i ];
    }
}

$main_featured = $final_projects[0];
$stacked_cards = array_slice( $final_projects, 1, 3 );
?>

<!-- Google Fonts & Tailwind CDN -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Montserrat:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    darkMode: 'class',
    theme: {
      extend: {
        fontFamily: {
          sans: ['Inter', 'sans-serif'],
          montserrat: ['Montserrat', 'sans-serif'],
        }
      }
    }
  }
</script>

<style>
/* =========================================================
   SCOPED FEATURED PROJECTS STYLES - ZERO PINK, PURE CYAN & BLUE
========================================================= */
#ci360-featured-projects-section {
    position: relative;
    background-color: #020617;
    color: #ffffff;
    font-family: 'Inter', sans-serif;
    padding: 90px 24px 80px 24px;
    box-sizing: border-box;
    overflow: hidden;
    border-bottom: 1px solid rgba(51, 65, 85, 0.8);
}

@media (min-width: 1024px) {
    #ci360-featured-projects-section {
        padding: 110px 48px 90px 48px;
    }
}

#ci360-featured-projects-section * {
    box-sizing: border-box;
}

/* Background Glows */
#ci360-featured-projects-section .fp-bg-glow {
    position: absolute;
    top: 20%;
    right: 10%;
    width: 500px;
    height: 500px;
    background: rgba(6, 182, 212, 0.08);
    border-radius: 9999px;
    filter: blur(140px);
    pointer-events: none;
}

#ci360-featured-projects-section .fp-bg-glow-2 {
    position: absolute;
    bottom: 10%;
    left: 10%;
    width: 450px;
    height: 450px;
    background: rgba(37, 99, 235, 0.1);
    border-radius: 9999px;
    filter: blur(150px);
    pointer-events: none;
}

/* Main Grid Layout */
#ci360-featured-projects-section .ss-fp-wrap {
    display: flex !important;
    gap: 24px !important;
    width: 100% !important;
    align-items: stretch !important;
}

/* Left Big Featured Card */
#ci360-featured-projects-section .ss-fp-featured {
    flex: 0 0 54% !important;
    min-height: 540px !important;
    border-radius: 24px !important;
    overflow: hidden !important;
    cursor: pointer !important;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    position: relative !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: flex-end !important;
    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.5) !important;
    border: 1px solid rgba(51, 65, 85, 0.85) !important;
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease !important;
    text-decoration: none !important;
}

#ci360-featured-projects-section .ss-fp-featured:hover {
    transform: translateY(-4px) !important;
    box-shadow: 0 20px 50px rgba(6, 182, 212, 0.22) !important;
    border-color: rgba(6, 182, 212, 0.7) !important;
}

#ci360-featured-projects-section .ss-fp-featured-body {
    padding: 32px 36px !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 10px !important;
    background: linear-gradient(to top, rgba(2, 6, 23, 0.96) 0%, rgba(2, 6, 23, 0.75) 55%, transparent 100%) !important;
    position: relative !important;
    z-index: 2 !important;
}

#ci360-featured-projects-section .ss-fp-featured-badge {
    display: inline-flex !important;
    background: linear-gradient(135deg, #0284c7, #06b6d4) !important;
    color: #ffffff !important;
    font-size: 11px !important;
    font-weight: 700 !important;
    padding: 4px 14px !important;
    border-radius: 50px !important;
    width: fit-content !important;
    margin-bottom: 4px !important;
    box-shadow: 0 4px 15px rgba(6, 182, 212, 0.35) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.06em !important;
}

#ci360-featured-projects-section .ss-fp-featured-cat {
    font-size: 12px !important;
    font-weight: 700 !important;
    color: #38bdf8 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.08em !important;
}

/* Heading color remains solid white on hover (NO HOVER COLOR CHANGE) */
#ci360-featured-projects-section .ss-fp-featured-title {
    font-size: 26px !important;
    font-weight: 800 !important;
    color: #ffffff !important;
    line-height: 1.3 !important;
    margin: 0 !important;
}

#ci360-featured-projects-section .ss-fp-featured:hover .ss-fp-featured-title {
    color: #ffffff !important;
}

#ci360-featured-projects-section .ss-fp-featured-excerpt {
    font-size: 13.5px !important;
    color: #94a3b8 !important;
    line-height: 1.6 !important;
    margin: 0 !important;
    font-weight: 300 !important;
}

/* Right Stacked List */
#ci360-featured-projects-section .ss-fp-list {
    flex: 1 !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 16px !important;
    min-height: 540px !important;
}

#ci360-featured-projects-section .ss-fp-card {
    display: flex !important;
    border-radius: 20px !important;
    border: 1px solid rgba(51, 65, 85, 0.8) !important;
    overflow: hidden !important;
    cursor: pointer !important;
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease !important;
    background: rgba(15, 23, 42, 0.9) !important;
    flex: 1 !important;
    min-height: 0 !important;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3) !important;
    text-decoration: none !important;
}

#ci360-featured-projects-section .ss-fp-card:hover {
    box-shadow: 0 12px 30px rgba(6, 182, 212, 0.16) !important;
    transform: translateY(-2px) !important;
    border-color: rgba(6, 182, 212, 0.65) !important;
}

#ci360-featured-projects-section .ss-fp-card-img {
    flex: 0 0 180px !important;
    min-height: 100% !important;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    position: relative !important;
}

#ci360-featured-projects-section .ss-fp-card-img::after {
    content: '' !important;
    position: absolute !important;
    inset: 0 !important;
    background: linear-gradient(to right, transparent 60%, rgba(15, 23, 42, 0.9) 100%) !important;
}

#ci360-featured-projects-section .ss-fp-card-body {
    padding: 16px 22px !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: center !important;
    gap: 5px !important;
    flex: 1 !important;
    min-width: 0 !important;
}

#ci360-featured-projects-section .ss-fp-card-cat {
    font-size: 11px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.08em !important;
    color: #38bdf8 !important;
}

/* Heading color remains solid white on hover (NO HOVER COLOR CHANGE) */
#ci360-featured-projects-section .ss-fp-card-title {
    font-size: 15px !important;
    font-weight: 700 !important;
    color: #ffffff !important;
    line-height: 1.35 !important;
    margin: 0 !important;
}

#ci360-featured-projects-section .ss-fp-card:hover .ss-fp-card-title {
    color: #ffffff !important;
}

#ci360-featured-projects-section .ss-fp-card-excerpt {
    font-size: 12px !important;
    color: #94a3b8 !important;
    line-height: 1.55 !important;
    margin: 0 !important;
    font-weight: 300 !important;
}

/* Mobile Carousel */
#ci360-featured-projects-section .ss-fp-carousel-wrap {
    display: none !important;
}

@media (max-width: 860px) {
    #ci360-featured-projects-section .ss-fp-wrap {
        display: none !important;
    }
    #ci360-featured-projects-section .ss-fp-carousel-wrap {
        display: block !important;
        width: 100% !important;
        overflow: hidden !important;
        position: relative !important;
    }
    #ci360-featured-projects-section .ss-fp-carousel-track {
        display: flex !important;
        gap: 16px !important;
        transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
        will-change: transform !important;
        touch-action: pan-y !important;
    }
    #ci360-featured-projects-section .ss-fp-slide {
        flex: 0 0 85% !important;
        height: 360px !important;
        border-radius: 20px !important;
        overflow: hidden !important;
        cursor: pointer !important;
        background-size: cover !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
        position: relative !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: flex-end !important;
        flex-shrink: 0 !important;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3) !important;
        border: 1px solid rgba(6, 182, 212, 0.35) !important;
        text-decoration: none !important;
    }
    #ci360-featured-projects-section .ss-fp-slide-overlay {
        position: absolute !important;
        inset: 0 !important;
        background: linear-gradient(to top, rgba(2, 6, 23, 0.95) 0%, rgba(2, 6, 23, 0.35) 60%, transparent 100%) !important;
    }
    #ci360-featured-projects-section .ss-fp-slide-body {
        position: relative !important;
        z-index: 2 !important;
        padding: 22px !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 8px !important;
    }
    #ci360-featured-projects-section .ss-fp-slide-badge {
        display: inline-flex !important;
        background: linear-gradient(135deg, #0284c7, #06b6d4) !important;
        color: #fff !important;
        font-size: 10.5px !important;
        font-weight: 700 !important;
        padding: 4px 12px !important;
        border-radius: 50px !important;
        width: fit-content !important;
    }
    #ci360-featured-projects-section .ss-fp-slide-cat {
        font-size: 11px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.08em !important;
        color: #38bdf8 !important;
    }
    #ci360-featured-projects-section .ss-fp-slide-title {
        font-size: 16px !important;
        font-weight: 800 !important;
        color: #fff !important;
        line-height: 1.35 !important;
        margin: 0 !important;
    }
    #ci360-featured-projects-section .ss-fp-dots {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 6px !important;
        margin-top: 18px !important;
    }
    #ci360-featured-projects-section .ss-fp-dot {
        width: 7px !important;
        height: 7px !important;
        border-radius: 50% !important;
        background: #334155 !important;
        transition: all 0.25s ease !important;
        border: none !important;
        padding: 0 !important;
        cursor: pointer !important;
    }
    #ci360-featured-projects-section .ss-fp-dot.active {
        background: #06b6d4 !important;
        width: 24px !important;
        border-radius: 4px !important;
    }
}
</style>

<section id="ci360-featured-projects-section">
  <!-- Background Glows -->
  <div class="fp-bg-glow"></div>
  <div class="fp-bg-glow-2"></div>

  <div class="max-w-7xl mx-auto relative z-10">
    <!-- Top Section Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
      <div>
        <span class="text-xs font-semibold text-cyan-400 uppercase tracking-widest"><?php echo esc_html( $fp_badge_text ); ?></span>
        <h2 class="text-3xl md:text-5xl font-bold mt-2 text-white"><?php echo esc_html( $fp_title_main ); ?></h2>
        <p class="text-slate-400 font-light mt-2"><?php echo esc_html( $fp_description ); ?></p>
      </div>
      <a class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-slate-900/90 border border-slate-800 text-xs font-semibold text-white hover:border-slate-700 hover:text-cyan-400 transition-all shadow-md backdrop-blur-md group" href="<?php echo esc_url( $fp_view_all_url ); ?>">
        <?php echo esc_html( $fp_view_all_text ); ?> 
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform">
          <path d="M5 12h14"></path>
          <path d="m12 5 7 7-7 7"></path>
        </svg>
      </a>
    </div>

    <!-- Desktop 2-Column Layout (Left 54% Big Featured + Right 46% Stacked 3 Cards) -->
    <div class="ss-fp-wrap">
      <!-- Left Side Big Featured Card -->
      <a href="<?php echo esc_url( $main_featured['url'] ); ?>" class="ss-fp-featured" style="background-image:url('<?php echo esc_url( $main_featured['image'] ); ?>');">
        <div class="ss-fp-featured-body">
          <span class="ss-fp-featured-badge"><?php echo esc_html( $main_featured['badge'] ); ?></span>
          <span class="ss-fp-featured-cat"><?php echo esc_html( $main_featured['cat'] ); ?></span>
          <h3 class="ss-fp-featured-title"><?php echo esc_html( $main_featured['title'] ); ?></h3>
          <p class="ss-fp-featured-excerpt"><?php echo esc_html( $main_featured['excerpt'] ); ?></p>
        </div>
      </a>

      <!-- Right Side Stacked 3 Cards -->
      <div class="ss-fp-list">
        <?php foreach ( $stacked_cards as $card ) : ?>
        <a href="<?php echo esc_url( $card['url'] ); ?>" class="ss-fp-card">
          <div class="ss-fp-card-img" style="background-image:url('<?php echo esc_url( $card['image'] ); ?>');"></div>
          <div class="ss-fp-card-body">
            <span class="ss-fp-card-cat"><?php echo esc_html( $card['cat'] ); ?></span>
            <h4 class="ss-fp-card-title"><?php echo esc_html( $card['title'] ); ?></h4>
            <p class="ss-fp-card-excerpt"><?php echo esc_html( $card['excerpt'] ); ?></p>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Mobile Touch / Swipe Carousel -->
    <div class="ss-fp-carousel-wrap" id="ci360-fp-carousel-wrap">
      <div class="ss-fp-carousel-track" id="ci360-fp-track">
        <?php foreach ( $final_projects as $idx => $slide ) : ?>
        <a href="<?php echo esc_url( $slide['url'] ); ?>" class="ss-fp-slide" style="background-image:url('<?php echo esc_url( $slide['image'] ); ?>');">
          <div class="ss-fp-slide-overlay"></div>
          <div class="ss-fp-slide-body">
            <span class="ss-fp-slide-badge"><?php echo esc_html( $slide['badge'] ); ?></span>
            <span class="ss-fp-slide-cat"><?php echo esc_html( $slide['cat'] ); ?></span>
            <h3 class="ss-fp-slide-title"><?php echo esc_html( $slide['title'] ); ?></h3>
          </div>
        </a>
        <?php endforeach; ?>
      </div>

      <!-- Mobile Carousel Pagination Dots -->
      <div class="ss-fp-dots" id="ci360-fp-dots">
        <?php foreach ( $final_projects as $idx => $slide ) : ?>
        <button class="ss-fp-dot <?php echo $idx === 0 ? 'active' : ''; ?>" aria-label="Slide <?php echo $idx + 1; ?>" onclick="ci360GoToFpSlide(<?php echo $idx; ?>)"></button>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<script>
(function() {
  var currentFpIdx = 0;
  var track = document.getElementById('ci360-fp-track');
  var dots = document.querySelectorAll('#ci360-fp-dots .ss-fp-dot');
  var slides = document.querySelectorAll('#ci360-fp-track .ss-fp-slide');
  var total = slides.length;

  window.ci360GoToFpSlide = function(idx) {
    if (idx < 0) idx = 0;
    if (idx >= total) idx = total - 1;
    currentFpIdx = idx;
    if (track) {
      track.style.transform = 'translateX(-' + (currentFpIdx * 88) + '%)';
    }
    dots.forEach(function(d, i) {
      if (i === currentFpIdx) {
        d.classList.add('active');
      } else {
        d.classList.remove('active');
      }
    });
  };

  // Touch swipe support
  var startX = 0;
  var isDragging = false;
  if (track) {
    track.addEventListener('touchstart', function(e) {
      startX = e.touches[0].clientX;
      isDragging = true;
    }, { passive: true });

    track.addEventListener('touchend', function(e) {
      if (!isDragging) return;
      isDragging = false;
      var endX = e.changedTouches[0].clientX;
      var diff = startX - endX;
      if (diff > 40) {
        ci360GoToFpSlide(currentFpIdx + 1);
      } else if (diff < -40) {
        ci360GoToFpSlide(currentFpIdx - 1);
      }
    }, { passive: true });
  }
})();
</script>
