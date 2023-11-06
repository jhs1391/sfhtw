<?php
/*
Template Name: Static Homepage Template
*/

get_header();

?>

<section id="primary">
	<main id="main">

		<section id="1">
			<?php include( 'home-hero.php' ); ?>
		</section>
		<section id="2">
			<?php include( 'home-news.php' ); ?>
		</section>

		<?php include( 'home-about.php' ); ?>

	</main>
</section>


<?php
get_footer();