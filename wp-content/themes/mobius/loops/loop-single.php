<?php
/**
 * Single Post Loop
 */
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php do_action('st_before_content');?>
	<div id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>
	<?php if (!get_post_meta($post->ID, 'hidetitle', true)) { ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	<?php } ?>
		<?php st_post_meta(); ?>
		<div class="entry-content">
			<?php do_action('st_single_post_image'); ?>
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'smpl' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php if ( get_the_author_meta( 'description' ) ) {st_author_bio();} ?>
		<?php st_postmeta_footer(); ?>
	</div><!-- #post-## -->
	<?php if (  $wp_query->max_num_pages > 1 ) {st_pagenavi();}?>
	<?php comments_template( '', true ); ?>
	<?php do_action('st_after_content');?>
<?php endwhile;?>