<?php


if ( !function_exists( 'st_stylebox' ) ) {

/*-----------------------------------------------------------------------------------*/
// Widget Styles in Content
// example [stylebox style="S1" title="My Title"]...your content..[/stylebox]
/*-----------------------------------------------------------------------------------*/

function st_stylebox( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'title' => '',
		'style' => 'S1'
    ), $atts));
  $stylebox  = '<div class="widget-container '.$style.'">';
  if ($title) {
  $stylebox .= '<h3 class="widget-title">'.$title.'</h3>';
  }
  $stylebox .= do_shortcode($content);
  $stylebox .= '</div><div class="clear"></div>';

  return $stylebox;
}
add_shortcode('stylebox', 'st_stylebox');
}



if ( !function_exists( 'st_readmore' ) ) {

/*-----------------------------------------------------------------------------------*/
// Read More Button
/*-----------------------------------------------------------------------------------*/

function st_readmore( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link' => '',
		'target' => '_self',
		'text' => 'Continue Reading &raquo;',
		'align' => 'right'
    ), $atts));
	$readmore ='';
	$readmore .= '<a class="more-link" target="'.$target.'" href="'.$link.'">';
	$readmore .= $text;
	$readmore .= '</a>';
	return $readmore;
}
add_shortcode('readmore', 'st_readmore');
}


if ( !function_exists( 'st_display' ) ) {
/*-----------------------------------------------------------------------------------*/
// Device-Specific Classes
// options: tablet, handheld OR mobile, desktop
// e.g; [display device="tablet"]Content hidden from tablets[/display]
/*-----------------------------------------------------------------------------------*/

function st_display( $atts, $content = null ) {
	extract(shortcode_atts(array(
	    'device' => ''
	    ), $atts));
	$output = '';
	$output .= '<div class="show-on '.$device.'">';
	$output .= do_shortcode($content);
	$output .= '</div>';

	return $output;
	}
add_shortcode('display', 'st_display');
}


if ( !function_exists( 'st_timthumb' ) ) {

/*-----------------------------------------------------------------------------------*/
// Timthumb
/*-----------------------------------------------------------------------------------*/

function st_timthumb( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link' => '',
		'target' => '_self',
		'border' => '',
		'alt' => 'image',
		'width' => '',
		'height' => '',
		'image' => '',
		'src' => '',
		'align' => ''
    ), $atts));
    $timthumb = get_bloginfo('template_directory')."/thumb.php?src=";
	$thumb ='';
	if ($link != '') {
	    $thumb .= '<a target="'.$target.'" href="'.$link.'">';
    }
    $thumb .= '<img alt="'.$alt.'" src="'.$timthumb.$image.$src;
	if ($height != '') {
        $thumb .= '&h='.$height;
    }
	if ($width != '') {
        $thumb .= '&w='.$width;
    }
    $thumb .= '" class="scale-with-grid';
	if ($align != '') {
        $thumb .= ' align'.$align;
    }
	if ($border == "true") {
        $thumb .= ' latest-img';
    }
    $thumb .= '"/>';
	if ($link != '') {
        $thumb .= '</a>';
    }
	return $thumb;
}
add_shortcode('thumb', 'st_timthumb');

}



if ( !function_exists( 'st_lightbox' ) ) {

/*-----------------------------------------------------------------------------------*/
// Lightbox
/*-----------------------------------------------------------------------------------*/

function st_lightbox( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'href' => '',
		'width' => '',
		'title' => '',
		'height' => '',
		'iframe' => ''
		), $atts));
	$lightbox;
	if ($iframe == 'true') {
	$lightbox .= '<a title="'.$title.'" rel="prettyphoto" href="'.$href.'?iframe=true&width='.$width.'&height='.$height.'">';
	} else {
	$lightbox .= '<a title="'.$title.'" rel="prettyphoto" href="'.$href.'">';
	}
	$lightbox .= $content;
	$lightbox .= '</a>';
	return $lightbox;
}
add_shortcode('lightbox', 'st_lightbox');

}




