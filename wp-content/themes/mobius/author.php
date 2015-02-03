<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage smpl
 * @since smpl 0.1
 */

get_header();
do_action('st_content_wrap');
?>


<?php
	/* Queue the first post, that way we know who
	 * the author is when we try to get their name,
	 * URL, description, avatar, etc.
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	if ( have_posts() )
		the_post();
?>
<h1 class="leader"><?php printf( __( 'Posts written by %s', 'smpl' ), "<a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?></h1>

<?php if ( get_the_author_meta( 'description' ) ) {st_author_bio();} ?>

<?php
	rewind_posts();
	get_template_part( '/loops/loop', 'category' );
	do_action('st_content_wrap_close');
	get_sidebar();
	get_footer();
?>