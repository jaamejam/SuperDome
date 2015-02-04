<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage smpl
 * @since smpl 0.1
 */
get_header();

do_action('st_content_wrap');

get_template_part( '/loops/loop', 'single' );

do_action('st_content_wrap_close');

get_sidebar();

get_footer();

?>