if ( !function_exists( 'st_break' ) ) {
/*-----------------------------------------------------------------------------------*/
// Clearing
/*-----------------------------------------------------------------------------------*/

function st_break( $atts, $content = null ) {
	return '<div class="clear"></div>';
}
add_shortcode('clear', 'st_break');

}

if ( !function_exists( 'st_linebreak' ) ) {

/*-----------------------------------------------------------------------------------*/
// Clearing with Horizontal Line
/*-----------------------------------------------------------------------------------*/

function st_linebreak( $atts, $content = null ) {
	return '<hr /><div class="clear"></div>';
}
add_shortcode('clearline', 'st_linebreak');

}

if ( !function_exists( 'st_linefade' ) ) {
/*-----------------------------------------------------------------------------------*/
// Clearing with Faded Background
/*-----------------------------------------------------------------------------------*/

function st_linefade( $atts, $content = null ) {
	return '<div class="clearfade"></div>';
}
add_shortcode('clearfade', 'st_linefade');
}



if ( !function_exists( 'st_centered' ) ) {

/*-----------------------------------------------------------------------------------*/
// Center
/*-----------------------------------------------------------------------------------*/

function st_centered( $atts, $content = null ) {
	extract( shortcode_atts( array(
     'width' => ''
     ), $atts ) );
	return '<div class="aligncenter" style="width:'.$width.'px;margin:0px auto;">'.do_shortcode($content).'</div>';
}
add_shortcode('center', 'st_centered');
}


if ( !function_exists( 'st_related_posts' ) ) {
/*-----------------------------------------------------------------------------------*/
// Related Posts - [related_posts]
/*-----------------------------------------------------------------------------------*/


function st_related_posts( $atts ) {
	extract(shortcode_atts(array(
	    'limit' => '5',
	), $atts));

	global $wpdb, $post, $table_prefix;

	if ($post->ID) {
		$retval = '<div class="st_relatedposts">';
		$retval .= '<h4>Related Posts</h4>';
		$retval .= '<ul>';
 		// Get tags
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);

		// Do the query
		$q = "SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id  = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
 			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";

		$related = $wpdb->get_results($q);
 		if ( $related ) {
			foreach($related as $r) {
				$retval .= '<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>';
			}
		} else {
			$retval .= '
	<li>No related posts found</li>';
		}
		$retval .= '</ul>';
		$retval .= '</div>';
		return $retval;
	}
	return;
}
add_shortcode('related_posts', 'st_related_posts');

}




if ( !function_exists( 'the_excerpt_rereloaded' ) ) {

function the_excerpt_rereloaded($words = 40, $link_text = 'Continue reading this entry &#187;', $allowed_tags = '', $container = 'p', $smileys = 'no' )
{
	global $post;

    if ( $allowed_tags == 'all' ) $allowed_tags = '<a>,<i>,<em>,<b>,<strong>,<ul>,<ol>,<li>,<span>,<blockquote>,<img>';

    $text = preg_replace('/\[.*\]/', '', strip_tags($post->post_content, $allowed_tags));

    $text = explode(' ', $text);
    $tot = count($text);

    for ( $i=0; $i<$words; $i++ ) : $output .= $text[$i] . ' '; endfor;

    if ( $smileys == "yes" ) $output = convert_smilies($output);

    ?><p><?php echo force_balance_tags($output) ?><?php if ( $i < $tot ) : ?> ...<?php else : ?></p><?php endif; ?>
    <?php if ( $i < $tot ) :
        if ( $container == 'p' || $container == 'div' ) : ?></p><?php endif;
            if ( $container != 'plain' ) : ?><<?php echo $container; ?> class="more"><?php if ( $container == 'div' ) : ?><p><?php endif; endif; ?>

    <a href="<?php the_permalink(); ?>" title="<?php echo $link_text; ?>"><?php echo $link_text; ?></a><?php

            if ( $container == 'div' ) : ?></p><?php endif; if ( $container != 'plain' ) : ?></<?php echo $container; ?>><?php endif;
        if ( $container == 'plain' || $container == 'span' ) : ?></p><?php endif;
        endif;

}

}


