<?php
$wp_include = "../wp-load.php";

$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
  $wp_include = "../$wp_include";
}

// let's load WordPress
require($wp_include);

if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here"));
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert Slideshow</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/lib/editor/tinymceSlideshow/tinymce.js"></script>
<style type="text/css">
fieldset { margin:16px 0; padding:10px; }
legend, label, select, input[type=text] { font-size:11px; }
select, input[type=text] { line-height:24px; height:24px; float:left; width:300px }

#tabnav {list-style:none; margin:0; padding:0;  float:left; }
#tabnav li{float:left; clear:none; margin: 0 -1px 0 0px;}
#tabnav li a{display:inline; padding:6px 8px;  float:left; clear:none; text-decoration:none; 
color:#333;  border:1px solid #ddd;
}
#tabnav li.active a{display:inline; padding:6px 8px; background:#f9f9f9; float:left; clear:none; 
color:#333; border:1px solid #ddd; font-weight:bold;}
.form-wrap{padding:10px; border:1px solid #ddd; float:left; background:#f9f9f9; margin-top:-1px;}

</style>
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');">

<form name="st_slideshow" action="#">
			<div class="tabcontent" id="tab1">
			
			<fieldset>
				<legend>Slideshow Category</legend>
					<select id="slideshow_category" name="slideshow_category">
					<?php
					$myterms = get_terms('slidecategory');
					$st_getTerms = array();
					foreach ($myterms as $term_list) {
					$st_getTerms [$term_list->term_id] = $term_list->name;
					echo ' <option value="'.$term_list->term_id.'">'.$term_list->name.'</option>';
					}
					?>
					</select>
			</fieldset>
      
      
			<fieldset>
				<legend>Slideshow Effect</legend>
					<select id="slideshow_type" name="slideshow_type">
						 <option value="slide">Slide</option>
						 <option value="fade">Fade</option>
					</select>
			</fieldset>
			
			<fieldset>
					<legend>Slideshow Width</legend>
					<input type="text" id="slideshow_width" name="slideshow_width" value="600">
					<legend>Slideshow Height</legend>
					<input type="text" id="slideshow_height" name="slideshow_height" value="250">
			</fieldset>

			<fieldset>
						<legend>Slideshow Speed (transtion length)</legend>
						<select id="slideshow_speed" name="slideshow_speed">
						<option value="1000">1 Second</option>
						<option value="700">700 ms</option>
						<option value="500">500 ms</option>
						<option value="400">400 ms</option>
						<option value="200">200 ms</option>
						</select>
			</fieldset>
			
			<fieldset>
						<legend>Auto Play (slide duration)</legend>
						<select id="slideshow_autoplay" name="slideshow_autoplay">
						<option value="false">Paused</option>
						<option value="1000">1 Second</option>
						<option value="2000">2 Seconds</option>
						<option value="3000">3 Seconds</option>
						<option value="4000">4 Seconds</option>
						<option value="5000">5 Seconds</option>
						<option value="6000">6 Seconds</option>
						<option value="7000">7 Seconds</option>
						<option value="8000">8 Seconds</option>
						<option value="9000">9 Seconds</option>
						<option value="10000">10 Seconds</option>
						</select>
			</fieldset>

			<fieldset>
						<legend>Pagination</legend>
						<select id="slideshow_pagination" name="slideshow_pagination">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
						</select>
			</fieldset>
			
			<fieldset>
						<legend>Prev/Next Arrows</legend>
						<select id="slideshow_prevnext" name="slideshow_prevnext">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
						</select>
			</fieldset>
						
			<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
			<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertSlideshowShortcode();" style="float:right; padding:10px; width:auto; height:auto;"/>
</form>

</body>
</html>
