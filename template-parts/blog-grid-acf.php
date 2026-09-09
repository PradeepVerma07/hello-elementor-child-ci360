<?php
/**
 * Dynamic Real WordPress Blog Archive & Insights Template
 * Automatically queries WordPress posts, categories, authors, thumbnails, and reading times.
 * No hardcoded posts.
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
        $word_count = str_word_count( strip_tags( (string) $content ) );
        $reading_time = ceil( $word_count / 200 );
        return max( 1, (int) $reading_time );
    }
}

// 1. Hero Content Controls (ACF or Defaults)
$hero_badge = ci360_get_blog_val( 'blog_hero_badge', 'Strategic Intelligence & Thought Leadership' );
$hero_h1_pre = ci360_get_blog_val( 'blog_hero_h1_pre', 'Insights &' );
$hero_h1_high = ci360_get_blog_val( 'blog_hero_h1_highlight', 'Perspectives.' );
$hero_desc = ci360_get_blog_val( 'blog_hero_description', 'Marketing never stops evolving, and neither does our thinking. Explore CI360 perspectives on strategic storytelling, digital marketing trends, AI in marketing, SEO, AEO, GEO, performance marketing, brand strategy, content marketing, podcasting, and changing consumer behaviour.' );

// 2. Fetch Published Categories for Filter Bar
$cat_include_raw = ci360_get_blog_val( 'blog_include_categories', '' );
$cat_exclude_raw = ci360_get_blog_val( 'blog_exclude_categories', '' );

$cat_args = array(
    'taxonomy'   => 'category',
    'hide_empty' => true,
    'orderby'    => 'count',
    'order'      => 'DESC',
);

if ( ! empty( $cat_include_raw ) ) {
    $cat_args['include'] = is_array( $cat_include_raw ) ? array_map( 'intval', $cat_include_raw ) : array_map( 'intval', explode( ',', $cat_include_raw ) );
}
if ( ! empty( $cat_exclude_raw ) ) {
    $cat_args['exclude'] = is_array( $cat_exclude_raw ) ? array_map( 'intval', $cat_exclude_raw ) : array_map( 'intval', explode( ',', $cat_exclude_raw ) );
}

$available_categories = get_categories( $cat_args );

// 3. Query Spotlight / Featured Post for Right Hero Box
$spotlight_post_id = ci360_get_blog_val( 'blog_spotlight_post', 0 );
$spotlight_post = null;

if ( ! empty( $spotlight_post_id ) ) {
    $spotlight_post = get_post( intval( $spotlight_post_id ) );
}

if ( ! $spotlight_post ) {
    // Check for Sticky Post first, else latest post
    $sticky_posts = get_option( 'sticky_posts' );
    $spotlight_query_args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
    );
    if ( ! empty( $sticky_posts ) ) {
        $spotlight_query_args['post__in'] = $sticky_posts;
    }
    $spotlight_query = new WP_Query( $spotlight_query_args );
    if ( $spotlight_query->have_posts() ) {
        $spotlight_post = $spotlight_query->posts[0];
    }
}

// 4. Query All Real WordPress Posts for Grid
$posts_per_pg = intval( ci360_get_blog_val( 'blog_posts_per_page', -1 ) );
if ( $posts_per_pg === 0 ) {
    $posts_per_pg = -1;
}

$query_args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => $posts_per_pg,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$blog_query = new WP_Query( $query_args );
$fallback_images = array(
    'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1000&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1000&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=1000&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?q=80&w=1000&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=1000&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1000&auto=format&fit=crop',
);
?>

<!-- Google Fonts & Tailwind CDN -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    darkMode: 'class',
    theme: {
      extend: {
        fontFamily: {
          sans: ['Poppins', 'sans-serif'],
          poppins: ['Poppins', 'sans-serif'],
        }
      }
    }
  }
</script>

<style>
/* =========================================================
   SCOPED BLOG PAGE STYLES - DARK LUXURY & CYAN GLOW
========================================================= */
#ci360-blog-archive-root {
    position: relative;
    background-color: #020617;
    color: #ffffff;
    font-family: 'Poppins', sans-serif;
    min-height: 100vh;
    box-sizing: border-box;
    overflow: hidden;
}

#ci360-blog-archive-root * {
    box-sizing: border-box;
}

/* Hero Section */
#ci360-blog-archive-root .ci360-blog-hero {
    position: relative;
    padding: 120px 24px 70px 24px;
    background: linear-gradient(180deg, rgba(15, 23, 42, 0.9) 0%, #020617 100%);
    border-bottom: 1px solid rgba(51, 65, 85, 0.6);
    overflow: hidden;
}

