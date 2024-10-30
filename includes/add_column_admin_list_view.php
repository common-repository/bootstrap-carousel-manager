<?php

//create the new "image" column
function da_bc_create_column($defaults) {  

	$defaults['name'] = 'Name';
	$defaults['image'] = 'Image'; 
	return $defaults;  

}  
add_filter('manage_posts_columns', 'da_bc_create_column'); 

//render the "image" column content
function da_bc_render_image_column($column_name, $post_id) {  

	//if the current column is "image"
	if ($column_name == 'image') {

		//get the featured image id
		$featured_image_id = get_post_thumbnail_id($post_id);  

		//check if we have a valid $featured_image_id
		if ( !empty( $featured_image_id ) and ( $featured_image_id != false ) ) { 

			//get the featured image url
			$img_url = wp_get_attachment_image_src($featured_image_id, 'thumbnail')[0];

			//print the image inside the column content
			echo '<img src="' . $img_url . '" />';  

		}

	}

	//if the current column is "name"
	if ($column_name == 'name') {

		//echo list of names terms
		$terms_a = get_the_terms( $post_id, 'bc_name' );
		if( !empty($terms_a) ){
			foreach ($terms_a as $key => $term) {
				echo $term->name . '<br />';			
			}			
		}


	}   

}
add_action('manage_posts_custom_column', 'da_bc_render_image_column',10,2);

?>