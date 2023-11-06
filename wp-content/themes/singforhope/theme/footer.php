<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the `#content` element and all content thereafter.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sing_for_Hope
 */

?>

</div><!-- #content -->

<?php get_template_part( 'template-parts/layout/footer', 'content' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

<script src="<? get_template_directory() . '/node_modules/flowbite/dist/flowbite.min.js'; ?>"></script>
<script src="<? get_template_directory() . '/node_modules/preline/dist/preline.js'; ?>"></script>

</body>

</html>