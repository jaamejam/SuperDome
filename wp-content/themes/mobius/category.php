<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage smpl
 * @since smpl 0.1
 */

get_header();

do_action('st_content_wrap');

?>

<h1 class="leader"><?php printf( __( 'Category: %s', 'smpl' ), single_cat_title( '', false ) );?></h1>
<?php $category_description = category_description();
	if ( ! empty( $category_description ) ) {
		echo '' . $category_description . '';
	}

	/* Run the loop for the category page to output the posts.
	 * If you want to override this in a child theme then include a file
	 * called loop-category.php and that will be used instead.
	 */

	// completely exclude specified categories from display in category templates
	// $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	// query_posts($query_string .'&cat='.st_exclude_blogcats());

	get_template_part( '/loops/loop', 'category' );

	do_action('st_content_wrap_close');

	get_sidebar();

	get_footer();
?>
