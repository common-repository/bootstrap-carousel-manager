<?php

function da_bc_shortcode( $atts ) {
     extract( shortcode_atts( array(
	      		'name' => '',
     		),
     		$atts ) );
     
	put_bootstrap_carousel($name);

}
add_shortcode( 'put-bootstrap-carousel', 'da_bc_shortcode' );


?>