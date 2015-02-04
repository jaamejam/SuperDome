<?php

/*-----------------------------------------------------------------------------------*/
/* Post Meta
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'st_post_meta' ) ) {

function st_post_meta() {
		/* Don't show meta on Pages */ if (!is_page()) {
		if (of_get_option('show_post_author') || of_get_option('show_post_date') || of_get_option('show_post_categories') || of_get_option('show_post_tags') || of_get_option('show_post_comments')) :
				echo '<div class="postmeta small">';

					if (of_get_option('show_post_author') || of_get_option('show_post_date')) :

					echo '<span class="post_written">';
					_e ('Written', 'smpl');
					echo ' ';

					if (of_get_option('show_post_date')) :
					 the_time(get_option('date_format'));
					echo ' ';

					endif;

					if (of_get_option('show_post_author')) :

					_e ('by', 'smpl');
					echo ' ';
					the_author_posts_link();
					endif;

					echo '</span><br />';

					endif;

					if (of_get_option('show_post_categories')) :

					echo '<span class="post_categories">';
						_e ('Categories', 'smpl') ?>: <?php the_category(', ');
					echo '</span><br />';

					endif;

					if (of_get_option('show_post_tags') && (get_the_tags())) :

					echo '<span class="post_tags">';
					_e ('Tags', 'smpl');
					echo ': ';
					the_tags('', ', ', '<br />');
					echo '</span>';

					endif;

					if (of_get_option('show_post_comments')) :

					echo '<span class="post-comments">';
						comments_popup_link(__ ('No Comments &#187;', 'smpl'),__ ('1 Comment &#187;', 'smpl'),_n ('% comment', '% comments',get_comments_number (),'smpl'));
					echo '</span>';

					endif;
		  echo '</div><!--/small-->';
			endif;
		}
	}
}


