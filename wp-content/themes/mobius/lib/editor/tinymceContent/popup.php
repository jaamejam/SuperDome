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
<title>Insert Content Template</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/lib/editor/tinymceContent/select.css" type="text/css" media="screen"/>

<script language="javascript" type="text/javascript">
<?php include(TEMPLATEPATH . '/content_templates.php');?>
</script>


<script type="text/javascript">
    $(document).ready(function() {

        $(".dropdown dd ul li a").click(function() {
            var text = $(this).html();
            $(".dropdown dt a span").html(text);
				    $('input[name=column_shortcode]').val(getSelectedValue("sample"));
						var img = getSelectedValue("sample");
						$("#imagepreview").attr("src","./img/" + img + ".png");						
						return false;
        });

        function getSelectedValue(id) {
            return $("#" + id).find("dt a span.value").html();
        }

    });
</script>


<style type="text/css">
fieldset { margin:16px 0; padding:10px; }
legend, label, select, input[type=text] { font-size:11px; }
select, input[type=text] { line-height:24px; height:24px; float:left; width:300px }
</style>
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');">
<div id="chooser">
  <dl id="sample" class="dropdown">
      <dt><a href="#"><span>Please select a layout to be inserted</span></a></dt>
      <dd>
          <ul>
              <li><a href="#"> 1 - Featured Image with Icon List and CTA<span class="value">tpl1</span></a></li>
              <li><a href="#"> 2 - Featured Image with Big Intro and CTA<span class="value">tpl2</span></a></li>
              <li><a href="#"> 3 - Full Width Slider, 3-Column Intro with Sidenote<span class="value">tpl3</span></a></li>
              <li><a href="#"> 4 - Big Feature List<span class="value">tpl4</span></a></li>
              <li><a href="#"> 5 - 2/3 Slider with 3-Column Graphic Intro<span class="value">tpl5</span></a></li>
              <li><a href="#"> 6 - Staff Directory w/ Social Networks<span class="value">tpl6</span></a></li>
              <li><a href="#"> 7 - Product/Service Page with CTA<span class="value">tpl7</span></a></li>
          </ul>
      </dd>
  </dl>
</div>
<div id="preview">
	<img id="imagepreview" src="img/selectlayout.png" width="400" height="300">
</div>
<div class="clearfix">&nbsp;</div>
<br />
	<form name="st_content" action="#">
		<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
		<input type="submit" id="insert" name="insert" value="Insert Content" onClick="insertShortcode();" style="float:right; padding:10px; width:auto; height:auto;"/>
		<input type="hidden" name="column_shortcode" id="column_shortcode"/>
	</form>
</body>
</html>
