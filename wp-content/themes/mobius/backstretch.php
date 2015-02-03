<?php

/*-----------------------------------------------------------------------------------*/
// Advanced Custom Fields
// http://wordpress.org/extend/plugins/advanced-custom-fields/
/*-----------------------------------------------------------------------------------*/

// Check to see the plugin is installed

function st_install_acf_warning() {
	if( !class_exists('acf') ) {
		$html = '<div class="container"><div class="ten columns offset3">';
		$html .= '<div class="note alert">Advanced Custom Fields is Not installed<br />To use this Page template, please <a href="wp-admin/plugins.php?s=Advanced+Custom+Fields">install the plugin</a> and assign the images to this post.</div>';
		$html .= '</div></div>';
		echo $html;
	}
}
add_action('st_backstretch','st_install_acf_warning',99);



/*-----------------------------------------------------------------------------------*/
// Global hook for Backstretch display in template
/*-----------------------------------------------------------------------------------*/


function st_backstretch() {
	do_action('st_backstretch');
}


// ACF plugin must be installed before anything else executes
if( class_exists('acf') ) {


/*-----------------------------------------------------------------------------------*/
// st_backstretch_script()
// Script to insert in Page
/*-----------------------------------------------------------------------------------*/


if(!function_exists("st_backstretch_script")) {

	function st_backstretch_script() {
		if ( is_page_template('backstretch-page.php') && !is_admin() ) {
			if( is_array( get_field('_st_acf_page_options') )  && in_array( 'show_backstretch', get_field('_st_acf_page_options') ) ) {
				global $post;

				$available_fields = get_field('_st_backstretch_images');
				$result = array();
				while(has_sub_field('_st_backstretch_images')) {
					$image_obj = get_sub_field('_image');
					$data = array(
						'img' => $image_obj['url'],
						'caption' => $image_obj['caption'],
						'link' => get_sub_field('_link')
					);
					array_push($result,$data);
				}
				$data = array_filter($result,'array_filter');

				$backstretch_fade = get_field('_st_backstretch_fade_speed');
				$backstretch_duration = get_field('_st_backstretch_duration');
				$backstretch_centeredY = get_field('_st_backstretch_center_images');
				$backstretch_height = get_field('_st_backstretch_height');
			?>
			<script type="text/javascript">

				jQuery(document).ready(function($) {
					//backstretch slider
					var items = <?php echo json_encode($data);?>;

					var options = {
					    fade: <?php echo $backstretch_fade;?>,
					    duration: <?php echo $backstretch_duration;?>,
					    centeredY: <?php echo $backstretch_centeredY;?>
					};

					var images = $.map(items, function(i) { return i.img; });
					var slideshow = $("#st_backstretch").backstretch(images,options);

					$("#st_backstretch").css("height", '<?php echo $backstretch_height;?>px');

					$(window).on("backstretch.show", function(e, instance) {
					    var theCaption = items[instance.index].caption;
					    var theLink = items[instance.index].link;
					    if (theCaption) {
							if (theLink) {
								$(".backstretch-caption").html('<a href="'+theLink+'">'+theCaption+'</a>').show().addClass('animated fadeInUp');
							} else {
								$(".backstretch-caption").text(theCaption).show().addClass('animated fadeInUp');
							}
						}
					});
					$(window).on("backstretch.before", function(e, instance) {
						$(".backstretch-caption").hide();
					});
					$(".backstretch-slide-pause").click(function(e){
						e.preventDefault();
					    slideshow.data('backstretch').pause();
					});
					$(".backstretch-slide-prev").click(function(e) {
						e.preventDefault();
						slideshow.data('backstretch').prev();
					    $(".backstretch-caption").hide();
					});
					$(".backstretch-slide-next").click(function(e) {
						e.preventDefault();
						slideshow.data('backstretch').next();
					    $(".backstretch-caption").hide();
					});
				});

			</script>
			<?php
			}
		}
	}
	add_action('wp_head','st_backstretch_script',99);

} //endif function_exists


/*-----------------------------------------------------------------------------------*/
// st_backstretch_markup()
// The output for backstretch
/*-----------------------------------------------------------------------------------*/


if(!function_exists("st_backstretch_markup")) {
	function st_backstretch_markup() {
		if( is_array( get_field('_st_acf_page_options') ) && in_array( 'show_backstretch', get_field('_st_acf_page_options') ) ) {
			$shownav = get_field('_st_backstretch_navigation');
			?>
			<div id="st_backstretch">
				<div class="backstretch-caption"></div>
				<div id="backstretch-controls" <?php if ($shownav) echo 'style="display:none;"';?>>
					<a class="backstretch-slide-prev btn" href="#">&laquo;</a>
					<a class="backstretch-slide-pause btn icon-pause" href="#"><strong>| |</strong></a>
					<a class="backstretch-slide-next btn" href="#">&raquo;</a>
				</div>
			</div>
			<div class="clear"></div>
		<?php
		}
	}
	add_action('st_backstretch','st_backstretch_markup',10);
} //endif function_exists



/*-----------------------------------------------------------------------------------*/
// st_google_map_script()
// The output for Google Maps
/*-----------------------------------------------------------------------------------*/


if(!function_exists("st_google_map_script")) {
function st_google_map_script() {
	if( is_page_template('backstretch-page.php') && is_array( get_field('_st_acf_page_options') )  && in_array( 'show_gmap', get_field('_st_acf_page_options')) && !is_admin() )  {
		$mapdata = get_field('_st_google_map');
		$address = $mapdata['address'];
		$latitude = $mapdata['lat'];
		$longitude = $mapdata['lng'];
		$marker_title = get_field('_st_google_map_marker_title');
		if ($marker_title == 'geodata') {
			$marker_title = $address;
		} else {
			$marker_title = $marker_title;
		}
	?>
<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var map; //<-- This is now available to both event listeners and the initialize() function
	function initialize() {
		var myLatlng = new google.maps.LatLng(<?php echo $latitude;?>,<?php echo $longitude;?>);
		var mapOptions = {
			center: myLatlng,
			zoom: 12,
			scrollwheel: false,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById("st_gmap"),mapOptions);
		var marker = new google.maps.Marker({
			position: myLatlng,
			title:"<?php echo $address;?>"
		});
		marker.setMap(map);

		var contentString = '<?php echo $marker_title;?>';
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		infowindow.open(map,marker);
	} // end inititalize
	google.maps.event.addDomListener(window, 'load', initialize);
	google.maps.event.addDomListener(window, "resize", function() {
		var center = map.getCenter();
		google.maps.event.trigger(map, "resize");
		map.setCenter(center);
	});
});
</script>

<?php
		}
	}
	add_action('wp_head','st_google_map_script',11);
} //endif function_exists