@media (min-width: 1024px) {
    #ci360-blog-archive-root .ci360-blog-hero {
        padding: 140px 48px 90px 48px;
    }
}

#ci360-blog-archive-root .ci360-hero-glow-orb {
    position: absolute;
    top: 20%;
    left: 15%;
    width: 650px;
    height: 450px;
    background: rgba(6, 182, 212, 0.12);
    border-radius: 9999px;
    filter: blur(140px);
    pointer-events: none;
}

#ci360-blog-archive-root .ci360-hero-glow-orb-2 {
    position: absolute;
    bottom: 10%;
    right: 10%;
    width: 550px;
    height: 400px;
    background: rgba(37, 99, 235, 0.14);
    border-radius: 9999px;
    filter: blur(150px);
    pointer-events: none;
}

/* Badge */
#ci360-blog-archive-root .ci360-pill-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 7px 18px;
    background: rgba(14, 165, 233, 0.1);
    border: 1px solid rgba(56, 189, 248, 0.3);
    border-radius: 9999px;
    color: #67e8f9;
    font-size: 0.78rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    width: fit-content;
    margin-bottom: 20px;
    box-shadow: 0 0 20px rgba(56, 189, 248, 0.15);
}

#ci360-blog-archive-root .ci360-hero-h1 {
    font-size: 3.2rem;
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.03em;
    color: #ffffff;
    margin: 0 0 18px 0;
}

@media (min-width: 768px) {
    #ci360-blog-archive-root .ci360-hero-h1 {
        font-size: 4.2rem;
    }
}

#ci360-blog-archive-root .ci360-gradient-text {
    background: linear-gradient(135deg, #67e8f9 0%, #38bdf8 45%, #818cf8 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    display: inline;
}

#ci360-blog-archive-root .ci360-hero-p {
    font-size: 1.05rem;
    font-weight: 300;
    line-height: 1.75;
    color: #94a3b8;
    max-width: 600px;
    margin: 0;
}

/* Spotlight Card (Right) */
#ci360-blog-archive-root .ci360-spotlight-card {
    background: rgba(15, 23, 42, 0.85);
    border: 1px solid rgba(51, 65, 85, 0.85);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 22px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
    transition: all 0.3s ease;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

#ci360-blog-archive-root .ci360-spotlight-card:hover {
    border-color: rgba(56, 189, 248, 0.5);
    transform: translateY(-3px);
    box-shadow: 0 25px 60px rgba(6, 182, 212, 0.2);
}

#ci360-blog-archive-root .spotlight-img-wrap {
    position: relative;
    height: 220px;
    border-radius: 16px;
    overflow: hidden;
    background: #0b1329;
}

#ci360-blog-archive-root .spotlight-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

#ci360-blog-archive-root .ci360-spotlight-card:hover .spotlight-img-wrap img {
    transform: scale(1.05);
}

/* Sticky Filter & Search Bar */
#ci360-blog-archive-root .ci360-filter-bar {
    position: sticky;
    top: 80px;
    z-index: 40;
    background: rgba(2, 6, 23, 0.9);
    backdrop-filter: blur(16px);
    border-bottom: 1px solid rgba(51, 65, 85, 0.7);
    padding: 16px 24px;
}

#ci360-blog-archive-root .filter-btn {
    padding: 8px 18px;
    border-radius: 9999px;
    font-size: 0.78rem;
    font-weight: 600;
    white-space: nowrap;
    transition: all 0.25s ease;
    background: rgba(15, 23, 42, 0.8);
    color: #94a3b8;
    border: 1px solid rgba(51, 65, 85, 0.8);
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
}

#ci360-blog-archive-root .filter-btn:hover {
    color: #ffffff;
    border-color: rgba(56, 189, 248, 0.5);
}

#ci360-blog-archive-root .filter-btn.active {
    background: #38bdf8;
    color: #020617 !important;
    font-weight: 700;
    border-color: #7dd3fc;
    box-shadow: 0 0 16px rgba(56, 189, 248, 0.4);
}

#ci360-blog-archive-root .ci360-search-input {
    background: #020617;
    border: 1px solid rgba(51, 65, 85, 0.8);
    border-radius: 9999px;
    padding: 9px 18px 9px 38px;
    font-size: 0.82rem;
    color: #ffffff;
    width: 100%;
    outline: none;
    transition: border-color 0.2s ease;
    font-family: 'Poppins', sans-serif;
}

