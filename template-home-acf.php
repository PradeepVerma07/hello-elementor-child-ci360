<?php
/**
 * Template Name: Home Page (ACF Hero)
 *
 * @package HelloElementorChildCI360ACF
 */

get_header();
?>

<main id="primary" class="site-main bg-slate-950 text-white min-h-screen">
    <?php 
    // Pure Elementor & WordPress Content (Use [ci360_home_hero] shortcode in Elementor)
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
    ?>
</main>

<?php
get_footer();


