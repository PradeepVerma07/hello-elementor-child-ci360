<?php
/**
 * Dynamic ACF Foundational Pillars (Vision, Mission, Values) Section
 *
 * @package HelloElementorChildCI360ACF
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'ci360_get_fpil_val' ) ) {
    function ci360_get_fpil_val( $field_name, $default = '' ) {
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

// 1. Section Header & Badges
$pillars_badge     = ci360_get_fpil_val( 'pillars_badge_text', 'Foundational Pillars' );
$pillars_title     = ci360_get_fpil_val( 'pillars_title_text', 'Vision. Mission. Values.' );
$pillars_desc      = ci360_get_fpil_val( 'pillars_description', 'The foundational compass guiding our culture, client partnerships, and creative rigor.' );

// 2. Pillar 1: Vision
$p1_tag   = ci360_get_fpil_val( 'p1_tag', 'Pillar 01' );
$p1_title = ci360_get_fpil_val( 'p1_title', 'Our Vision' );
$p1_sub   = ci360_get_fpil_val( 'p1_subtitle', 'Architecting Tomorrow\'s Brand Ecosystems' );
$p1_desc  = ci360_get_fpil_val( 'p1_description', 'To be the premier global catalyst where visionary thinking, generative intelligence, and sensory storytelling converge to redefine how enterprises connect with humanity.' );
$p1_b1    = ci360_get_fpil_val( 'p1_bullet1', 'Continuous technological evolution' );
$p1_b2    = ci360_get_fpil_val( 'p1_bullet2', 'Cross-border enterprise scale & reach' );
$p1_b3    = ci360_get_fpil_val( 'p1_bullet3', 'Zero-compromise aesthetic excellence' );

// 3. Pillar 2: Mission
$p2_tag   = ci360_get_fpil_val( 'p2_tag', 'Pillar 02' );
$p2_title = ci360_get_fpil_val( 'p2_title', 'Our Mission' );
$p2_sub   = ci360_get_fpil_val( 'p2_subtitle', 'Engineering Measurable Growth & Impact' );
$p2_desc  = ci360_get_fpil_val( 'p2_description', 'Empower transformative brands through precision digital infrastructure, multi-channel marketing velocity, and bespoke brand narratives that convert complexity into clear competitive advantage.' );
$p2_b1    = ci360_get_fpil_val( 'p2_bullet1', 'Data-backed performance engines' );
$p2_b2    = ci360_get_fpil_val( 'p2_bullet2', 'Seamless full-stack digital integration' );
$p2_b3    = ci360_get_fpil_val( 'p2_bullet3', 'High-velocity, transparent delivery' );

// 4. Pillar 3: Values
$p3_tag   = ci360_get_fpil_val( 'p3_tag', 'Pillar 03' );
$p3_title = ci360_get_fpil_val( 'p3_title', 'Core Values' );
$p3_sub   = ci360_get_fpil_val( 'p3_subtitle', 'Uncompromising Rigor & Authenticity' );
$p3_desc  = ci360_get_fpil_val( 'p3_description', 'Our work is anchored in deep integrity, relentless craft perfection, radical empathy for user experiences, and enduring long-term client partnership stewardship.' );
$p3_b1    = ci360_get_fpil_val( 'p3_bullet1', 'Obsessive craft & typographic rigor' );
$p3_b2    = ci360_get_fpil_val( 'p3_bullet2', 'Radical transparency & complete ownership' );
$p3_b3    = ci360_get_fpil_val( 'p3_bullet3', 'Scalable client-first collaboration' );
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
   SCOPED FOUNDATIONAL PILLARS STYLES - ZERO PINK, PURE CYAN & BLUE
========================================================= */
#ci360-pillars-section {
    position: relative;
    background-color: #020617;
    color: #ffffff;
    font-family: 'Inter', sans-serif;
    padding: 100px 24px 90px 24px;
    box-sizing: border-box;
    overflow: hidden;
    border-bottom: 1px solid rgba(51, 65, 85, 0.8);
}

@media (min-width: 1024px) {
    #ci360-pillars-section {
        padding: 120px 48px 110px 48px;
    }
}

#ci360-pillars-section * {
    box-sizing: border-box;
}

