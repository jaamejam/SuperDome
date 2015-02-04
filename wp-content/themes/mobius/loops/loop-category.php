<?php
/**
 * Loop Style 3
 */
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>

<?php if ( ! have_posts() ) : ?>

	<div id="post-0" class="post error404 not-found">
	
		<h1 class="entry-title"><?php _e( 'Not Found', 'smpl' ); ?></h1>
		
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'smpl' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
		
	</div><!-- #post-0 -->
	
<?php endif; ?>


<?php st_before_content();	?>

<?php // begin categories loop ?>

<?php while ( have_posts() ) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if (of_get_option('show_post_title')) : ?>
	<h2 class="entry-title">
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'smpl' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h2>
<?php endif; ?>

<?php st_post_meta(); ?>

<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
	<div class="entry-summary clearfix">
	<?php if (of_get_option('show_post_thumbnails') && has_post_thumbnail()) {
		echo '<div class="alignleft">';
		st_thumbnailer('squared150');
		echo '</div>';
	}?>

		
		<?php do_action('st_content'); ?>
	
	</div><!-- .entry-summary -->

<?php else : ?>

<div class="entry-content">

	<?php if (of_get_option('show_post_thumbnails')) {
		echo '<div class="alignleft">';
		st_thumbnailer('squared150');
		echo '</div>';
	}?>
	
	<?php //the_content( __( 'Continue Reading', 'smpl' ) );
	do_action('st_content');
	?>
	
	<div class="clear"></div>
		
	</div><!-- .entry-content -->
	
	<?php endif; ?>

</div><!-- #post-## -->

<?php endwhile; // End the loop. ?>

<?php /* Display navigation to next/previous pages when applicable */
	if (  $wp_query->max_num_pages > 1 ) {
	st_pagenavi();
	}
?>
<?php st_after_content();	?>
