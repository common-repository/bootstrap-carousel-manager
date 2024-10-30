<?php

//create the options menu
function da_bc_admin_menu() {
	
	$form_name='BC Options';
	
	//create menu
	add_menu_page($form_name, $form_name, 'manage_options', 'da_bc_options','da_bc_menu_options');
	
}
add_action( 'admin_menu', 'da_bc_admin_menu' );

function da_bc_menu_options(){

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	?>

	<!-- add options ***************************************************************************** -->

	<?php
	add_option('da_bc_data_ride',"carousel");
	add_option('da_bc_data_interval',"5000");
	add_option('da_bc_data_pause',"hover");
	add_option('da_bc_data_wrap',"wrap");
	?>
		
	<!-- process data *************************************************************************** -->
	
	<?php
	
	if(isset($_POST['form_submitted'])){
		
		//data-ride
		if(isset($_POST['data_ride'])){
			update_option('da_bc_data_ride',$_POST['data_ride']);
		}

		//data-interval
		if(isset($_POST['data_interval'])){
			update_option('da_bc_data_interval',$_POST['data_interval']);
		}

		//data-pause
		if(isset($_POST['data_pause'])){
			update_option('da_bc_data_pause',$_POST['data_pause']);
		}

		//data-wrap
		if(isset($_POST['data_wrap'])){
			update_option('da_bc_data_wrap',$_POST['data_wrap']);
		}
		
	}
	
	?>
	
	<!-- output ******************************************************************************* -->

	<div class="wrap">

		<?php screen_icon( 'options-general' ); ?>
		<h2>Bootstrap Carousel Options</h2>

		<form method="POST" action="" >
			
			<input name="form_submitted" type="hidden" value="true">

					<table class="form-table">				
						
						<!-- data-ride -->
						<tr valign="top">
							<th scope="row"><label for="da-bc-data-ride">data-ride ( default => "carousel" )<br /><small>Start the slide automatically.</small></label></th>
							<td><input maxlength="100" size="20" name="data_ride" id="dc-bc-data-ride" value="<?php echo esc_attr( stripslashes ( get_option('da_bc_data_ride') ) ); ?>" ></td>
						</tr>

						<!-- data-interval -->
						<tr valign="top">
							<th scope="row"><label for="da-bc-data-interval">data-interval ( default => "5000" )<br /><small>The amount of time to delay between automatically cycling an item. If false, carousel will not automatically cycle.</small></label></th>
							<td><input maxlength="6" size="6" name="data_interval" id="dc-bc-data-interval" value="<?php echo esc_attr( stripslashes ( get_option('da_bc_data_interval') ) ); ?>" ></td>
						</tr>

						<!-- data-pause -->
						<tr valign="top">
							<th scope="row"><label for="da-bc-data-pause">data-pause ( default => "hover" )<br /><small>Pauses the cycling of the carousel on mouseenter and resumes the cycling of the carousel on mouseleave.</small></label></th>
							<td><input maxlength="100" size="20" name="data_pause" id="dc-bc-data-pause" value="<?php echo esc_attr( stripslashes ( get_option('da_bc_data_pause') ) ); ?>" ></td>
						</tr>

						<!-- data-wrap -->
						<tr valign="top">
							<th scope="row"><label for="da-bc-data-wrap">data-wrap ( default => "wrap" )<br /><small>Whether the carousel should cycle continuously or have hard stops.</small></label></th>
							<td><input maxlength="100" size="20" name="data_wrap" id="dc-bc-data-wrap" value="<?php echo esc_attr( stripslashes ( get_option('da_bc_data_wrap') ) ); ?>" ></td>
						</tr>
					
					</table>

			<!-- Submit Button -->

			<input type="submit" name="save" value="Save Options" class="button-primary" />
		
		</form>
		
		<h3>How To Use:</h3>
		<ul>

			<li>* Add your slides in the Bootstrap Carousel menu and assign every slide to a specific carousel with the "Carousel Name" taxonomy.</li>
			<li>* Add the carousel in the HTML of your theme with the following code: <code>&lt?php put_bootstrap_slider('carouselname'); ?&gt</code></li>
			<li>* Show the carousel only in specific area of your website by adding a second parameter: <code>&lt?php put_bootstrap_slider('carouselname','home'); ?&gt</code> ( 'all' -> Show throughout the website - "home" -> Show only in the homepage - "posts" -> Show only in your posts - "pages" -> Show only in your pages )</li>
			<li>* Add the carousel in a post with the following shortcode.<code>[put-bootstrap-slider name="carouselname"]</code></li>
			<li>* Customize the carousel caption title with the <code>.carousel-caption-custom-title</code> selector.</li>
			<li>* Customize the carousel caption description with the <code>.carousel-caption-custom-description</code> selector.</li>

		</ul>


	</div>

	<?php

}

?>