<?php
// SLIDESHOW POST TYPE

/*-----------------------------------------------------------------------------------*/
// Add admin scripts for Slides Post type
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'st_admin_scripts' ) ) {

function st_admin_scripts() {
	if (is_admin()) {
		$javascripts = wp_enqueue_script('slides-post-type',get_bloginfo('template_url') ."/lib/admin/js/post-type.js",array('jquery'),'1.0',false);
		return $javascripts;
	}
}
add_action('admin_enqueue_scripts', 'st_admin_scripts');

} // endif



function st_post_type_slide() {

$postlabels = array(
  'name' => _x('Slides', 'post type general name'),
  'singular_name' => _x('Slide', 'post type singular name'),
  'add_new' => _x('Add New', 'slide'),
  'add_new_item' => __('Add New Slide'),
  'edit_item' => __('Edit Slide'),
  'new_item' => __('New Slide'),
  'view_item' => __('View Slide'),
  'search_items' => __('Search Slides'),
  'not_found' =>  __('No slides found'),
  'not_found_in_trash' => __('No slides found in Trash'),
  'parent_item_colon' => '',
  'menu_name' => 'Slides',
  );


register_post_type('slide',
	array(
	'labels' => $postlabels,
	'singular_label' => __('Slide'),
	'public' => true,
	'show_ui' => true,
	'_builtin' => false, // It's a custom post type, not built in
	'_edit_link' => 'post.php?post=%d',
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array("slug" => "slide"), // Permalinks
	'query_var' => "stslide", // This goes to the WP_Query schema
	'supports' => array('title','author','thumbnail','customexcerpt'),
	'menu_position' => null,
	'publicly_queryable' => true,
	'show_in_nav_menus' => false,
	'exclude_from_search' => true,
  	'menu_icon' => get_template_directory_uri() . '/lib/editor/tinymceSlideshow/icon.png',
	));
}

$slidelabels = array(
  'name' => _x( 'Slideshows', 'taxonomy general name' ),
  'singular_name' => _x( 'Slideshow', 'taxonomy singular name' ),
  'search_items' =>  __( 'Search Slideshows' ),
  'all_items' => __( 'All Slideshows' ),
  'parent_item' => __( 'Parent Slideshow' ),
  'parent_item_colon' => __( 'Parent Slideshow:' ),
  'edit_item' => __( 'Edit Slideshow' ),
  'update_item' => __( 'Update Slideshow' ),
  'add_new_item' => __( 'Add New Slideshow' ),
  'new_item_name' => __( 'New Slideshow' ),
  'menu_name' => __( 'Slideshows' ),
);

register_taxonomy("slidecategory", array("slide"),
array('hierarchical' => true,
		'labels' => $slidelabels,
		'rewrite' => true,
		'show_in_nav_menus' => false,
		'show_ui' => true
		));


add_action('init', 'st_post_type_slide');

// if wp_show_ids plugin isn't installed - add ID column
if (!class_exists ("c_ws_plugin__wp_show_ids_columns")) {

add_filter('manage_edit-slidecategory_columns', 'st_slidecategory_columns', 5);
add_action('manage_slidecategory_custom_column', 'st_slidecategory_custom_columns', 5, 3);
function st_slidecategory_columns($defaults) {
	$defaults['st_slidecategory_ids'] = __('ID');
	return $defaults;
}

function st_slidecategory_custom_columns($value, $column_name, $id) {
	if( $column_name == 'st_slidecategory_ids' ) {
		return (int)$id;
	}
}

}


// Contextual Help for Slides and Slideshows
add_action( 'contextual_help', 'slider_add_help_text', 10, 3 );
function slider_add_help_text($contextual_help, $screen_id, $screen) {
// $contextual_help .= var_dump($screen); // use this to help determine $screen->id
if ('edit-slidecategory' == $screen->id ) {
$contextual_help = '<p>Once you create a \'Slideshow\' below, you\'ll be able to add \'Slides\' which can be assigned to them.</p><p>To insert a Slideshow into your content, click the \'Insert Slideshow\' button in the editor of any Page or Post.</p>';
} elseif ('slide' == $screen->id || 'edit-slide' == $screen->id ) {
$contextual_help = '<p>Create a \'Slide\' below, and assign it to a \'Slideshow\'.</p><p>To assign an image to a Slide, click \'<strong>Set Featured Image</strong>\' and upload or choose an existing image.<br />After selecting an image, be sure to click \'<strong>Use as featured image</strong>\' in the popup window.</p>';
}
return $contextual_help;
}

