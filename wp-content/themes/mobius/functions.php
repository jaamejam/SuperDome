<?php
/**
 * Mobius theme functions and definitions
 *
 * Other functions are attached to action and filter hooks in WordPress to change core functionality.
 *
 * Layout Functions:
 *
 * st_above_header
 * st_header_open
 * st_top_bar
 * st_logo
 * st_header_close
 * st_below_header
 * st_navbar
 * st_before_content
 * st_after_content
 * st_before_comments
 * st_after_comments
 * st_before_footer
 * st_footer
 * st_footernav
 * st_after_footer
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, smpl_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage smpl
 * @since smpl 0.1
 */

// User Interface Metaboxes
require_once ( get_template_directory().'/lib/ui.php');

// Slides Post Type & Frontend Theme Functions
require_once ( get_template_directory().'/lib/slides.php');

// Shortcodes Functions
require_once ( get_template_directory().'/lib/shortcodes.php');

// Custom Widgets
require_once ( get_template_directory().'/lib/custom_widgets.php');
require_once ( get_template_directory().'/widgets.php');

// Content functions (breadcrumbs, blog meta, etc.)
require_once ( get_template_directory().'/lib/content_functions.php');


// Imports ACF Custom Fields
define( 'ACF_LITE' , true );
require_once( get_template_directory().'/lib/class-tgm-plugin-activation.php');
require_once( get_template_directory().'/backstretch.php');

// Include this file to enable Widget Classes
// Adds S1,S2,S3 classes to widget containers
// require_once( get_template_directory().'/lib/widget-classes.php');

/*-----------------------------------------------------------------------------------*/
/* Initialize the Options Framework
/* http://wptheming.com/options-framework-theme/
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'optionsframework_init' ) ) {

define('OPTIONS_FRAMEWORK_URL', get_template_directory_uri() . '/lib/admin/');
define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory() . '/lib/admin/');

require_once ( OPTIONS_FRAMEWORK_DIRECTORY.'options-framework.php');

// Enables automatic theme updates.
if (is_child_theme()) {
	require (get_template_directory().'/lib/update.php');
}

/*-----------------------------------------------------------------------------------*/
/* Define the sidebar and content widths for use in multiple functions
/* These values can be overridden on a conditional basis later on. See comments.
/*-----------------------------------------------------------------------------------*/

if (!of_get_option('sidebar_width')) {
	define('SIDEBARWIDTH', 'five');
} else {
	define('SIDEBARWIDTH', of_get_option('sidebar_width'));
}

if (!of_get_option('content_width')) {
	define('CONTENTWIDTH', 'eleven');
} else {
	define('CONTENTWIDTH', of_get_option('content_width'));
}


} // endif optionsframework_init()


/*-----------------------------------------------------------------------------------*/
// Run smpl_setup() when the 'after_setup_theme' hook is run.
/*-----------------------------------------------------------------------------------*/

add_action( 'after_setup_theme', 'smpl_setup' );

if ( ! function_exists( 'smpl_setup' ) ):

function smpl_setup() {
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override smpl_setup() in a child theme, add your own smpl_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Smpl 1.0
 */

/*-----------------------------------------------------------------------------------*/
// Styles the visual editor with editor-style.css to match the theme style.
/*-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
// Post Formats not enabled
// add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
// Enable Featured Thumbnails
/*-----------------------------------------------------------------------------------*/

	add_theme_support( 'post-thumbnails' );
	set_user_setting( 'dfw_width', 1024 );
	add_editor_style();

 	// Use Regenerate Thumbnails Plugin to create these images on an existing install..
	// Set default thumbnail size

  	set_post_thumbnail_size( 150, 150 );
	// 75px square
	add_image_size( $name = 'squared75', $width = 75, $height = 75, $crop = true );
	// 150px square
	add_image_size( $name = 'squared150', $width = 150, $height = 150, $crop = true );
	// 250px square
	add_image_size( $name = 'squared250', $width = 250, $height = 250, $crop = true );
	// Small Banner
	add_image_size( $name = 'sm_banner', $width = 290, $height = 90, $crop = true );
	// 4:3 Video
	add_image_size( $name = 'video43', $width = 320, $height = 240, $crop = true );
	// 16:9 Video
	add_image_size( $name = 'video169', $width = 320, $height = 180, $crop = true );
	// small 16:9 Video
	add_image_size( $name = 'video169sm', $width = 250, $height = 140, $crop = true );


/*-----------------------------------------------------------------------------------*/
// Add default posts and comments RSS feed links to head
/*-----------------------------------------------------------------------------------*/

	add_theme_support( 'automatic-feed-links' );


/*-----------------------------------------------------------------------------------*/
// Register Menus
/*-----------------------------------------------------------------------------------*/

	register_nav_menus( array(
		'top'		=> __( 'Top Navigation', 'smpl' ),
		'primary'	=> __( 'Primary Navigation', 'smpl' ),
		'footer'	=> __( 'Footer Navigation', 'smpl' )
	));


/*-----------------------------------------------------------------------------------*/
// Make theme available for translation
// Translations can be filed in the /languages/ directory
/*-----------------------------------------------------------------------------------*/

	load_theme_textdomain( 'smpl', get_stylesheet_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_stylesheet_directory() . "/languages/$locale.php";

	if (is_readable($locale_file)) {
		require_once($locale_file);
	}


}
endif; // smpl_setup


// Begin Header Action Hooks

/*-----------------------------------------------------------------------------------*/
// Hook to add content before header
/*-----------------------------------------------------------------------------------*/


function st_before_header() {
    do_action('st_before_header');
}



/*-----------------------------------------------------------------------------------*/
// Primary Header Function
/*-----------------------------------------------------------------------------------*/


function st_header() {
  do_action('st_header');
}



/*-----------------------------------------------------------------------------------*/
// Hook to add content after header
/*-----------------------------------------------------------------------------------*/


function st_after_header() {
    do_action('st_after_header');
}


/*-----------------------------------------------------------------------------------*/
// st_content_wrap
/*-----------------------------------------------------------------------------------*/

function st_content_wrap() {
	do_action('st_content_wrap');
}


/*-----------------------------------------------------------------------------------*/
// st_before_content
/*-----------------------------------------------------------------------------------*/

function st_before_content() {
	do_action('st_before_content');
}


/*-----------------------------------------------------------------------------------*/
// st_after_content
/*-----------------------------------------------------------------------------------*/

function st_after_content() {
	do_action('st_after_content');
}


/*-----------------------------------------------------------------------------------*/
// st_content_wrap_close
/*-----------------------------------------------------------------------------------*/

function st_content_wrap_close() {
	do_action('st_content_wrap_close');
}

/*-----------------------------------------------------------------------------------*/
// Before/After Commment Hooks
/*-----------------------------------------------------------------------------------*/


// Before Comments Hook
function st_before_comments() {
    do_action('st_before_comments');
}

// After Comments Hook
function st_after_comments() {
    do_action('st_after_comments');
}


/*-----------------------------------------------------------------------------------*/
// Before/After Sidebar Hooks
/*-----------------------------------------------------------------------------------*/

function st_before_sidebar() {
    do_action('st_before_sidebar');
}


function st_after_sidebar() {
    do_action('st_after_sidebar');
}


/*-----------------------------------------------------------------------------------*/
// Footer Hook
/*-----------------------------------------------------------------------------------*/


function st_footer() {
	do_action('st_footer');
}
add_action('wp_footer', 'st_footer',1);



/*-----------------------------------------------------------------------------------*/
// Register Core Stylesheets
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'st_registerstyles' ) ) {

function st_registerstyles() {
	$theme = wp_get_theme();
	if(is_child_theme()) {
		$parent = $theme->parent();
		$version = $parent['Version'];
		} else {
		$version = $theme['Version'];
	}

	$stylesheets = '';
	// Main theme stylesheet
    $stylesheets .= wp_register_style('theme', get_bloginfo('stylesheet_directory').'/style.css', array(), $version, 'screen, projection');

	// first, check to see that responsive mode is enabled
	if (of_get_option('mobile_support') == 'mobile') {

		// register the various widths based on max_layout_width option
		$maxwidth = of_get_option('max_layout_width');

		if ($maxwidth) {
			// load the appropriate stylesheet
  			$stylesheets = wp_register_style('skeleton', get_bloginfo('template_directory').'/css/skeleton-'.$maxwidth.'.css', array(), $version, 'screen, projection');
		} else {
			//fallback to original for legacy theme compatibility
  			$stylesheets = wp_register_style('skeleton', get_bloginfo('template_directory').'/css/skeleton-r.css', array(), $version, 'screen, projection');
		}
  		$stylesheets .= wp_register_style('layout', get_bloginfo('template_directory').'/layout.css', array('theme'), $version, 'screen, projection');

	} else {
		// apply fixed width if disabled
  		$stylesheets = wp_register_style('skeleton', get_bloginfo('template_directory').'/css/skeleton-f.css', array(), $version, 'screen, projection');
	}

	// Formalize // adds universal browser compatibility to form elements - http://formalize.me
    $stylesheets .= wp_register_style('formalize', get_bloginfo('template_directory').'/css/formalize.css', array('theme'), $version, 'screen, projection');
	// Flexslider // responsive slider - http://flex.madebymufffin.com/
    $stylesheets .= wp_register_style('slider', get_bloginfo('template_directory').'/css/flexslider.css', array('theme'), $version, 'screen, projection');

	$stylesheets .= wp_register_style('style', get_bloginfo('stylesheet_directory').'/'.of_get_option('layout_style').'.css', array('theme'), $version, 'screen, projection');

    $stylesheets .= wp_register_style('animate', get_bloginfo('template_directory').'/css/animate-custom.css', array('theme'), $version, 'screen, projection');
    $stylesheets .= wp_register_style('demostyle', get_bloginfo('template_directory').'/demo.css', array('theme'), $version, 'screen, projection');

	// loads the prettyphoto stylesheet if enabled
	if (of_get_option('enable_prettyphoto') == 1) {
    	$stylesheets .= wp_register_style('prettyphoto', get_bloginfo('template_directory').'/css/prettyphoto.css', array('theme'), $version, 'screen, projection');
	}

	// hook to add additional stylesheets from a child theme
	echo apply_filters ('add_stylesheets',$stylesheets);

	wp_enqueue_style( 'theme');
	wp_enqueue_style( 'skeleton');
	wp_enqueue_style( 'layout');
	wp_enqueue_style( 'slider');
	wp_enqueue_style( 'style');
	//demo
	//wp_enqueue_style( 'demostyle');
	wp_enqueue_style( 'animate');
	wp_enqueue_style( 'prettyphoto');
} //function end

add_action( 'wp_enqueue_scripts', 'st_registerstyles');


} // endif