if ( !function_exists( 'st_remove_wpautop' ) ) {


// Instead of remove_filter('the_content', 'wpautop');
// The function below removes wp_autop from specified pages with a custom field:
// Name: wpautop Value: false

function st_remove_wpautop($content) {
    global $post;
    // Get the keys and values of the custom fields:
    $rmwpautop = get_post_meta($post->ID, 'wpautop', true);
    if ('false' === $rmwpautop) {
    	remove_filter('the_content', 'wpautop');
    }
    return $content;
}
// Hook into the Plugin API
add_filter('the_content', 'st_remove_wpautop', 9);

}

// Better Pre Tag code display

add_shortcode('showshortcode', 'st_showshortcode');
add_shortcode('showsc', 'st_showshortcode');
add_shortcode('ssc', 'st_showshortcode');

function st_showshortcode($atts, $content = null){
	extract(shortcode_atts(array('linebreak'=>''),$atts));
	$brackets = array();
	$brackets[0] = "/\[/";
	$brackets[1] = "/\]/";
	$replace_with = array();
	$replace_with[0] = "&#91;";
	$replace_with[1] = "&#93;";
	$content  = preg_replace($brackets, $replace_with, trim($content));
	$content .= (!empty($linebreak))? "<br />" : "";
	return $content;
} // end st_showshortcode

//replaces pre content with html entities
function pre_entities($matches) {
	return str_replace($matches[1],htmlentities($matches[1]),$matches[0]);
}

//to html entities;  assume content is in the "content" variable
$content = '';
$content .= preg_replace_callback('/<pre.*?>(.*?)<\/pre>/imsu','pre_entities', $content);

function pre_esc_html($content) {
  return preg_replace_callback(
    '#(<pre.*?>)(.*?)(</pre>)#imsu',
    create_function('$i','return $i[1].esc_html($i[2]).$i[3];'),$content);
}

add_filter('the_content','pre_esc_html',9);


// Pages Shortcode
// http://wordpress.org/plugins/list-pages-shortcode/

class ST_List_Pages_Shortcode {

	/**
	 * Constructor
	 */
	function ST_List_Pages_Shortcode() {
		add_shortcode( 'child-pages', array( $this, 'shortcode_list_pages' ) );
		add_shortcode( 'sibling-pages', array( $this, 'shortcode_list_pages' ) );
		add_shortcode( 'list-pages', array( $this, 'shortcode_list_pages' ) );
		add_filter( 'ST_list_pages_shortcode_excerpt', array( $this, 'excerpt_filter' ) );
	}

	function shortcode_list_pages( $atts, $content, $tag ) {
		global $post;

		// Child Pages
		$child_of = 0;
		if ( $tag == 'child-pages' )
			$child_of = $post->ID;
		if ( $tag == 'sibling-pages' )
			$child_of = $post->post_parent;

		// Set defaults
		$defaults = array(
			'class'       => $tag,
			'depth'       => 0,
			'show_date'   => '',
			'date_format' => get_option( 'date_format' ),
			'exclude'     => '',
			'include'     => '',
			'child_of'    => $child_of,
			'list_type'   => 'ul',
			'title_li'    => '',
			'authors'     => '',
			'sort_column' => 'menu_order, post_title',
			'sort_order'  => '',
			'link_before' => '',
			'link_after'  => '',
			'exclude_tree'=> '',
			'meta_key'    => '',
			'meta_value'  => '',
			'offset'      => '',
			'post_status' => 'publish',
			'exclude_current_page' => 0,
			'excerpt'     => 0
		);

		// Merge user provided atts with defaults
		$atts = shortcode_atts( $defaults, $atts );
		$atts['title_li'] = html_entity_decode( $atts['title_li'] );

		// Set necessary params
		$atts['echo'] = 0;
		if ( $atts['exclude_current_page'] && absint( $post->ID ) ) {
			if ( !empty( $atts['exclude'] ) )
				$atts['exclude'] .= ',';
			$atts['exclude'] .= $post->ID;
		}

		$atts = apply_filters( 'shortcode_list_pages_attributes', $atts, $content, $tag );

		// Use custom walker
		if ( $atts['excerpt'] || $atts['list_type'] != 'ul' ) {
			$atts['walker'] = new ST_List_Pages_Shortcode_Walker_Page;
		}

		// Catch <ul> tags in wp_list_pages()
		if ( $atts['list_type'] != 'ul' ) {
			add_filter( 'wp_list_pages', array( $this, 'ul2list_type' ), 10, 2 );
		}

		// Create output
		$out = wp_list_pages( $atts );
		remove_filter( 'wp_list_pages', array( $this, 'ul2list_type' ), 10 );
		if ( !empty( $out ) )
			$out = '<' . $atts['list_type'] . ' class="' . $atts['class'] . '">' . $out . '</' . $atts['list_type'] . '>';

		return apply_filters( 'shortcode_list_pages', $out, $atts, $content, $tag );
	}

