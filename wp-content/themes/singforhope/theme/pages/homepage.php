<?php
/*
Template Name: Static Homepage Template
*/

get_header();

?>

<section id="primary">
    <main id="main">

    <?php get_template_part('template-parts/content/pages/home-hero'); ?>

    <?php get_template_part('template-parts/content/pages/home-news'); ?>

    <?php get_template_part('template-parts/content/pages/home-about'); ?>  

    </main>
</section>


<?php
get_footer();