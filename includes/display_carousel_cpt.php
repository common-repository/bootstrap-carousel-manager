<?php

//display the bootstrap carousel based on the bootstrap slider cpt
function put_bootstrap_carousel( $carousel_name = '', $specific_area = "all" ){

	//show the carousel only in specific areas of the website
	switch ($specific_area) {
		case 'all':
			break;
		case 'home':
			if( !is_home() ){return;}
			break;
		case 'posts':
			if( !is_single() ){return;}
			break;
		case 'pages':
			if( !is_page() ){return;}
			break;				
	}


	//prepare the query
	$args = array(
		'post_type' => 'bootstrap_carousel',
		'tax_query' => array(
			array(
				'taxonomy' => 'bc_name',
				'field' => 'name',
				'terms' => $carousel_name
			)
		)
	);

	$carousel_elements = new WP_Query( $args );
	$images = array();
	while ( $carousel_elements->have_posts() ) {
		$carousel_elements->the_post();
		if ( has_post_thumbnail() ) {
			$carousel_elements_a[] = array(
				'title' => get_the_title(),
				'post_thumbnail' => get_the_post_thumbnail( get_the_ID(), 'full' ),
				'image_description' => get_post_meta( get_the_ID(), 'image_description', true),
				'destination_url' => get_post_meta( get_the_ID(), 'destination_url', true)
			);
		}
	}
	wp_reset_postdata();

	if( count( $carousel_elements_a ) > 0){
		
		?>

		<div id="bootstrap-slider-cpt" class="carousel slide" data-ride="<?php echo esc_attr(stripslashes(get_option("da_bc_data_ride"))); ?>" data-interval="<?php echo esc_attr(stripslashes(get_option("da_bc_data_interval"))); ?>" data-pause="<?php echo esc_attr(stripslashes(get_option("da_bc_data_pause"))); ?>" data-wrap="<?php echo esc_attr(stripslashes(get_option("da_bc_data_wrap"))); ?>" >

			 <!-- Indicators -->
			<ol class="carousel-indicators">

				<?php foreach ( $carousel_elements_a as $key => $carousel_element ) { ?>
					<li data-target="#bootstrap-slider-cpt" data-slide-to="<?php echo $key; ?>" <?php echo $key == 0 ? 'class="active"' : ''; ?>></li>
				<?php } ?>

			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner">
			<?php foreach ( $carousel_elements_a as $key => $carousel_element ) { ?>

				<div class="item <?php echo $key == 0 ? 'active' : ''; ?>">

					<?php if( !empty( $carousel_element['destination_url'] ) ) { echo '<a href="' . $carousel_element['destination_url'] . '">'; } ?>
						<?php echo $carousel_element['post_thumbnail']; ?>
					<?php if( !empty( $carousel_element['destination_url'] ) ) { echo '</a>'; } ?>

						<div class="carousel-caption">
							<div class="carousel-caption-custom-title"><?php echo esc_html(stripslashes($carousel_element['title'])); ?></div>
							<?php if( !empty( $carousel_element['image_description'] ) ) : ?>
								<div class="carousel-caption-custom-description"><?php echo esc_html(stripslashes($carousel_element['image_description'])); ?></div>
							<?php endif; ?>
						</div>

				</div>

			<?php } ?>
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#bootstrap-slider-cpt" data-slide="prev"><span class="icon-prev"></span></a>
			<a class="right carousel-control" href="#bootstrap-slider-cpt" data-slide="next"><span class="icon-next"></span></a>

		</div>

	<?php }

}

?>