/* Background Ambient Glows */
#ci360-pillars-section .pillars-glow-1 {
    position: absolute;
    top: 15%;
    left: 10%;
    width: 500px;
    height: 500px;
    background: rgba(6, 182, 212, 0.07);
    border-radius: 9999px;
    filter: blur(150px);
    pointer-events: none;
}

#ci360-pillars-section .pillars-glow-2 {
    position: absolute;
    bottom: 10%;
    right: 10%;
    width: 480px;
    height: 480px;
    background: rgba(37, 99, 235, 0.08);
    border-radius: 9999px;
    filter: blur(160px);
    pointer-events: none;
}

/* Pillar Card Styles */
#ci360-pillars-section .pillar-card {
    position: relative;
    background: rgba(15, 23, 42, 0.75);
    border: 1px solid rgba(51, 65, 85, 0.85);
    border-radius: 24px;
    padding: 38px 32px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 24px;
    backdrop-filter: blur(12px);
    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.4);
    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
}

#ci360-pillars-section .pillar-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(6, 182, 212, 0.6), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

#ci360-pillars-section .pillar-card:hover {
    transform: translateY(-6px);
    border-color: rgba(6, 182, 212, 0.7);
    box-shadow: 0 24px 50px rgba(6, 182, 212, 0.18);
}

#ci360-pillars-section .pillar-card:hover::before {
    opacity: 1;
}

/* Icon Wrap */
#ci360-pillars-section .pillar-icon-wrap {
    width: 58px;
    height: 58px;
    border-radius: 18px;
    background: linear-gradient(135deg, rgba(6, 182, 212, 0.15), rgba(37, 99, 235, 0.15));
    border: 1px solid rgba(6, 182, 212, 0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #38bdf8;
    box-shadow: 0 8px 20px rgba(6, 182, 212, 0.2);
    transition: transform 0.3s ease, background 0.3s ease, color 0.3s ease;
}

#ci360-pillars-section .pillar-card:hover .pillar-icon-wrap {
    transform: scale(1.08) rotate(3deg);
    background: linear-gradient(135deg, #0284c7, #06b6d4);
    color: #ffffff;
    box-shadow: 0 10px 25px rgba(6, 182, 212, 0.4);
}

/* Typography & Titles - No hover color change */
#ci360-pillars-section .pillar-card-title {
    color: #ffffff !important;
    font-size: 22px !important;
    font-weight: 800 !important;
    line-height: 1.3 !important;
    margin: 0 !important;
}

#ci360-pillars-section .pillar-card:hover .pillar-card-title {
    color: #ffffff !important;
}
</style>