	/**
	 * UL 2 List Type
	 * Replaces all <ul> tags with <{list_type}> tags.
	 *
	 * @param string $output Output of wp_list_pages().
	 * @param array $args shortcode_list_pages() args.
	 * @return string HTML output.
	 */
	function ul2list_type( $output, $args = null ) {
		$output = str_replace( '<ul>', '<' . $args['list_type'] . '>', $output );
		$output = str_replace( '<ul ', '<' . $args['list_type'] . ' ', $output );
		$output = str_replace( '</ul> ', '</' . $args['list_type'] . '>', $output );
		return $output;
	}

	/**
	 * Excerpt Filter
	 * Add a <div> around the excerpt by default.
	 *
	 * @param string $excerpt Excerpt.
	 * @return string Filtered excerpt.
	 */
	function excerpt_filter( $text ) {
		if ( ! empty( $text ) )
			return ' <div class="excerpt">' . $text . '</div>';
		return $text;
	}

}

/**
 * Create HTML list of pages.
 * A copy of the WordPress Walker_Page class which adds an excerpt.
 */
class ST_List_Pages_Shortcode_Walker_Page extends Walker_Page {

	/**
	 * @see Walker::start_lvl()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<" . $args['list_type'] . " class='children'>\n";
	}

	/**
	 * @see Walker::end_lvl()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</" . $args['list_type'] . ">\n";
	}

	function start_el(&$output, $page, $depth = 0, $args = Array(), $current_page = 0) {
	//function start_el( &$output, $page, $depth, $args, $current_page = 0 ) {
		if ( $depth )
			$indent = str_repeat("\t", $depth);
		else
			$indent = '';

		extract($args, EXTR_SKIP);
		$css_class = array('page_item', 'page-item-'.$page->ID);
		if ( !empty($current_page) ) {
			$_current_page = get_page( $current_page );
			if ( in_array( $page->ID, $_current_page->ancestors ) )
				$css_class[] = 'current_page_ancestor';
			if ( $page->ID == $current_page )
				$css_class[] = 'current_page_item';
			elseif ( $_current_page && $page->ID == $_current_page->post_parent )
				$css_class[] = 'current_page_parent';
		} elseif ( $page->ID == get_option('page_for_posts') ) {
			$css_class[] = 'current_page_parent';
		}

		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

		$output .= $indent . '<li class="' . $css_class . '"><a href="' . get_permalink($page->ID) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';

		if ( !empty($show_date) ) {
			if ( 'modified' == $show_date )
				$time = $page->post_modified;
			else
				$time = $page->post_date;

			$output .= " " . mysql2date($date_format, $time);
		}

		// Excerpt
		if ( $args['excerpt'] ) {
			$output .= apply_filters( 'ST_list_pages_shortcode_excerpt', $page->post_excerpt, $page, $depth, $args, $current_page );
		}
	}

}

/**
 * [shortcode_list_pages] Function
 * Kept for legacy reasons in case people are using it directly.
 */
function shortcode_list_pages( $atts, $content, $tag ) {
	global $ST_List_Pages_Shortcode;
	return $ST_List_Pages_Shortcode->shortcode_list_pages( $atts, $content, $tag );
}

global $ST_List_Pages_Shortcode;
$ST_List_Pages_Shortcode = new ST_List_Pages_Shortcode();

?>