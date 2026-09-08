<?php
/**
 * Dynamic ACF Home Hero Section
 *
 * @package HelloElementorChildCI360ACF
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Helper function for ACF value or fallback
if ( ! function_exists( 'ci360_acf_val' ) ) {
    function ci360_acf_val( $field_name, $default = '' ) {
        if ( function_exists( 'get_field' ) ) {
            $val = get_field( $field_name );
            if ( ! empty( $val ) ) {
                return $val;
            }
        }
        return $default;
    }
}

// 1. Text & Headings
$hero_badge       = ci360_acf_val( 'hero_badge_text', 'One Integrated Partner. Every Marketing Possibility.' );
$hero_title_pre   = ci360_acf_val( 'hero_title_prefix', 'Stories That' );
$hero_title_high  = ci360_acf_val( 'hero_title_highlight', 'Move Brands' );
$hero_title_post  = ci360_acf_val( 'hero_title_suffix', 'Forward.' );
$hero_desc        = ci360_acf_val( 'hero_description', 'CI360 Degrees is an integrated digital marketing and strategic communication agency helping businesses transform ideas into impactful brand experiences and measurable growth.' );

// 2. CTA Buttons
$hero_btn1_text   = ci360_acf_val( 'hero_btn1_text', 'Start a Conversation' );
$hero_btn1_url    = ci360_acf_val( 'hero_btn1_url', home_url( '/contact-us/' ) );
$hero_btn2_text   = ci360_acf_val( 'hero_btn2_text', 'Explore Our Work' );
$hero_btn2_url    = ci360_acf_val( 'hero_btn2_url', home_url( '/projects/' ) );

// 3. Stats / Metrics
$hero_stats = array();
if ( function_exists( 'have_rows' ) && have_rows( 'hero_stats_repeater' ) ) {
    while ( have_rows( 'hero_stats_repeater' ) ) {
        the_row();
        $hero_stats[] = array(
            'value' => get_sub_field( 'stat_value' ),
            'label' => get_sub_field( 'stat_label' ),
            'color' => get_sub_field( 'stat_color' ) ?: 'text-cyan-400',
        );
    }
}

if ( empty( $hero_stats ) ) {
    $hero_stats = array(
        array( 'value' => '₹450Cr+', 'label' => 'Client Revenue', 'color' => 'text-emerald-400' ),
        array( 'value' => '98.4%', 'label' => 'Client Retention', 'color' => 'text-cyan-400' ),
        array( 'value' => '3 Studios', 'label' => 'Ahmedabad • Delhi • USA', 'color' => 'text-blue-400' ),
        array( 'value' => '< 1.2s', 'label' => 'Page Speed', 'color' => 'text-indigo-400' ),
    );
}

// 4. Showcase Slides
$hero_slides = array();
if ( function_exists( 'have_rows' ) && have_rows( 'hero_slides_repeater' ) ) {
    while ( have_rows( 'hero_slides_repeater' ) ) {
        the_row();
        $img_field = get_sub_field( 'slide_image' );
        $img_url   = is_array( $img_field ) ? $img_field['url'] : $img_field;
        $video_val = get_sub_field( 'slide_video_url' );

        $hero_slides[] = array(
            'image'    => $img_url,
            'videoUrl' => $video_val,
            'title'    => get_sub_field( 'slide_title' ),
            'tag'      => get_sub_field( 'slide_tag' ),
            'desc'     => get_sub_field( 'slide_description' ),
        );
    }
}

if ( empty( $hero_slides ) ) {
    $asset_base = 'https://lightcyan-dinosaur-747226.hostingersite.com/wp-content/themes/hello-elementor-child-ci360/assets/images';
    $hero_slides = array(
        array(
            'image' => $asset_base . '/DESIGN_1600x900.jpg',
            'title' => 'Brand Architecture & Design',
            'tag'   => 'Visual Moats',
            'desc'  => 'Crafting iconic visual identities, packaging, and design systems that define category leaders.',
        ),
        array(
            'image' => $asset_base . '/bulb-2.png',
            'title' => 'Strategic Storytelling',
            'tag'   => 'Creative Strategy',
            'desc'  => 'Unlocking profound business insights to build emotional resonance and enduring client trust.',
        ),
        array(
            'image' => $asset_base . '/MEDIA_1600x900.jpg',
            'title' => 'Commercial Film & Media',
            'tag'   => 'Production',
            'desc'  => 'High-touch cinematography, national TVCs, and high-impact digital campaigns.',
        ),
        array(
            'image'    => $asset_base . '/ANIMATION_1600x900.jpg',
            'videoUrl' => 'https://lightcyan-dinosaur-747226.hostingersite.com/wp-content/uploads/2026/09/WhatsApp-Video-2026-09-08-at-15.18.30.mp4',
            'title'    => '3D CGI & Motion Graphics',
            'tag'      => 'Project',
            'desc'     => 'Photorealistic 3D product visualizations, virtual environments, and motion narratives.',
        ),
        array(
            'image' => $asset_base . '/WEB_1600x900.jpg',
            'title' => 'Websites & Digital Experiences',
            'tag'   => 'Engineering',
            'desc'  => 'Sub-second Next.js architectures, headless CMS integrations, and conversion-optimized UX.',
        ),
        array(
            'image' => $asset_base . '/podcast1.png',
            'title' => 'Sound-Treated 4K Studios',
            'tag'   => 'Broadcasting',
            'desc'  => 'In-house broadcast audio podcast suites, multi-cam capture, and transatlantic live bridges.',
        ),
    );
}

$first_slide = $hero_slides[0] ?? array();
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
   SCOPED HERO SECTION STYLES - ZERO PINK, PURE CYAN & BLUE
========================================================= */
#ci360-elementor-hero {
    position: relative;
    min-height: 90vh;
    display: flex;
    align-items: center;
    background-color: #020617;
    color: #ffffff;
    font-family: 'Inter', sans-serif;
    overflow: hidden;
    padding: 110px 24px 70px 24px;
    box-sizing: border-box;
}

