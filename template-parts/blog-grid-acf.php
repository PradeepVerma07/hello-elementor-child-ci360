<?php
/**
 * Dynamic Real WordPress Blog Grid with Premium Hero Section & Category Meta Controls
 *
 * @package HelloElementorChildCI360ACF
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'ci360_get_blog_val' ) ) {
    function ci360_get_blog_val( $field_name, $default = '' ) {
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

if ( ! function_exists( 'ci360_calc_reading_time' ) ) {
    function ci360_calc_reading_time( $content ) {
        $word_count = str_word_count( strip_tags( $content ) );
        $reading_time = ceil( $word_count / 200 );
        return max( 1, $reading_time );
    }
}

// 1. Hero Section Content & Media Controls
$hero_badge    = ci360_get_blog_val( 'blog_hero_badge', 'Editorial & Strategic Insights' );
$hero_pre      = ci360_get_blog_val( 'blog_hero_title_prefix', 'Perspectives That' );
$hero_high     = ci360_get_blog_val( 'blog_hero_title_highlight', 'Shape The Future' );
$hero_post     = ci360_get_blog_val( 'blog_hero_title_suffix', 'of Digital Leadership.' );
$hero_desc     = ci360_get_blog_val( 'blog_hero_description', 'Original frameworks, strategic foresight, and deep-dive analysis on digital architecture, brand velocity, and transformative technology.' );
$hero_img      = ci360_get_blog_val( 'blog_hero_image_url', 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1200&auto=format&fit=crop' );
$hero_video    = ci360_get_blog_val( 'blog_hero_video_url', '' );
$hero_card_tag = ci360_get_blog_val( 'blog_hero_card_tag', 'Executive Briefing' );
$hero_card_ttl = ci360_get_blog_val( 'blog_hero_card_title', 'Architecting Modern Enterprise Moats in the Age of AI' );
$hero_card_dsc = ci360_get_blog_val( 'blog_hero_card_desc', 'How forward-thinking brands bridge the gap between human storytelling and autonomous digital scale.' );

// 2. Query & Category Controls
$posts_per_pg    = intval( ci360_get_blog_val( 'blog_posts_per_page', 9 ) );
if ( $posts_per_pg <= 0 ) $posts_per_pg = 9;

$cat_include_raw = ci360_get_blog_val( 'blog_include_categories', '' );
$cat_exclude_raw = ci360_get_blog_val( 'blog_exclude_categories', '' );

$include_ids = array();
if ( ! empty( $cat_include_raw ) ) {
    if ( is_array( $cat_include_raw ) ) {
        $include_ids = array_map( 'intval', $cat_include_raw );
    } else {
        $parts = explode( ',', $cat_include_raw );
        foreach ( $parts as $p ) {
            $p = trim( $p );
            if ( is_numeric( $p ) ) {
                $include_ids[] = intval( $p );
            } else {
                $term = get_category_by_slug( $p );
                if ( $term ) $include_ids[] = $term->term_id;
            }
        }
    }
}

$exclude_ids = array();
if ( ! empty( $cat_exclude_raw ) ) {
    if ( is_array( $cat_exclude_raw ) ) {
        $exclude_ids = array_map( 'intval', $cat_exclude_raw );
    } else {
        $parts = explode( ',', $cat_exclude_raw );
        foreach ( $parts as $p ) {
            $p = trim( $p );
            if ( is_numeric( $p ) ) {
                $exclude_ids[] = intval( $p );
            } else {
                $term = get_category_by_slug( $p );
                if ( $term ) $exclude_ids[] = $term->term_id;
            }
        }
    }
}

// 3. Active Category Filter from URL
$active_cat_slug = isset( $_GET['blog_cat'] ) ? sanitize_text_field( $_GET['blog_cat'] ) : '';
$active_cat_id = 0;
if ( ! empty( $active_cat_slug ) ) {
    $active_term = get_category_by_slug( $active_cat_slug );
    if ( $active_term ) {
        $active_cat_id = $active_term->term_id;
    }
}

// 4. Build Categories List for Filter Tabs
$cat_args = array(
    'taxonomy'   => 'category',
    'hide_empty' => true,
);
if ( ! empty( $include_ids ) ) {
    $cat_args['include'] = $include_ids;
}
if ( ! empty( $exclude_ids ) ) {
    $cat_args['exclude'] = $exclude_ids;
}
$available_categories = get_terms( $cat_args );

// 5. Query Real WordPress Posts
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

$query_args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => $posts_per_pg,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

if ( $active_cat_id > 0 ) {
    $query_args['cat'] = $active_cat_id;
} else {
    if ( ! empty( $include_ids ) ) {
        $query_args['category__in'] = $include_ids;
    }
    if ( ! empty( $exclude_ids ) ) {
        $query_args['category__not_in'] = $exclude_ids;
    }
}

$blog_query = new WP_Query( $query_args );
$current_page_url = ! empty( $_SERVER["REQUEST_URI"] ) ? strtok( $_SERVER["REQUEST_URI"], '?' ) : get_permalink();
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
   SCOPED BLOG HERO & GRID STYLES - ZERO PINK, PURE CYAN & BLUE
========================================================= */
#ci360-blog-section {
    position: relative;
    background-color: #020617;
    color: #ffffff;
    font-family: 'Inter', sans-serif;
    padding: 80px 24px 100px 24px;
    box-sizing: border-box;
    overflow: hidden;
}

