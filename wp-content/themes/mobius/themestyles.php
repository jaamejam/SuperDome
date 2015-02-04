<?php
global $wp_query;
// values must match of_recognized_font_faces in admin/options-sanitize.php


function st_font_faces() {
	$default = array(
		'helvetica'  => '"HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif',
		'arial' 	 => 'Arial, Helvetica, sans-serif',
		'georgia' 	 => 'Constantia, "Lucida Bright", Lucidabright, "Lucida Serif", Lucida, "DejaVu Serif", "Bitstream Vera Serif", "Liberation Serif", Georgia, serif',
		'cambria' 	 => 'Cambria, "Hoefler Text", Utopia, "Liberation Serif", "Nimbus Roman No9 L Regular", Times, "Times New Roman", serif',
		'tahoma' 	 => 'Tahoma, Verdana, Segoe, sans-serif',
		'palatino' 	 => '"Palatino Linotype", Palatino, Baskerville, Georgia, serif',
		'droidsans'  => '"Droid Sans", sans-serif',
		'droidserif' => '"Droid Serif", serif',
		);
	return apply_filters( 'st_font_faces', $default );
}

function st_font_stack($face) {
	$stackarray = st_font_faces();
	$var = apply_filters( 'st_font_stack', $face );
	return $stackarray[$var];
}

// @font-face import (Droid)
// Check if the droid font is used and import the font only once

function importfonts() {
	// get all font settings
	// get all font settings
	$typography = of_get_option('body_typography');
	$posttitle = of_get_option('post_title_typography');
	$widget_title = of_get_option('widget_title_typography');
	$h1 = of_get_option('h1_typography');
	$h2 = of_get_option('h2_typography');
	$h3 = of_get_option('h3_typography');
	$h4 = of_get_option('h4_typography');
	$h5 = of_get_option('h5_typography');
	$headertext = of_get_option('header_typography');
	$taglinetext = of_get_option('tagline_typography');

// build the array for checking
$fonts = array(
	$typography['face'],
	$posttitle['face'],
	$h1['face'],
	$h2['face'],
	$h3['face'],
	$h4['face'],
	$h5['face'],
	$headertext['face'],
	$taglinetext['face']
	);

	if (in_array("droidsans", $fonts) || in_array("droidserif", $fonts)) {
	echo '@import url(http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Serif:400,700);'."\n";
	}
}

importfonts();

// Begin theme options
$typography = of_get_option('body_typography');
$body_face = $typography['face'];
// Main Body Styles
echo "\n".'body {';
if ($typography) {
		echo 'color:'.$typography['color'].';';
		echo 'font-size:'.$typography['size'].';';
		echo 'font-family:'.st_font_stack($body_face).';';
		echo 'font-weight:'.$typography['style'].';';
		echo 'font-style:normal;';
	}
// Custom Background

$body_background = of_get_option('body_background');
		if ($body_background) {
				if ($body_background['image']) {
				echo 'background:'.$body_background['color'].' url('.$body_background['image'].') '.$body_background['repeat'].' '.$body_background['position'].' '.$body_background['attachment'].';'."\n";
				} elseif ($body_background['color']) {
				echo 'background-color:'.$body_background['color'].';';
				}
			}
// End Body Styles
echo '}'."\n";


// H1 Page Titles
$posttitle = of_get_option('post_title_typography');
$posttitle_face = $posttitle['face'];

echo 'h1.entry-title,h2.entry-title {';
if ($posttitle) {
		echo 'color:'.$posttitle['color'].';';
		echo 'font-size:'.$posttitle['size'].';';
		echo 'font-family:'.st_font_stack($posttitle_face).';';
		if ($posttitle['style'] == "bold italic") {
			echo 'font-weight:bold;';
			echo 'font-style:italic;';
		} else {
			echo 'font-weight:'.$posttitle['style'].';';
		}
	}
	echo '}'."\n";


// H1 Settings
$h1 = of_get_option('h1_typography');
$h1_face = $h1['face'];

echo 'h1 {';
if ($h1) {
		echo 'color:'.$h1['color'].';';
		echo 'font-size:'.$h1['size'].';';
		echo 'font-family:'.st_font_stack($h1_face).';';
		if ($h1['style'] == "bold italic") {
			echo 'font-weight:bold;';
			echo 'font-style:italic;';
		} else {
			echo 'font-weight:'.$h1['style'].';';
		}
	}
	echo '}'."\n";

// H2 Settings
$h2 = of_get_option('h2_typography');
$h2_face = $h2['face'];

echo 'h2 {';
if ($h2) {
		echo 'color:'.$h2['color'].';';
		echo 'font-size:'.$h2['size'].';';
		echo 'font-family:'.st_font_stack($h2_face).';';
		if ($h2['style'] == "bold italic") {
			echo 'font-weight:bold;';
			echo 'font-style:italic;';
		} else {
			echo 'font-weight:'.$h2['style'].';';
		}
	}
	echo '}'."\n";

// H3 Settings
$h3 = of_get_option('h3_typography');
$h3_face = $h3['face'];