@media (min-width: 1024px) {
    #ci360-elementor-hero {
        padding: 130px 48px 80px 48px;
    }
}

#ci360-elementor-hero * {
    box-sizing: border-box;
}

/* Background Gradients & Glows */
#ci360-elementor-hero .hero-bg-layer {
    position: absolute;
    inset: 0;
    pointer-events: none;
    overflow: hidden;
}

#ci360-elementor-hero .hero-glow-1 {
    position: absolute;
    top: 20%;
    left: 15%;
    width: 600px;
    height: 450px;
    background: rgba(6, 182, 212, 0.12);
    border-radius: 9999px;
    filter: blur(140px);
}

#ci360-elementor-hero .hero-glow-2 {
    position: absolute;
    bottom: 40px;
    right: 40px;
    width: 550px;
    height: 400px;
    background: rgba(37, 99, 235, 0.15);
    border-radius: 9999px;
    filter: blur(150px);
}

/* Glass Showcase Card - ALIGNED WITH LEFT HEADLINE & CTA */
#ci360-elementor-hero .hero-glass-card {
    background: rgba(15, 23, 42, 0.85) !important;
    border: 1px solid rgba(51, 65, 85, 0.8) !important;
    backdrop-filter: blur(20px) !important;
    -webkit-backdrop-filter: blur(20px) !important;
    border-radius: 24px !important;
    box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.6) !important;
    padding: 22px !important;
    transition: border-color 0.3s ease, box-shadow 0.3s ease !important;
    width: 100%;
}

#ci360-elementor-hero .hero-glass-card:hover {
    border-color: rgba(6, 182, 212, 0.45) !important;
    box-shadow: 0 25px 60px -15px rgba(6, 182, 212, 0.18) !important;
}

/* Video & Media Box - SIZED TO ALIGN WITH CTA BOTTOM */
#ci360-elementor-hero .hero-media-box {
    position: relative;
    width: 100%;
    height: 240px;
    border-radius: 18px;
    overflow: hidden;
    border: 1px solid rgba(51, 65, 85, 0.9);
    background-color: #0b1329;
}