#ci360-blog-archive-root .ci360-search-input:focus {
    border-color: #38bdf8;
    box-shadow: 0 0 15px rgba(56, 189, 248, 0.2);
}

/* Blog Article Cards */
#ci360-blog-archive-root .ci360-blog-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 30px;
    padding: 60px 24px 90px 24px;
    max-width: 1280px;
    margin: 0 auto;
}

@media (min-width: 640px) {
    #ci360-blog-archive-root .ci360-blog-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    #ci360-blog-archive-root .ci360-blog-grid {
        grid-template-columns: repeat(3, 1fr);
        padding: 70px 48px 100px 48px;
    }
}

#ci360-blog-archive-root .ci360-post-card {
    background: rgba(15, 23, 42, 0.65);
    border: 1px solid rgba(51, 65, 85, 0.8);
    border-radius: 24px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    text-decoration: none !important;
}

#ci360-blog-archive-root .ci360-post-card:hover {
    transform: translateY(-5px);
    border-color: rgba(56, 189, 248, 0.5);
    box-shadow: 0 20px 45px rgba(6, 182, 212, 0.18), 0 0 25px rgba(56, 189, 248, 0.1);
    background: rgba(15, 23, 42, 0.95);
}

#ci360-blog-archive-root .post-card-img-wrap {
    position: relative;
    height: 220px;
    width: 100%;
    overflow: hidden;
    background: #020617;
}

#ci360-blog-archive-root .post-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
}

#ci360-blog-archive-root .ci360-post-card:hover .post-card-img {
    transform: scale(1.06);
}

#ci360-blog-archive-root .post-cat-badge {
    position: absolute;
    top: 14px;
    left: 14px;
    background: rgba(2, 6, 23, 0.85);
    border: 1px solid rgba(51, 65, 85, 0.8);
    padding: 4px 12px;
    border-radius: 9999px;
    font-size: 0.7rem;
    font-weight: 700;
    color: #67e8f9;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    backdrop-filter: blur(8px);
}

#ci360-blog-archive-root .post-card-body {
    padding: 24px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    flex: 1;
}

#ci360-blog-archive-root .post-meta-line {
    font-size: 0.75rem;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 6px;
}

#ci360-blog-archive-root .post-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: #ffffff;
    line-height: 1.35;
    margin: 0;
    transition: color 0.2s;
}

#ci360-blog-archive-root .ci360-post-card:hover .post-title {
    color: #67e8f9;
}

#ci360-blog-archive-root .post-excerpt {
    font-size: 0.85rem;
    color: #94a3b8;
    line-height: 1.6;
    font-weight: 300;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

#ci360-blog-archive-root .post-card-footer {
    padding: 16px 24px;
    border-top: 1px solid rgba(51, 65, 85, 0.5);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

#ci360-blog-archive-root .post-author {
    font-size: 0.78rem;
    color: #94a3b8;
    font-weight: 500;
}

#ci360-blog-archive-root .read-btn {
    font-size: 0.82rem;
    font-weight: 700;
    color: #38bdf8;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: transform 0.2s;
}

#ci360-blog-archive-root .ci360-post-card:hover .read-btn {
    transform: translateX(3px);
    color: #67e8f9;
}

/* Strategic CTA Strip */
#ci360-blog-archive-root .ci360-blog-cta {
    padding: 70px 24px 90px 24px;
    border-top: 1px solid rgba(51, 65, 85, 0.7);
    background: radial-gradient(circle at 50% 0%, rgba(14, 165, 233, 0.12) 0%, transparent 70%);
}
</style>

