<?php $x=0;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array (
    'post_type' => 'post',
    'paged' => $paged
);
$query = new WP_Query($args );


 if ($query->have_posts()) : ?>

<?php while ($query->have_posts()) : $query->the_post(); ?>


<?php // if (get_query_var('paged') < 2): ?>

<div class="one_half <?php if ($odd = $x%2){?> last<?php }?>">

<?php // endif; ?>

<div <?php post_class() ?> id="post-<?php the_ID(); ?>">



<?php if (of_get_option('show_post_title')) : ?>
	<h2 class="blog-title">
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'smpl' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h2>
<?php endif; ?>


<?php st_post_meta(); ?>


<div class="entry">
	<?php if (of_get_option('show_post_thumbnails')) {
		echo '<div class="alignright">';
		st_thumbnailer('squared150');
		echo '</div>';
	}?>

<?php
do_action('st_content');
?>

</div><!-- /entry -->
<div class="clear"></div>
</div><!-- /post -->
</div><!-- /x-column-x -->


<?php if ($odd = $x%2){?>
	<div class="clear"></div>
<?php }?>


<?php
$x++;
endwhile;

st_pagenavi();

?>

<?php else : ?>
<?php endif; ?>
<div class="clear"></div>
