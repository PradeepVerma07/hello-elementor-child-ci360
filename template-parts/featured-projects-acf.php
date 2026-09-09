<?php
/**
 * Dynamic ACF Featured Projects Section (100% ACF Controlled)
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

// 1. Top Section Headings & Text
$fp_badge_text    = ci360_get_fp_val( 'fp_badge_text', 'Case Studies' );
$fp_title_main    = ci360_get_fp_val( 'fp_title_main', 'Featured Projects' );
$fp_description   = ci360_get_fp_val( 'fp_description', 'Transforming ambitious brands into category leaders with data-driven strategy and precision design.' );
$fp_view_all_text = ci360_get_fp_val( 'fp_view_all_text', 'View All Projects' );
$fp_view_all_url  = ci360_get_fp_val( 'fp_view_all_url', home_url( '/case-studies/' ) );

// 2. Bottom Callout Banner
$fp_bottom_title    = ci360_get_fp_val( 'fp_bottom_title', 'Stay informed. Stay ahead.' );
$fp_bottom_subtitle = ci360_get_fp_val( 'fp_bottom_subtitle', 'Curated insights and expert analysis to help you navigate change and lead with confidence.' );
$fp_bottom_btn_text = ci360_get_fp_val( 'fp_bottom_btn_text', 'Check All Case Studies' );
$fp_bottom_btn_url  = ci360_get_fp_val( 'fp_bottom_btn_url', home_url( '/case-studies/' ) );

// 3. Card 1 (Main Left 54% Featured Card)
$card1_img   = ci360_get_fp_val( 'fp_card1_image_url', 'https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=1200&auto=format&fit=crop' );
$card1_video = ci360_get_fp_val( 'fp_card1_video_url', '' );
$card1_badge = ci360_get_fp_val( 'fp_card1_badge', 'Featured Project' );
$card1_cat   = ci360_get_fp_val( 'fp_card1_cat', 'Reality • Client: Leoz' );
$card1_title = ci360_get_fp_val( 'fp_card1_title', 'LEOZ: Art of Ambiance & Architectural Illumination' );
$card1_desc  = ci360_get_fp_val( 'fp_card1_desc', 'Sensory ambient lighting catalogs, 3D architectural illumination renders, and high-end interior designer partnerships.' );
$card1_url   = ci360_get_fp_val( 'fp_card1_url', home_url( '/case-studies/leoz/' ) );

// 4. Card 2 (Right Top Card)
$card2_img   = ci360_get_fp_val( 'fp_card2_image_url', 'https://images.unsplash.com/photo-1541872703-74c5e44368f9?q=80&w=800&auto=format&fit=crop' );
$card2_cat   = ci360_get_fp_val( 'fp_card2_cat', 'Public Policy • Client: Ananta Aspen Centre' );
$card2_title = ci360_get_fp_val( 'fp_card2_title', 'Ananta Aspen Centre: High-Level Track-II Diplomacy & Leadership' );
$card2_desc  = ci360_get_fp_val( 'fp_card2_desc', 'International bilateral summit digital stage graphics, track-two diplomacy identity, and policy research monographs.' );
$card2_url   = ci360_get_fp_val( 'fp_card2_url', home_url( '/case-studies/ananta-centre-aspen/' ) );

// 5. Card 3 (Right Middle Card)
$card3_img   = ci360_get_fp_val( 'fp_card3_image_url', 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=800&auto=format&fit=crop' );
$card3_cat   = ci360_get_fp_val( 'fp_card3_cat', 'Education • Client: Chaitanya School Gandhinagar' );
$card3_title = ci360_get_fp_val( 'fp_card3_title', 'Chaitanya School Gandhinagar: Academic Pedagogy & Campus Admissions' );
$card3_desc  = ci360_get_fp_val( 'fp_card3_desc', 'Campus life documentary cinematography, value-based curriculum branding, and 100% capacity student admissions scaling.' );
$card3_url   = ci360_get_fp_val( 'fp_card3_url', home_url( '/case-studies/chaitanya-school-gandhinagar/' ) );

// 6. Card 4 (Right Bottom Card)
$card4_img   = ci360_get_fp_val( 'fp_card4_image_url', 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=800&auto=format&fit=crop' );
$card4_cat   = ci360_get_fp_val( 'fp_card4_cat', 'Satcom • Client: Station Satcom' );
$card4_title = ci360_get_fp_val( 'fp_card4_title', 'Station Satcom: B2B Satellite Telecom Modernization' );
$card4_desc  = ci360_get_fp_val( 'fp_card4_desc', 'Global brand repositioning and Next.js portal for maritime, defense, and enterprise satellite connectivity.' );
$card4_url   = ci360_get_fp_val( 'fp_card4_url', home_url( '/case-studies/station-satcom/' ) );

$all_slides = array(
    array( 'badge' => $card1_badge, 'cat' => $card1_cat, 'title' => $card1_title, 'image' => $card1_img, 'url' => $card1_url ),
    array( 'badge' => 'Featured', 'cat' => $card2_cat, 'title' => $card2_title, 'image' => $card2_img, 'url' => $card2_url ),
    array( 'badge' => 'Featured', 'cat' => $card3_cat, 'title' => $card3_title, 'image' => $card3_img, 'url' => $card3_url ),
    array( 'badge' => 'Featured', 'cat' => $card4_cat, 'title' => $card4_title, 'image' => $card4_img, 'url' => $card4_url ),
);
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
    min-height: 560px !important;
    border-radius: 24px !important;
    overflow: hidden !important;
    cursor: pointer !important;
    background-color: #0f172a !important;
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
    box-shadow: 0 20px 50px rgba(6, 182, 212, 0.25) !important;
    border-color: rgba(6, 182, 212, 0.75) !important;
}

#ci360-featured-projects-section .ss-fp-video-bg {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    z-index: 1 !important;
}

#ci360-featured-projects-section .ss-fp-featured-body {
    padding: 34px 38px !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 10px !important;
    background: linear-gradient(to top, rgba(2, 6, 23, 0.98) 0%, rgba(2, 6, 23, 0.8) 55%, transparent 100%) !important;
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
    min-height: 560px !important;
}

#ci360-featured-projects-section .ss-fp-card {
    display: flex !important;
    border-radius: 20px !important;
    border: 1px solid rgba(51, 65, 85, 0.8) !important;
    overflow: hidden !important;
    cursor: pointer !important;
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease !important;
    background: rgba(15, 23, 42, 0.95) !important;
    flex: 1 !important;
    min-height: 0 !important;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3) !important;
    text-decoration: none !important;
}

#ci360-featured-projects-section .ss-fp-card:hover {
    box-shadow: 0 12px 30px rgba(6, 182, 212, 0.2) !important;
    transform: translateY(-2px) !important;
    border-color: rgba(6, 182, 212, 0.75) !important;
}

#ci360-featured-projects-section .ss-fp-card-img {
    flex: 0 0 180px !important;
    min-height: 100% !important;
    background-color: #0f172a !important;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    position: relative !important;
}

#ci360-featured-projects-section .ss-fp-card-img::after {
    content: '' !important;
    position: absolute !important;
    inset: 0 !important;
    background: linear-gradient(to right, transparent 55%, rgba(15, 23, 42, 0.95) 100%) !important;
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

/* Call to Action Button */
#ci360-featured-projects-section .ss-fp-cta-btn {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    padding: 13px 30px !important;
    border-radius: 50px !important;
    background: linear-gradient(135deg, #0284c7 0%, #06b6d4 100%) !important;
    color: #ffffff !important;
    font-size: 13.5px !important;
    font-weight: 700 !important;
    text-decoration: none !important;
    box-shadow: 0 8px 24px rgba(6, 182, 212, 0.3) !important;
    transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease !important;
}