/*-----------------------------------------------------------------------------------*/
// Register Core Javscripts
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'st_header_scripts' ) ) {

function st_header_scripts() {
	$theme = wp_get_theme();
	if(is_child_theme()) {
		$parent = $theme->parent();
		$version = $parent['Version'];
		} else {
		$version = $theme['Version'];
	}

	if (!is_admin()) {
		// Load jQuery
  		$javascripts  = wp_enqueue_script('jquery');
		// Load Custom Theme Scripts
  		$javascripts .= wp_enqueue_script('custom',get_bloginfo('template_url') ."/javascripts/custom.js",array('jquery'),$version,false);
		// Load Cycle plugin
  		$javascripts .= wp_enqueue_script('cycle',get_bloginfo('template_url') ."/javascripts/jquery.cycle.min.js",array('jquery'),$version,false);
		// Load Superfish (Dropdowns)
		$javascripts .= wp_enqueue_script('superfish',get_bloginfo('template_url') ."/javascripts/superfish.js",array('jquery'),$version,false);
		// Load Formalize
		$javascripts .= wp_enqueue_script('formalize',get_bloginfo('template_url') ."/javascripts/jquery.formalize.min.js",array('jquery'),$version,false);
		// Load Slider
		$javascripts .= wp_enqueue_script('flexslider',get_bloginfo('template_url') ."/javascripts/jquery.flexslider.js",array('jquery'),$version,false);
		// Load Backstretch
		if ( is_page_template('backstretch-page.php')) {
		$javascripts .= wp_enqueue_script('backstretch',get_bloginfo('template_url') ."/javascripts/jquery.backstretch.min.js",array('jquery'),$version,false);
		}
		// Load Prettyphoto if enabled
		if (of_get_option('enable_prettyphoto') == 1) {
		$javascripts .= wp_enqueue_script('prettyphoto',get_bloginfo('template_url') ."/javascripts/jquery.prettyphoto.js",array('jquery'),$version,false);
		}
		echo apply_filters ('add_scripts',$javascripts);
	}
}

add_action('wp_enqueue_scripts', 'st_header_scripts');

} // endif


/*-----------------------------------------------------------------------------------*/
// Topbar
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'st_top_bar' ) ) {

	function st_top_bar() {
		echo '<div id="wrap">';
		if ( is_active_sidebar( 'top_bar' ) ) {
			echo '<div id="st_topbar">';
			echo '<div class="container">';
			echo '<div class="sixteen columns">';
			dynamic_sidebar('Top Bar');
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
	}
	add_action('st_before_header','st_top_bar', 1);

} // endif


/*-----------------------------------------------------------------------------------*/
// 1.Header
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'st_header_open' ) ) {

function st_header_open() {

	$class = (of_get_option('use_logo_image') ? "graphic" : "text");

	echo "<div id=\"header\" class=\"$class\">\n";
	echo "\t<div class=\"container\">\n";
	echo "\t<div class=\"sixteen columns\">\n";

}

add_action('st_header','st_header_open', 1);

} // endif


/*-----------------------------------------------------------------------------------*/
// 2.SEO Header/Logo Text
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'st_logo' ) ) {

function st_logo() {

	// Displays H1 or DIV based on whether we are on the home page or not (SEO)
	$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';

	// Apply a text or graphic class to the logo
	if (of_get_option('use_logo_image')) {
		$class="graphic";
	} else {
		$class="text";
	}

	// Check to see if a custom title and tagline is defined
	if (of_get_option('use_custom_titletag')) {
		$headline = of_get_option('site_title');
		$tagline =  of_get_option('site_tagline');
	} else {
		$headline = get_bloginfo('name');
		$tagline =  get_bloginfo('description');
	}

	// output the header
	$st_logo  = '<'.$heading_tag.' id="site-title" class="'.$class.'">';
	$st_logo .= '<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo('name','display')).'">';
	$st_logo .= $headline;
	$st_logo .= '</a></'.$heading_tag.'>'."\n";
	$st_logo .= '<span class="site-desc '.$class.'">'.$tagline.'</span>'. "\n";
	echo $st_logo;
}
add_action('st_header','st_logo', 2);

} // endif


/*-----------------------------------------------------------------------------------*/
// 3.Main Navigation
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'st_main_nav' ) ) {

	function st_main_nav() {
		$menu_placement = of_get_option('mainmenu_placement');

		echo '<div id="menu" class="'.$menu_placement.'">';
		if ($menu_placement == 'below') {
			echo '<div class="container">';
			echo '<div class="sixteen columns">';
		}
		wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary', 'menu_id' => 'nav'));
		if ($menu_placement == 'below') {
			echo '</div><!--/.columns row-->';
			echo '</div><!--/.container-->';
		}
		echo '<div class="clear"></div>';
		echo '</div><!--/#menu-->';
	}
	add_action( 'st_header', 'st_main_nav', 3);

} //endif



/*-----------------------------------------------------------------------------------*/
// 4.Close the header divs
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'st_header_close' ) ) {

	function st_header_close() {
		echo "</div><!--/.container-->";
		echo "</div><!--/.columns-->";
		echo "</div><!--/#header-->";
	}
	add_action('st_header','st_header_close', 4);

} //endif


/*-----------------------------------------------------------------------------------*/
// Teaser
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'st_teaser' ) ) {

	function st_teaser() {
		if ( is_active_sidebar( 'teaser-widget-area' ) ) {
			dynamic_sidebar( 'teaser-widget-area' );
		}
	}
	add_action( 'st_after_header', 'st_teaser',1);

} //endif