@media (min-width: 1024px) {
    #ci360-blog-section {
        padding: 90px 48px 120px 48px;
    }
}

#ci360-blog-section * {
    box-sizing: border-box;
}

/* Background Ambient Glows */
#ci360-blog-section .blog-glow-1 {
    position: absolute;
    top: 5%;
    left: 10%;
    width: 600px;
    height: 600px;
    background: rgba(6, 182, 212, 0.08);
    border-radius: 9999px;
    filter: blur(160px);
    pointer-events: none;
}

#ci360-blog-section .blog-glow-2 {
    position: absolute;
    top: 40%;
    right: 5%;
    width: 550px;
    height: 550px;
    background: rgba(37, 99, 235, 0.09);
    border-radius: 9999px;
    filter: blur(170px);
    pointer-events: none;
}

/* Hero Showcase Card */
#ci360-blog-section .blog-hero-showcase {
    position: relative;
    min-height: 420px;
    border-radius: 28px;
    overflow: hidden;
    background-color: #0f172a;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
    border: 1px solid rgba(51, 65, 85, 0.85);
    transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
}

#ci360-blog-section .blog-hero-showcase:hover {
    transform: translateY(-4px);
    border-color: rgba(6, 182, 212, 0.7);
    box-shadow: 0 24px 60px rgba(6, 182, 212, 0.22);
}

#ci360-blog-section .blog-hero-video {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
}

#ci360-blog-section .blog-hero-overlay {
    position: relative;
    z-index: 2;
    padding: 32px 34px;
    background: linear-gradient(to top, rgba(2, 6, 23, 0.98) 0%, rgba(2, 6, 23, 0.75) 60%, transparent 100%);
}

/* Category Filter Tabs */
#ci360-blog-section .cat-filter-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 20px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    background: rgba(15, 23, 42, 0.85);
    border: 1px solid rgba(51, 65, 85, 0.8);
    color: #94a3b8;
    text-decoration: none;
    transition: all 0.25s ease;
}

#ci360-blog-section .cat-filter-btn:hover {
    color: #ffffff;
    border-color: rgba(6, 182, 212, 0.6);
    background: rgba(15, 23, 42, 0.95);
}

#ci360-blog-section .cat-filter-btn.active {
    background: linear-gradient(135deg, #0284c7, #06b6d4);
    color: #ffffff;
    border-color: transparent;
    box-shadow: 0 4px 15px rgba(6, 182, 212, 0.35);
}

/* Standard Blog Cards */
#ci360-blog-section .blog-card {
    position: relative;
    background: rgba(15, 23, 42, 0.8);
    border: 1px solid rgba(51, 65, 85, 0.85);
    border-radius: 22px;
    overflow: hidden;
    backdrop-filter: blur(12px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
    transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
    display: flex;
    flex-direction: column;
    text-decoration: none !important;
}

#ci360-blog-section .blog-card:hover {
    transform: translateY(-4px);
    border-color: rgba(6, 182, 212, 0.65);
    box-shadow: 0 16px 40px rgba(6, 182, 212, 0.16);
}

#ci360-blog-section .blog-card-img {
    height: 220px;
    background-size: cover;
    background-position: center;
    background-color: #0f172a;
    position: relative;
}

#ci360-blog-section .blog-card-img::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(15, 23, 42, 0.9) 0%, transparent 50%);
}

