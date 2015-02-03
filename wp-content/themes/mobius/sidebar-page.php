<?php
/**
 * The Sidebar containing the secondary Page widget area.
 *
 * @package WordPress
 * @subpackage smpl
 * @since smpl 0.1
 */
$page_wide = is_page_template('onecolumn-page.php') || is_page_template('wide-page.php') || is_page_template('backstretch-page.php');
if ( is_active_sidebar('secondary-widget-area') && !$page_wide ) {
		do_action('st_before_sidebar');
		dynamic_sidebar( 'secondary-widget-area' );
		do_action('st_after_sidebar');
	}
?>