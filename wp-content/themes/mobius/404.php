<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage smpl
 * @since smpl 0.1
 */

get_header();
do_action('st_content_wrap');
?>
	<h1><?php _e( 'Not Found', 'smpl' ); ?></h1>
	<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'smpl' ); ?></p>
	<?php get_search_form(); ?>

	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php
do_action('st_content_wrap_close');
get_sidebar();
get_footer();
?>