<div class="p-y-12 mx-auto px-4 sm:px-8 lg:px-14">
    <!-- Grid -->
    <div class="grid lg:grid-cols-7 lg:gap-x-8 xl:gap-x-12 lg:items-center">
        <div class="lg:col-span-3">
            <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl md:text-5xl lg:text-6xl dark:text-white">
                <?php the_field('homepage_hero_title'); ?>
            </h1>
            <p class="mt-3 text-lg text-gray-800 dark:text-gray-400">Introducing a new way for your brand to
                reach the creative community.</p>

            <div class="mt-5 lg:mt-8 flex flex-col items-center gap-2 sm:flex-row sm:gap-3">
                <div class="w-full sm:w-auto">
                    <label for="hero-input" class="sr-only">Search</label>
                    <input type="text" id="hero-input" name="hero-input"
                        class="py-3 px-4 block w-full xl:min-w-[18rem] border-gray-200 shadow-sm rounded-md focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                        placeholder="Enter work email">
                </div>
                <a class="w-full sm:w-auto inline-flex justify-center items-center gap-x-3 text-center bg-blue-600 hover:bg-blue-700 border border-transparent text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white transition py-3 px-4 dark:focus:ring-offset-gray-800"
                    href="#">
                    Request demo
                </a>
            </div>

            <!-- Brands -->
            <div class="mt-6 lg:mt-12">
                <span class="text-xs font-medium text-gray-800 uppercase dark:text-gray-200">Trusted by:</span>


            </div>
            <!-- End Brands -->
        </div>
        <!-- End Col -->

        <div class="lg:col-span-4 mt-10 lg:mt-0">
            <!-- Video Background -->
            <video autoplay muted loop id="myVideo" class="w-full rounded-xl">
                <source src="https://sfhmedia.nyc3.digitaloceanspaces.com/2023/06/About-Sing-for-Hope.mp4"
                    type="video/mp4">
                Your browser does not support HTML5 video.
            </video>
        </div>
        <!-- End Col -->
    </div>
    <!-- End Grid -->
</div>
<!-- End Hero -->