/*-----------------------------------------------------------------------------------*/
/* Post Meta Footer
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'st_postmeta_footer' ) ) {

function st_postmeta_footer() {
global $post;
if (of_get_option('show_post_summary')) {

	echo '<div class="entry-utility">';
		if ( count( get_the_category() ) ) :
			echo '<span class="cat-links">';
			printf( __( '<span class="%1$s">Posted in</span> %2$s', 'smpl' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) );
			echo '</span>';
		endif;

	if (of_get_option('show_post_tags')) {
	$tags_list = get_the_tag_list( '', ', ' );
	if ($tags_list):
		echo '<span class="tag-links">';
		printf( __( '<span class="%1$s">Tagged</span> %2$s', 'smpl' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
		echo '</span>';
	endif;
	}
	if ('open' == $post->comment_status) {
		echo '<span class="meta-sep">  &nbsp;|&nbsp;  </span>';
		echo '<span class="comments-link">';
			comments_popup_link( __( 'Leave a comment', 'smpl' ), __( '1 Comment', 'smpl' ), __( '% Comments', 'smpl' ) );
		echo '</span>';
		}
		edit_post_link( __( 'Edit', 'smpl' ), '<span class="meta-sep"> &nbsp;|&nbsp; </span> <span class="edit-link">', '</span>' );
		echo '</div><!-- .entry-utility -->';

	}
	if (of_get_option('show_post_pagination')) {
	echo '<div class="post_pagination clearfix">';
	echo '<div class="prevpost">';
  previous_post_link('%link',__('&laquo; Previous Post', 'smpl'), FALSE, '');
	echo '</div>';
	echo '<div class="nextpost">';
  next_post_link('%link',__('Next Post &raquo;', 'smpl'), FALSE, '');
	echo '</div>';
	echo '</div>';
	}
	}

}



/*-----------------------------------------------------------------------------------*/
/* Breadcrumbs
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'st_breadcrumbs' ) ) {

function st_breadcrumbs() {
  global $post;
  // separator
  $delimiter = '<span class="sep">&raquo;</span>';

  // Breadcrumb 'Home' title
  $homename = of_get_option('bread_home_title');
  // Breadcrumb 'Blog' title
  $blogname = of_get_option('bread_blog_title');

  // curent item
  $currentBefore = '<strong>';
  $currentAfter = '</strong>';

	// Establish the 'Blog' URL
	// returns 'page' or 'posts'
	$show_on_front = get_option('show_on_front');
	// if page is returned
  $posts_page_id = get_option('page_for_posts');
  // get the Posts page ID
  $posts_page = get_page($posts_page_id);
  // and the title
  $posts_page_title = $posts_page->post_title;
  // and finally the URL
  $posts_page_url = get_page_uri($posts_page_id);

  if ($show_on_front != 'posts') {
    $blogurl = '<a href="'.home_url( '/' ).$posts_page_url.'" title="'.$posts_page_title.'">'.$blogname.'</a>'.$delimiter;
  } else {
	 $blogurl = '';
  }


  $show = of_get_option('show_breadcrumbs');
  $display = false;
  switch ($show) {

	// "0" => "Only on Blog (including blog home)",
	// "4" => "Only on Blog (excluding blog home)",
	// "1" => "Only on Pages",
	// "2" => "Show Everywhere",
	// "5" => "Show Everywhere (except home page)",
	// "3" => "Disable");


	// display only on blog (including blog home)
	case 0:
		if (is_home() || is_single() || is_category() || is_author() || is_tag() || is_month() || is_year() || is_day())
		$display = true;
		break;
	// display only on blog (excluding blog home)
	case 4:
		if (is_single() || is_category() || is_author() || is_tag() || is_month() || is_year() || is_day())
		$display = true;
		break;
	// display only on pages
	case 1:
		if (is_page())
		$display = true;
		break;
	// display everywhere
	case 2:
		$display = true;
		break;
	// disable everywhere
	case 3:
		$display = false;
		break;
	}

if ($display) {

  if ( !is_front_page() || is_paged() ) {

    echo '<p id="breadcrumbs">';
    $home = get_bloginfo('url');
    echo '<a href="' . $home . '">' . $homename . '</a> ' . $delimiter . ' ';
    if (is_home() && ( $show == 0 || $show == 2 )) {
    echo '<strong>'.$blogname.'</strong>';
    }

    if (class_exists('Woocommerce') && is_woocommerce() ) {
      $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
      echo $currentBefore . '<a href="'.$shop_page_url.'">Shop</a>'. $currentAfter.$delimiter;
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
			echo $blogurl;
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore;
      single_cat_title();
      echo $currentAfter;

    } elseif ( is_day() ) {
			echo $blogurl;
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;

    } elseif ( is_month() ) {
			echo $blogurl;
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;

    } elseif ( is_year() ) {
			echo $blogurl;
      echo $currentBefore . get_the_time('Y') . $currentAfter;

    } elseif ( is_single() && !is_attachment() ) {
			echo $blogurl;
      $cat = get_the_category(); $cat = $cat[0];
			if (get_post_type() == 'post') {
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			} elseif (get_post_type()) {
	   	echo $currentBefore . ucfirst(get_post_type()) . $currentAfter.$delimiter;
			}
      echo $currentBefore;
			// display the title
			$mytitle = get_the_title();
			$layoutstyle = get_post_meta($post->ID, "layout", $single = true);
			// unless on a 3-column page
			if  ($layoutstyle = 'leftright') {
			if (strlen($mytitle) >35 )
			// ony display 35 characters
			$mytitle = substr($mytitle,0,35).' [...]';
			}
			echo $mytitle;
      echo $currentAfter;

    } elseif ( is_attachment() ) {
      echo $blogurl;
      $parent = get_post($post->post_parent);
      //$cat = get_the_category($parent->ID);
      //$cat = $cat[0];
      //echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_search() ) {
      echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;

    } elseif ( is_tag() ) {
			echo $blogurl;
      echo $currentBefore . 'Posts tagged &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;

    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;

    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</p>';

  }
} // display
}
add_action('st_show_breadcrumbs','st_breadcrumbs');

} // function exists





if ( !function_exists( 'get_image_path' ) ) {

function get_image_path() {
 global $post;
 global $blog_id;
 $id = get_post_thumbnail_id();

if(stripos($id,'ngg-') !== false && class_exists('nggdb')) {
 $nggImage = nggdb::find_image(str_replace('ngg-','',$id));
 $thumbnail = array($nggImage->imageURL,$nggImage->width,$nggImage->height);
 } else {
 $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
 $theimage = $thumbnail[0];
 // TEST FOR WP MU
 if (isset($blog_id) && $blog_id > 0) {
     $realpath = explode('/files/', $theimage);
    if (isset($realpath[1])) {
     $theimage = get_site_option('siteurl') . 'wp-content/blogs.dir/' . $blog_id . '/files/' . $realpath[1];
    }
 }
 }
 return $theimage;
}

} // end function_exists


/*-----------------------------------------------------------------------------------*/
// Creates an additional hook to limit the excerpt
/*-----------------------------------------------------------------------------------*/

