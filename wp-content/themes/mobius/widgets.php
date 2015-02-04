<?php
/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override st_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @uses register_sidebar
 */
//

function st_widgets_init() {
// located at the top of the sidebar.
		register_sidebar( array(
		'name' => __( 'Posts Widget Area', 'smpl' ),
		'id' => 'primary-widget-area',
		'description' => __( 'Shown only in Blog Posts, Archives, Categories, etc.', 'smpl' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


// located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Pages Widget Area', 'smpl' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'Shown only in Pages', 'smpl' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

// located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Above Content', 'smpl' ),
		'id' => 'above-content-widget',
		'description' => __( 'Shown directly above content in single entries', 'smpl' ),
		'before_widget' => '<div class="widget-wrap"><div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
// located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Below Content', 'smpl' ),
		'id' => 'below-content-widget',
		'description' => __( 'Shown directly below content in single entries', 'smpl' ),
		'before_widget' => '<div class="widget-wrap"><div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

// located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Teaser Widget Area', 'smpl' ),
		'id' => 'teaser-widget-area',
		'description' => __( 'Shown above navigation', 'smpl' ),
		'before_widget' => '<div id="showcase" class="%2$s"><div class="container"><div class="sixteen columns"><div class="inside">',
		'after_widget' => '</div></div></div></div><div class="clear"></div>',
		'before_title' => '<h2 class="teaser-widget-title">',
		'after_title' => '</h2>',
	) );

// located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'smpl' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'smpl' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

// located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'smpl' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'smpl' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

// located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'smpl' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'smpl' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

// located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'smpl' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'smpl' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

// located in st_header
	register_sidebar( array(
	  'name' => __( 'Top Bar', 'smpl' ),
	  'id' => 'top_bar',
	  'description' => __( 'Displays above the header. Useful for horizontal content such as menus and contact info.', 'smpl' ),
	  'before_widget' => '<div class="widget-extras %1$s">',
	  'after_widget' => '</div>',
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	 ) );
}
/** Register sidebars by running smpl_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'st_widgets_init' );
