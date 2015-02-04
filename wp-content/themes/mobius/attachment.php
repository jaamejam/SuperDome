<?php
/**
 * The template for displaying attachments.
 *
 * @package WordPress
 * @subpackage smpl
 * @since smpl 0.1
 */

get_header();

do_action('st_content_wrap');

/* Run the loop to output the attachment.
 * If you want to overload this in a child theme then include a file
 * called loop-attachment.php and that will be used instead.
 */
get_template_part( '/loops/loop', 'attachment' );

do_action('st_content_wrap_close');

// get_sidebar();
get_footer();
?>