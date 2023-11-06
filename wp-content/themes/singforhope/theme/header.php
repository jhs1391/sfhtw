<?php
/**
 * The header for our theme
 *
 * This is the template that displays the `head` element and everything up
 * until the `#content` element.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sing_for_Hope
 */

setcookie( 'visited', '1', time() + ( 86400 * 30 ), "/" ); // 86400 = 1 day


?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- OpenGraph -->
	<meta property="og:title" content="Sing for Hope" />
	<meta property="og:type" content="Website" />
	<meta property="og:description" content="Creating a better world through the arts." />
	<meta property="og:url" content="https://singforhope.org/" />
	<meta property="og:site_name" content="Sing for Hope" />
	<meta property="og:image" content="https://singforhope.org/logo" />
	<meta property="og:image:width" content="512" />
	<meta property="og:image:height" content="512" />
	<meta property="og:locale" content="en_US" />

	<link rel="profile" href="https://gmpg.org/xfn/11">
	<script src="//unpkg.com/alpinejs" defer></script>


	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<div id="page">
		<a href="#content" class="sr-only">
			<?php esc_html_e( 'Skip to content', 'singforhope' ); ?>
		</a>

		<?php get_template_part( 'template-parts/layout/header', 'content' ); ?>

		<div id="content">