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
    // Render Dynamic ACF Hero Section
    get_template_part( 'template-parts/home-hero-acf' ); 

    // Elementor Content Area (Required by Elementor Editor)
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
    ?>
</main>

<?php
get_footer();