<section id="ci360-pillars-section">
  <!-- Ambient Lighting -->
  <div class="pillars-glow-1"></div>
  <div class="pillars-glow-2"></div>

  <div class="max-w-7xl mx-auto relative z-10">
    <!-- Top Header -->
    <div class="text-center max-w-3xl mx-auto mb-16">
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-cyan-950/60 border border-cyan-500/30 text-cyan-400 text-xs font-semibold uppercase tracking-widest mb-4 shadow-sm">
        <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
        <?php echo esc_html( $pillars_badge ); ?>
      </div>
      <h2 class="text-3xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-white mb-4">
        <?php echo esc_html( $pillars_title ); ?>
      </h2>
      <p class="text-sm md:text-base text-slate-400 font-light leading-relaxed">
        <?php echo esc_html( $pillars_desc ); ?>
      </p>
    </div>

    <!-- 3 Pillar Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Card 1: Vision -->
      <div class="pillar-card">
        <div>
          <div class="flex items-center justify-between mb-6">
            <div class="pillar-icon-wrap">
              <!-- Vision Eye / North Star Icon -->
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </div>
            <span class="text-xs font-mono font-semibold text-cyan-400 px-3 py-1 rounded-full bg-cyan-950/50 border border-cyan-800/60 uppercase tracking-wider">
              <?php echo esc_html( $p1_tag ); ?>
            </span>
          </div>

          <h3 class="pillar-card-title mb-2"><?php echo esc_html( $p1_title ); ?></h3>
          <h4 class="text-xs font-semibold text-cyan-400/90 uppercase tracking-wider mb-4"><?php echo esc_html( $p1_sub ); ?></h4>
          <p class="text-slate-300 text-sm font-light leading-relaxed mb-6">
            <?php echo esc_html( $p1_desc ); ?>
          </p>
        </div>

        <div class="pt-6 border-t border-slate-800/80 space-y-2.5">
          <div class="flex items-center gap-2.5 text-xs text-slate-300 font-medium">
            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 shrink-0"></span>
            <?php echo esc_html( $p1_b1 ); ?>
          </div>
          <div class="flex items-center gap-2.5 text-xs text-slate-300 font-medium">
            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 shrink-0"></span>
            <?php echo esc_html( $p1_b2 ); ?>
          </div>
          <div class="flex items-center gap-2.5 text-xs text-slate-300 font-medium">
            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 shrink-0"></span>
            <?php echo esc_html( $p1_b3 ); ?>
          </div>
        </div>
      </div>

      <!-- Card 2: Mission -->
      <div class="pillar-card">
        <div>
          <div class="flex items-center justify-between mb-6">
            <div class="pillar-icon-wrap">
              <!-- Mission Rocket / Target Icon -->
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path>
                <path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path>
                <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"></path>
                <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"></path>
              </svg>
            </div>
            <span class="text-xs font-mono font-semibold text-cyan-400 px-3 py-1 rounded-full bg-cyan-950/50 border border-cyan-800/60 uppercase tracking-wider">
              <?php echo esc_html( $p2_tag ); ?>
            </span>
          </div>

          <h3 class="pillar-card-title mb-2"><?php echo esc_html( $p2_title ); ?></h3>
          <h4 class="text-xs font-semibold text-cyan-400/90 uppercase tracking-wider mb-4"><?php echo esc_html( $p2_sub ); ?></h4>
          <p class="text-slate-300 text-sm font-light leading-relaxed mb-6">
            <?php echo esc_html( $p2_desc ); ?>
          </p>
        </div>

        <div class="pt-6 border-t border-slate-800/80 space-y-2.5">
          <div class="flex items-center gap-2.5 text-xs text-slate-300 font-medium">
            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 shrink-0"></span>
            <?php echo esc_html( $p2_b1 ); ?>
          </div>
          <div class="flex items-center gap-2.5 text-xs text-slate-300 font-medium">
            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 shrink-0"></span>
            <?php echo esc_html( $p2_b2 ); ?>
          </div>
          <div class="flex items-center gap-2.5 text-xs text-slate-300 font-medium">
            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 shrink-0"></span>
            <?php echo esc_html( $p2_b3 ); ?>
          </div>
        </div>
      </div>

      <!-- Card 3: Values -->
      <div class="pillar-card">
        <div>
          <div class="flex items-center justify-between mb-6">
            <div class="pillar-icon-wrap">
              <!-- Values Shield / Diamond Icon -->
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                <path d="m9 12 2 2 4-4"></path>
              </svg>
            </div>
            <span class="text-xs font-mono font-semibold text-cyan-400 px-3 py-1 rounded-full bg-cyan-950/50 border border-cyan-800/60 uppercase tracking-wider">
              <?php echo esc_html( $p3_tag ); ?>
            </span>
          </div>

          <h3 class="pillar-card-title mb-2"><?php echo esc_html( $p3_title ); ?></h3>
          <h4 class="text-xs font-semibold text-cyan-400/90 uppercase tracking-wider mb-4"><?php echo esc_html( $p3_sub ); ?></h4>
          <p class="text-slate-300 text-sm font-light leading-relaxed mb-6">
            <?php echo esc_html( $p3_desc ); ?>
          </p>
        </div>

        <div class="pt-6 border-t border-slate-800/80 space-y-2.5">
          <div class="flex items-center gap-2.5 text-xs text-slate-300 font-medium">
            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 shrink-0"></span>
            <?php echo esc_html( $p3_b1 ); ?>
          </div>
          <div class="flex items-center gap-2.5 text-xs text-slate-300 font-medium">
            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 shrink-0"></span>
            <?php echo esc_html( $p3_b2 ); ?>
          </div>
          <div class="flex items-center gap-2.5 text-xs text-slate-300 font-medium">
            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 shrink-0"></span>
            <?php echo esc_html( $p3_b3 ); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
