<?php
/*
Template Name: Static Pianos Template
*/

get_header();

?>

<section id="primary">
    <main id="main">
<!-- Hero -->
<div class="bg-harmony">
  <div class="bg-gradient-to-b from-resonance/[.15] via-transparent">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-24 space-y-8">
      
      <!-- Title -->
      <div class="max-w-3xl text-center mx-auto">
      <h1 class="block font-medium text-gray-200 text-2xl sm:text-3xl md:text-4xl lg:text-5xl">
         Sing for Hope Pianos
        </h1>
      </div>
      <!-- End Title -->

     
    </div>
  </div>
</div>
<!-- End Hero -->
<div class="post-content">
<?php 
    $pianos_page_content = get_field('pianos_page_content');
    if($pianos_page_content) {
        echo $pianos_page_content;
    }
?>


<?php acfe_form('edit-pianos-page-content'); ?>
</div>

<!-- Card Blog -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Grid -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Card -->
   <?php 
       $args = array( 
           'post_type' => 'program', 
           'posts_per_page' => -1 
       ); 
   
       $the_query = new WP_Query( $args ); 
   
       while ( $the_query->have_posts() ) : $the_query->the_post(); 
   ?>
   
   <div class="group flex flex-col h-full bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-700 dark:shadow-slate-700/[.7]">
       <div class="h-52 flex flex-col justify-center items-center bg-blue-600 rounded-t-xl">
           <?php if ( has_post_thumbnail() ) { ?>
               <div class="w-28 h-28" style="background-image: url('<?php the_post_thumbnail_url(); ?>'); background-size: cover;"></div>
           <?php } else { ?>
               <!-- Default Image or SVG -->
           <?php } ?>
       </div>
   
       <div class="p-4 md:p-6">
           <span class="block mb-1 text-xs font-semibold uppercase text-blue-600 dark:text-blue-500">
             Atlassian API
           </span>
   
           <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-300 dark:hover:text-white">
               <a href="<?php the_permalink(); ?>">
                   <?php the_title(); ?>
               </a>
           </h3>
           
   
           <p class="mt-3 text-gray-500">
             <?php the_excerpt(); ?>
           </p>
       </div>
   
       <div class="mt-auto flex border-t border-gray-200 divide-x divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
           <a class="w-full py-3 px-4 inline-flex justify-center items-center gap-2 rounded-bl-xl font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm sm:p-4 dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800" href="<?php the_permalink(); ?>">
             View sample
           </a>
       </div>
   </div>
   
   <?php 
       endwhile; 
       wp_reset_postdata(); 
   ?>
   
    <!-- End Card -->

  </div>
  <!-- End Grid -->
</div>
<!-- End Card Blog -->


    </main>
</section>


<?php
get_footer();