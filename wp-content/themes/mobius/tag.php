<?php
/**
 * Template for displaying tagged Posts.
 *
 * @package WordPress
 * @subpackage smpl
 * @since smpl 0.1
 */
get_header();

do_action('st_content_wrap');

?>
<h1><?php printf( __( 'Tag Archives: %s', 'smpl' ), '<span class="bolder">' . single_tag_title( '', false ) . '</span>' );?></h1>
<?php

get_template_part( 'loops/loop', 'category' );

do_action('st_content_wrap_close');

get_sidebar();

get_footer();

?>