#ci360-featured-projects-section .ss-fp-cta-btn:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 12px 28px rgba(6, 182, 212, 0.45) !important;
    opacity: 0.95 !important;
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
        background-color: #0f172a !important;
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
      <!-- Left Side Big Featured Card (Card 1) -->
      <a href="<?php echo esc_url( $card1_url ); ?>" class="ss-fp-featured" style="background-image:url('<?php echo esc_url( $card1_img ); ?>');">
        <?php if ( ! empty( $card1_video ) ) : ?>
        <video class="ss-fp-video-bg" autoplay muted loop playsinline src="<?php echo esc_url( $card1_video ); ?>"></video>
        <?php endif; ?>
        <div class="ss-fp-featured-body">
          <span class="ss-fp-featured-badge"><?php echo esc_html( $card1_badge ); ?></span>
          <span class="ss-fp-featured-cat"><?php echo esc_html( $card1_cat ); ?></span>
          <h3 class="ss-fp-featured-title"><?php echo esc_html( $card1_title ); ?></h3>
          <p class="ss-fp-featured-excerpt"><?php echo esc_html( $card1_desc ); ?></p>
        </div>
      </a>

      <!-- Right Side Stacked 3 Cards -->
      <div class="ss-fp-list">
        <!-- Card 2 -->
        <a href="<?php echo esc_url( $card2_url ); ?>" class="ss-fp-card">
          <div class="ss-fp-card-img" style="background-image:url('<?php echo esc_url( $card2_img ); ?>');"></div>
          <div class="ss-fp-card-body">
            <span class="ss-fp-card-cat"><?php echo esc_html( $card2_cat ); ?></span>
            <h4 class="ss-fp-card-title"><?php echo esc_html( $card2_title ); ?></h4>
            <p class="ss-fp-card-excerpt"><?php echo esc_html( $card2_desc ); ?></p>
          </div>
        </a>

        <!-- Card 3 -->
        <a href="<?php echo esc_url( $card3_url ); ?>" class="ss-fp-card">
          <div class="ss-fp-card-img" style="background-image:url('<?php echo esc_url( $card3_img ); ?>');"></div>
          <div class="ss-fp-card-body">
            <span class="ss-fp-card-cat"><?php echo esc_html( $card3_cat ); ?></span>
            <h4 class="ss-fp-card-title"><?php echo esc_html( $card3_title ); ?></h4>
            <p class="ss-fp-card-excerpt"><?php echo esc_html( $card3_desc ); ?></p>
          </div>
        </a>

        <!-- Card 4 -->
        <a href="<?php echo esc_url( $card4_url ); ?>" class="ss-fp-card">
          <div class="ss-fp-card-img" style="background-image:url('<?php echo esc_url( $card4_img ); ?>');"></div>
          <div class="ss-fp-card-body">
            <span class="ss-fp-card-cat"><?php echo esc_html( $card4_cat ); ?></span>
            <h4 class="ss-fp-card-title"><?php echo esc_html( $card4_title ); ?></h4>
            <p class="ss-fp-card-excerpt"><?php echo esc_html( $card4_desc ); ?></p>
          </div>
        </a>
      </div>
    </div>

    <!-- Mobile Touch / Swipe Carousel -->
    <div class="ss-fp-carousel-wrap" id="ci360-fp-carousel-wrap">
      <div class="ss-fp-carousel-track" id="ci360-fp-track">
        <?php foreach ( $all_slides as $idx => $slide ) : ?>
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
        <?php foreach ( $all_slides as $idx => $slide ) : ?>
        <button class="ss-fp-dot <?php echo $idx === 0 ? 'active' : ''; ?>" aria-label="Slide <?php echo $idx + 1; ?>" onclick="ci360GoToFpSlide(<?php echo $idx; ?>)"></button>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Bottom Insights Callout Bar -->
    <div class="mt-12 pt-7 border-t border-slate-800/80 flex flex-col md:flex-row items-center justify-between gap-6">
      <div class="flex items-center gap-5">
        <div class="w-11 h-11 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 shrink-0">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="2" y1="12" x2="22" y2="12"></line>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
          </svg>
        </div>
        <div class="text-xs font-bold uppercase tracking-wider leading-tight text-white whitespace-nowrap">
          <?php echo nl2br( esc_html( $fp_bottom_title ) ); ?>
        </div>
        <div class="hidden sm:block h-9 w-px bg-slate-700/80 mx-1"></div>
        <p class="text-xs md:text-sm font-light text-slate-300 leading-relaxed max-w-xl">
          <?php echo esc_html( $fp_bottom_subtitle ); ?>
        </p>
      </div>
      <a href="<?php echo esc_url( $fp_bottom_btn_url ); ?>" class="ss-fp-cta-btn shrink-0">
        <?php echo esc_html( $fp_bottom_btn_text ); ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M5 12h14"></path>
          <path d="m12 5 7 7-7 7"></path>
        </svg>
      </a>
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
