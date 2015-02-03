<?php
	$x=0;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array (
        'post_type' => 'post',
        'paged' => $paged
    );
    $query = new WP_Query($args );

	if ($query->have_posts()) : ?>

<?php while ($query->have_posts()) : $query->the_post(); ?>

<?php if (is_home() && ($post == $posts[0]) ) :?>

<div class="fullwidth">

<?php elseif (get_query_var('paged') < 2): ?>

<div class="one_half <?php if (!$odd = $x%2){?> last<?php }?>">

<?php else: ?>
	<div class="fullwidth">
<?php endif; ?>

<div <?php post_class() ?> id="post-<?php the_ID(); ?>">


<?php if (of_get_option('show_post_title')) : ?>
	<h2 class="entry-title">
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'smpl' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h2>
<?php endif; ?>


<?php st_post_meta(); ?>

<?php if (of_get_option('show_post_thumbnails') && has_post_thumbnail()) {
	echo '<div class="alignleft">';
	st_thumbnailer('squared150');
	echo '</div>';
}?>


<div class="entry">
<?php //the_content(__('Read the rest of this entry &raquo;', 'smpl'));
	do_action('st_content');
?>
</div><!-- /entry -->
<div class="clear"></div>
</div><!-- /post -->
</div><!-- /x-column-x -->


<?php if (!$odd = $x%2){?>
	<div class="clear"></div>
<?php }?>


<?php
$x++;
endwhile;

/* Display navigation to next/previous pages when applicable */
	if (  $wp_query->max_num_pages > 1 ) {
	st_pagenavi();
	}
?>

<?php else : ?>
<?php endif; ?>
<div class="clear"></div>
