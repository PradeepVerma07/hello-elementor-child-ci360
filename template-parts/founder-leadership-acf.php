<?php
/**
 * Dynamic ACF Founder Page - Second Section (Executive Leadership Profiles)
 * Clean executive profile cards with NO logo overlay on images.
 *
 * @package HelloElementorChildCI360ACF
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'ci360_get_fnd_val' ) ) {
    function ci360_get_fnd_val( $field_name, $default = '' ) {
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
        $post_meta = get_post_meta( get_the_ID(), $field_name, true );
        if ( ! empty( $post_meta ) ) {
            return $post_meta;
        }
        return $default;
    }
}

// 1. Founder 1: Pramit Ghosh
$f1_name     = ci360_get_fnd_val( 'f1_name', 'Pramit Ghosh' );
$f1_role     = ci360_get_fnd_val( 'f1_role', 'Founder & Chief Executive Officer' );
$f1_location = ci360_get_fnd_val( 'f1_location', 'Ahmedabad HQ & Global Strategy' );
$f1_image    = ci360_get_fnd_val( 'f1_image_url', 'https://lightcyan-dinosaur-747226.hostingersite.com/wp-content/themes/hello-elementor-child-ci360/assets/images/team/pramit-ghosh.webp' );
$f1_linkedin = ci360_get_fnd_val( 'f1_linkedin_url', 'https://www.linkedin.com/in/pramitghosh/' );
$f1_bio      = ci360_get_fnd_val( 'f1_bio', 'Pramit is a seasoned brand architect and communication strategist with over two decades of experience helping enterprises build enduring market authority. Prior to founding CI360, he spearheaded national and international campaigns across telecom, healthcare, and infrastructure.' );
$f1_quote    = ci360_get_fnd_val( 'f1_quote', 'We founded CI360 on a simple, uncompromising premise: marketing shouldn\'t be an expensive collection of fragmented agency silos. When strategy, cinema, and digital engineering work as one unified organism, brands don\'t just get noticed—they dominate their category and create lasting commercial value.' );
$f1_f1       = ci360_get_fnd_val( 'f1_focus1', 'Diagnostic Commercial Strategy' );
$f1_f2       = ci360_get_fnd_val( 'f1_focus2', 'Brand Narrative Architecture' );
$f1_f3       = ci360_get_fnd_val( 'f1_focus3', 'Enterprise Growth Modeling' );
$f1_f4       = ci360_get_fnd_val( 'f1_focus4', 'Keynote & Executive Positioning' );

// 2. Founder 2: Aashit Shah
$f2_name     = ci360_get_fnd_val( 'f2_name', 'Aashit Shah' );
$f2_role     = ci360_get_fnd_val( 'f2_role', 'Co-Founder & Director' );
$f2_location = ci360_get_fnd_val( 'f2_location', 'Corporate Governance & Global Alliances' );
$f2_image    = ci360_get_fnd_val( 'f2_image_url', 'https://lightcyan-dinosaur-747226.hostingersite.com/wp-content/themes/hello-elementor-child-ci360/assets/images/team/aashit-shah.jpg' );
$f2_linkedin = ci360_get_fnd_val( 'f2_linkedin_url', 'https://www.linkedin.com/company/ci360degrees/' );
$f2_bio      = ci360_get_fnd_val( 'f2_bio', 'Aashit brings extensive executive leadership in corporate advisory, global client expansion, and multi-market business operations. He oversees strategic alliances, high-touch enterprise client relationships, and transatlantic operational delivery across India and the United States.' );
$f2_quote    = ci360_get_fnd_val( 'f2_quote', 'Our commitment to clients is transparency and accountability. We eliminate the \'mediocrity tax\' of traditional retainers by ensuring every rupee invested in CI360 connects directly to visibility, qualified pipeline, and measurable enterprise valuation.' );
$f2_f1       = ci360_get_fnd_val( 'f2_focus1', 'Transatlantic Client Alliances' );
$f2_f2       = ci360_get_fnd_val( 'f2_focus2', 'Global Operational Agility' );
$f2_f3       = ci360_get_fnd_val( 'f2_focus3', 'Institutional Relationship Governance' );
$f2_f4       = ci360_get_fnd_val( 'f2_focus4', 'Commercial Deal Structuring' );
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
   SCOPED FOUNDER SECTION TWO STYLES - ZERO PINK, PURE CYAN & BLUE
========================================================= */
#ci360-founder-profiles-section {
    position: relative;
    background-color: #020617;
    color: #ffffff;
    font-family: 'Inter', sans-serif;
    padding: 100px 24px 110px 24px;
    box-sizing: border-box;
    overflow: hidden;
    border-bottom: 1px solid rgba(51, 65, 85, 0.8);
}

@media (min-width: 1024px) {
    #ci360-founder-profiles-section {
        padding: 120px 48px 130px 48px;
    }
}

#ci360-founder-profiles-section * {
    box-sizing: border-box;
}

/* Background Ambient Glows */
#ci360-founder-profiles-section .fnd-glow-1 {
    position: absolute;
    top: 20%;
    left: 5%;
    width: 550px;
    height: 550px;
    background: rgba(6, 182, 212, 0.08);
    border-radius: 9999px;
    filter: blur(160px);
    pointer-events: none;
}

