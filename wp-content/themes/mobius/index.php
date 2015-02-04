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

do_action('st_content_wrap');

get_template_part( 'loop', 'index' );

do_action('st_content_wrap_close');

get_sidebar();

get_footer();

?>