/*-----------------------------------------------------------------------------------*/
// Before Content - st_open_content_col()
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'st_open_content_col' ) )  {

	function st_open_content_col($columns) {

	if (apply_filters('st_filter_content_width', true)) {
		$columns = apply_filters('st_filter_content_width', $columns);
	}

	if (empty($columns)) {
	// Set the default
		$columns = CONTENTWIDTH;
	} else {
	// Check the function for a returned variable
		$columns = $columns;
	}
	//$columns = apply_filters('st_filter_content_width','st_set_contentwidth',1);


	// Apply the markup
	echo '<div id="content-wrapper">'; // closed in st_before_footer
	echo '<div class="container main">'; // closed in st_before_footer
	echo '<a id="top"></a>';
	echo '<div id="content">';
	echo '<div class="'.$columns.' columns">';
	do_action('st_show_breadcrumbs');
	}
	// hook to st_content_wrap()
	add_action( 'st_content_wrap', 'st_open_content_col');

} //endif


/*-----------------------------------------------------------------------------------*/
// Before Content Widgets - loaded in st_before_content
/*-----------------------------------------------------------------------------------*/


if (!function_exists( 'st_before_content_widget' ) )  {

function st_before_content_widget() {

	if ( is_active_sidebar( 'above-content-widget' )) {
		do_action('st_before_content_widget','above-content-widget');
	}

}

add_action('st_before_content_widget','st_split_widgets',10,1);
add_action('st_before_content','st_before_content_widget',1);

} //endif



/*-----------------------------------------------------------------------------------*/
// After Content Widget - loaded in st_after_content
/*-----------------------------------------------------------------------------------*/

if (!function_exists( 'st_after_content_widget' ) )  {

function st_after_content_widget() {
	if ( is_active_sidebar( 'below-content-widget' )) {
		do_action('st_after_content_widget','below-content-widget');
	}
}

add_action('st_after_content_widget','st_split_widgets',10,1);
add_action('st_after_content','st_after_content_widget',1);

} //endif



/*-----------------------------------------------------------------------------------*/
// After Content
/*-----------------------------------------------------------------------------------*/

// Close the st_content_wrap container

if (!function_exists( 'st_close_content_col' ) )  {

    function st_close_content_col() {
    	echo "\t\t</div><!-- /.columns -->\n";
    	echo "\t\t</div><!-- /#content -->\n";
    }
	add_action('st_content_wrap_close','st_close_content_col');

} //endif



/*-----------------------------------------------------------------------------------*/
// Detect Page Layout (proceed with caution!)
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'st_set_contentwidth' ) ) {

function st_set_contentwidth() {
	global $post;

	// Single Posts
	if ( is_single() ) {
		$post_wide = get_post_meta($post->ID, "sidebars", $single = true) ==  "false";

		// make sure no Post widgets are active
		if ( !is_active_sidebar('primary-widget-area') || $post_wide ) {
			$columns = 'sixteen';
		// widgets are active
		} elseif ( is_active_sidebar('primary-widget-area') && !$post_wide ) {
			$columns = CONTENTWIDTH;
		}

	// Single Pages
	} elseif ( is_page() ) {
		$page_wide = is_page_template('onecolumn-page.php') || is_page_template('wide-page.php') || is_page_template('backstretch-page.php');

		// make sure no Page widgets are active
		if ( !is_active_sidebar('secondary-widget-area') || $page_wide ) {
			$columns = 'sixteen';
		// widgets are active
		} elseif ( is_active_sidebar('secondary-widget-area') && !$page_wide ) {
			$columns = CONTENTWIDTH;
		}

	} else {
		$hide_blog_sidebar = of_get_option('hide_bloghome_sidebar');
		$theme_defaults = of_get_option('page_layout');
		// first lets check if the sidebar is included on blog page
		if ( is_home() && !$hide_blog_sidebar ) {
			$columns = CONTENTWIDTH;
		} elseif ( is_home() && $hide_blog_sidebar ) {
			$columns = 'sixteen';
		} elseif ($theme_defaults == 'wide') {
			$columns = 'sixteen';
		} else {
			$columns = CONTENTWIDTH;
		}
	}
	return $columns;

} // end function

add_filter('st_filter_content_width', 'st_set_contentwidth', 10, 1);

} //endif


/*-----------------------------------------------------------------------------------*/
// Before Sidebar - st_before_sidebar
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'st_sidebar_open' ) ) {

	function st_sidebar_open($columns) {

		if (apply_filters('st_sidebar_width', true)) {
			$columns = apply_filters('st_sidebar_width', $columns);
		}

		if (empty($columns)) {
		// Set the default
			$columns = SIDEBARWIDTH;
		} else {
		// Check the function for a returned variable
			$columns = $columns;
		}

		// Example of further conditionals:
		// Be sure to add the excess of 16 to st_content_wrap as well
		// if (is_page('typography')) {
		//  $columns = 'six';
		// }

		// Apply the markup
		echo '<div id="sidebar" class="'.$columns.' columns" role="complementary">';
		}

		add_action('st_before_sidebar', 'st_sidebar_open');


} //endif


/*-----------------------------------------------------------------------------------*/
// After Sidebar - do_action('st_after_sidebar')
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'st_sidebar_close' ) ) {

	function st_sidebar_close() {
  		echo '</div><!-- #sidebar -->';
	}
	add_action('st_after_sidebar', 'st_sidebar_close');

} //endif


/*-----------------------------------------------------------------------------------*/
// After Sidebar - do_action('st_after_sidebar')
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'st_sidebar_open' ) ) {

	function st_sidebar_open() {
  		echo '</div><!-- #sidebar -->';
	}
	add_action('st_after_sidebar', 'st_sidebar_open');

} //endif




/*-----------------------------------------------------------------------------------*/
// Before Footer
/*-----------------------------------------------------------------------------------*/


if (! function_exists('st_before_footer'))  {

    function st_before_footer() {
		echo '<div class="clear"></div>';
    	echo "\t\t</div><!-- /.container (#content) -->\n";
    	echo "\t\t</div><!-- /#content-wrapper -->\n";
    	echo '<div id="footer-wrap">';
    }
	add_action('st_footer', 'st_before_footer',1);

} //endif



if (! function_exists('st_footer_open'))  {

    function st_footer_open() {
		$footerwidgets = is_active_sidebar('first-footer-widget-area') + is_active_sidebar('second-footer-widget-area') + is_active_sidebar('third-footer-widget-area') + is_active_sidebar('fourth-footer-widget-area');
		$class = ($footerwidgets == '0' ? 'noborder' : 'normal');
		echo '<div class="clear"></div>';
		echo '<div id="footer" class="'.$class.'">';
		echo '<div class="container">';
		echo '<div class="sixteen columns">';
    }
	add_action('st_footer', 'st_footer_open',2);

} //endif



/*-----------------------------------------------------------------------------------*/
// Footer Widgets
/*-----------------------------------------------------------------------------------*/

if (! function_exists('st_footer_widgets'))  {
	function st_footer_widgets() {
		//loads sidebar-footer.php
		get_sidebar( 'footer' );
	}
	add_action('st_footer', 'st_footer_widgets',3);
}


/*-----------------------------------------------------------------------------------*/
// Footer Navigation
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'st_footer_nav' ) ) {

	function st_footer_nav() {

		$defaults = array(
		  'theme_location'  => 'footer',
		  'container'       => 'div',
		  'container_id' 		=> 'footermenu',
		  'menu_class'      => 'menu',
		  'echo'            => true,
		  'fallback_cb'     => 'wp_page_menu',
		  'after'           => '<span> | </span>',
		  'depth'           => 1);
		wp_nav_menu($defaults);
		echo '<div class="clear"></div>';

	}
	add_action('st_footer', 'st_footer_nav',4);
} //endif


/*-----------------------------------------------------------------------------------*/
// Footer Fine Print
/*-----------------------------------------------------------------------------------*/