// shows the 'slidecategories' in dropdown filter
add_action( 'restrict_manage_posts', 'st_slidecats_restrict_manage_posts' );
function st_slidecats_restrict_manage_posts() {
	global $typenow;
	$taxonomy = 'slidecategory';
	if( $typenow != "page" && $typenow != "post" ){
		$filters = array($taxonomy);
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>Show All $tax_name</option>";
			foreach ($terms as $term) { echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; }
			echo "</select>";
		}
	}
}



/*-----------------------------------------------------------------------------------*/
/* Slideshow Options
/*-----------------------------------------------------------------------------------*/

function st_cycle_slider($termId,$width,$height,$effect,$speed,$pagination,$prevnext,$autoplay,$autoheight){
	global $post;

	if($width == 'fullwidth'){
		$imagesize ='slider';
	} elseif($width == 'normal'){
		$imagesize='post';}
	else {
		$imagesize ='slider';
	}

	// smoothHeight
	$autoheight = ($autoheight) ? $autoheight : 'false';
	// animationSpeed
	$slidespeed = ($speed) ? $speed : 7000;
	// controlNav
	$showpagination = ($pagination) ? $pagination : 'true';
	// directionNav
	$showprevnext = ($prevnext) ? $prevnext : 'true';

	// autoplay not defined or false
	if ($autoplay == '' || $autoplay == 'false') {
		// disabled (default)
		$slideshow = 'false';
	} else {
		// enabled
		$slideshow = 'true';
	}

	// autoplay not false, not undefined, and has a number
	if ($autoplay != 'false' && $autoplay != '' && is_numeric($autoplay)) {
		// return the number
		$cycle = $autoplay;
		// set some defaults
	} else {
		$cycle = 3000;
	}

	$termName = get_term_by( 'id', $termId,'slidecategory' );
	$slug = $termName->slug;
	$term = preg_replace('/[^A-Za-z0-9]/', '', strtolower($slug));

	$result='';
    $result.='<div class="wpscript"><script type="text/javascript">
        jQuery.noConflict();
        jQuery(document).ready(function(){
            jQuery("#'.$term.'").flexslider({
                        animation: "'.$effect.'",
                        controlsContainer: ".controls",
                        slideshow: '.$slideshow.',
                        slideshowSpeed: '.$cycle.',
                        animationDuration: '.$slidespeed.',
                        directionNav: '.$showprevnext.',
                        controlNav: '.$showpagination.',
                        smoothHeight: '.$autoheight.',
                        pauseOnAction: true,
                        pauseOnHover: false
                        });
                    });
    </script></div>';


/*-----------------------------------------------------------------------------------*/
/* Slideshow Renderer Opening Tags
/*-----------------------------------------------------------------------------------*/

	$result.= '<div id="'.$term.'" class="flexslider">';
	$result.= '<ul class="slides">';
	// Begin Query
	$args = array(
	'post_type' => 'slide',
	'taxonomy' => 'slidecategory',
	'term' => $slug,
	'order'=>'DESC',
	'showposts'=> -1,
	);
	$myposts = new WP_Query($args);
	// query_posts($args);

	while($myposts->have_posts()) : $myposts->the_post();
	// if (have_posts()): while (have_posts()) : the_post();

	/*-----------------------------------------------------------------------------------*/
	/* Individual Slide Options
	/*-----------------------------------------------------------------------------------*/

	// title
	$showtitle = get_post_meta($post->ID,'_st_show_title',true);
	// Custom Excerpt
	$excerpt = get_post_meta($post->ID,'_st_customexcerpt',true);
	// the link
	$slideurl = get_post_meta($post->ID,'_st_customurl',true);
	// button title
	$slideurlname = get_post_meta($post->ID,'_st_customurlname',true);
	// link target
	$slidelinktarget = get_post_meta($post->ID,'_st_slide_linktarget',true);
	// caption
	$slidecaption = get_post_meta($post->ID,'_st_slide_caption',true);

	// Get the Width of the thumbnail for each slide
	$thumbnailsize = get_post_meta($post->ID,'_st_slide_thumb_size',true);
	$thumbarray = preg_split( "/(,|x)/", $thumbnailsize );
	$thumb_width = $thumbarray[0];
	$thumb_height = (isset($thumbarray[1])) ? $thumbarray[1] : $thumbarray[0];

	// st_0 = tn left
	// st_1 = tn right
	// st_2 = fullsize
	// st_3 = none
	$slidetype = get_post_meta($post->ID,'_st_slide_type',true);


	/*-----------------------------------------------------------------------------------*/
	/* Thumbnail Alignment for Content Slides
	/*-----------------------------------------------------------------------------------*/

	switch ($slidetype) {
		case '_st_0':
			$tnalign = "alignleft";
			break;
		case '_st_1':
			$tnalign = "alignright";
			break;
		case '_st_2':
			$tnalign = "fullsize";
			break;
		default:
			$tnalign = "alignleft";
			break;
	}

	/*-----------------------------------------------------------------------------------*/
	/* The Slides
	/*-----------------------------------------------------------------------------------*/

	$result.= '<li class="slide '.$tnalign.'">';

	// text slide - add inner wrap for padding
	if ($slidetype == "_st_0" || $slidetype == "_st_1" || $slidetype == "_st_3") {
		$result.= '<div class="inner">';
	}

	if (!$showtitle == '' && $slidetype != "_st_2") {
		$result.= '<h3>'.get_the_title().'</h3>';
	}


	if (has_post_thumbnail()) {
		// left/right aligned thumbnail
		if ($slidetype == "_st_0" || $slidetype == "_st_1") {
			$result.= '<img alt="'.get_the_title().'" class="'.$tnalign.'" src="'.get_bloginfo('template_directory').'/thumb.php?src='.get_image_path().'&amp;h='.$thumb_height.'&amp;w='.$thumb_width.'"/>';
		// full size image
		} elseif ($slidetype == "_st_2") {
			if (!$slideurl == '') {
				$result.= '<a href="'.$slideurl.'" ';
				if ($slidelinktarget == "_st_1") {
					$result.= 'rel ="external" ';
				}
				$result.= '>';
			}
		$result.= '<img alt="'.get_the_title().'" class="'.$tnalign.'" src="'.get_bloginfo('template_directory').'/thumb.php?src='.get_image_path().'&amp;h='.$height.'&amp;w='.$width.'"/>';
			if (!$slideurl == '') {
				$result.= '</a>';
			}
		}
	}
	// if left aligned image
	if ($slidetype == "_st_0") {
	// right aligned button
		$btnalign = "right";
	// if right aligned image
	} elseif ($slidetype == "_st_1") {
	// left aligned button
		$btnalign = "left";
	//fullsize image
	} elseif ($slidetype == "_st_2") {
	// just do center for safe measure
		$btnalign = null;
	// no image. default is right
	} else {
		$btnalign = "right";
	}


	if ($slidelinktarget == "_st_0") {
	$target = "_self";
	} else {
	$target = "_blank";
	}

	if ($slidetype != "_st_2") {
	$result.= '<p>'.$excerpt.'</p>';
	}
	if (!$slideurl == '' && $slidetype != "_st_2") {
	$result.= '<div class="button '.$btnalign.'"><a class="button" target="'.$target.'" href="'.$slideurl.'">';
	$result.= $slideurlname = (!$slideurlname == '') ? $slideurlname : "Read More..";
	$result.= '</a></div>';
	}


	// text slide - add inner wrap for padding
	if ($slidetype == "_st_0" || $slidetype == "_st_1" || $slidetype == "_st_3") {
		$result.= '</div>';
	}

	if (!$slidecaption == '' && $slidetype == "_st_2") {
	$result.= '<p class="flex-caption"><span>'.$slidecaption.'</span></p>';
	}

	$result.= '</li>'; // end slides
	endwhile;
	wp_reset_postdata();
	$result.= '</ul>';
	$result.= '</div>';

	// Previous and Next Buttons
	if ($showprevnext == "true") {
		$result.= '<div class="prevnext"></div>';
	}

	$result.= '<div class="clear"></div>';
	return $result;
	}