#ci360-founder-profiles-section .fnd-glow-2 {
    position: absolute;
    bottom: 20%;
    right: 5%;
    width: 520px;
    height: 520px;
    background: rgba(37, 99, 235, 0.09);
    border-radius: 9999px;
    filter: blur(170px);
    pointer-events: none;
}

/* Executive Card Container */
#ci360-founder-profiles-section .fnd-card {
    background: rgba(15, 23, 42, 0.7);
    border: 1px solid rgba(51, 65, 85, 0.85);
    border-radius: 28px;
    padding: 36px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.45);
    backdrop-filter: blur(14px);
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

@media (min-width: 768px) {
    #ci360-founder-profiles-section .fnd-card {
        padding: 48px;
    }
}

#ci360-founder-profiles-section .fnd-card:hover {
    border-color: rgba(6, 182, 212, 0.65);
    box-shadow: 0 24px 60px rgba(6, 182, 212, 0.18);
}

/* Founder Portrait Wrap (NO LOGO) */
#ci360-founder-profiles-section .fnd-portrait-wrap {
    position: relative;
    width: 100%;
    max-width: 380px;
    height: 480px;
    border-radius: 24px;
    overflow: hidden;
    background-color: #0f172a;
    border: 1px solid rgba(51, 65, 85, 0.9);
    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.5);
}

#ci360-founder-profiles-section .fnd-portrait-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

#ci360-founder-profiles-section .fnd-card:hover .fnd-portrait-img {
    transform: scale(1.04);
}

/* Bottom Portrait Pill */
#ci360-founder-profiles-section .fnd-portrait-bottom-info {
    position: absolute;
    bottom: 16px;
    left: 16px;
    right: 16px;
    background: rgba(2, 6, 23, 0.88);
    backdrop-filter: blur(12px);
    padding: 16px 20px;
    border-radius: 18px;
    border: 1px solid rgba(51, 65, 85, 0.8);
    z-index: 2;
}

/* Quote Callout Box */
#ci360-founder-profiles-section .fnd-quote-box {
    padding: 24px 28px;
    border-radius: 20px;
    background: rgba(6, 182, 212, 0.06);
    border: 1px solid rgba(6, 182, 212, 0.28);
    position: relative;
    box-shadow: inset 0 2px 10px rgba(6, 182, 212, 0.05);
}

/* Check Icons */
#ci360-founder-profiles-section .fnd-check-icon {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: rgba(6, 182, 212, 0.15);
    border: 1px solid rgba(6, 182, 212, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #38bdf8;
    flex-shrink: 0;
}
</style>