@media (min-width: 640px) {
    #ci360-elementor-hero .hero-media-box {
        height: 280px;
    }
}

@media (min-width: 1024px) {
    #ci360-elementor-hero .hero-media-box {
        height: 275px;
    }
}

#ci360-elementor-hero .hero-media-box img,
#ci360-elementor-hero .hero-media-box video {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

/* Buttons */
#ci360-elementor-hero .btn-primary {
    background-color: #06b6d4;
    color: #020617;
    font-weight: 700;
    font-size: 14px;
    padding: 13px 30px;
    border-radius: 9999px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(6, 182, 212, 0.25);
    text-decoration: none;
}

#ci360-elementor-hero .btn-primary:hover {
    background-color: #22d3ee;
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(6, 182, 212, 0.4);
}

#ci360-elementor-hero .btn-secondary {
    background: rgba(15, 23, 42, 0.85);
    border: 1px solid rgba(51, 65, 85, 0.85);
    color: #ffffff;
    font-weight: 600;
    font-size: 14px;
    padding: 13px 28px;
    border-radius: 9999px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    text-decoration: none;
    backdrop-filter: blur(8px);
}

#ci360-elementor-hero .btn-secondary:hover {
    background: rgba(30, 41, 59, 0.95);
    border-color: rgba(6, 182, 212, 0.6);
    color: #38bdf8;
    transform: translateY(-2px);
}

/* Stat Box */
#ci360-elementor-hero .stat-card {
    background: rgba(15, 23, 42, 0.65);
    border: 1px solid rgba(51, 65, 85, 0.8);
    backdrop-filter: blur(10px);
    border-radius: 14px;
    padding: 12px 14px;
}

/* Controls - Clean Blue & Cyan ONLY (No Pink) */
#ci360-elementor-hero .hero-nav-btn {
    width: 40px !important;
    height: 40px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 12px !important;
    background: rgba(15, 23, 42, 0.9) !important;
    border: 1px solid rgba(51, 65, 85, 0.8) !important;
    color: #38bdf8 !important;
    transition: all 0.25s ease !important;
    cursor: pointer !important;
    outline: none !important;
    box-shadow: none !important;
}

#ci360-elementor-hero .hero-nav-btn:hover {
    background: #06b6d4 !important;
    border-color: #06b6d4 !important;
    color: #020617 !important;
    transform: scale(1.05) !important;
    box-shadow: 0 6px 18px rgba(6, 182, 212, 0.3) !important;
}

#ci360-elementor-hero .hero-dot-btn {
    height: 7px !important;
    border-radius: 9999px !important;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
    border: 1px solid rgba(51, 65, 85, 0.6) !important;
    background: rgba(30, 41, 59, 0.8) !important;
    padding: 0 !important;
    cursor: pointer !important;
    outline: none !important;
}

#ci360-elementor-hero .hero-dot-btn.active {
    width: 28px !important;
    background: #06b6d4 !important;
    border-color: #06b6d4 !important;
    box-shadow: 0 2px 8px rgba(6, 182, 212, 0.4) !important;
}

#ci360-elementor-hero .hero-dot-btn:not(.active) {
    width: 7px !important;
}

#ci360-elementor-hero .hero-dot-btn:not(.active):hover {
    background: rgba(56, 189, 248, 0.5) !important;
    border-color: #38bdf8 !important;
}
</style>