// Slideshow Shortcode
function st_slideshow( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'type'       => '',
			'category'   => '',
			'width'      => '',
			'height'     => '',
			'speed'      => '',
			'pagination' => '',
			'prevnext'   => '',
			'autoplay'   => '',
			'autoheight' => '',
			'effect'     => ''
    ), $atts));
	return st_cycle_slider($category,$width,$height,$effect,$speed,$pagination,$prevnext,$autoplay,$autoheight);
}
add_shortcode('slideshow', 'st_slideshow');

/*
Content Slideshow Renderer
-----------------------------------------
*/


	// function get_formatted ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '' ) {
	// 	apply_filters('the_content',get_the_content( $more_link_text, $stripteaser, $more_file ));
	// 	$content = str_replace(']]>', ']]&gt;', $content);
	// 	return $content;
	// }

	function st_content_slider($category,$display,$type,$ids,$thumbsize,$width,$height,$effect,$speed,$pagination,$prevnext,$autoplay,$autoheight){
		global $post;

		if($width == 'fullwidth'){
		$imagesize ='slider';
		}
		elseif($width == 'normal'){
		$imagesize='post';}
		else {
		$imagesize ='slider';
		}
		$truewidth = $width - 20;

		// smoothHeight
		$autoheight = ($autoheight) ? $autoheight : false;

		// speed not defined
		if ($speed == '') {
		// set a default value so it doesn't wig out
		$slidespeed = 7000;
		// ok, we have a value
		} else {
		$slidespeed = $speed;
		}

		// controlNav not defined
		if ($pagination == '') {
		// default to true
		$showpagination = 'true';
		// ok, let's be specific
		} else {
		$showpagination = $pagination;
		}

		// directionNav not defined
		if ($prevnext == '') {
			// default to true
		$showprevnext = 'true';
		// ok, let's be specific
		} else {
		$showprevnext = $prevnext;
		}

		// autoplay not defined or false
		if ($autoplay == '' || $autoplay == 'false') {
		// disabled (default)
		$slideshow = 'false';
		// enabled
		} else {
		$slideshow = 'true';
		}

		// autoplay not false, not undefined, and has a number
		if ($autoplay != 'false' && $autoplay != '' && is_numeric($autoplay)) {
		// return the number
		$cycle = $autoplay;
		// set some defaults
		} else {
		$cycle = 3000;
		}

		// excerpt length
		if ($length == '') {
		$dolength = 55;
		} else {
		$dolength = $length;
		}

		// Get the Width of the thumbnail
		$thumbarray = explode(',', $thumbsize);
		$thumb_width = $thumbarray[0];
		$thumb_height = $thumbarray[1];

		$termName = get_term_by( 'id',$ids,'category' );
		$term = preg_replace('/[^A-Za-z0-9]/', '', strtolower($termName->slug));

		// if displaying pages, no slug is found so we set to 'slideshow'
		if ($type == 'page' || $type == 'pages') {
		$term = 'slideshow';
		}

		$result;
	    $result.='<div class="wpscript"><script type="text/javascript">
	        jQuery.noConflict();
	        jQuery(document).ready(function(){
	            jQuery("#'.$term.'").flexslider({
	                        animation: "'.$effect.'",
	                        controlsContainer: ".controls",
	                        slideshow: '.$slideshow.',
	                        slideshowSpeed: '.$cycle.',
	                        animationDuration: '.$slidespeed.',
	                        directionNav: '.$showprevnext.',
	                        controlNav: '.$showpagination.',
	                        smoothHeight: '.$autoheight.',
	                        pauseOnAction: true,
	                        pauseOnHover: false
	                        });
	                    });
	    </script></div>';

		// Slideshow
		$result.= '<div class="controls">';
		$result.= '<div id="'.$term.'" class="flex-container">';
		$result.= '<div id="slider" class="flexslider">';
		$result.= '<ul class="slides">';

		// Pages Query
		if ($type == 'page' || $type == 'pages') {
		$args = array(
		'post_type' => 'page',
		'order'=>'menu_order',
		'post__in' => explode(',',$ids),
		'showposts'=> -1,
		);

		// Posts Query
		} elseif ($type == 'post' || $type == 'posts' || $type == 'category' || $type == 'categories') {
		$args = array(
		'post_type' => 'post',
		'cat' => $ids,
		'term' => $term,
		'order'=>'DESC',
		'showposts'=> -1,
		);
		}


		$contentslides = new WP_Query($args);
		global $more;
		$more = 0;
		while($contentslides->have_posts()) : $contentslides->the_post();
		// Get optional 'slidecaption' custom field
		$slidecaption = get_post_meta($post->ID,'_slidecaption',true);


		// generate class for img tag display
		if ($display == "content") {
			$tnalign = "alignleft";
		} else {
			$tnalign = "fullsize";
		}

		// display the slider
		$result.= '<li class="slide '.$tnalign.'">';


		// show slide headings on content slides only
		if ($display != "image") {
			$result.= '<div class="inner">';
			$result.= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
		}

		// If featured image is set, display a thumbnail
		if (has_post_thumbnail()) {

			// thumbnail
			if ($display == "content") {
				$result.= '<img alt="'.get_the_title().'" class="'.$tnalign.'" src="'.get_bloginfo('template_directory').'/thumb.php?src='.get_image_path().'&amp;h='.$thumb_height.'&amp;w='.$thumb_width.'"/>';

			// full size image
			} elseif ($display == "image") {
			$result.= '<a href="'.get_permalink().'"><img alt="'.get_the_title().'" class="'.$tnalign.'" src="'.get_bloginfo('template_directory').'/thumb.php?src='.get_image_path().'&amp;h='.$height.'&amp;w='.$width.'"/></a>';
			}
		}

		// read more button
		if ($display != "image") {
		// $result.= get_the_excerpt();
		// $result.=  limit_words(get_the_excerpt(), $length);
		$result.= st_slideexcerpt('st_excerptlength', 'st_excerptmore');
		$result.= '<div class="button right"><a class="button" href="'.get_permalink().'">Read more..</a></div>';
		$result.= '</div>'; // .inner
		}

		// read more button
		// if ($display != "image") {
		// 	$result.= get_formatted();
		// }



		if (!$slidecaption == '') {
		$result.= '<p class="flex-caption">'.get_the_title().'</p>';
		}

		$result.= '</li>'; // #slide

		endwhile;
		wp_reset_postdata();

		$result.= '</ul>';
		$result.= '</div>';
		$result.= '</div>';
		$result.= '</div>';

		// Previous and Next Buttons
		if ($showprevnext == "true") {
			$result.= '<div class="prevnext">';
			$result.= '</div>';
		}


		$result.= '<div class="clear"></div>';
		return $result;
		}


