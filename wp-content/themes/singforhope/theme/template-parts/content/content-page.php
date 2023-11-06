<?php
/**
 * Template part for displaying pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sing_for_Hope
 */

?>

<<<<<<< HEAD
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
		if ( ! is_front_page() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title">', '</h2>' );
=======
<article class="px-8" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="">
		<?php
		if ( ! is_front_page() ) {
			the_title( '<h1 class="text-3xl">', '</h1>' );
		} else {
			the_title( '<h2 class="text-3xl">', '</h2>' );
>>>>>>> master
		}
		?>
	</header><!-- .entry-header -->

	<?php sfh_post_thumbnail(); ?>

<<<<<<< HEAD
	<div <?php sfh_content_class( 'entry-content' ); ?>>
=======
	<div <?php sfh_content_class( '' ); ?>>
>>>>>>> master
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div>' . __( 'Pages:', 'singforhope' ),
<<<<<<< HEAD
				'after'  => '</div>',
=======
				'after' => '</div>',
>>>>>>> master
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers. */
						__( 'Edit <span class="sr-only">%s</span>', 'singforhope' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>

<<<<<<< HEAD
</article><!-- #post-<?php the_ID(); ?> -->
=======
</article><!-- #post-<?php the_ID(); ?> -->
>>>>>>> master
