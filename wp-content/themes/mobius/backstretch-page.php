<?php
/**
 * Template Name: Backstretch Slideshow Page
*/

get_header();

st_backstretch();

do_action('st_content_wrap');

get_template_part( '/loops/loop', 'page' );

do_action('st_content_wrap_close');

get_sidebar('page');

get_footer();

?>