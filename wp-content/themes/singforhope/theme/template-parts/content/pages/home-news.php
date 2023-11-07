<div class="px-4 sm:px-8 lg:px-12 py-10 lg:py-14 mx-auto">
    <!-- Title -->
    <div class="mx-auto text-start mb-2 lg:mb-2">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Featured News</h2>
        <p class="mt-1 text-gray-600 dark:text-gray-400">View All</p>
    </div>
    <!-- End Title -->

    <!-- Flex Container -->
    <div class="flex gap-3 overflow-x-auto whitespace-nowrap">

        <?php
        $args = array(
            'post_type' => 'news',
            'posts_per_page' => 6,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <!-- Card -->
                <a class="group hover:bg-gray-100 rounded-xl p-0 transition-all dark:hover:bg-white/[.05] flex-none"
                    href="<?php the_permalink(); ?>">
                    <div class="aspect-w-16 aspect-h-10">
                        <?php if (has_post_thumbnail()): ?>
                            <img class="w-full object-cover rounded-xl" src="<?php the_post_thumbnail_url(); ?>"
                                alt="<?php the_title_attribute(); ?>" style="width:250px; height:200px;">
                        <?php else: ?>
                            <img class="w-full object-cover rounded-xl" src="https://placehold.co/600x400" alt="Placeholder Image"
                                style="width:250px; height:200px;">
                        <?php endif; ?>
                    </div>
                    <div class="p-2">
                        <h3 class="mt-0 text-xl text-gray-800 dark:text-gray-300 dark:group-hover:text-white">
                            <?php the_title(); ?>
                        </h3>
                        <p class="mt-3 inline-flex items-center gap-x-2 text-sm font-semibold text-gray-800 dark:text-gray-200">
                            Learn more
                            <svg class="w-2.5 h-2.5 transition ease-in-out group-hover:translate-x-1" width="16" height="16"
                                viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.975821 6.92249C0.43689 6.92249 -3.50468e-07 7.34222 -3.27835e-07 7.85999C-3.05203e-07 8.37775 0.43689 8.79749 0.975821 8.79749L12.7694 8.79748L7.60447 13.7596C7.22339 14.1257 7.22339 14.7193 7.60447 15.0854C7.98555 15.4515 8.60341 15.4515 8.98449 15.0854L15.6427 8.68862C16.1191 8.23098 16.1191 7.48899 15.6427 7.03134L8.98449 0.634573C8.60341 0.268455 7.98555 0.268456 7.60447 0.634573C7.22339 1.00069 7.22339 1.59428 7.60447 1.9604L12.7694 6.92248L0.975821 6.92249Z"
                                    fill="currentColor" />
                            </svg>
                        </p>
                    </div>
                </a>

                <!-- End Card -->
                <?php
            }
        } else {
            echo '<p>No posts found.</p>';
        }

        wp_reset_postdata();
        ?>
    </div>
    <!-- End Flex Container -->


</div>