<?php

// Custom Post Type Setup
function da_create_bootstrap_carousel_cpt() {
	$labels = array(
		'name' => 'Bootstrap Carousel',
		'singular_name' => 'Bootstrap Carousel',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Carousel Image',
		'edit_item' => 'Edit Carousel Image',
		'new_item' => 'New Carousel Image',
		'view_item' => 'View Carousel Image',
		'search_items' => 'Search Carousel Images',
		'not_found' =>  'No Carousel Image',
		'not_found_in_trash' => 'No Carousel Images found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'Bootstrap Carousel'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'page',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array('title','thumbnail')
	); 
	register_post_type('bootstrap_carousel', $args);
}
add_action( 'init', 'da_create_bootstrap_carousel_cpt' );


//Create the 'bc_name' taxonomy
function da_bc_create_taxonomies(){
	$ingredients_labels = array(
		'name' => _x( 'Carousel Name', 'taxonomy general name' ),
		'singular_name' => _x( 'Name', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in names' ),
		'popular_items' => __( 'Popular names' ),
		'all_items' => __( 'All names' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit names' ), 
		'update_item' => __( 'Update names' ),
		'add_new_item' => __( 'Add new name' ),
		'new_item_name' => __( 'New name' ),
		'separate_items_with_commas' => __( 'Separate names with commas' ),
		'add_or_remove_items' => __( 'Add or remove names' ),
		'choose_from_most_used' => __( 'Choose from the most used names' ),
		'menu_name' => __( 'Carousel Names' ),
	);
	register_taxonomy('bc_name',array('bootstrap_carousel'),array(
		'hierarchical' => false,
		'labels' => $ingredients_labels,
		'show_ui' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array('slug' => 'bc_name' )
	));	
}
add_action( 'init', 'da_bc_create_taxonomies', 0 );

//add meta boxes
function da_add_meta_box_bootstrap_carousel(){
	add_meta_box("da_bootstrap_carousel_cf", "Image Details", "da_render_bootstrap_carousel_cf", "bootstrap_carousel", "normal");
}
add_action("add_meta_boxes", "da_add_meta_box_bootstrap_carousel");

//render the bootstrap carousel custom field
function da_render_bootstrap_carousel_cf( $post ){

  $image_description = get_post_meta( $post->ID, 'image_description', true );
  $destination_url = get_post_meta( $post->ID, 'destination_url', true );
  ?>

  <label>Image Description</label><br /> 
  <textarea name="image_description" cols="50" rows="6" ><?php echo $image_description; ?></textarea><br /> 

  <label>Destination URL</label><br /> 
  <input name="destination_url" value="<?php echo $destination_url; ?>" size="80" /><br />
  
  <?php
}

//save the custom fields value
function da_save_bootstrap_carousel_cf( $post_id ){

    //do not save if this is an autosave routine        
    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) { return; }	

    //save meta
    update_post_meta( $post_id, "image_description", $_POST['image_description'] );
	update_post_meta( $post_id, "destination_url", $_POST['destination_url'] );

}
add_action('save_post', 'da_save_bootstrap_carousel_cf');

?>