<div id="ci360-elementor-hero">
  <!-- Background Layers -->
  <div class="hero-bg-layer">
    <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-[2px]"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/85 to-slate-950/60"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-slate-950/70"></div>
    <div class="hero-glow-1"></div>
    <div class="hero-glow-2"></div>
  </div>

  <div class="relative z-10 max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
    <!-- Left Hero Column -->
    <div class="lg:col-span-6 flex flex-col justify-between space-y-7 text-left">
      <div class="space-y-6">
        <!-- Badge -->
        <?php if ( ! empty( $hero_badge ) ) : ?>
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-300 text-xs font-semibold uppercase tracking-widest backdrop-blur-md">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-cyan-400">
            <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
            <path d="M20 3v4"></path>
            <path d="M22 5h-4"></path>
            <path d="M4 17v2"></path>
            <path d="M5 18H3"></path>
          </svg> 
          <?php echo esc_html( $hero_badge ); ?>
        </div>
        <?php endif; ?>

        <!-- Main Headline -->
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-[1.1] text-white">
          <?php echo esc_html( $hero_title_pre ); ?> <br/>
          <?php if ( ! empty( $hero_title_high ) ) : ?>
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 via-blue-400 to-indigo-300"><?php echo esc_html( $hero_title_high ); ?></span> <br/>
          <?php endif; ?>
          <?php echo esc_html( $hero_title_post ); ?>
        </h1>

        <!-- Description -->
        <?php if ( ! empty( $hero_desc ) ) : ?>
        <p class="text-base sm:text-lg text-slate-300 max-w-xl leading-relaxed font-light">
          <?php echo esc_html( $hero_desc ); ?>
        </p>
        <?php endif; ?>

        <!-- Action Buttons -->
        <div class="flex flex-wrap items-center gap-4 pt-1">
          <?php if ( ! empty( $hero_btn1_text ) ) : ?>
          <a class="btn-primary group" href="<?php echo esc_url( $hero_btn1_url ); ?>">
            <?php echo esc_html( $hero_btn1_text ); ?> 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform">
              <path d="M5 12h14"></path>
              <path d="m12 5 7 7-7 7"></path>
            </svg>
          </a>
          <?php endif; ?>
          <?php if ( ! empty( $hero_btn2_text ) ) : ?>
          <a class="btn-secondary group" href="<?php echo esc_url( $hero_btn2_url ); ?>">
            <?php echo esc_html( $hero_btn2_text ); ?> 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform">
              <path d="M7 7h10v10"></path>
              <path d="M7 17 17 7"></path>
            </svg>
          </a>
          <?php endif; ?>
        </div>
      </div>

      <!-- Live Metric Grid -->
      <?php if ( ! empty( $hero_stats ) ) : ?>
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-6 border-t border-slate-800/80 text-left">
        <?php foreach ( $hero_stats as $st ) : ?>
        <div class="stat-card">
          <p class="text-xl font-bold font-mono <?php echo esc_attr( $st['color'] ); ?>"><?php echo esc_html( $st['value'] ); ?></p>
          <p class="text-[10px] text-slate-400 font-mono mt-0.5 uppercase tracking-wide"><?php echo esc_html( $st['label'] ); ?></p>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>

    <!-- Right Showcase Card Column - PRECISELY ALIGNED -->
    <div class="lg:col-span-6 flex flex-col justify-start">
      <div class="hero-glass-card space-y-4">
        <!-- Top Status Bar -->
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-cyan-400 animate-pulse"></span>
            <span id="ci360-hero-counter" class="text-xs font-mono uppercase tracking-widest text-cyan-300 font-semibold">Showcase 1 / <?php echo count( $hero_slides ); ?></span>
          </div>
          <span id="ci360-hero-tag" class="px-3 py-1 rounded-full bg-slate-800/90 text-xs font-mono text-slate-300 border border-slate-700"><?php echo esc_html( $first_slide['tag'] ?? 'Showcase' ); ?></span>
        </div>

        <!-- Dynamic Media Card (Image or Video) -->
        <div class="hero-media-box group shadow-2xl">
          <img id="ci360-hero-img" src="<?php echo esc_url( $first_slide['image'] ?? '' ); ?>" alt="<?php echo esc_attr( $first_slide['title'] ?? '' ); ?>" />
          <video id="ci360-hero-video" class="hidden" autoplay muted loop playsinline></video>
          
          <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent pointer-events-none"></div>
          <div class="absolute bottom-4 left-4 right-4 z-10 pointer-events-none">
            <h3 id="ci360-hero-title" class="text-base md:text-lg font-bold text-white"><?php echo esc_html( $first_slide['title'] ?? '' ); ?></h3>
            <p id="ci360-hero-desc" class="text-xs md:text-sm text-slate-300 font-light line-clamp-2 mt-0.5 leading-relaxed"><?php echo esc_html( $first_slide['desc'] ?? '' ); ?></p>
          </div>
        </div>

        <!-- Slider Controls & Dots - PURE CYAN / BLUE -->
        <div class="flex items-center justify-between pt-1">
          <div class="flex items-center gap-2" id="ci360-hero-dots">
            <?php foreach ( $hero_slides as $i => $s ) : ?>
            <button class="hero-dot-btn <?php echo 0 === $i ? 'active' : ''; ?>" aria-label="Go to slide <?php echo esc_attr( (string) ( $i + 1 ) ); ?>"></button>
            <?php endforeach; ?>
          </div>

          <div class="flex items-center gap-2.5">
            <button id="ci360-hero-prev" class="hero-nav-btn" title="Previous slide" aria-label="Previous slide">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6"></path>
              </svg>
            </button>
            <button id="ci360-hero-next" class="hero-nav-btn" title="Next slide" aria-label="Next slide">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
