<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage smpl
 * @since smpl 0.1
 */
?>
<!doctype html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes();?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes();?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes();?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes();?>> <!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	// Detect Yoast SEO Plugin
	if (defined('WPSEO_VERSION')) {
		wp_title('');
	} else {
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'smpl' ), max( $paged, $page ) );
	}
	?>
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<!--[if lte IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<style type="text/css">
html button,
html .gallery .gallery-item img,
html .gallery .gallery-item img.thumbnail,
html ul.tabs li a.active,
html input[type="submit"],
html input[type="reset"],
html input[type="button"],
html .cta,
html a.button,
html a.more-link,
html #teaser,
html #breadcrumbs,
html #menu .columns,
html #menu.wide,
html .latest-img,
html .widget-container.S1,
html .widget-container.S2,
html .widget-container.S3,
html #author-info,
html ul.advanced-recent-posts li img,
html .instapress img,
html .st-callout,
html .wp-post-image {behavior: url("<?php bloginfo('template_directory'); ?>/PIE.php") !important;position: relative;}
</style>
<![endif]-->


<!-- Favicons
================================================== -->

<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon.ico">

<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon.png">

<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon-72x72.png" />

<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon-114x114.png" />

<link rel="pingback" href="<?php echo get_option('siteurl') .'/xmlrpc.php';?>" />

<?php if (of_get_option('dev_mode') == '1') { ?>
<link rel="stylesheet" id="custom" href="<?php echo home_url() .'/?get_styles=css';?>" type="text/css" media="all" />
<?php }
	/*
	 * enqueue threaded comments support.
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_head();
	if (of_get_option('mobile_selectmenu') == 'select-menu' || isset($_COOKIE['menu']) && $_COOKIE['menu'] == 'select-menu') {
		include (TEMPLATEPATH . '/lib/init_mobilemenu.php');
	}
?>
</head>
<body <?php body_class(); ?>>
<?php
	st_before_header();
	st_header();
	st_after_header();
	//include (TEMPLATEPATH . '/demo_themestyler.php');
?>