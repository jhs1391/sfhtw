<!-- This template contains a grid that displays the piano programs in /pianos -->
<div class="px-8 mx-auto">

	<h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white text-center mt-12">Open Locations</h2>

	<!-- Open Applications -->
	<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-2">
		<?php
		$args = array(
			'post_type' => 'program',
			'posts_per_page' => -1,
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'program_dates_applications_start_date',
					'value' => current_time( 'Ymd' ),
					'compare' => '<=',
					'type' => 'DATE'
				),
				array(
					'key' => 'program_dates_applications_end_date',
					'value' => current_time( 'Ymd' ),
					'compare' => '>=',
					'type' => 'DATE'
				)
			)
		);

		$the_query = new WP_Query( $args );

		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			get_template_part( 'components/program-card' );
		endwhile;
		wp_reset_postdata();
		?>
	</div>

	<!-- Other Programs -->
	<div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-2 mt-12">
		<?php
		$args = array(
			'post_type' => 'program',
			'posts_per_page' => -1,
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'program_dates_public_start_date',
					'value' => current_time( 'Ymd' ),
					'compare' => '<=',
					'type' => 'DATE'
				),
				array(
					'key' => 'program_dates_public_end_date',
					'value' => current_time( 'Ymd' ),
					'compare' => '>=',
					'type' => 'DATE'
				)
			)
		);

		$the_query = new WP_Query( $args );

		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			get_template_part( 'components/program-card' );
		endwhile;
		wp_reset_postdata();

		?>
	</div>
</div>