echo 'h3 {';
if ($h3) {
		echo 'color:'.$h3['color'].';';
		echo 'font-size:'.$h3['size'].';';
		echo 'font-family:'.st_font_stack($h3_face).';';
		if ($h3['style'] == "bold italic") {
			echo 'font-weight:bold;';
			echo 'font-style:italic;';
		} else {
			echo 'font-weight:'.$h3['style'].';';
		}
	}
	echo '}'."\n";
// H4 Settings
$h4 = of_get_option('h4_typography');
$h4_face = $h4['face'];

echo 'h4 {';
if ($h4) {
		echo 'color:'.$h4['color'].';';
		echo 'font-size:'.$h4['size'].';';
		echo 'font-family:'.st_font_stack($h4_face).';';
		if ($h4['style'] == "bold italic") {
			echo 'font-weight:bold;';
			echo 'font-style:italic;';
		} else {
			echo 'font-weight:'.$h4['style'].';';
		}
	}
	echo '}'."\n";

// h5 Settings
$h5 = of_get_option('h5_typography');
$h5_face = $h5['face'];

echo 'h5,h6 {';
if ($h5) {
		echo 'color:'.$h5['color'].';';
		echo 'font-size:'.$h5['size'].';';
		echo 'font-family:'.st_font_stack($h5_face).';';
		if ($h5['style'] == "bold italic") {
			echo 'font-weight:bold;';
			echo 'font-style:italic;';
		} else {
			echo 'font-weight:'.$h5['style'].';';
		}
	}
	echo '}'."\n";


// h3 Widget Titles

$widget_title = of_get_option('widget_title_typography');
$widget_title_face = $widget_title['face'];

echo 'h3.widget-title,h4.widget-title {';
if ($posttitle) {
		echo 'color:'.$widget_title['color'].';';
		echo 'font-size:'.$widget_title['size'].';';
		echo 'font-family:'.st_font_stack($widget_title_face).';';
		if ($widget_title['style'] == "bold italic") {
			echo 'font-weight:bold;';
			echo 'font-style:italic;';
		} else {
			echo 'font-weight:'.$widget_title['style'].';';
		}
	}
	echo '}'."\n";


// Header Text
$headertext = of_get_option('header_typography');
$headertext_face = $headertext['face'];

echo '#header #site-title,#site-title a {';
if ($headertext) {
		echo 'color:'.$headertext['color'].';';
		echo 'font-size:'.$headertext['size'].';';
		echo 'font-family:'.st_font_stack($headertext_face).';';
		if ($headertext['style'] == "bold italic") {
			echo 'font-weight:bold;';
			echo 'font-style:italic;';
		} else {
			echo 'font-weight:'.$headertext['style'].';';
		}
	}
	echo '}'."\n";


// Tagline Text
$taglinetext = of_get_option('tagline_typography');
$taglinetext_face = $taglinetext['face'];

	echo '.site-desc.text {';
	if ($taglinetext) {
			echo 'color:'.$taglinetext['color'].';';
			echo 'font-size:'.$taglinetext['size'].';';
			echo 'font-family:'.st_font_stack($taglinetext_face).';';
			if ($taglinetext['style'] == "bold italic") {
				echo 'font-weight:bold;';
				echo 'font-style:italic;';
			} else {
				echo 'font-weight:'.$taglinetext['style'].';';
		}
		}
		echo '}'."\n";

$topbar_background = of_get_option('topbar_bg');
if ($topbar_background) {
	echo "#st_topbar { background-color:".$topbar_background.";}\n";
}


$header_background = of_get_option('header_background');

echo "#header {";
if ($header_background['color']) {
	echo "background-color:".$header_background['color'].";";
}
if ($header_background['image']) {
	echo "background-image: url('".$header_background['image']."');";
}
if ($header_background['position']) {
	echo "background-position: ".$header_background['position'].";";
}
if ($header_background['repeat']) {
	echo "background-repeat: ".$header_background['repeat'].";";
}
if ($header_background['attachment']) {
	echo "background-attachment: ".$header_background['attachment'].";";
}
echo "}"."\n";

echo "@media only screen and (max-width: 767px) {";
	//echo "#header,#menu,body.select-menu #menu,body.dropdown-menu #menu {";
	echo "#header {";
	echo "background-color:".$header_background['color'].";";
	echo "}";
echo "}\n";

// $body_background = of_get_option('body_background');
// 		if ($body_background) {
// 				if ($body_background['image']) {
// 				echo 'background:'.$body_background['color'].' url('.$body_background['image'].') '.$body_background['repeat'].' '.$body_background['position'].' '.$body_background['attachment'].';'."\n";
// 				} elseif ($body_background['color']) {
// 				echo 'background-color:'.$body_background['color'].';'."\n";
// 				}
// 			}
// // End Body Styles
// echo '}'."\n";
?>
a,a:link,a:visited,a:active {color: <?php echo of_get_option('link_color', '#000' ); ?>;}
a:hover {color: <?php echo of_get_option('link_hover_color', '#000' ); ?>;}
#menu ul li a {padding: 0px <?php echo of_get_option('menu_spacing', '20' ); ?>px;}
#menu.right {left:<?php echo of_get_option('menu_h_offset', '250' ); ?>px;top:<?php echo of_get_option('menu_v_offset', '30' ); ?>px;}