<section id="ci360-founder-profiles-section">
  <!-- Ambient Lights -->
  <div class="fnd-glow-1"></div>
  <div class="fnd-glow-2"></div>

  <div class="max-w-7xl mx-auto relative z-10 space-y-20">
    
    <!-- =========================================================================
         FOUNDER 1: PRAMIT GHOSH (Founder & CEO)
    ========================================================================= -->
    <div class="fnd-card grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      
      <!-- Left: Portrait Photo (Clean - No Logo) -->
      <div class="lg:col-span-5 flex justify-center">
        <div class="fnd-portrait-wrap group">
          <img src="<?php echo esc_url( $f1_image ); ?>" alt="<?php echo esc_attr( $f1_name ); ?>" class="fnd-portrait-img" />
          <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent"></div>
          
          <div class="fnd-portrait-bottom-info">
            <h3 class="text-lg font-bold text-white"><?php echo esc_html( $f1_name ); ?></h3>
            <p class="text-xs text-cyan-300 font-mono font-medium"><?php echo esc_html( $f1_role ); ?></p>
            <p class="text-[11px] text-slate-400 font-mono mt-0.5"><?php echo esc_html( $f1_location ); ?></p>
          </div>
        </div>
      </div>

      <!-- Right: Biography, Quote & Strategic Focus -->
      <div class="lg:col-span-7 space-y-6 text-left">
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-800 pb-5">
          <div>
            <span class="text-xs font-mono font-semibold text-cyan-400 uppercase tracking-widest"><?php echo esc_html( $f1_role ); ?></span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1"><?php echo esc_html( $f1_name ); ?></h2>
          </div>
          <?php if ( ! empty( $f1_linkedin ) ) : ?>
          <a href="<?php echo esc_url( $f1_linkedin ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-600/15 border border-blue-500/35 text-blue-400 text-xs font-semibold hover:bg-blue-600 hover:text-white transition-all shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
              <rect width="4" height="12" x="2" y="9"></rect>
              <circle cx="4" cy="4" r="2"></circle>
            </svg> 
            Connect on LinkedIn
          </a>
          <?php endif; ?>
        </div>

        <p class="text-sm sm:text-base text-slate-300 font-light leading-relaxed">
          <?php echo esc_html( $f1_bio ); ?>
        </p>

        <!-- Founder's Note Callout -->
        <div class="fnd-quote-box space-y-3">
          <div class="flex items-center gap-2 text-cyan-400">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
              <path d="M16 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"></path>
              <path d="M5 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"></path>
            </svg>
            <span class="text-xs font-mono font-bold uppercase tracking-wider">Founder's Note</span>
          </div>
          <p class="text-xs sm:text-sm text-slate-200 font-light italic leading-relaxed">
            "<?php echo esc_html( $f1_quote ); ?>"
          </p>
        </div>

        <!-- Strategic Focus & Mastery -->
        <div class="space-y-3 pt-2">
          <span class="text-xs font-mono text-slate-400 uppercase tracking-wider block">Strategic Focus &amp; Mastery:</span>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            <div class="flex items-center gap-2.5 text-xs text-slate-200 font-light">
              <div class="fnd-check-icon">✓</div>
              <span><?php echo esc_html( $f1_f1 ); ?></span>
            </div>
            <div class="flex items-center gap-2.5 text-xs text-slate-200 font-light">
              <div class="fnd-check-icon">✓</div>
              <span><?php echo esc_html( $f1_f2 ); ?></span>
            </div>
            <div class="flex items-center gap-2.5 text-xs text-slate-200 font-light">
              <div class="fnd-check-icon">✓</div>
              <span><?php echo esc_html( $f1_f3 ); ?></span>
            </div>
            <div class="flex items-center gap-2.5 text-xs text-slate-200 font-light">
              <div class="fnd-check-icon">✓</div>
              <span><?php echo esc_html( $f1_f4 ); ?></span>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- =========================================================================
         FOUNDER 2: AASHIT SHAH (Co-Founder & Director)
    ========================================================================= -->
    <div class="fnd-card grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      
      <!-- Left: Portrait Photo (Clean - No Logo) -->
      <div class="lg:col-span-5 flex justify-center">
        <div class="fnd-portrait-wrap group">
          <img src="<?php echo esc_url( $f2_image ); ?>" alt="<?php echo esc_attr( $f2_name ); ?>" class="fnd-portrait-img" />
          <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent"></div>
          
          <div class="fnd-portrait-bottom-info">
            <h3 class="text-lg font-bold text-white"><?php echo esc_html( $f2_name ); ?></h3>
            <p class="text-xs text-cyan-300 font-mono font-medium"><?php echo esc_html( $f2_role ); ?></p>
            <p class="text-[11px] text-slate-400 font-mono mt-0.5"><?php echo esc_html( $f2_location ); ?></p>
          </div>
        </div>
      </div>

      <!-- Right: Biography, Quote & Strategic Focus -->
      <div class="lg:col-span-7 space-y-6 text-left">
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-800 pb-5">
          <div>
            <span class="text-xs font-mono font-semibold text-cyan-400 uppercase tracking-widest"><?php echo esc_html( $f2_role ); ?></span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1"><?php echo esc_html( $f2_name ); ?></h2>
          </div>
          <?php if ( ! empty( $f2_linkedin ) ) : ?>
          <a href="<?php echo esc_url( $f2_linkedin ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-600/15 border border-blue-500/35 text-blue-400 text-xs font-semibold hover:bg-blue-600 hover:text-white transition-all shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
              <rect width="4" height="12" x="2" y="9"></rect>
              <circle cx="4" cy="4" r="2"></circle>
            </svg> 
            Connect on LinkedIn
          </a>
          <?php endif; ?>
        </div>

        <p class="text-sm sm:text-base text-slate-300 font-light leading-relaxed">
          <?php echo esc_html( $f2_bio ); ?>
        </p>

        <!-- Founder's Note Callout -->
        <div class="fnd-quote-box space-y-3">
          <div class="flex items-center gap-2 text-cyan-400">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
              <path d="M16 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"></path>
              <path d="M5 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"></path>
            </svg>
            <span class="text-xs font-mono font-bold uppercase tracking-wider">Founder's Note</span>
          </div>
          <p class="text-xs sm:text-sm text-slate-200 font-light italic leading-relaxed">
            "<?php echo esc_html( $f2_quote ); ?>"
          </p>
        </div>

        <!-- Strategic Focus & Mastery -->
        <div class="space-y-3 pt-2">
          <span class="text-xs font-mono text-slate-400 uppercase tracking-wider block">Strategic Focus &amp; Mastery:</span>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            <div class="flex items-center gap-2.5 text-xs text-slate-200 font-light">
              <div class="fnd-check-icon">✓</div>
              <span><?php echo esc_html( $f2_f1 ); ?></span>
            </div>
            <div class="flex items-center gap-2.5 text-xs text-slate-200 font-light">
              <div class="fnd-check-icon">✓</div>
              <span><?php echo esc_html( $f2_f2 ); ?></span>
            </div>
            <div class="flex items-center gap-2.5 text-xs text-slate-200 font-light">
              <div class="fnd-check-icon">✓</div>
              <span><?php echo esc_html( $f2_f3 ); ?></span>
            </div>
            <div class="flex items-center gap-2.5 text-xs text-slate-200 font-light">
              <div class="fnd-check-icon">✓</div>
              <span><?php echo esc_html( $f2_f4 ); ?></span>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</section>
