<?php
/*
Template Name: Static Workforce Template
*/

get_header();

?>

<section id="primary">
    <main id="main">

    
    <!-- Hero -->
<div class="bg-symphony">
  <div class="bg-gradient-to-b from-resonance/[.15] via-transparent">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-24 space-y-8">
      
      <!-- Title -->
      <div class="max-w-3xl text-center mx-auto">
      <h1 class="block font-medium text-gray-200 text-2xl sm:text-3xl md:text-4xl lg:text-5xl">
         Cultural Workforce Development
        </h1>
      </div>
      <!-- End Title -->

     
    </div>
  </div>
</div>
<!-- End Hero -->

<div class="post-content">
<?php 
            if ( have_posts() ) : 
                while ( have_posts() ) : the_post();
                    the_content(); 
                endwhile; 
            endif; 
        ?>
</div>


    </main>
</section>


<?php
get_footer();