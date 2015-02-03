<?php

/*-----------------------------------------------------------------------------------*/
/* Sidebar containing the primary blog sidebar
/*-----------------------------------------------------------------------------------*/

$post_wide = get_post_meta($post->ID, "sidebars", $single = true) == "false";

if ( is_home() && !of_get_option('hide_bloghome_sidebar') ) {
	// continue
} elseif (is_single() && $post_wide ) {
	return;
} elseif ( is_archive() ||  is_category() ) {
	// continue
}
if ( is_active_sidebar('primary-widget-area')) :
	do_action('st_before_sidebar');
	dynamic_sidebar( 'primary-widget-area' );
	do_action('st_after_sidebar');
endif;

?>

