<?php
/**
 * The template for displaying all single posts of type 'piano'
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Sing_for_Hope
 */

 get_header();
 ?>
 
     <section id="primary">
         <main id="main">
 
             <?php
             /* Start the Loop */
             while ( have_posts() ) :
                 the_post();
                 get_template_part( 'template-parts/content/content', get_post_type() );
 
                 // End the loop.
             endwhile;
             ?>
 
         </main><!-- #main -->
     </section><!-- #primary -->
 
 <?php
 get_footer();