if (! function_exists('st_footer_credits'))  {

	function st_footer_credits() {
		// prints site credits
		echo '<div id="credits">';
		echo of_get_option('footer_text');
		// display theme credits
		if (of_get_option('st_credits')) {
			// use affiliate link if defined
			if (of_get_option('st_affid') != "") {
				$st_url = 'http://www.simplethemes.com/aff/wp.php?id='.of_get_option('st_affid');
			} else {
				$st_url = 'http://www.simplethemes.com';
			}
		echo '<br /><a class="themeauthor" href="'.$st_url.'" title="Simple WordPress Themes">WordPress Theme by Simple Themes</a>';
		// end credits
		}
		echo '</div>';
	}

	add_action('st_footer', 'st_footer_credits',5);

} // endif



/*-----------------------------------------------------------------------------------*/
// After Footer
/*-----------------------------------------------------------------------------------*/


if (! function_exists('st_footer_close'))  {

    function st_footer_close() {
			echo "</div><!--/.columns-->"."\n";
			echo "</div><!--/.container-->"."\n";
			echo "</div><!--/#footer-->"."\n";
			echo "</div><!--/#footer-wrap-->"."\n";
			echo "</div><!--/#wrap-->"."\n";
			// Google Analytics
			if (of_get_option('footer_scripts') <> "" ) {
				echo stripslashes(of_get_option('footer_scripts'));
			}
    }
	add_action('st_footer', 'st_footer_close',6);
} // endif


/*-----------------------------------------------------------------------------------*/
// Split Widgets // Divides before_content_widget and after_content_widget
// into individual widget columns
/*-----------------------------------------------------------------------------------*/

if (! function_exists('st_split_widgets'))  {

function st_split_widgets($sidebar_position) {

	if ( is_active_sidebar( $sidebar_position )) {
		// count the active widgets to determine column sizes
		$the_widgets = wp_get_sidebars_widgets();
		$below_content_sidebars = $the_widgets[$sidebar_position];
		$number = count($below_content_sidebars);

		// default
		$split = "full-width";
		// if only one
		if ($number == "1") {
			$split = "fullwidth";
			dynamic_sidebar($sidebar_position);
			return;
		// if two, split in half
		} elseif ($number == "2") {
		$split = "half";
		// if three, divide in thirds
		} elseif ($number == "3") {
		$split = "third";
		// if four, split in fourths
		} elseif ($number == "4") {
		$split = "fourth";
		}

		// Turn on output buffering because we can't access individual widget objects
		ob_start();
		echo '<div class="split-widgets '.$split.'">';
		dynamic_sidebar($sidebar_position);
		echo '<div class="clear"></div></div>';
		$sidebar = ob_get_contents();
		ob_end_clean();

		// search the output for the widget-container class
		$pattern = '/widget-wrap/';
		// define replacement for columns
		$replacement = 'widget-wrap one_'.$split;
		// widget content
		$content = preg_replace($pattern, $replacement, $sidebar, -1 );

		// define search string
		$search = "widget-wrap one_".$split;
		// define replacement for .last class
		$replace = "widget-wrap one_".$split." last";
		// find the last instance and add the replace class
		$pos = strrpos($content, $search);
		if($pos !== false) {
		    $content = substr_replace($content, $replace, $pos, strlen($search));
		}
			echo $content;
	} //endif
} //@end st_split_widgets()


} // @endif function_exists('st_split_widgets')




/*-----------------------------------------------------------------------------------*/
// Comment Styles
/*-----------------------------------------------------------------------------------*/



if ( ! function_exists( 'st_comments' ) ) :
function st_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>" class="single-comment clearfix">
				<div class="comment-author vcard"> <?php echo get_avatar($comment,$size='64'); ?></div>
				<div class="comment-meta commentmetadata">
						<?php if ($comment->comment_approved == '0') : ?>
						<em><?php _e('Comment is awaiting moderation','smpl');?></em> <br />
						<?php endif; ?>
						<h6><?php echo __('By','smpl').' '.get_comment_author_link(). ' '. get_comment_date(). '  -  ' . get_comment_time(); ?></h6>
						<?php comment_text() ?>
						<?php edit_comment_link(__('Edit comment','smpl'),'  ',''); ?>
						<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply','smpl'),'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				</div>
		</div>
<!-- </li> -->
<?php  }
endif;


/*-----------------------------------------------------------------------------------*/
/* Author Bio
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'st_author_bio' ) ) {
function st_author_bio() {
	 if ( get_the_author_meta( 'description' ) ) {
	 		echo '<div id="author-info" class="outset">';
	 		echo '<div id="author-avatar">';
	 		echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'st_author_bio_avatar_size', 80 ) );
	 		echo '</div><!-- #author-avatar -->';
	 		echo '<div id="author-description">';
	 		echo '<div class="author-about">';
			printf( __( 'About the Author', 'smpl' ), get_the_author() );
			echo ': <span class="normal">';
			echo get_the_author_meta( 'firstname' );
			echo get_the_author_meta( 'lastname' );
			echo '</span><br />';
			echo '<span class="author-url"><a href="';
			echo get_the_author_meta( 'url' );
			echo '">';
			echo get_the_author_meta( 'url' );
			echo '</a></span>';
			echo '</div>';
	 		the_author_meta( 'description' );
			echo '</div><!-- #author-description	-->';
			echo '<div class="clear"></div>';
	 		echo '</div>';
		}
	}
}


if (! function_exists('addlightboxrel_replace'))  {

if (of_get_option('enable_prettyphoto')) {

function addlightboxrel_replace ($content) {
	global $post;
	$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
	$replacement = '<a$1href=$2$3.$4$5 rel="prettyPhoto['.$post->ID.']"$6>$7</a>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}
add_filter('the_content', 'addlightboxrel_replace', 12);
add_filter('get_comment_text', 'addlightboxrel_replace');

}	// endif
} // endif





/*-----------------------------------------------------------------------------------*/
// Logo CSS
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'logostyle' ) ) {

	function logostyle() {
	// render the logo as text or image
	if (of_get_option('use_logo_image')) {
		$styles = '#header #site-title.graphic a {background-image: url('.of_get_option('header_logo').');width: '.of_get_option('logo_width').'px;height: '.of_get_option('logo_height').'px;margin:'.of_get_option('logo_margin').'}';
	}

	// center the logo
	if (of_get_option('center_logo')) {
		$styles .= '#header div#site-title a,#header h1#site-title a,.site-desc {margin:0px auto !important;display:block;text-align:center;}';
	}

	// output the styles
	if (of_get_option('use_logo_image') || of_get_option('center_logo')) {
			echo "\n".'<style type="text/css">'."\n";
			echo $styles."\n";
			echo '</style>'."\n";
		}
	}
	add_action('wp_head', 'logostyle');

} //endif


/*-----------------------------------------------------------------------------------*/
// Mobile Logo CSS
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'st_mobile_logo' ) ) {

function st_mobile_logo() {
	if (of_get_option('use_mobile_logo_image')) {
		$styles  =  '<style type="text/css">';
		$styles .= 	'@media
		only screen and (-webkit-min-device-pixel-ratio: 2),
		only screen and (   min--moz-device-pixel-ratio: 2),
		only screen and (     -o-min-device-pixel-ratio: 2/1),
		only screen and (        min-device-pixel-ratio: 2),
		only screen and (                min-resolution: 192dpi),
		only screen and (                min-resolution: 2dppx) {';
		$styles .=	'#wrap #header #site-title.graphic a {';
		$styles .=	'background-size: 100% auto;';
		$styles .=	'background: url('.of_get_option('mobile_header_logo').') no-repeat center center;';
		$styles .=	'margin: 0px auto;';
		$styles .=	'display:block;';
		$styles .=	'width: 250px;';
		$styles .=	'height: '.of_get_option('mobile_logo_height').'px;';
		$styles .=	'}';
		$styles .=	'}';
		$styles .=  '</style>';
		echo $styles;
		}
	}
add_action('wp_head', 'st_mobile_logo');

}	// endif


/*-----------------------------------------------------------------------------------*/
// Mobile Meta Viewport Tag
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'st_mobile_viewport' ) ) {

function st_mobile_viewport() {

	if (of_get_option('mobile_support') == 'mobile') {

		if (of_get_option('viewport_scale') == 'disable') {
			$properties = array('width=device-width','initial-scale=1','maximum-scale=1','minimal-ui');
		} else {
			$properties = array('width=device-width','initial-scale=1','minimal-ui');
		}
		$viewport = "\n".'<meta name="viewport" content="'.implode(",", $properties).'" />'."\n";
		echo $viewport;

	}
}
add_action('wp_head', 'st_mobile_viewport', 1);

} //endif



