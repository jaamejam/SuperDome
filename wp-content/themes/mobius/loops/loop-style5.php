<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage smpl
 * @since smpl 0.1
 */

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array (
    'post_type' => 'post',
    'paged' => $paged
);
$query = new WP_Query($args );


?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! $query->have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'smpl' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'smpl' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 * In Skeleton we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>
<?php while ( $query->have_posts() ) : $query->the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



<div class="entry-content large">

<?php if (of_get_option('show_post_thumbnails') && has_post_thumbnail()) {
	echo '<div class="alignleft">';
	st_thumbnailer('video43');
	echo '</div>';
}?>


<?php if (of_get_option('show_post_title')) : ?>
	<h2 class="blog-title">
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'smpl' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h2>
<?php endif; ?>


<?php st_post_meta(); ?>


<?php //the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'smpl' ) );
do_action('st_content');
?>
<div class="clear"></div>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'smpl' ), 'after' => '</div>' ) ); ?>
</div><!-- .entry-content -->

</div><!-- #post-## -->
<?php comments_template( '', true ); ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */
	if (  $wp_query->max_num_pages > 1 ) {
	st_pagenavi();
	}
?>