<?php
/**
 * Template Name: Freeform Content - No Sidebars or Page Title
*/

get_header();

do_action('st_content_wrap');

get_template_part( '/loops/loop', 'page' );

do_action('st_content_wrap_close');

get_footer();

?>