function st_limit_words($string, $word_limit, $ending=false) {
	// creates an array of words from $string (this will be our excerpt)
	// explode divides the excerpt up by using a space character
	$words = explode(' ', $string);
	// this next bit chops the $words array and sticks it back together
	// starting at the first word '0' and ending at the $word_limit
	// the $word_limit which is passed in the function will be the number
	// of words we want to use
	// implode glues the chopped up array back together using a space character
	return implode(' ', array_slice($words, 0, $word_limit)).$ending;
}




/*-----------------------------------------------------------------------------------*/
// Enable Shortcodes in excerpts and widgets
/*-----------------------------------------------------------------------------------*/

add_filter('widget_text', 'do_shortcode');
add_filter( 'the_excerpt', 'do_shortcode');
add_filter('get_the_excerpt', 'do_shortcode');


/*-----------------------------------------------------------------------------------*/
// Override a default filter for 'textarea' sanitization and $allowedposttags + embed and script.
/*-----------------------------------------------------------------------------------*/


if (! function_exists('optionscheck_change_sanitization'))  {

function optionscheck_change_sanitization() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'custom_sanitize_textarea' );
}

add_action('admin_init','optionscheck_change_sanitization', 100);

}

if (! function_exists('custom_sanitize_textarea'))  {

function custom_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
      "src" => array(),
      "type" => array(),
      "allowfullscreen" => array(),
      "allowscriptaccess" => array(),
      "height" => array(),
          "width" => array()
      );
      $custom_allowedtags["script"] = array(
	      "src" => array(),
	      "type" => array()
      );

      $of_custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      $output = wp_kses( $input, $of_custom_allowedtags);
    return $output;
}
} // endif


/*-----------------------------------------------------------------------------------*/
// Exclude specified categories from display on blog
/*-----------------------------------------------------------------------------------*/


if (! function_exists('st_exclude_blogcats'))  {

function st_exclude_blogcats() {
$thecats = of_get_option('exclude_blogcats');
$excludes = '';
if ($thecats != "")
$excludes = str_replace(",",",-", $thecats);
$blog_exclude_cats = '-'.$excludes;
return $blog_exclude_cats;
}

} // endif


/*-----------------------------------------------------------------------------------*/
// PAGE NAVIGATION
/*-----------------------------------------------------------------------------------*/


// Pages
if (! function_exists('st_page_pagenavi'))  {

function st_page_pagenavi() {
			echo '<div class="pagination">';
			wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number'));
			echo '</div>';
}
} // endif

if (! function_exists('st_pagenavi'))  {
//Posts
function st_pagenavi($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}
} // endif

// Adds a 'last' class to the last menu item

function nav_menu_first_last( $items ) {
 $pos = strrpos($items, 'class="menu-item', -1);
 $items=substr_replace($items, 'menu-item-last ', $pos+7, 0);
 $pos = strpos($items, 'class="menu-item');
 $items=substr_replace($items, 'menu-item-first ', $pos+7, 0);
 return $items;
}
add_filter( 'wp_nav_menu_items', 'nav_menu_first_last' );