(function() {
  const HERO_SLIDES = <?php echo wp_json_encode( $hero_slides ); ?>;
  let currentSlide = 0;
  let autoplayTimer = null;

  function init() {
    const cardImg = document.getElementById('ci360-hero-img');
    const cardVideo = document.getElementById('ci360-hero-video');
    const cardTitle = document.getElementById('ci360-hero-title');
    const cardDesc = document.getElementById('ci360-hero-desc');
    const cardTag = document.getElementById('ci360-hero-tag');
    const counterSpan = document.getElementById('ci360-hero-counter');
    const dotsContainer = document.getElementById('ci360-hero-dots');
    const prevBtn = document.getElementById('ci360-hero-prev');
    const nextBtn = document.getElementById('ci360-hero-next');

    if (!cardImg || !cardTitle) return;

    const dots = dotsContainer ? dotsContainer.querySelectorAll('.hero-dot-btn') : [];

    function setSlide(index) {
      currentSlide = (index + HERO_SLIDES.length) % HERO_SLIDES.length;
      const slide = HERO_SLIDES[currentSlide];

      if (slide.videoUrl) {
        if (cardVideo) {
          if (!cardVideo.src || !cardVideo.src.includes(slide.videoUrl)) {
            cardVideo.src = slide.videoUrl;
          }
          cardVideo.classList.remove('hidden');
          cardVideo.style.display = 'block';
          cardVideo.play().catch(function() {});
        }
        if (cardImg) {
          cardImg.classList.add('hidden');
          cardImg.style.display = 'none';
        }
      } else {
        if (cardVideo) {
          cardVideo.pause();
          cardVideo.classList.add('hidden');
          cardVideo.style.display = 'none';
        }
        if (cardImg) {
          cardImg.src = slide.image;
          cardImg.classList.remove('hidden');
          cardImg.style.display = 'block';
        }
      }

      if (cardTitle) cardTitle.textContent = slide.title || '';
      if (cardDesc) cardDesc.textContent = slide.desc || '';
      if (cardTag) cardTag.textContent = slide.tag || 'Showcase';
      if (counterSpan) counterSpan.innerHTML = 'Showcase ' + (currentSlide + 1) + ' / ' + HERO_SLIDES.length;

      dots.forEach(function(dot, i) {
        if (i === currentSlide) {
          dot.classList.add('active');
        } else {
          dot.classList.remove('active');
        }
      });
    }

    function startAutoplay() {
      stopAutoplay();
      autoplayTimer = setInterval(function() {
        setSlide(currentSlide + 1);
      }, 4500);
    }

    function stopAutoplay() {
      if (autoplayTimer) clearInterval(autoplayTimer);
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', function(e) {
        e.preventDefault();
        setSlide(currentSlide + 1);
        startAutoplay();
      });
    }

    if (prevBtn) {
      prevBtn.addEventListener('click', function(e) {
        e.preventDefault();
        setSlide(currentSlide - 1);
        startAutoplay();
      });
    }

    dots.forEach(function(dot, i) {
      dot.addEventListener('click', function(e) {
        e.preventDefault();
        setSlide(i);
        startAutoplay();
      });
    });

    setSlide(0);
    startAutoplay();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>