/* Heading color remains solid white on hover (NO HOVER COLOR CHANGE) */
#ci360-blog-section .blog-title {
    color: #ffffff !important;
    font-weight: 700;
    line-height: 1.35;
    margin: 0;
}

#ci360-blog-section .blog-card:hover .blog-title {
    color: #ffffff !important;
}

/* Pagination Links */
#ci360-blog-section .page-numbers {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 14px;
    border-radius: 50px;
    background: rgba(15, 23, 42, 0.9);
    border: 1px solid rgba(51, 65, 85, 0.85);
    color: #94a3b8;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
}

#ci360-blog-section .page-numbers:hover {
    color: #ffffff;
    border-color: rgba(6, 182, 212, 0.7);
}

#ci360-blog-section .page-numbers.current {
    background: linear-gradient(135deg, #0284c7, #06b6d4);
    color: #ffffff;
    border-color: transparent;
    box-shadow: 0 4px 15px rgba(6, 182, 212, 0.35);
}
</style>

<section id="ci360-blog-section">
  <!-- Ambient Lights -->
  <div class="blog-glow-1"></div>
  <div class="blog-glow-2"></div>

  <div class="max-w-7xl mx-auto relative z-10">
    
    <!-- =========================================================================
         1. HERO SECTION (Matching Theme Hero Style)
    ========================================================================= -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center mb-16 lg:mb-20">
      
      <!-- Left Column: Headlines & Text (7 cols) -->
      <div class="lg:col-span-7 flex flex-col justify-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-cyan-950/60 border border-cyan-500/30 text-cyan-400 text-xs font-semibold uppercase tracking-widest mb-6 w-fit shadow-sm">
          <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
          <?php echo esc_html( $hero_badge ); ?>
        </div>

        <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight mb-6">
          <?php echo esc_html( $hero_pre ); ?> 
          <span class="bg-gradient-to-r from-sky-400 via-cyan-400 to-teal-300 bg-clip-text text-transparent">
            <?php echo esc_html( $hero_high ); ?>
          </span> 
          <?php echo esc_html( $hero_post ); ?>
        </h1>

        <p class="text-base md:text-lg text-slate-300 font-light leading-relaxed mb-8 max-w-2xl">
          <?php echo esc_html( $hero_desc ); ?>
        </p>

        <!-- Micro Badges / Stats -->
        <div class="flex flex-wrap items-center gap-6 pt-6 border-t border-slate-800/80 text-xs text-slate-400 font-medium">
          <div class="flex items-center gap-2">
            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
            100% Original Strategy
          </div>
          <div class="flex items-center gap-2">
            <span class="w-1.5 h-1.5 rounded-full bg-sky-400"></span>
            Cross-Disciplinary Rigor
          </div>
          <div class="flex items-center gap-2">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
            Open Access
          </div>
        </div>
      </div>

      <!-- Right Column: High-Tech Hero Media Showcase Card (5 cols) -->
      <div class="lg:col-span-5">
        <div class="blog-hero-showcase" style="background-image:url('<?php echo esc_url( $hero_img ); ?>');">
          <?php if ( ! empty( $hero_video ) ) : ?>
          <video class="blog-hero-video" autoplay muted loop playsinline src="<?php echo esc_url( $hero_video ); ?>"></video>
          <?php endif; ?>
          <div class="blog-hero-overlay">
            <span class="inline-flex px-3 py-1 rounded-full text-[10.5px] font-bold uppercase tracking-wider bg-gradient-to-r from-sky-600 to-cyan-500 text-white shadow-sm mb-2.5">
              <?php echo esc_html( $hero_card_tag ); ?>
            </span>
            <h3 class="text-xl md:text-2xl font-bold text-white mb-2 leading-snug">
              <?php echo esc_html( $hero_card_ttl ); ?>
            </h3>
            <p class="text-slate-300 text-xs md:text-sm font-light leading-relaxed">
              <?php echo esc_html( $hero_card_dsc ); ?>
            </p>
          </div>
        </div>
      </div>

    </div>

    <!-- Divider Bar -->
    <div class="h-px w-full bg-gradient-to-r from-transparent via-slate-700/80 to-transparent mb-12"></div>

    <!-- =========================================================================
         2. CATEGORY FILTER TABS
    ========================================================================= -->
    <?php if ( ! empty( $available_categories ) && ! is_wp_error( $available_categories ) ) : ?>
    <div class="flex flex-wrap items-center justify-center gap-2.5 mb-14">
      <?php $all_active = empty( $active_cat_slug ) ? 'active' : ''; ?>
      <a href="<?php echo esc_url( $current_page_url ); ?>" class="cat-filter-btn <?php echo $all_active; ?>">
        All Articles
      </a>
      <?php foreach ( $available_categories as $cat ) : 
        $is_active = ( $active_cat_slug === $cat->slug ) ? 'active' : '';
        $cat_url = add_query_arg( 'blog_cat', $cat->slug, $current_page_url );
      ?>
      <a href="<?php echo esc_url( $cat_url ); ?>" class="cat-filter-btn <?php echo $is_active; ?>">
        <?php echo esc_html( $cat->name ); ?>
        <span class="text-[10px] px-1.5 py-0.5 rounded-full bg-slate-800 text-slate-400"><?php echo esc_html( $cat->count ); ?></span>
      </a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- =========================================================================
         3. REAL BLOG POSTS GRID
    ========================================================================= -->
    <?php if ( $blog_query->have_posts() ) : ?>
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
          <?php 
          $pid = get_the_ID();
          $p_img = get_the_post_thumbnail_url( $pid, 'large' );
          if ( ! $p_img ) {
              $p_img = 'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=800&auto=format&fit=crop';
          }
          $cats = get_the_category();
          $cat_name = ! empty( $cats ) ? $cats[0]->name : 'Article';
          $time_read = ci360_calc_reading_time( get_the_content() );
          ?>
          <a href="<?php the_permalink(); ?>" class="blog-card group">
            <div class="blog-card-img" style="background-image:url('<?php echo esc_url( $p_img ); ?>');"></div>
            <div class="p-6 md:p-7 flex flex-col justify-between flex-1">
              <div>
                <div class="flex items-center justify-between gap-2 mb-3">
                  <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wider bg-cyan-950/80 border border-cyan-800/70 text-cyan-400">
                    <?php echo esc_html( $cat_name ); ?>
                  </span>
                  <span class="text-[11px] text-slate-400">
                    <?php echo get_the_date( 'M j, Y' ); ?>
                  </span>
                </div>
                <h3 class="text-lg md:text-xl font-bold text-white blog-title mb-3">
                  <?php the_title(); ?>
                </h3>
                <p class="text-slate-300 text-xs md:text-sm font-light leading-relaxed mb-5">
                  <?php echo wp_trim_words( get_the_excerpt() ?: get_the_content(), 18, '...' ); ?>
                </p>
              </div>

              <div class="flex items-center justify-between pt-4 border-t border-slate-800/80">
                <span class="text-[11px] text-slate-400">
                  <?php echo $time_read; ?> min read
                </span>
                <span class="inline-flex items-center gap-1 text-xs font-semibold text-cyan-400 group-hover:translate-x-1 transition-transform">
                  Read 
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                  </svg>
                </span>
              </div>
            </div>
          </a>
        <?php endwhile; ?>
      </div>

      <!-- Pagination -->
      <?php if ( $blog_query->max_num_pages > 1 ) : ?>
        <div class="flex justify-center items-center gap-2 mt-16">
          <?php 
          echo paginate_links( array(
              'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
              'format'    => '?paged=%#%',
              'current'   => max( 1, $paged ),
              'total'     => $blog_query->max_num_pages,
              'prev_text' => '&larr; Prev',
              'next_text' => 'Next &rarr;',
              'type'      => 'plain',
          ) );
          ?>
        </div>
      <?php endif; ?>

      <?php wp_reset_postdata(); ?>

    <?php else : ?>
      <!-- Empty State -->
      <div class="text-center py-20 px-6 rounded-3xl bg-slate-900/60 border border-slate-800/80 max-w-2xl mx-auto">
        <div class="w-16 h-16 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 flex items-center justify-center mx-auto mb-5">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path>
            <path d="M6 6h10"></path>
            <path d="M6 10h10"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-white mb-2">No Articles Found</h3>
        <p class="text-slate-400 text-sm font-light mb-6">
          No published blog posts match the selected criteria. Publish real posts under <strong>Posts > Add New</strong> in WordPress admin.
        </p>
        <a href="<?php echo esc_url( $current_page_url ); ?>" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-cyan-600 text-white text-xs font-bold uppercase tracking-wider hover:bg-cyan-500 transition-colors">
          View All Categories
        </a>
      </div>
    <?php endif; ?>

  </div>
</section>
