<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$theme  = wp_get_theme();
	$themename = $theme['Name'];
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {


// Background Defaults

$body_background_defaults = array(
'color' => '#FFFFFF',
'image' => '',
'repeat' => 'repeat-x',
'position' => 'top center',
'attachment'=>'fixed');

$header_background_defaults = array(
'color' => '#006A9F',
'image' => get_site_url().'/wp-content/themes/mobius/images/style1/header_bg.png',
'repeat' => 'repeat-x',
'position' => 'top center',
'attachment'=>'fixed');


// Image radio button path

$imagepath =  get_bloginfo('template_directory') . '/images/';


// Breadcrumb Options

$breadcrumb_options = array(
"0" => "Only on Blog (including blog index)",
"4" => "Only on Blog (excluding blog index)",
"1" => "Only on Pages",
"2" => "Show Everywhere (except home page)",
"3" => "Disable");


// Pull all the categories into an array
$options_categories = array();
$options_categories_obj = get_categories();
foreach ($options_categories_obj as $category) {
   	$options_categories[$category->cat_ID] = $category->cat_name;
}

// Pull all the pages into an array
$options_pages = array();
$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
$options_pages[''] = 'Select a page:';
foreach ($options_pages_obj as $page) {
   	$options_pages[$page->ID] = $page->post_title;
}

$options = array();

// Options

$options[] = array( "name" => "General Settings",
					"type" => "heading");


$options[] = array( "name" => "Customization",
					"desc" => "In Live Mode, your customizations are cached in a dynamic stylesheet. Enabling Customization Mode puts the styles in wp_head and is not cached. This comes at a small price. For more info, please read <a target=\"_blank\" href=\"#\">http://goo.gl/speed</a>",
					"id" => "dev_mode",
					"std" => "0",
					"type" => "radio",
					"class" => "linear",
					"options" => array(
						"1" => "Live Mode",
						"0" => "Customization Mode"
						)
					);

$options[] = array( "name" => "Max Layout Width",
					"desc" => "Select preferred container maximum layout width.",
					"id" => "max_layout_width",
					"std" => "960",
					"type" => "radio",
					"class" => "linear",
					"options" => array(
						'960' => '960px',
						'1140' => '1140px',
						'1200' => '1200px',
						'1400' => '1400px',
						'1600' => '1600px'
						)
					);


$options[] = array( "name" => "Breadcrumb Menu",
					"desc" => "Display a breadcrumb navigation menu in selected areas.",
					"id" => "show_breadcrumbs",
					"std" => "0",
					"type" => "radio",
					"class" => "linear",
					"options" => $breadcrumb_options);

$options[] = array( "name" => "Breadcrumb Home Title",
					"desc" => "Breadcrumb home title display",
					"id" => "bread_home_title",
					"std" => __( "Home", "smpl" ),
					"class" => "mini",
					"type" => "text");


$options[] = array( "name" => "Breadcrumb Blog Title",
					"desc" => "Breadcrumb blog title display",
					"id" => "bread_blog_title",
					"std" => "Blog",
					"class" => "mini",
					"type" => "text");


$options[] = array( "name" => "Default Sidebar Position",
					"desc" => "Select a sidebar layout position (left or right). You may change this on a per-page basis in the inidividual Page/Post settings.",
					"id" => "page_layout",
					"std" => "right",
					"type" => "images",
					"options" => array(
						'left' => $imagepath . '2cl.png',
						'wide' => $imagepath . '1col.png',
						'right' => $imagepath . '2cr.png')
					);

$options[] = array( "name" => "Layout Dimensions",
					"desc" => "Important: The content in this theme is powered by a responsive grid system. The Sidebar Width and Content Width options below must equal a total of 16. Defaults are Content: 11 + Sidebar: 5",
					"class" => "basic",
					"type" => "info");


$options[] = array( "name" => "Sidebar Width",
					"desc" => "Define the width of your sidebar.",
					"id" => "sidebar_width",
					"std" => "five",
					"type" => "select",
					"options" => array(
						'one' =>		'1 Columns',
						'two' =>		'1 Columns',
						'three' =>	'3 Columns',
						'four' =>		'4 Columns',
						'five' =>		'5 Columns',
						'six' =>		'6 Columns',
						'seven' =>	'7 Columns',
						'eight' =>	'8 Columns')
					);

$options[] = array( "name" => "Content Width",
					"desc" => "Define the width of your content area.",
					"id" => "content_width",
					"std" => "eleven",
					"type" => "select",
					"options" => array(
						'one' =>			' 1 Column',
						'two' =>			' 2 Columns',
						'three' =>		' 3 Columns',
						'four' =>			' 4 Columns',
						'five' =>			' 5 Columns',
						'six' =>			' 6 Columns',
						'seven' =>		' 7 Columns',
						'eight' =>		' 8 Columns',
						'nine' =>			' 9 Columns',
						'ten' =>			'10 Columns',
						'eleven' =>		'11 Columns',
						'twelve' =>		'12 Columns',
						'thirteen' =>	'13 Columns')
					);


$options[] = array( "name" => "Footer Fine Print",
					"desc" => "HTML or text to be inserted into the very bottom after the widgets.",
					"id" => "footer_text",
					"std" => "",
					"type" => "editor",
					"options" => array(
						'cols' => 4)
					);

$options[] = array( "name" => "Footer Scripts",
					"desc" => "Add custom footer scripts such as Google Analytics or Typekit.",
					"id" => "footer_scripts",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "Custom CSS",
					"desc" => "Add custom CSS to override default styles. You may also edit the stylesheets directly form Appearance &rarr; Editor",
					"id" => "custom_css",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "Theme Credits",
					"desc" => "Display theme credits in footer. ",
					"id" => "st_credits",
					"std" => "1",
					"type" => "checkbox");

$options[] = array( "name" => "Affiliate ID",
					"desc" => "Enter your Affiliate ID. Not an affiliate? <a href=\"https://www.simplethemes.com/aff/\">Sign up here!</a>.",
					"id" => "st_affid",
					"std" => "",
					"class" => "mini hidden",
					"type" => "text");


$options[] = array( "name" => "Header","type" => "heading");


// Typography

$options[] = array( "name" => "Logo Style",
					"desc" => "Display a custom image/logo image in place of title header.",
					"id" => "use_logo_image",
					"std" => "1",
					"type" => "checkbox");

$options[] = array( "name" => "Center Logo",
					"desc" => "Center the logo/text inside the header.",
					"id" => "center_logo",
					"std" => "0",
					"type" => "checkbox");

 $options[] = array( "name" => "Top Bar Background Color",
 					"desc" => "To enable, assign a Widget to the Top Bar location.",
 					"id" => "topbar_bg",
 					"std" => "#168CC2",
 					"type" => "color");

$options[] = array( "name" =>  "Header Background",
					"desc" => "Customize the header background image.",
					"id" => "header_background",
					"std" => $header_background_defaults,
					"type" => "background");

$options[] = array( "name" => "Header Logo",
					"desc" => "If you prefer to show a graphic logo in place of the header, you can upload or paste the URL here. Set the width and height below. <strong>Your logo should be resized prior to uploading</strong>. (24/32-but transparent PNG is optimal)",
					"id" => "header_logo",
					"class" => "hidden",
					"std" => get_site_url()."/wp-content/themes/mobius/images/style1/logo.png",
					"type" => "upload");

$options[] = array( "name" => "Logo Width",
					"desc" => "Width (in px) of Your logo.",
					"id" => "logo_width",
					"std" => "180",
					"class" => "mini hidden",
					"type" => "text");

$options[] = array( "name" => "Logo Height",
					"desc" => "Height (in px) of Your logo.",
					"id" => "logo_height",
					"std" => "70",
					"class" => "mini hidden",
					"type" => "text"
				);

$options[] = array( "name" => "Logo Margin",
					"desc" => "CSS margin around the logo",
					"id" => "logo_margin",
					"std" => "10px",
					"class" => "mini",
					"type" => "text"
				);


$options[] = array(
	"name" => "Text Header Settings",
	"desc" => "If you choose not to upload a logo for your header, the options below allow you to customize the text and tagline. If you have uploaded a logo, the settings below have no effect.",
	"class" => "text-header-none",
	"type" => "info"
	);

$options[] = array(
	"name" => "Header Text Style",
	"desc" => "Header text style.",
	"id" => "header_typography",
	"std" => array(
		'size' => '40px',
		'face' => 'helvetica',
		'style' => 'normal',
		'color' => '#ec5006'
		),
	"type" => "typography"
	);

$options[] = array( "name" => "Tagline Text Style",
					"desc" => "Tagline text style.",
					"id" => "tagline_typography",
					"std" => array('size' => '24px','face' => 'helvetica','style' => 'normal','color' => '#c1cfd3'),
					"type" => "typography");

$options[] = array( "name" => "Use Custom Headline & Tagline",
					"desc" => "By default, the site title and tagline is used in the header (Settings &rarr; General) Check this option if you would like to define your own.",
					"id" => "use_custom_titletag",
					"type" => "checkbox");

$options[] = array( "name" => "Header Text",
					"desc" => "Your Site Title",
					"id" => "site_title",
					"std" => "",
					"class" => "hidden",
					"type" => "text");

$options[] = array( "name" => "Header Tagline Text",
					"desc" => "Your Site Tagline - Leave empty to omit.",
					"id" => "site_tagline",
					"std" => "",
					"class" => "hidden",
					"type" => "text");


$options[] = array( "name" => "Background","type" => "heading");

$options[] = array( "name" =>  "Body Background",
					"desc" => "Customize the background color and image.",
					"id" => "body_background",
					"std" => $body_background_defaults,
					"type" => "background");

$options[] = array( "name" => "Mobile Settings","type" => "heading");

$options[] = array( "name" => "Responsive Device Support",
					"desc" => "Enable or disable responsve layout for smartphone and tablet devices. (this option triggers layout.css and smpl-r.css)",
					"id" => "mobile_support",
					"std" => "mobile",
					"type" => "radio",
					"class" => "linear",
					"options" => array(
						'mobile' => 'Enabled',
						'desktop' => 'Disabled')
					);

$options[] = array( "name" => "Viewport Scaling",
					"desc" => "Enable to allow pinch/zoom accesssibility. Disable to forces content to a 1:1 viewport scale.",
					"id" => "viewport_scale",
					"std" => "enable",
					"type" => "radio",
					"class" => "linear",
					"options" => array(
						'enable' => 'Enable - Allow Pinch/Zoom',
						'disable' => 'Disable - Force Scale to Viewport')
					);

$options[] = array( "name" => "Mobile Menu Style",
					"desc" => "Choose a menu style for the main menu on mobile devices.",
					"id" => "mobile_selectmenu",
					"std" => "dropdown-menu",
					"type" => "radio",
					"class" => "linear",
					"options" => array(
						'select-menu' => 'Select Dropdown',
						'dropdown-menu' => 'Toggle Dropdown')
						);

$options[] = array( "name" => "Mobile Menu Default Text",
					"desc" => "Text to display for default menu select",
					"id" => "menu_text",
					"std" => "-- Select a page --",
					"class" => "hidden",
					"type" => "text");

// Responsive Header Logo

$options[] = array( "name" => "Enable Mobile Header",
					"desc" => "If your default logo is wider than 300px, your users may experience unwanted horizontal scrolling. Enable this option to upload an alternate mobile logo.",
					"id" => "use_mobile_logo_image",
					"std" => "0",
					"type" => "checkbox");

$options[] = array( "name" => "Mobile Header (Logo)",
					"desc" => "<strong>Your mobile logo should be resized to 300px wide prior to uploading</strong>. (24/32-but transparent PNG is optimal)",
					"id" => "mobile_header_logo",
					"class" => "hidden",
					"type" => "upload");

$options[] = array( "name" => "Mobile Logo Height",
					"desc" => "Height (in px) of Your logo.",
					"id" => "mobile_logo_height",
					"std" => "94",
					"class" => "mini",
					"type" => "text");

$options[] = array( "name" => "Enable Responsive Images",
					"desc" => "Display WP images and captions at full width in mobile browsers?",
					"id" => "responsive_images",
					"std" => "0",
					"type" => "checkbox");

$options[] = array( "name" => "Menu","type" => "heading");


$options[] = array( "name" => "Main Menu Placement",
					"desc" => "Location to display the main menu.",
					"id" => "mainmenu_placement",
					"std" => "right",
					"type" => "radio",
					"class" => "linear",
					"options" => array(
						'right' => 'Right of Logo',
						'below' => 'Below Logo'
						)
					);



$options[] = array( "name" => "Menu Horizontal Offset",
					"desc" => "Enter the the horizontal offset distance (in px) for your menu",
					"id" => "menu_h_offset",
					"std" => "250",
					"class" => "mini hidden",
					"type" => "text"
					);
$options[] = array( "name" => "Menu Vertical Offset",
					"desc" => "Enter the the vertical offset distance (in px) for your menu.",
					"id" => "menu_v_offset",
					"std" => "30",
					"class" => "mini hidden",
					"type" => "text"
					);


$options[] = array( "name" => "Menu Item Spacing",
					"desc" => "Enter the number (in px) to space individual top-level menu items.",
					"id" => "menu_spacing",
					"std" => "20",
					"class" => "mini",
					"type" => "text");

// Typography

$options[] = array( "name" => "Typography",
					"type" => "heading");

$options[] = array( "name" => "Style Options",
					"desc" => "The following options allow you to apply basic customizations to your theme colors. For more specific changes, you may need to edit CSS. <br /> This can be done from the <a href=\"theme-editor.php\">	Theme Editor</a> which is located at Appearance &rarr; Editor.",
					"class" => "basic",
					"type" => "info");


 $options[] = array( "name" => "Main Body Typography",
  			"desc" => "Body Typography.",
  			"id" => "body_typography",
  			"std" => array('size' => '14px','face' => 'helvetica','style' => 'normal','color' => '#444444'),
  			"type" => "typography");

 $options[] = array( "name" => "Global Link Color",
 					"desc" => "Default hyperlink color.",
 					"id" => "link_color",
 					"std" => "#1582d6",
 					"type" => "color");

 $options[] = array( "name" => "Global Link Hover Color",
 					"desc" => "Default hyperlink hover color.",
 					"id" => "link_hover_color",
 					"std" => "#ec5006",
 					"type" => "color");


$options[] = array( "name" => "Single Page/Post Titles",
					"desc" => "Single heading typography.",
					"id" => "post_title_typography",
 					"std" => array('size' => '38px','face' => 'helvetica','style' => 'normal','color' => '#181818'),
					"type" => "typography");

$options[] = array( "name" => "Widget Titles",
					"desc" => "Widget heading typography.",
					"id" => "widget_title_typography",
 					"std" => array('size' => '20px','face' => 'helvetica','style' => 'normal','color' => '#181818'),
					"type" => "typography");

 $options[] = array( 	"name" => "Heading Styles",
 						"desc" => "The settings below control the main body (content) headings.",
 						"class" => "none",
 						"type" => "info");

$options[] = array( "name" => "Heading One (H1)",
					"desc" => "Heading typography.",
					"id" => "h1_typography",
					"std" => array('size' => '36px','face' => 'helvetica','style' => 'normal','color' => '#000000'),
					"type" => "typography");

$options[] = array( "name" => "Heading Two (H2)",
				"desc" => "Heading Two typography.",
				"id" => "h2_typography",
				"std" => array('size' => '32px','face' => 'helvetica','style' => 'normal','color' => '#4d4d4d'),
				"type" => "typography");


$options[] = array( "name" => "Heading Three",
				"desc" => "Heading Three typography.",
				"id" => "h3_typography",
				"std" => array('size' => '26px','face' => 'helvetica','style' => 'normal','color' => '#ec5006'),
				"type" => "typography");

$options[] = array( "name" => "Heading Four (H4)",
				"desc" => "Heading Four typography.",
				"id" => "h4_typography",
				"std" => array('size' => '20px','face' => 'helvetica','style' => 'bold','color' => '#174144'),
				"type" => "typography");

$options[] = array( "name" => "Heading Five (H5)",
			"desc" => "Heading Five typography.",
			"id" => "h5_typography",
			"std" => array('size' => '20px','face' => 'helvetica','style' => 'bold','color' => '#3f3f3f'),
			"type" => "typography");


$options[] = array( "name" => "Blog Options",
					"type" => "heading");


$options[] = array( "name" => "Blog Settings",
					"desc" => "The options below apply to your blog home, archives, categories, and tags pages. Power users may wish to have multiple settings for various categories. This can be achieved using the framework's action hooks in functions.php.",
					"class" => "none",
					"type" => "info");


$options[] = array( "name" => "Default Layout Style",
					"desc" => "Select a default layout for your blog home page. Some layouts may display better without a sidebar present.",
					"id" => "blog_layout",
					"std" => "style3",
					"type" => "images",
					"options" => array(
					'style1' => $imagepath . 'ls1.png',
					'style2' => $imagepath . 'ls2.png',
					'style3' => $imagepath . 'ls3.png',
					'style4' => $imagepath . 'ls4.png',
					'style5' => $imagepath . 'ls5.png',
					'style6' => $imagepath . 'ls6.png')
					);


$options[] = array( "name" => "Hide Sidebar on Blog Home",
					"desc" => "Hide the sidebar on blog home (useful for some layout styles)",
					"id" => "hide_bloghome_sidebar",
					"type" => "checkbox");


$options[] = array( "name" => "Exclude Category ID's",
					"desc" => "Enter a comma-separated list of the Category ID's that you'd like to exclude from display in your blog. (e.g. 1,2,3,4) Tip: Use the WP Show ID's plugin to reveal category ID's",
					"id" => "exclude_blogcats",
					"std" => "",
					"class" => "",
					"type" => "text");



$options[] = array( "name" => "Content Output",
					"desc" => "Select the type of content output to show in your blog.",
					"id" => "content_type",
					"std" => "content",
					"type" => "radio",
					"class" => "linear",
					"options" => array(
						'content' => 'Full Content (the_content)',
						'excerpt' => 'Post Excerpt (the_excerpt)',
						'none' => 'No Content (useful for gallery style layouts)')
					);

$options[] = array( "name" => "Display Read More Link",
					"desc" => "Display the \"Continue Reading\" link?",
					"id" => "display_readmore",
					"class" => "hidden",
					"std" => "1",
					"type" => "checkbox");


$options[] = array( "name" => "Show Post Title",
					"desc" => "Display Post Titles in your blog. This option is useful for portfolio style blogs.",
					"id" => "show_post_title",
					"std" => "1",
					"type" => "checkbox");

$options[] = array( "name" => "Show Post Authors",
 					"desc" => "Display author links in your blog.",
 					"id" => "show_post_author",
					"std" => "1",
 					"type" => "checkbox");

$options[] = array(
	"name" => "Show Post Date",
	"desc" => "Display Post dates in your blog.",
	"id" => "show_post_date",
	"std" => "1",
	"type" => "checkbox"
	);

$options[] = array(
	"name" => "Show Thumbnails",
	"desc" => "Most of the layout styles (above) allow for featured thumbnails. You can opt to hide them using this setting.",
	"id" => "show_post_thumbnails",
	"std" => "1",
	"type" => "checkbox"
	);

// Hidden by default
$options[] = array(
	"name" => "Thumbnail Options",
	"desc" => "Action when thumbnail image is clicked.",
	"id" => "thumbnail_action",
	"std" => "link_to_post",
	"type" => "select",
	"class" => "hidden",
	"options" => array(
		'link_to_lightbox' =>	'Display in Lightbox',
		'link_to_post' =>	'Links to Post',
		'link_to_nothing' =>	'Do Nothing'
		)
	);

$options[] = array(
	"name" => "Show Tags",
	"desc" => "Displays Post Tags in your blog",
	"id" => "show_post_tags",
	"std" => "1",
	"type" => "checkbox"
	);


$options[] = array(
	"name" => "Show Categories",
	"desc" => "Displays Post Categories in your blog.",
	"id" => "show_post_categories",
	"std" => "1",
	"type" => "checkbox"
	);


$options[] = array(
	"name" => "Show Comment Count",
	"desc" => "Displays the number of Comments for each blog Post.",
	"id" => "show_post_comments",
	"std" => "1",
	"type" => "checkbox"
	);

$options[] = array(
	"name" => "Show Post Summary Footer",
	"desc" => "Displays a fine print summary of each blog post (single view).",
	"id" => "show_post_summary",
	"std" => "1",
	"type" => "checkbox"
	);

$options[] = array(
	"name" => "Show Post Pagination",
	"desc" => "Displays Previous and Next links at the end of each post.",
	"id" => "show_post_pagination",
	"std" => "1",
	"type" => "checkbox"
	);


$options[] = array(
	"name" => "Lightbox Control",
	"type" => "heading"
	);

$options[] = array(
	"name" => "Enable PrettyPhoto",
	"desc" => "By default, when you insert an image or gallery into your content, WordPress links the image to the full resoltuion image. Enabling this option loads the PrettyPhoto lightbox plugin which will instead display your images in an elegant popup modal window.",
	"id" => "enable_prettyphoto",
	"type" => "checkbox"
	);


$options[] = array(
	"name" => "PrettyPhoto Style",
	"desc" => "Select a popup style for your PrettyPhoto lightbox.",
	"id" => "prettyphoto_style",
	"std" => "light_rounded",
	"type" => "select",
	"options" => array(
		'light_rounded' =>	'Light Rounded',
		'light_square' =>	'Light Square',
		'dark_rounded' =>	'Dark Rounded',
		'dark_square' =>	'Dark Square',
		'facebook' =>	'Facebook')
	);


$options[] = array(
	"name" => "Preset Styles",
	"type" => "heading"
	);

if(is_child_theme()) {

$options[] = array(
	"name" => "Preset Styles",
	"desc" => "Selecting a preset below will alter your current typography, background, and header settings. No other settings will be changed. After selecting a preset, you may review the individual settings before saving.",
	"class" => "basic",
	"type" => "info"
	);

} else {

$options[] = array(
	"name" => "Preset Styles",
	"desc" => "Selecting a preset below will alter your current typography, background, and header settings. No other settings will be changed. After selecting a preset, you may review the individual settings before saving. <br /> We highly recommend using a child theme if you intend to make customizations to any of the stylesheets listed below. To use a child theme, install and ectivate it in your Theme Manager. Automatic updates are disabled until the child theme is activated.",
	"class" => "basic",
	"type" => "info"
	);
}

$options[] = array( "name" => "Presets",
					"desc" => "After selecting a preset, you can customize its options. Click 'Save Options' to apply the new settings.",
					"id" => "layout_style",
					"std" => "style1",
					"type" => "images",
					"options" => array(
					'style1'	=> $imagepath . 's1.png',
					'style2'	=> $imagepath . 's2.png',
					'style3'	=> $imagepath . 's3.png',
					'style4'	=> $imagepath . 's4.png',
					'style5'	=> $imagepath . 's5.png',
					'style6'	=> $imagepath . 's6.png',
					'style7'	=> $imagepath . 's7.png',
					'style8'	=> $imagepath . 's8.png',
					'style9'	=> $imagepath . 's9.png',
					'style10'	=> $imagepath . 's10.png')
					);

$options[] = array("name" => "Docs & Info","type" => "heading");

$options[] = array( "name" => "Documentation",
					"id" => "theme_docs",
					"desc" => "README.md",
					"class" => "basic",
					"type" => "docs");

	return $options;
}