/*-----------------------------------------------------------------------------------*/
// Load CSS in wp_head or dynamically
// 0 = Customization Mode
// 1 = Live Mode
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'production_stylesheet' ) ) {
// Build Query vars for dynamic theme option CSS from Options Framework

if (of_get_option('dev_mode') == '1') {

	function production_stylesheet($public_query_vars) {
    	$public_query_vars[] = 'get_styles';
    	$public_query_vars[] = 'sidebar';
    	return $public_query_vars;
	}

    add_action('query_vars', 'production_stylesheet');
}

} // endif


if ( !function_exists( 'theme_css' ) ) {

// Load the styles
function theme_css() {
	$css = get_query_var('get_styles');
	if ($css == 'css') {
	  	include_once (TEMPLATEPATH . '/style.php');
	  	exit;  //This stops WP from loading any further
	}
}
add_action('template_redirect', 'theme_css');

}  // endif


if ( !function_exists( 'custom_mode' ) ) {

	// Customization Mode - load custom styles in wp_head
	if (of_get_option('dev_mode') == '0') {

		function custom_mode() {
			echo '<style type="text/css">';
			locate_template( 'themestyles.php',true,true);
	 		echo '</style>';
		}

		add_action( 'wp_head', 'custom_mode' );
		remove_action( 'template_redirect', 'theme_css' );
		remove_filter( 'query_vars', 'production_stylesheet' );

	} //endif custom_mode

} // endif function_exists



/*-----------------------------------------------------------------------------------*/
// Sidebar Positioning
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'sidebar_position' ) ) {

function sidebar_position($class) {
		//global $post;
		$sidebar_position = of_get_option('page_layout');
		$sidebar_position = ($sidebar_position == "right" ? "right" : "left");
		$class[] = 'sidebar-'.$sidebar_position;
		return $class;
	}
	add_filter('body_class','sidebar_position');

}  // endif



/*-----------------------------------------------------------------------------------*/
// Add a light or dark body class
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'st_body_contrast' ) ) {

	function st_body_contrast($contrast) {
		global $post;
			$class = 'light';
			$class = get_post_meta($post->ID, "bodyclass", $single = true);
			$layout_style = of_get_option('layout_style');
			if ($layout_style == 'style9') {
				$class = 'dark';
			}
			$contrast[] = $class;
		return $contrast;
	}
	add_filter('body_class','st_body_contrast');

} // endif



/*-----------------------------------------------------------------------------------*/
// Add style-specific body class
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'st_style_switch' ) ) {

	function st_style_switch($body_contrast) {
		// variables
		if(isset($_COOKIE['style'])) {
			$cookie = $_COOKIE['style'];
			$currentstyle = $cookie;
		} else {
			$currentstyle = of_get_option('layout_style');
		}
		$body_contrast[] = $currentstyle;
		return $body_contrast;
	}

	add_filter('body_class','st_style_switch');

} // endif



/*-----------------------------------------------------------------------------------*/
// Enables responsive select menu for mobile browsers
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'st_select_navmenu' ) ) {

	function st_select_navmenu($menu_style) {
		// variables
		$options = array('select-menu','dropdown-menu');
		$default = 'dropdown-menu';
		$switch = (isset($_COOKIE['menu'])) ? $_COOKIE['menu'] : $default;

		if (isset($_COOKIE['menu'])) {
			$style = $switch;
		} else {
			$style = of_get_option('mobile_selectmenu');
		}
		if (in_array($style,$options)) {
			$menu_style[] = $style;
		} else {
			$menu_style[] = $default;
		}

		return $menu_style;
	}
	add_filter('body_class','st_select_navmenu');

} // endif



if (! function_exists('st_prettyphoto'))  {

	function st_prettyphoto() {
		if (of_get_option('enable_prettyphoto')) {
		  $prettyphoto = "<script type=\"text/javascript\">
		  	jQuery(document).ready(function($) {
		  			$(\"a[rel^='prettyphoto']\").prettyPhoto({
		  				animation_speed: 'fast', /* fast/slow/normal */
		  				slideshow: false, /* false OR interval time in ms */
		  				horizontal_padding: 20, /* The padding on each side of the picture */
		  				autoplay: true, /* Automatically start videos: True/False */
		  				opacity: 0.35, /* Value between 0 and 1 */
		  				show_title: true, /* true/false */
		  				allow_resize: true, /* Resize the photos bigger than viewport. true/false */
		  				allow_expand: true, /* Allow the user to expand a resized image. true/false */
		  				overlay_gallery:false,
		  				overlay_gallery_max: 30, /* Maximum number of pictures in the overlay gallery */
		  				social_tools:false,
		  				default_width: 500,
		  				default_height: 344,
		  				keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
		  				deeplinking: false, /* Allow prettyPhoto to update the url to enable deeplinking. */
		  				autoplay_slideshow: false, /* true/false */
		  				counter_separator_label: '/', /* The separator for the gallery counter 1 of 2 */
		  				theme: '".of_get_option('prettyphoto_style')."', /* light_rounded / dark_rounded / light_square / dark_square */
		  				hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
		  				modal: false, /* If set to true, only the close button will close the window */
		  				changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
		  				callback: function(){} /* Called when prettyPhoto is closed */
		  		});
		  	});
		  </script>";
		  echo $prettyphoto;

		}	// endif prettyphoto enabled
	}	// end function

	add_action('wp_head', 'st_prettyphoto');

} // end if function exists


/*-----------------------------------------------------------------------------------*/
// Selectively remove page elements with custom fields for landing pages
// Custom Fields: hidenav,hideheader,hidefooter (set value to 'true' to hide elements)
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'st_landing_options' ) ) {

	function st_landing_options() {
    	global $post;
    	// Get the keys and values of the custom fields:

    	if (is_page() || is_single()) {

			$hidenav 	= 	get_post_meta($post->ID, 'hidenav', true);
			$hidetopnav = 	get_post_meta($post->ID, 'hidetopnav', true);
			$hideheader = 	get_post_meta($post->ID, 'hideheader', true);
			$hidefooter	=	get_post_meta($post->ID, 'hidefooter', true);
			$hidebg 	= 	get_post_meta($post->ID, 'hidebg', true);

    		if ('true' === $hidetopnav) {
    			// Remove Top Navbar
            	remove_action( 'st_header', 'st_top_bar', 1);
    		}

    		if ('true' === $hidenav) {
    			// Remove Navbar
            	remove_action( 'st_navbar', 'st_main_nav', 1);
    		}

			if ('true' === $hidebg) {
				// Remove body bg
				add_action( 'wp_head', 'st_remove_bg', 1);
			}

    		if ('true' === $hideheader) {
    			// Hide The logo
        		remove_action('st_header','st_logo', 3);
				// Remove the Top BAr Widget
				remove_action('st_header','st_top_bar', 4);
				// Remove Logo CSS from Head
        		remove_action('wp_head', 'logostyle');
    		}

    		if ('true' === $hidefooter) {
        		// Hide The Footer
    			remove_action('wp_footer', 'st_footer',2);
    			add_action( 'wp_head', 'st_remove_footer', 1);
    		}
    	}
	}
    add_action('template_redirect', 'st_landing_options');
}

// Remove body_background image
function st_remove_bg() {
	echo '<style>body {background-image:none !important;}</style>';
}

// Remove sticky footer overflow
function st_remove_footer() {
	echo '<style>#footer {display:none !important;}</style>';
}


/*-----------------------------------------------------------------------------------*/
// get_post_meta with default option
/*-----------------------------------------------------------------------------------*/


function st_get_post_meta($post_id, $key, $single = true, $default = '')
{
    $value = get_post_meta($post_id, $key, $single);
    if(empty($value))
        $value = $default;
    return $value;
}


