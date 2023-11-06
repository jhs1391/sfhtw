<?php
/**
 * Template part for displaying pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sing_for_Hope
 */

?>

<article class="px-8" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="">
		<?php
		if ( ! is_front_page() ) {
			the_title( '<h1 class="text-3xl">', '</h1>' );
		} else {
			the_title( '<h2 class="text-3xl">', '</h2>' );
		}
		?>
	</header><!-- .entry-header -->

	<?php sfh_post_thumbnail(); ?>

	<div <?php sfh_content_class( '' ); ?>>
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div>' . __( 'Pages:', 'singforhope' ),
				'after' => '</div>',
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

</article><!-- #post-<?php the_ID(); ?> -->