<div id="ci360-blog-archive-root">

    <!-- ============================================================
         1. EDITORIAL HERO WITH DYNAMIC SPOTLIGHT ARTICLE
         ============================================================ -->
    <section class="ci360-blog-hero">
        <div class="ci360-hero-glow-orb"></div>
        <div class="ci360-hero-glow-orb-2"></div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
            <!-- Left Header Content -->
            <div class="lg:col-span-7 text-left space-y-6">
                <div class="ci360-pill-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    <span><?php echo esc_html( $hero_badge ); ?></span>
                </div>

                <h1 class="ci360-hero-h1">
                    <?php echo esc_html( $hero_h1_pre ); ?> <br/>
                    <span class="ci360-gradient-text"><?php echo esc_html( $hero_h1_high ); ?></span>
                </h1>

                <p class="ci360-hero-p">
                    <?php echo esc_html( $hero_desc ); ?>
                </p>
            </div>

            <!-- Right Spotlight Blueprint Card (Dynamically fetched) -->
            <div class="lg:col-span-5">
                <?php if ( $spotlight_post ) : 
                    $sp_id = $spotlight_post->ID;
                    $sp_title = get_the_title( $sp_id );
                    $sp_url = get_permalink( $sp_id );
                    $sp_date = get_the_date( 'M d, Y', $sp_id );
                    $sp_img = get_the_post_thumbnail_url( $sp_id, 'large' );
                    if ( empty( $sp_img ) ) {
                        $sp_img = $fallback_images[0];
                    }
                    $sp_cats = get_the_category( $sp_id );
                    $sp_cat_name = ! empty( $sp_cats ) ? $sp_cats[0]->name : 'Featured Blueprint';
                    $sp_read = ci360_calc_reading_time( $spotlight_post->post_content );
                    $sp_excerpt = get_the_excerpt( $sp_id );
                    if ( empty( $sp_excerpt ) ) {
                        $sp_excerpt = wp_trim_words( strip_tags( $spotlight_post->post_content ), 20, '...' );
                    }
                ?>
                <a href="<?php echo esc_url( $sp_url ); ?>" class="ci360-spotlight-card">
                    <div class="spotlight-img-wrap">
                        <img src="<?php echo esc_url( $sp_img ); ?>" alt="<?php echo esc_attr( $sp_title ); ?>">
                        <span class="post-cat-badge"><?php echo esc_html( $sp_cat_name ); ?></span>
                    </div>
                    <div>
                        <div class="post-meta-line mb-1">
                            <span><?php echo esc_html( $sp_date ); ?></span> • <span><?php echo esc_html( $sp_read ); ?> min read</span>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold text-white line-clamp-2">
                            <?php echo esc_html( $sp_title ); ?>
                        </h3>
                        <p class="text-xs text-slate-400 font-light mt-1.5 line-clamp-2">
                            <?php echo esc_html( $sp_excerpt ); ?>
                        </p>
                    </div>
                    <div class="w-full py-3 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 text-xs font-bold transition-all flex items-center justify-center gap-2 mt-2">
                        <span>Read Blueprint</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </div>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ============================================================
         2. DYNAMIC CATEGORY FILTER & INSTANT LIVE SEARCH BAR
         ============================================================ -->
    <div class="ci360-filter-bar">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
            
            <!-- Category Pills (Automatically retrieved from WordPress) -->
            <div class="flex gap-2 overflow-x-auto pb-1 w-full md:w-auto" id="ci360-cat-filters">
                <button class="filter-btn active" data-filter="all">All Insights</button>
                <?php if ( ! empty( $available_categories ) && ! is_wp_error( $available_categories ) ) : 
                    foreach ( $available_categories as $cat ) : ?>
                    <button class="filter-btn" data-filter="<?php echo esc_attr( $cat->slug ); ?>">
                        <?php echo esc_html( $cat->name ); ?>
                    </button>
                <?php endforeach; endif; ?>
            </div>

            <!-- Instant Search Input -->
            <div class="relative w-full md:w-72">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" id="ci360-blog-search" class="ci360-search-input" placeholder="Search essays &amp; topics...">
            </div>

        </div>
    </div>

    <!-- ============================================================
         3. DYNAMIC ARTICLES GRID (Real WordPress Posts)
         ============================================================ -->
    <div class="ci360-blog-grid max-w-7xl mx-auto" id="ci360-blog-list">

        <?php if ( $blog_query->have_posts() ) : 
            $card_index = 0;
            while ( $blog_query->have_posts() ) : $blog_query->the_post(); 
                $post_id = get_the_ID();
                $post_title = get_the_title();
                $post_url = get_permalink();
                $post_date = get_the_date( 'M d, Y' );
                $post_author = get_the_author();
                $post_img = get_the_post_thumbnail_url( $post_id, 'large' );
                if ( empty( $post_img ) ) {
                    $post_img = $fallback_images[ $card_index % count( $fallback_images ) ];
                }
                $post_cats = get_the_category( $post_id );
                $primary_cat_name = ! empty( $post_cats ) ? $post_cats[0]->name : 'Insights';
                $cat_slugs_array = array();
                if ( ! empty( $post_cats ) ) {
                    foreach ( $post_cats as $c ) {
                        $cat_slugs_array[] = $c->slug;
                    }
                }
                $all_cat_slugs = implode( ' ', $cat_slugs_array );

                $reading_time = ci360_calc_reading_time( get_the_content() );
                $post_excerpt = get_the_excerpt();
                if ( empty( $post_excerpt ) ) {
                    $post_excerpt = wp_trim_words( strip_tags( get_the_content() ), 22, '...' );
                }
                $card_index++;
        ?>
        <!-- Dynamic Blog Card -->
        <a href="<?php echo esc_url( $post_url ); ?>" class="ci360-post-card" data-cat="<?php echo esc_attr( $all_cat_slugs ); ?>" data-title="<?php echo esc_attr( strtolower( $post_title ) ); ?>">
            <div>
                <div class="post-card-img-wrap">
                    <img src="<?php echo esc_url( $post_img ); ?>" alt="<?php echo esc_attr( $post_title ); ?>" class="post-card-img" loading="lazy">
                    <span class="post-cat-badge"><?php echo esc_html( $primary_cat_name ); ?></span>
                </div>
                <div class="post-card-body">
                    <div class="post-meta-line">
                        <span><?php echo esc_html( $post_date ); ?></span> • <span><?php echo esc_html( $reading_time ); ?> min read</span>
                    </div>
                    <h3 class="post-title"><?php echo esc_html( $post_title ); ?></h3>
                    <p class="post-excerpt"><?php echo esc_html( $post_excerpt ); ?></p>
                </div>
            </div>
            <div class="post-card-footer">
                <span class="post-author"><?php echo esc_html( $post_author ); ?></span>
                <span class="read-btn">Read Memo →</span>
            </div>
        </a>
        <?php endwhile; wp_reset_postdata(); ?>
        <?php else : ?>
        <div class="col-span-full text-center py-20 text-slate-400">
            <p class="text-lg">No posts published yet. Create your first post in WordPress Admin &gt; Posts.</p>
        </div>
        <?php endif; ?>

    </div>

    <!-- No Search Results Found State -->
    <div id="ci360-no-results" style="display:none;" class="max-w-7xl mx-auto text-center py-20 text-slate-400">
        <p class="text-lg">No articles found matching your search or category filter.</p>
    </div>

    <!-- ============================================================
         4. EXECUTIVE BRIEFING CTA STRIP
         ============================================================ -->
    <section class="ci360-blog-cta">
        <div class="max-w-4xl mx-auto rounded-3xl bg-slate-900/90 border border-cyan-500/30 p-8 sm:p-12 text-center space-y-6 shadow-2xl backdrop-blur-xl">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-300 text-xs font-mono">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                <span>CI360 Executive Desk</span>
            </div>
            <h2 class="text-2xl sm:text-4xl font-bold text-white">
                Ready to Architect an Enduring Brand Narrative?
            </h2>
            <p class="text-sm sm:text-base text-slate-300 font-light max-w-xl mx-auto leading-relaxed">
                Book a confidential 30-minute strategic consultation with our leadership team to diagnose market whitespace.
            </p>
            <div class="pt-2">
                <a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 text-xs font-bold transition-all shadow-xl shadow-cyan-500/20">
                    <span>Schedule Strategic Briefing</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

