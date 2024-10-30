<?php

//add scripts and css to the front
add_action('wp_enqueue_scripts','da_bc_add_scripts');

//wp_enqueue_scripts callback function
function da_bc_add_scripts(){
		
	//front-style.css
	wp_register_style('da_bc_front_style',WP_PLUGIN_URL.'/bootstrap-carousel-manager/css/front-style.css');
	wp_enqueue_style('da_bc_front_style');		
	
}

?>