/*-----------------------------------------------------------------------------------*/
// Sets the custom post excerpt length to 45 characters.
// To override this length in a child theme, remove the filter and add your own
// function tied to the excerpt_length filter hook.
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'smpl_excerpt_length' ) ) {

function smpl_excerpt_length( $length ) {
	return 45;
}
add_filter( 'excerpt_length', 'smpl_excerpt_length' );

} // endif


/*-----------------------------------------------------------------------------------*/
// Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and smpl_continue_reading_link().
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'smpl_auto_excerpt_more' ) ) {

function smpl_auto_excerpt_more( $more ) {
	return '&hellip;' . smpl_continue_reading_link();
}

add_filter( 'excerpt_more', 'smpl_auto_excerpt_more' );

} // endif



/*-----------------------------------------------------------------------------------*/
// Returns a "Continue Reading" link for excerpts
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'smpl_continue_reading_link' ) ) {

function smpl_continue_reading_link() {
	return ' <div class="button right"><a class="button more-link" href="'. get_permalink() . '">' . __( 'Continue Reading &raquo;', 'smpl' ) . '</a></div>';
}

} // endif



/*-----------------------------------------------------------------------------------*/
// Adds a pretty "Continue Reading" link to custom post excerpts.
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'smpl_custom_excerpt_more' ) ) {

function smpl_custom_excerpt_more( $output ) {

	if ( has_excerpt() && ! is_attachment() ) {
		$output .= smpl_continue_reading_link();
	}

	return $output;
}

add_filter( 'get_the_excerpt', 'smpl_custom_excerpt_more' );
} // endif



/*-----------------------------------------------------------------------------------*/
// Provides a hook to display content within loops
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'st_display_content' ) ) {
		function st_display_content() {
			if (is_archive() || is_search()) {
				if (of_get_option('display_readmore') != '1') {
					remove_filter( 'excerpt_more', 'smpl_auto_excerpt_more' );
					remove_filter( 'get_the_excerpt', 'smpl_custom_excerpt_more' );
				}
				the_excerpt();
			} elseif (is_home() && of_get_option('content_type') == 'none') {
				return;
			} elseif (is_home() && of_get_option('content_type') == 'content') {
				the_content( __( 'Continue reading', 'smpl' ) );
			} elseif (is_home() && of_get_option('content_type') == 'excerpt') {
				if (of_get_option('display_readmore') != '1') {
					remove_filter( 'excerpt_more', 'smpl_auto_excerpt_more' );
					remove_filter( 'get_the_excerpt', 'smpl_custom_excerpt_more' );
				}
				the_excerpt();
			} else {
				the_content( __( 'Continue reading', 'smpl' ) );
			}
		}
add_action('st_content','st_display_content');

} //


/*-----------------------------------------------------------------------------------*/
// Example of how we can override each loop's specified thumbnail size
// Available Conditonals: http://codex.wordpress.org/Conditional_Tags
/*-----------------------------------------------------------------------------------*/
if (!function_exists( 'st_thumbsize' ) )  {

	function st_thumbsize() {
        $image='';


		// if (is_single()) {
		// $image = get_the_post_thumbnail($id, 'squared125', array('class' => 'scale-with-grid'));
		// }

		// if (in_category('1')) {
		// $image = get_the_post_thumbnail($id, 'squared250', array('class' => 'scale-with-grid'));
		// }

		return $image;
	}
	add_filter( 'st_thumbnailer', 'st_thumbsize', 10, $image='' );

} //endif


/*-----------------------------------------------------------------------------------*/
// Example of how we can add featured thumbnail to single posts
/*-----------------------------------------------------------------------------------*/

if (!function_exists( 'st_addSingleImage' ) )  {

	function st_addSingleImage($content) {
		global $post;
		$image  = '<a rel="prettyphoto[group]" href="'.get_image_path().'">';
		$image .= get_the_post_thumbnail($post->ID, 'video43', array('class' => 'alignleft scale-with-grid'));
		$image .= '</a>';

		if (is_single()) {
			return $image.$content;
		} else {
			return $content;
		}
	}
	//add_filter('the_content','st_addSingleImage');
} //endif


/*-----------------------------------------------------------------------------------*/
// Builds our thumbnail image
/*-----------------------------------------------------------------------------------*/

	function st_thumbnailer($name,$align='scale-with-grid') {
	global $post;
	global $id;
	$theimage = get_image_path();
	// not used here, but available if bruteforce post image sizes are needed
	$thumbscript = get_bloginfo('template_directory').'/thumb.php?';
	$options = of_get_option('thumbnail_action');

	switch ($options) {
		// Display in Lightbox
		case 'link_to_lightbox':
		$open = '<a rel="prettyphoto[group]" href="'.$theimage.'">';
		$image = get_the_post_thumbnail($id, $name, array('class' => $align));
		$close = '</a>';
		break;
		// Link to Post
		case 'link_to_post':
		$open = '<a href="'.get_permalink($post->ID).'">';
		$image = get_the_post_thumbnail($id, $name, array('class' => $align));
		$close = '</a>';
		break;
		// Do Nothing
		case 'link_to_nothing':
		// ZzzZzzZ
		$open = '';
		$image = get_the_post_thumbnail($id, $name, array('class' => $align));
		$close = '';
		break;
		}
		echo $open;
			if (apply_filters('st_thumbnailer',$image)) {
			echo apply_filters('st_thumbnailer',$image);
			} else {
			echo $image;
			}
		echo $close;
	} //



/*-----------------------------------------------------------------------------------*/
// Removes inline styles printed when the gallery shortcode is used.
// Galleries are styled by the theme in style.css. This is just
// a simple filter call that tells WordPress to not use the default styles.
/*-----------------------------------------------------------------------------------*/

add_filter( 'use_default_gallery_style', '__return_false' );


/*-----------------------------------------------------------------------------------*/
// Removes auto jump link when article more-link is clicked.
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'remove_more_jump_link' ) ) {

function remove_more_jump_link($link) {
	$offset = strpos($link, '#more-');
	if ($offset) {
	$end = strpos($link, '"',$offset);
	}
	if ($end) {
	$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
	}
add_filter('the_content_more_link', 'remove_more_jump_link');

} // endif


/*-----------------------------------------------------------------------------------*/
// Responsive Images
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'st_responsive_images' ) ) {

	function st_responsive_images($bodyclass) {
		// variables
		$enabled = false;
		$enabled = of_get_option('responsive_images');

		if ($enabled == 1) {
			$bodyclass[] = 'rspimg';
		}
		return $bodyclass;
	}
	add_filter('body_class','st_responsive_images');

} // endif


/*-----------------------------------------------------------------------------------*/
// Load Theme Colors into Color Picker Pallette
// when overriding, use get_stylesheet_directory_uri()
/*-----------------------------------------------------------------------------------*/

if (! function_exists('st_colorpicker_options'))  {

function st_colorpicker_options() {
	wp_enqueue_script( 'colorpicker-options', get_template_directory_uri() . '/javascripts/colorpicker.js', array( 'jquery','wp-color-picker' ),1,true );
}
add_action( 'optionsframework_custom_scripts', 'st_colorpicker_options' );

} // endif function exists


/*-----------------------------------------------------------------------------------*/
// TinyMCE Plugins (Slideshow and Content Templates)
/*-----------------------------------------------------------------------------------*/


// TinyMCE Editor Plugins (TinyMCE V.3)
if ( !function_exists( 'st_load_tinymce_plugins' ) ) {
	global $wp_version;
	if ($wp_version < 3.9) {
		require_once( get_template_directory().'/lib/editor/tinymceContent/tinymce.php');
		require_once( get_template_directory().'/lib/editor/tinymceSlideshow/tinymce.php');
	}
}


// Load TinyMCE V.4 Plugins

function st_mce_external_plugins( $plugins ) {
	global $wp_version;

	if ($wp_version >= 3.9) {
	    $plugins['template'] = get_template_directory_uri() . '/lib/editor/tinymceContent/editor_plugin_mce_v4.js';
	    $plugins['slideshow'] = get_template_directory_uri() . '/lib/editor/tinymceSlideshow/editor_plugin_mce_v4.js';
	}
    return $plugins;
}
add_filter( 'mce_external_plugins', 'st_mce_external_plugins' );