// Content Slideshow Shortcode
function st_contentslides( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'display' 		=> 'content',
			'type' 		=> 'posts',
			'ids' 		=> '',
			'thumbsize' 	=> '100,100',
			'category' 	=> '',
			'width'		=> '',
			'height'		=> '',
			'speed'		=> '',
			'pagination'		=> '',
			'prevnext'		=> '',
			'autoplay'		=> '',
			'length' => '',
			'effect'		=> ''
    ), $atts));


	return st_content_slider($category,$display,$type,$ids,$thumbsize,$width,$height,$effect,$speed,$pagination,$prevnext,$autoplay);
}
add_shortcode('contentslides', 'st_contentslides');



// Custom Excerpt Length for Slider
function st_excerptlength($length) {
return 55;
}

// Excerpt more
function st_excerptmore($more) {
return '...';
}

// The Callback
function st_slideexcerpt($length_callback='', $more_callback='') {
global $post;
if(function_exists($length_callback)){
add_filter('excerpt_length', $length_callback);
}
if(function_exists($more_callback)){
add_filter('excerpt_more', $more_callback);
}
$output = get_the_excerpt();
$output = apply_filters('wptexturize', $output);
$output = apply_filters('convert_chars', $output);
$output = $output;
return $output;
}
// http://www.simplethemes.com/forum/viewtopic.php?f=26&t=720#p2818
// [contentslides effect="slide" thumbsize="200,150" display="image" type="category" ids="5" width="600" height="320" autoplay="3000" speed="700" pagination="true" prevnext="false"]
// effect: slide,fade
// display: content, image
// (content will display text before the <!--more--> tag. image will display full sized featured images)
// thumbsize: width,height of featured image (if set) when used in content display mode.
// type: category, pages (display a Post category series of Pages)
// ids: comma separated Category/Page ID's (e.g; 1,7,9,12)
// width: Slider Width
// height: Slider Height
// autoplay: time in milliseconds to auto advance to next slide
// speed: duration of slide/fade animation
// pagination:true,false (shows bullet pagination)
// prevnext: true,false (shows previous and next arrows)

?>