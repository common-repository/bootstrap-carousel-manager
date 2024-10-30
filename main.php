<?php
/*
Plugin Name: Bootstrap Carousel Manager
Plugin URI: http://www.daext.com
Description: This plugin is useful to manage the Bootstrap Carousel in your WordPress installation.
Version: 1.00
Author: Danilo Andreini
Author URI: http://www.daext.com
License: GPLv2
*/

//enqueue scripts
require_once('includes/embed.php');

//create the carousel cpt
require_once('includes/create_bootstrap_carousel_cpt.php');

//add column in admin list view to show featured image
require_once('includes/add_column_admin_list_view.php');

//display the carousel based on the cpt
require_once('includes/display_carousel_cpt.php');

//allows the carousel to be use with shortcodes
require_once('includes/shortcode.php');

//menu options
require_once('includes/menu_options.php');

//delete options when the plugin is uninstalled
register_uninstall_hook( __FILE__, 'da_bc_uninstall' );
function da_bc_uninstall(){
	
	//deleting options
	delete_option('da_bc_data_ride');
	delete_option('da_bc_data_interval');
	delete_option('da_bc_data_pause');
	delete_option('da_bc_data_wrap');
	
}

?>