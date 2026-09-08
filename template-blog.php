<?php
/**
 * Template Name: CI360 Blog Page (Real Posts & Filter)
 *
 * @package HelloElementorChildCI360ACF
 */

get_header();
?>

<main id="primary" class="site-main bg-slate-950 text-white min-h-screen">
    <?php 
    // 1. Render Dynamic Blog Grid & Filter Section
    get_template_part( 'template-parts/blog-grid-acf' ); 

    // 2. Elementor & Standard WordPress Content Area
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
    ?>
</main>

<?php
get_footer();
