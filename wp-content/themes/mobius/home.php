<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage smpl
 * @since smpl 0.1
 */
get_header();

// hide the sidebar on blog home
do_action('st_content_wrap');
st_before_content();
// exclude specified categories form the main blog
query_posts( array( 'cat' => st_exclude_blogcats(), 'paged' => get_query_var('paged') ) );

// include the loop style based on theme settings
$layout_style = of_get_option('blog_layout');
switch ($layout_style) {
	// style1
	case 'style1':
	get_template_part( '/loops/loop' , 'style1' );  
	break;
	// style2
	case 'style2':
	get_template_part( '/loops/loop' , 'style2' );  
	break;
	// style3
	case 'style3':
	get_template_part( '/loops/loop' , 'style3' );  
	break;
	// style4
	case 'style4':
	get_template_part( '/loops/loop' , 'style4' );  
	break;
	// style5
	case 'style5':
	get_template_part( '/loops/loop' , 'style5' );  
	break;
	// style6
	case 'style6':
	get_template_part( '/loops/loop' , 'style6' );  
	break;
	default:
	get_template_part( '/loops/loop' , 'index' );  
	}
st_after_content();
do_action('st_content_wrap_close');
// hide the sidebar on blog home
if (!of_get_option('hide_bloghome_sidebar')) {
get_sidebar();
}

get_footer();
?>