// Add Buttons
function st_mce_buttons( $buttons ) {
	global $wp_version;

	if ($wp_version >= 3.9) {
		array_push( $buttons, 'template','slideshow' );
	}
	return $buttons;
}
add_filter( 'mce_buttons', 'st_mce_buttons' );


/*-----------------------------------------------------------------------------------*/
// TinyMCE CSS
/*-----------------------------------------------------------------------------------*/


if (! function_exists('st_mce_css'))  {

	function st_mce_css( $mce_css ) {
		if ( ! empty( $mce_css ) )
			$mce_css .= ',';
			$mce_css .= get_bloginfo('template_directory').'/style.css';
			$mce_css .= ',';
			$mce_css .= get_bloginfo('template_directory').'/css/skeleton-r.css';
			$mce_css .= ',';
			$mce_css .= get_bloginfo('template_directory').'/layout.css';
			$mce_css .= ',';
			$mce_css .= plugins_url().'/smpl-shortcodes/assets/css/smpl-shortcodes.css';
			$mce_css .= ',';
			$mce_css .= get_bloginfo('stylesheet_directory').'/'.of_get_option('layout_style').'.css';
			$mce_css .= ',';
			$mce_css .= get_bloginfo('template_directory').'/editor-style.css';
			return $mce_css;
	}

} // endif function exists

add_filter( 'mce_css', 'st_mce_css' );



/*-----------------------------------------------------------------------------------*/
// Content Templates for WP 3.9
/*-----------------------------------------------------------------------------------*/


if (! function_exists('st_content_templates'))  {

	function st_content_templates( $content_templates ) {

	    $templates = array(
	    	array(
	    		'title' => 'Template One',
	    		'description' => '',
	    		'image' => get_template_directory_uri().'/lib/editor/tinymceContent/img/tpl1.png',
	    		'content' => '<div class="three_fourths"><img class="alignleft featured scale-with-grid" alt="image" src="http://placehold.it/162x162/EEE/CCC&text=placeholder"/> <div class="subheading"> <h3>Get to the point</h3> <h4 class="lighter dim40">A Better Web Experience</h4> </div> <p class="largetext serif italic dim40">"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s."</p> </div> <div class="one_fourth last"> <h4 class="loose normal caps small brand-accent">Interestingness</h4> <p class="small">This is a small side caption that might be used to outline some of the fine print for your product or service.</p> <p class="small">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.</p> </div> <hr class="clear"/> <div class="one_third"> <h3>Column</h3> The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form. </div> <div class="one_third"> <h3>Column</h3> The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form. </div> <div class="one_third last"> <h3>Column</h3> The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form. </div>'
	    	),
	        array(
	        	'title' => 'Template Two',
	    		'description' => '',
	    		'image' => get_template_directory_uri().'/lib/editor/tinymceContent/img/tpl2.png',
				'content' => '<p class="floatleft"><img class="alignleft" src="'.get_template_directory_uri().'/images/product_box-1.png" alt="Image" width="341" height="258"/></p> <h1>The Big Introduction</h1> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. <p style="text-align:center;">[button align="center" size="medium" link="http://www.simplethemes.com"]Button Text[/button]</p> <hr class="clear"/> <div class="one_third"> <h3>Feature One</h3> <img class="alignleft" src="'.get_template_directory_uri().'/images/framed_75.png" alt=""/>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form.</div> <div class="one_third"> <h3>Feature Two</h3> <img class="alignleft" src="'.get_template_directory_uri().'/images/framed_75.png" alt=""/>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form.</div> <div class="one_third last"> <h3>Feature Three</h3> <img class="alignleft" src="'.get_template_directory_uri().'/images/framed_75.png" alt=""/>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form.</div> <hr class="clear"/> <div class="cta"> <h3>Call to Action</h3> <div class="button large right"><a class="button" href="http://www.URL.com/">Big Button!</a></div> The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from “de Finibus Bonorum et Malorum” by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</div>'
	        ),
	        array(
	        	'title' => 'Template Three',
	    		'description' => '',
	    		'image' => get_template_directory_uri().'/lib/editor/tinymceContent/img/tpl3.png',
				'content' => '<div id="mce_slider_full"> [slideshow effect="fade" category="SLIDESHOW_ID" width="930" height="260" autoplay="4000" speed="1000" pagination="true" prevnext="false"] </div> <div class="one_fourth"> <p class="small"><span class="accent">1/4 Side Caption</span></p> <p class="small">This is a small side caption that might be used to outline some of the fine print for your product or service.</p> <p class="small">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.</p> </div> <div class="three_fourths last"> <h3>3/4 Column</h3> <img class="alignleft" src="'.get_template_directory_uri().'/images/placeholder_125.png" alt=""/>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham. </div> <hr class="clear"/> <div class="one_third"> <h3>Column One</h3> The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form. </div> <div class="one_third"> <h3>Column Two</h3> The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form. </div> <div class="one_third last"> <h3>Column Three</h3> The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form. </div> <hr class="clear"/> <div class="cta"> <h3>Call To Action</h3> <div class="button large right"><a class="button" href="https://www.simplethemes.com/members/signup.php">Big Button!</a></div> The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham. </div>'
	        ),
	        array(
	        	'title' => 'Template Four',
	    		'description' => '',
	    		'image' => get_template_directory_uri().'/lib/editor/tinymceContent/img/tpl4.png',
				'content' => '<div class="one_half"> <h2>The Big Features</h2> <img class="aligncenter bottom10 scale-with-grid" alt="Image" src="http://placehold.it/540x135/CCC/EEE&amp;text=PLACEHOLDER"/> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.[button align="center" link="#" caption="about this product"]Learn More![/button] </div> <div class="one_half last"> <h2>The Big Features</h2> <img class="aligncenter bottom10 scale-with-grid" alt="Image" src="http://placehold.it/540x135/CCC/EEE&amp;text=PLACEHOLDER"/> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.[button align="center" link="#" caption="about this product"]Learn More![/button] </div> <hr class="clear"/> <div class="one_half"> <h2>The Big Features</h2> <img class="aligncenter bottom10 scale-with-grid" alt="Image" src="http://placehold.it/540x135/CCC/EEE&amp;text=PLACEHOLDER"/> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.[button align="center" link="#" caption="about this product"]Learn More![/button] </div> <div class="one_half last"> <h2>The Big Features</h2> <img class="aligncenter bottom10 scale-with-grid" alt="Image" src="http://placehold.it/540x135/CCC/EEE&amp;text=PLACEHOLDER"/> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.[button align="center" link="#" caption="about this product"]Learn More![/button] </div> <hr class="clear"/> <div class="one_half"> <h2>The Big Features</h2> <img class="aligncenter bottom10 scale-with-grid" alt="Image" src="http://placehold.it/540x135/CCC/EEE&amp;text=PLACEHOLDER"/> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.[button align="center" link="#" caption="about this product"]Learn More![/button] </div> <div class="one_half last"> <h2>The Big Features</h2> <img class="aligncenter bottom10 scale-with-grid" alt="Image" src="http://placehold.it/540x135/CCC/EEE&amp;text=PLACEHOLDER"/> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.[button align="center" link="#" caption="about this product"]Learn More![/button] </div> <hr class="clear"/>'
	        ),
	        array(
	        	'title' => 'Template Five',
	    		'description' => '',
	    		'image' => get_template_directory_uri().'/lib/editor/tinymceContent/img/tpl5.png',
	        	'content' => '<div class="two_thirds"> <div id="mce_slider_full"> [slideshow effect="fade" category="SLIDESHOW_ID" width="605" height="250" autoplay="4000" speed="1000" pagination="true" prevnext="false"] </div> </div> <div class="one_third last"> <h3>Big Introduction</h3> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. <a class="more-link" href="#">Learn More...</a> </div> <hr class="clear"/> <div class="one_third"> <h3>Feature One</h3> <img class="alignleft" src="'.get_template_directory_uri().'/images/framed_75.png" alt=""/>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form. </div> <div class="one_third"> <h3>Feature Two</h3> <img class="alignleft" src="'.get_template_directory_uri().'/images/framed_75.png" alt=""/>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form. </div> <div class="one_third last"> <h3>Feature Three</h3> <img class="alignleft" src="'.get_template_directory_uri().'/images/framed_75.png" alt=""/>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form. </div> <hr class="clear"/> <div class="cta"> <h3>Call To Action</h3> <div class="button large right"><a class="button" href="https://www.url.com/">Big Button!</a></div> The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham. </div> <hr class="clear"/>'
	        ),
	        array(
	        	'title' => 'Template Six',
	    		'description' => '',
	    		'image' => get_template_directory_uri().'/lib/editor/tinymceContent/img/tpl6.png',
				'content' => '<div class="one_half"> <h2>John Doe</h2> <p><img class="alignleft" src="'.get_template_directory_uri().'/images/contact_man.png" alt="img"/> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.</p> <ul class="staff_social"> <li><a class="facebook" href="http://facebook.com">Facebook</a></li> <li><a class="twitter" href="http://twitter.com">Twitter</a></li> <li><a class="linkedin" href="http://linkedin.com">Linkedin</a></li> <li><a class="email" href="mailto:you@yourdomain.com">Email</a></li> </ul> </div> <div class="one_half last"> <h2>Jane Doe</h2> <p><img class="alignleft" src="'.get_template_directory_uri().'/images/contact_woman.png" alt="img"/> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.</p> <ul class="staff_social"> <li><a class="facebook" href="http://facebook.com">Facebook</a></li> <li><a class="twitter" href="http://twitter.com">Twitter</a></li> <li><a class="linkedin" href="http://linkedin.com">Linkedin</a></li> <li><a class="email" href="mailto:you@yourdomain.com">Email</a></li> </ul> </div> <hr class="clear"/> <div class="one_half"> <h2>John Doe</h2> <p><img class="alignleft" src="'.get_template_directory_uri().'/images/contact_man.png" alt="img"/> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.</p> <ul class="staff_social"> <li><a class="facebook" href="http://facebook.com">Facebook</a></li> <li><a class="twitter" href="http://twitter.com">Twitter</a></li> <li><a class="linkedin" href="http://linkedin.com">Linkedin</a></li> <li><a class="email" href="mailto:you@yourdomain.com">Email</a></li> </ul> </div> <div class="one_half last"> <h2>Jane Doe</h2> <p><img class="alignleft" src="'.get_template_directory_uri().'/images/contact_woman.png" alt="img"/> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.</p> <ul class="staff_social"> <li><a class="facebook" href="http://facebook.com">Facebook</a></li> <li><a class="twitter" href="http://twitter.com">Twitter</a></li> <li><a class="linkedin" href="http://linkedin.com">Linkedin</a></li> <li><a class="email" href="mailto:you@yourdomain.com">Email</a></li> </ul> </div> <hr class="clear"/> <div class="one_half"> <h2>John Doe</h2> <p><img class="alignleft" src="'.get_template_directory_uri().'/images/contact_man.png" alt="img"/> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.</p> <ul class="staff_social"> <li><a class="facebook" href="http://facebook.com">Facebook</a></li> <li><a class="twitter" href="http://twitter.com">Twitter</a></li> <li><a class="linkedin" href="http://linkedin.com">Linkedin</a></li> <li><a class="email" href="mailto:you@yourdomain.com">Email</a></li> </ul> </div> <div class="one_half last"> <h2>Jane Doe</h2> <p><img class="alignleft" src="'.get_template_directory_uri().'/images/contact_woman.png" alt="img"/> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.</p> <ul class="staff_social"> <li><a class="facebook" href="http://facebook.com">Facebook</a></li> <li><a class="twitter" href="http://twitter.com">Twitter</a></li> <li><a class="linkedin" href="http://linkedin.com">Linkedin</a></li> <li><a class="email" href="mailto:you@yourdomain.com">Email</a></li> </ul> </div> <hr class="clear"/>'
	        )
	    );
	    $content_templates['templates'] = json_encode( $templates );
	    return $content_templates;

	}
} // endif function exists