</div>

<script>
(function() {
    var filterBtns = document.querySelectorAll('#ci360-cat-filters .filter-btn');
    var searchInput = document.getElementById('ci360-blog-search');
    var cards = document.querySelectorAll('#ci360-blog-list .ci360-post-card');
    var noResults = document.getElementById('ci360-no-results');

    var currentCategory = 'all';
    var currentQuery = '';

    function applyFilters() {
        var visibleCount = 0;
        cards.forEach(function(card) {
            var catStr = card.getAttribute('data-cat') || '';
            var title = (card.getAttribute('data-title') || '').toLowerCase();
            var text = card.textContent.toLowerCase();

            var catArray = catStr.split(' ');
            var matchesCat = (currentCategory === 'all' || catArray.indexOf(currentCategory) !== -1);
            var matchesSearch = (!currentQuery || title.indexOf(currentQuery) !== -1 || text.indexOf(currentQuery) !== -1);

            if (matchesCat && matchesSearch) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        if (noResults) {
            noResults.style.display = (visibleCount === 0) ? 'block' : 'none';
        }
    }

    filterBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            filterBtns.forEach(function(b) { b.classList.remove('active'); });
            btn.classList.add('active');
            currentCategory = btn.getAttribute('data-filter') || 'all';
            applyFilters();
        });
    });

    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            currentQuery = e.target.value.toLowerCase().trim();
            applyFilters();
        });
    }
})();
</script>