/*-----------------------------------------------------------------------------------*/
// st_google_map()
// The output for Google Maps
/*-----------------------------------------------------------------------------------*/


if(!function_exists("st_google_map")) {
	function st_google_map() {
		if( is_page_template('backstretch-page.php') && is_array( get_field('_st_acf_page_options') ) && in_array( 'show_gmap', get_field('_st_acf_page_options') ) ) {
			echo '<div id="st_gmap"></div>';
		}
	}
	add_action('st_footer', 'st_google_map',2);
}


/*-----------------------------------------------------------------------------------*/
// register_field_group()
// Register The ACF Image Fields - Proceed with extreme caution
/*-----------------------------------------------------------------------------------*/


if(function_exists("register_field_group") && class_exists('acf')) {
	//require_once ( get_template_directory().'/lib/acf-repeater/acf-repeater.php');
	if(function_exists("register_field_group")) {
		// BEGIN EXPORT
		register_field_group(array (
			'id' => 'acf_page-options',
			'title' => 'Page Options',
			'fields' => array (
				array (
					'key' => 'field_5291841cf937a',
					'label' => 'Page Options',
					'name' => '_st_acf_page_options',
					'type' => 'checkbox',
					'instructions' => 'Select the elements you wish to display on this Page.',
					'choices' => array (
						'show_backstretch' => 'Backstretch Slider',
						'show_gmap' => 'Google Map',
					),
					'default_value' => 'false
		false',
					'layout' => 'horizontal',
				),
				array (
					'key' => 'field_52918750f034b',
					'label' => 'Backstretch Slider',
					'name' => '',
					'type' => 'tab',
					'conditional_logic' => array (
						'status' => 1,
						'rules' => array (
							array (
								'field' => 'field_5291841cf937a',
								'operator' => '==',
								'value' => 'show_backstretch',
							),
						),
						'allorany' => 'all',
					),
				),
				array (
					'key' => 'field_529188e991074',
					'label' => 'Images',
					'name' => '_st_backstretch_images',
					'type' => 'repeater',
					'instructions' => 'Images are displayed at full width, so be please be sure to use compressed wide images (e.g; 1400px).<br />
		Too many large images can slow down your site, so please restraint with this! <br />
		Visit unsplash.com for free high quality sample images.',
					'sub_fields' => array (
						array (
							'key' => 'field_5291893791075',
							'label' => 'Image',
							'name' => '_image',
							'type' => 'image',
							'instructions' => 'Edit the image caption to display a short caption.',
							'column_width' => 25,
							'save_format' => 'object',
							'preview_size' => 'thumbnail',
							'library' => 'uploadedTo',
						),
						array (
							'key' => 'field_5291897b91076',
							'label' => 'Link',
							'name' => '_link',
							'type' => 'text',
							'instructions' => 'Optional Link to go when slide caption is clicked.',
							'column_width' => 75,
							'default_value' => '',
							'placeholder' => 'http://domain.com',
							'prepend' => '',
							'append' => '',
							'formatting' => 'none',
							'maxlength' => '',
						),
					),
					'row_min' => '',
					'row_limit' => '',
					'layout' => 'table',
					'button_label' => 'Add Row',
				),
				array (
					'key' => 'field_52918778a837f',
					'label' => 'Height',
					'name' => '_st_backstretch_height',
					'type' => 'text',
					'instructions' => 'Slider Height (px)',
					'required' => 1,
					'default_value' => 250,
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'formatting' => 'none',
					'maxlength' => 3,
				),
				array (
					'key' => 'field_529187eea8380',
					'label' => 'Fade Speed',
					'name' => '_st_backstretch_fade_speed',
					'type' => 'text',
					'instructions' => 'Fade Transition duration<br />*in milliseconds',
					'required' => 1,
					'default_value' => 700,
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'formatting' => 'none',
					'maxlength' => 3,
				),
				array (
					'key' => 'field_52918823357f2',
					'label' => 'Duration',
					'name' => '_st_backstretch_duration',
					'type' => 'text',
					'instructions' => 'Timeout between transitions<br />*in milliseconds',
					'required' => 1,
					'default_value' => 4000,
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'formatting' => 'html',
					'maxlength' => '',
				),
				array (
					'key' => 'field_529188674929d',
					'label' => 'Center Images',
					'name' => '_st_backstretch_center_images',
					'type' => 'radio',
					'instructions' => 'Center images on the Y axis (vertically)',
					'choices' => array (
						'true' => 'True',
						'false' => 'False',
					),
					'other_choice' => 0,
					'save_other_choice' => 0,
					'default_value' => 'false',
					'layout' => 'horizontal',
				),
				array (
					'key' => 'field_529188a79c155',
					'label' => 'Backstretch Navigation',
					'name' => '_st_backstretch_navigation',
					'type' => 'true_false',
					'instructions' => 'Hide the navigation arrows?',
					'message' => '',
					'default_value' => 1,
				),
				array (
					'key' => 'field_5291852af937b',
					'label' => 'Google Maps',
					'name' => '',
					'type' => 'tab',
					'conditional_logic' => array (
						'status' => 1,
						'rules' => array (
							array (
								'field' => 'field_5291841cf937a',
								'operator' => '==',
								'value' => 'show_gmap',
							),
						),
						'allorany' => 'all',
					),
				),
				array (
					'key' => 'field_5291867229532',
					'label' => 'Google Maps',
					'name' => '_st_google_map',
					'type' => 'google_map',
					'instructions' => 'Add a Google Map to this Page.',
					'conditional_logic' => array (
						'status' => 1,
						'rules' => array (
							array (
								'field' => 'field_5291841cf937a',
								'operator' => '==',
								'value' => 'show_gmap',
							),
						),
						'allorany' => 'all',
					),
					'center_lat' => '40.7386048',
					'center_lng' => '-73.98841049999999',
					'height' => 250,
				),
				array (
					'key' => 'field_529185595ce38',
					'label' => 'Marker Title',
					'name' => '_st_google_map_marker_title',
					'type' => 'radio',
					'instructions' => 'Select how you prefer the map marker tooltip to display.',
					'choices' => array (
						'geodata' => 'Use Geodata',
					),
					'other_choice' => 1,
					'save_other_choice' => 0,
					'default_value' => '',
					'layout' => 'vertical',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'page_template',
						'operator' => '==',
						'value' => 'backstretch-page.php',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options' => array (
				'position' => 'acf_after_title',
				'layout' => 'default',
				'hide_on_screen' => array (
				),
			),
			'menu_order' => 0,
		));
		// END EXPORT
	}
}

} //endif ACF installed
?>