add_filter( 'tiny_mce_before_init', 'st_content_templates' );


/*-----------------------------------------------------------------------------------*/
// Returns JSON format of available Slideshow names and ids
/*-----------------------------------------------------------------------------------*/


function st_slideshow_categories( $slideshow_categories ) {

	$slideterms = get_terms('slidecategory');
	$slidecats = array();
	foreach ($slideterms as $term_list) {
		$slideshow_id = $term_list->term_id;
		$slideshow_title = $term_list->name.' ('.$slideshow_id.') ';
    	$arr = array('text' => $slideshow_title, 'value' => $slideshow_id);
		$slidecats[] = $arr;
	}
	$slideshow_categories['slidecats'] = json_encode( $slidecats );
	return $slideshow_categories;

}
add_filter( 'tiny_mce_before_init', 'st_slideshow_categories' );



/*-----------------------------------------------------------------------------------*/
// Register the required plugins for this theme.
/*-----------------------------------------------------------------------------------*/


add_action( 'tgmpa_register', 'st_register_required_plugins' );

function st_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'ACF Repeater',
			'slug'     				=> 'acf-repeater',
			'source'   				=> get_template_directory().'/lib/acf-repeater.zip',
			'required' 				=> true,
			'force_activation' 		=> true,
			'force_deactivation' 	=> true
		),
		array(
			'name' 					=> 'Advanced Custom Fields',
			'slug' 					=> 'advanced-custom-fields',
			'required' 				=> true,
			'force_activation' 		=> true
		),
		array(
			'name' 					=> 'Simple Shortcodes',
			'slug' 					=> 'smpl-shortcodes',
			'required' 				=> true,
			'force_activation' 		=> true
		)
	);

	tgmpa($plugins);

}

if (! function_exists('st_acf_toolbars'))  {

	function st_acf_toolbars() {
	// Full
	$toolbars['Full'] = array();
	$toolbars['Full'][1] = apply_filters('mce_buttons', array('code','bold', 'italic', 'strikethrough', 'bullist', 'numlist', 'blockquote', 'justifyleft', 'justifycenter', 'justifyright', 'link', 'unlink', 'wp_more', 'spellchecker', 'fullscreen', 'wp_adv' ), $editor_id);
	$toolbars['Full'][2] = apply_filters('mce_buttons_2', array( 'formatselect', 'underline', 'justifyfull', 'forecolor', 'pastetext', 'pasteword', 'removeformat', 'charmap', 'outdent', 'indent', 'undo', 'redo'), $editor_id);
	$toolbars['Full'][3] = apply_filters('mce_buttons_3', array(), $editor_id);
	$toolbars['Full'][4] = apply_filters('mce_buttons_4', array(), $editor_id);

	// Basic
	$toolbars['Basic'] = array();
	$toolbars['Basic'][1] = apply_filters( 'teeny_mce_buttons', array('bold', 'italic', 'underline', 'blockquote', 'strikethrough', 'bullist', 'numlist', 'justifyleft', 'justifycenter', 'justifyright', 'undo', 'redo', 'link', 'unlink', 'fullscreen'), $editor_id );

	// Simple
	$toolbars['Simple'] = array();
	$toolbars['Simple'][1] = apply_filters('teeny_mce_buttons', array( 'code', 'formatselect', 'bold', 'italic', 'bullist', 'numlist', 'justifyleft', 'justifycenter', 'justifyright', 'link', 'unlink', 'removeformat' ), $editor_id);

	return $toolbars;
	}

}
add_filter( 'acf/fields/wysiwyg/toolbars', 'st_acf_toolbars', 1, 1 );



function update_mobius() {
	global $wpdb;
	//$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key = '_st_layout_box';");
	$wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '_st_slide_type' WHERE meta_key = 'st_slide_type';");
	$wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '_st_slide_thumb_size' WHERE meta_key = 'st_slide_thumb_size';");
	$wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '_st_customexcerpt' WHERE meta_key = 'st_customexcerpt';");
	$wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '_st_customurlname' WHERE meta_key = 'st_customurlname';");
	$wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '_st_customurl' WHERE meta_key = 'st_customurl';");
	$wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '_st_slide_linktarget' WHERE meta_key = 'st_slide_linktarget';");
	$wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '_st_show_title' WHERE meta_key = 'st_show_title';");
}
add_action ('after_setup_theme', 'update_mobius');