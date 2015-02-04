/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */

jQuery(document).ready(function($) {

	var siteURL = st_getsiteurl.st_siteurl;
	var themeDir = st_activethemedir.st_activethemedir;
	var shortName = st_shortname;
	var PreSet = st_preset;


$("#img_layout_style_style1").click(changeStyle1);

	function changeStyle1(){
		var presetName = 'Style 1';
		var answer = confirm("Are you sure you want to load the " + presetName + " Preset?" + '\n' + "Only color, background, and logo settings will be replaced.")
		if (answer){

		$('input#topbar_bg').val('#008fd6');
		$('div#section-topbar_bg  a.wp-color-result').css('background-color', '#008fd6');

		$('input#header_background_color').val('#00699e');
		$('div#section-header_background_color  a.wp-color-result').css('background-color', '#00699e');

		$('input#body_typography_color').val('#383838');
		$('div#body_typography_color_picker *').css('background-color', '#383838');

		$('input#link_color').val('#00699e');
		$('div#section-link_color  a.wp-color-result').css('background-color', '#00699e');

		$('input#link_hover_color').val('#00476b');
		$('div#section-link_hover_color  a.wp-color-result').css('background-color', '#00476b');

		$('input#post_title_typography_color').val('#000000');
		$('div#section-post_title_typography a.wp-color-result').css('background-color', '#000000');

		$('input#widget_title_typography_color').val('#ea4e06');
		$('div#section-widget_title_typography a.wp-color-result').css('background-color', '#ea4e06');

		$('input#h1_typography_color').val('#111111');
		$('div#section-h1_typography a.wp-color-result').css('background-color', '#111111');

		$('input#h2_typography_color').val('#008bd1');
		$('div#section-h2_typography a.wp-color-result').css('background-color', '#008bd1');

		$('input#h3_typography_color').val('#333333');
		$('div#section-h3_typography a.wp-color-result').css('background-color', '#333333');

		$('input#h4_typography_color').val('#ea4e06');
		$('div#section-h4_typography a.wp-color-result').css('background-color', '#ea4e06');

		$('input#h5_typography_color').val('#008fd6');
		$('div#section-h5_typography a.wp-color-result').css('background-color', '#008fd6');

		$('input#header_logo').val(themeDir +'/images/style1/logo.png');
		$('#header_logo_image img').attr("src", themeDir +'/images/style1/logo.png');

		$('input#header_typography_color').val('#ec5006');
		$('div#section-header_typography a.wp-color-result').css('background-color', '#fff');

		$('input#tagline_typography_color').val('#c1cfd3');
		$('div#section-tagline_typography a.wp-color-result').css('background-color', '#eee');

		window.alert(presetName + " is loaded! Please review and save your settings.");
	}
}  // end Style1


$("#img_layout_style_style2").click(changeStyle2);

	function changeStyle2(){
		var presetName = 'Style 2';
		var answer = confirm("Are you sure you want to load the " + presetName + " Preset?" + '\n' + "Only color, background, and logo settings will be replaced.")
		if (answer){

		$('input#topbar_bg').val('#2e2e2e');
		$('div#section-topbar_bg  a.wp-color-result').css('background-color', '#2e2e2e');

		$('input#header_background_color').val('#800000');
		$('div#section-header_background_color  a.wp-color-result').css('background-color', '#800000');

		$('input#body_typography_color').val('#383838');
		$('div#body_typography_color_picker *').css('background-color', '#383838');

		$('input#link_color').val('#800000');
		$('div#section-link_color  a.wp-color-result').css('background-color', '#800000');

		$('input#link_hover_color').val('#4d0000');
		$('div#section-link_hover_color  a.wp-color-result').css('background-color', '#4d0000');

		$('input#post_title_typography_color').val('#000000');
		$('div#section-post_title_typography a.wp-color-result').css('background-color', '#000000');

		$('input#widget_title_typography_color').val('#1a1a1a');
		$('div#section-widget_title_typography a.wp-color-result').css('background-color', '#1a1a1a');

		$('input#h1_typography_color').val('#111111');
		$('div#section-h1_typography a.wp-color-result').css('background-color', '#111111');

		$('input#h2_typography_color').val('#b30000');
		$('div#section-h2_typography a.wp-color-result').css('background-color', '#b30000');

		$('input#h3_typography_color').val('#2e2e2e');
		$('div#section-h3_typography a.wp-color-result').css('background-color', '#2e2e2e');

		$('input#h4_typography_color').val('#666666');
		$('div#section-h4_typography a.wp-color-result').css('background-color', '#666666');

		$('input#h5_typography_color').val('#333333');
		$('div#section-h5_typography a.wp-color-result').css('background-color', '#333333');

		$('input#header_logo').val(themeDir +'/images/style2/logo.png');
		$('#header_logo_image img').attr("src", themeDir +'/images/style2/logo.png');

		$('input#header_typography_color').val('#ec5006');
		$('div#section-header_typography a.wp-color-result').css('background-color', '#fff');

		$('input#tagline_typography_color').val('#c1cfd3');
		$('div#section-tagline_typography a.wp-color-result').css('background-color', '#eee');

		window.alert(presetName + " is loaded! Please review and save your settings.");
	}
}  // end Style2


$("#img_layout_style_style3").click(changeStyle3);

	function changeStyle3(){
		var presetName = 'Style 3';
		var answer = confirm("Are you sure you want to load the " + presetName + " Preset?" + '\n' + "Only color, background, and logo settings will be replaced.")
		if (answer){

		$('input#topbar_bg').val('#303030');
		$('div#section-topbar_bg  a.wp-color-result').css('background-color', '#303030');

		$('input#header_background_color').val('#488d25');
		$('div#section-header_background_color  a.wp-color-result').css('background-color', '#488d25');

		$('input#body_typography_color').val('#383838');
		$('div#body_typography_color_picker *').css('background-color', '#383838');

		$('input#link_color').val('#488d25');
		$('div#section-link_color  a.wp-color-result').css('background-color', '#488d25');

		$('input#link_hover_color').val('#33651b');
		$('div#section-link_hover_color  a.wp-color-result').css('background-color', '#33651b');

		$('input#post_title_typography_color').val('#000000');
		$('div#section-post_title_typography a.wp-color-result').css('background-color', '#000000');

		$('input#widget_title_typography_color').val('#ea4e06');
		$('div#section-widget_title_typography a.wp-color-result').css('background-color', '#ea4e06');

		$('input#h1_typography_color').val('#111111');
		$('div#section-h1_typography a.wp-color-result').css('background-color', '#111111');

		$('input#h2_typography_color').val('#5db530');
		$('div#section-h2_typography a.wp-color-result').css('background-color', '#5db530');

		$('input#h3_typography_color').val('#00699e');
		$('div#section-h3_typography a.wp-color-result').css('background-color', '#00699e');

		$('input#h4_typography_color').val('#333333');
		$('div#section-h4_typography a.wp-color-result').css('background-color', '#333333');

		$('input#h5_typography_color').val('#333333');
		$('div#section-h5_typography a.wp-color-result').css('background-color', '#333333');

		$('input#header_logo').val(themeDir +'/images/style3/logo.png');
		$('#header_logo_image img').attr("src", themeDir +'/images/style3/logo.png');

		$('input#header_typography_color').val('#ec5006');
		$('div#section-header_typography a.wp-color-result').css('background-color', '#fff');

		$('input#tagline_typography_color').val('#c1cfd3');
		$('div#section-tagline_typography a.wp-color-result').css('background-color', '#eee');

		window.alert(presetName + " is loaded! Please review and save your settings.");
	}
}  // end Style3


$("#img_layout_style_style4").click(changeStyle4);

	function changeStyle4(){
		var presetName = 'Style 4';
		var answer = confirm("Are you sure you want to load the " + presetName + " Preset?" + '\n' + "Only color, background, and logo settings will be replaced.")
		if (answer){

		$('input#topbar_bg').val('#292929');
		$('div#section-topbar_bg  a.wp-color-result').css('background-color', '#292929');

		$('input#header_background_color').val('#00699e');
		$('div#section-header_background_color  a.wp-color-result').css('background-color', '#00699e');

		$('input#body_typography_color').val('#383838');
		$('div#body_typography_color_picker *').css('background-color', '#383838');

		$('input#link_color').val('#008bd1');
		$('div#section-link_color  a.wp-color-result').css('background-color', '#008bd1');

		$('input#link_hover_color').val('#00699e');
		$('div#section-link_hover_color  a.wp-color-result').css('background-color', '#00699e');

		$('input#post_title_typography_color').val('#000000');
		$('div#section-post_title_typography a.wp-color-result').css('background-color', '#000000');

		$('input#widget_title_typography_color').val('#000000');
		$('div#section-widget_title_typography a.wp-color-result').css('background-color', '#000000');

		$('input#h1_typography_color').val('#111111');
		$('div#section-h1_typography a.wp-color-result').css('background-color', '#111111');

		$('input#h2_typography_color').val('#008bd1');
		$('div#section-h2_typography a.wp-color-result').css('background-color', '#008bd1');

		$('input#h3_typography_color').val('#333333');
		$('div#section-h3_typography a.wp-color-result').css('background-color', '#333333');

		$('input#h4_typography_color').val('#ea4e06');
		$('div#section-h4_typography a.wp-color-result').css('background-color', '#ea4e06');

		$('input#h5_typography_color').val('#333333');
		$('div#section-h5_typography a.wp-color-result').css('background-color', '#333333');

		$('input#header_logo').val(themeDir +'/images/style4/logo.png');
		$('#header_logo_image img').attr("src", themeDir +'/images/style4/logo.png');

		$('input#header_typography_color').val('#ec5006');
		$('div#section-header_typography a.wp-color-result').css('background-color', '#fff');

		$('input#tagline_typography_color').val('#c1cfd3');
		$('div#section-tagline_typography a.wp-color-result').css('background-color', '#eee');

		window.alert(presetName + " is loaded! Please review and save your settings.");
	}
}  // end Style4


$("#img_layout_style_style5").click(changeStyle5);

	function changeStyle5(){
		var presetName = 'Style 5';
		var answer = confirm("Are you sure you want to load the " + presetName + " Preset?" + '\n' + "Only color, background, and logo settings will be replaced.")
		if (answer){

		$('input#topbar_bg').val('#5e1782');
		$('div#section-topbar_bg  a.wp-color-result').css('background-color', '#5e1782');

		$('input#header_background_color').val('#3f0f57');
		$('div#section-header_background_color  a.wp-color-result').css('background-color', '#3f0f57');

		$('input#body_typography_color').val('#383838');
		$('div#body_typography_color_picker *').css('background-color', '#383838');

		$('input#link_color').val('#5e1782');
		$('div#section-link_color  a.wp-color-result').css('background-color', '#5e1782');

		$('input#link_hover_color').val('#7e1fad');
		$('div#section-link_hover_color  a.wp-color-result').css('background-color', '#7e1fad');

		$('input#post_title_typography_color').val('#000000');
		$('div#section-post_title_typography a.wp-color-result').css('background-color', '#000000');

		$('input#widget_title_typography_color').val('#f05000');
		$('div#section-widget_title_typography a.wp-color-result').css('background-color', '#f05000');

		$('input#h1_typography_color').val('#111111');
		$('div#section-h1_typography a.wp-color-result').css('background-color', '#111111');

		$('input#h2_typography_color').val('#3f0f57');
		$('div#section-h2_typography a.wp-color-result').css('background-color', '#3f0f57');

		$('input#h3_typography_color').val('#333333');
		$('div#section-h3_typography a.wp-color-result').css('background-color', '#333333');

		$('input#h4_typography_color').val('#f05000');
		$('div#section-h4_typography a.wp-color-result').css('background-color', '#f05000');

		$('input#h5_typography_color').val('#5e1782');
		$('div#section-h5_typography a.wp-color-result').css('background-color', '#5e1782');

		$('input#header_logo').val(themeDir +'/images/style5/logo.png');
		$('#header_logo_image img').attr("src", themeDir +'/images/style5/logo.png');

		$('input#header_typography_color').val('#ec5006');
		$('div#section-header_typography a.wp-color-result').css('background-color', '#fff');

		$('input#tagline_typography_color').val('#c1cfd3');
		$('div#section-tagline_typography a.wp-color-result').css('background-color', '#eee');

		window.alert(presetName + " is loaded! Please review and save your settings.");
	}
}  // end Style5

$("#img_layout_style_style6").click(changeStyle6);

	function changeStyle6(){
		var presetName = 'Style 6';
		var answer = confirm("Are you sure you want to load the " + presetName + " Preset?" + '\n' + "Only color, background, and logo settings will be replaced.")
		if (answer){

		$('input#topbar_bg').val('#1d7c74');
		$('div#section-topbar_bg  a.wp-color-result').css('background-color', '#1d7c74');

		$('input#header_background_color').val('#259d93');
		$('div#section-header_background_color  a.wp-color-result').css('background-color', '#259d93');

		$('input#body_typography_color').val('#383838');
		$('div#body_typography_color_picker *').css('background-color', '#383838');

		$('input#link_color').val('#17635c');
		$('div#section-link_color  a.wp-color-result').css('background-color', '#17635c');

		$('input#link_hover_color').val('#000000');
		$('div#section-link_hover_color  a.wp-color-result').css('background-color', '#000000');

		$('input#post_title_typography_color').val('#000000');
		$('div#section-post_title_typography a.wp-color-result').css('background-color', '#000000');

		$('input#widget_title_typography_color').val('#000000');
		$('div#section-widget_title_typography a.wp-color-result').css('background-color', '#000000');

		$('input#h1_typography_color').val('#111111');
		$('div#section-h1_typography a.wp-color-result').css('background-color', '#111111');

		$('input#h2_typography_color').val('#259d93');
		$('div#section-h2_typography a.wp-color-result').css('background-color', '#259d93');

		$('input#h3_typography_color').val('#1d7c74');
		$('div#section-h3_typography a.wp-color-result').css('background-color', '#1d7c74');

		$('input#h4_typography_color').val('#ea4e06');
		$('div#section-h4_typography a.wp-color-result').css('background-color', '#ea4e06');

		$('input#h5_typography_color').val('#333333');
		$('div#section-h5_typography a.wp-color-result').css('background-color', '#333333');

		$('input#header_logo').val(themeDir +'/images/style6/logo.png');
		$('#header_logo_image img').attr("src", themeDir +'/images/style6/logo.png');

		$('input#header_typography_color').val('#ec5006');
		$('div#section-header_typography a.wp-color-result').css('background-color', '#fff');

		$('input#tagline_typography_color').val('#c1cfd3');
		$('div#section-tagline_typography a.wp-color-result').css('background-color', '#eee');

		window.alert(presetName + " is loaded! Please review and save your settings.");
	}
}  // end Style6


$("#img_layout_style_style7").click(changeStyle7);

	function changeStyle7(){
		var presetName = 'Style 7';
		var answer = confirm("Are you sure you want to load the " + presetName + " Preset?" + '\n' + "Only color, background, and logo settings will be replaced.")
		if (answer){

		$('input#topbar_bg').val('#610000');
		$('div#section-topbar_bg  a.wp-color-result').css('background-color', '#610000');

		$('input#header_background_color').val('#470000');
		$('div#section-header_background_color  a.wp-color-result').css('background-color', '#470000');

		$('input#body_typography_color').val('#383838');
		$('div#body_typography_color_picker *').css('background-color', '#383838');

		$('input#link_color').val('#7a0000');
		$('div#section-link_color  a.wp-color-result').css('background-color', '#7a0000');

		$('input#link_hover_color').val('#ad0000');
		$('div#section-link_hover_color  a.wp-color-result').css('background-color', '#ad0000');

		$('input#post_title_typography_color').val('#000000');
		$('div#section-post_title_typography a.wp-color-result').css('background-color', '#000000');

		$('input#widget_title_typography_color').val('#000000');
		$('div#section-widget_title_typography a.wp-color-result').css('background-color', '#000000');

		$('input#h1_typography_color').val('#111111');
		$('div#section-h1_typography a.wp-color-result').css('background-color', '#111111');

		$('input#h2_typography_color').val('#470000');
		$('div#section-h2_typography a.wp-color-result').css('background-color', '#470000');

		$('input#h3_typography_color').val('#610000');
		$('div#section-h3_typography a.wp-color-result').css('background-color', '#610000');

		$('input#h4_typography_color').val('#ea4e06');
		$('div#section-h4_typography a.wp-color-result').css('background-color', '#ea4e06');

		$('input#h5_typography_color').val('#333333');
		$('div#section-h5_typography a.wp-color-result').css('background-color', '#333333');

		$('input#header_logo').val(themeDir +'/images/style7/logo.png');
		$('#header_logo_image img').attr("src", themeDir +'/images/style7/logo.png');

		$('input#header_typography_color').val('#ec5006');
		$('div#section-header_typography a.wp-color-result').css('background-color', '#fff');

		$('input#tagline_typography_color').val('#c1cfd3');
		$('div#section-tagline_typography a.wp-color-result').css('background-color', '#eee');

		window.alert(presetName + " is loaded! Please review and save your settings.");
	}
}  // end Style7

$("#img_layout_style_style8").click(changeStyle8);

	function changeStyle8(){
		var presetName = 'Style 8';
		var answer = confirm("Are you sure you want to load the " + presetName + " Preset?" + '\n' + "Only color, background, and logo settings will be replaced.")
		if (answer){

		$('input#topbar_bg').val('#2f5775');
		$('div#section-topbar_bg  a.wp-color-result').css('background-color', '#2f5775');

		$('input#header_background_color').val('#0f1b24');
		$('div#section-header_background_color  a.wp-color-result').css('background-color', '#0f1b24');

		$('input#body_typography_color').val('#383838');
		$('div#body_typography_color_picker *').css('background-color', '#383838');

		$('input#link_color').val('#1d3749');
		$('div#section-link_color  a.wp-color-result').css('background-color', '#1d3749');

		$('input#link_hover_color').val('#2c526d');
		$('div#section-link_hover_color  a.wp-color-result').css('background-color', '#2c526d');

		$('input#post_title_typography_color').val('#000000');
		$('div#section-post_title_typography a.wp-color-result').css('background-color', '#000000');

		$('input#widget_title_typography_color').val('#000000');
		$('div#section-widget_title_typography a.wp-color-result').css('background-color', '#000000');

		$('input#h1_typography_color').val('#111111');
		$('div#section-h1_typography a.wp-color-result').css('background-color', '#111111');

		$('input#h2_typography_color').val('#0f1b24');
		$('div#section-h2_typography a.wp-color-result').css('background-color', '#0f1b24');

		$('input#h3_typography_color').val('#2f5775');
		$('div#section-h3_typography a.wp-color-result').css('background-color', '#2f5775');

		$('input#h4_typography_color').val('#ea4e06');
		$('div#section-h4_typography a.wp-color-result').css('background-color', '#ea4e06');

		$('input#h5_typography_color').val('#333333');
		$('div#section-h5_typography a.wp-color-result').css('background-color', '#333333');

		$('input#header_logo').val(themeDir +'/images/style8/logo.png');
		$('#header_logo_image img').attr("src", themeDir +'/images/style8/logo.png');

		$('input#header_typography_color').val('#ec5006');
		$('div#section-header_typography a.wp-color-result').css('background-color', '#fff');

		$('input#tagline_typography_color').val('#c1cfd3');
		$('div#section-tagline_typography a.wp-color-result').css('background-color', '#eee');

		window.alert(presetName + " is loaded! Please review and save your settings.");
	}
}  // end Style8


$("#img_layout_style_style9").click(changeStyle9);

	function changeStyle9(){
		var presetName = 'Style 9';
		var answer = confirm("Are you sure you want to load the " + presetName + " Preset?" + '\n' + "Only color, background, and logo settings will be replaced.")
		if (answer){
		$('input#body_typography_color').val('#c4c4c4');
		$('div#body_typography_color_picker *').css('background-color', '#c4c4c4');

		$('input#link_color').val('#3790b3');
		$('div#section-link_color  a.wp-color-result').css('background-color', '#3790b3');

		$('input#link_hover_color').val('#3db6c6');
		$('div#section-link_hover_color  a.wp-color-result').css('background-color', '#3db6c6');

		$('input#post_title_typography_color').val('#ffffff');
		$('div#section-post_title_typography a.wp-color-result').css('background-color', '#ffffff');

		$('input#widget_title_typography_color').val('#ffffff');
		$('div#section-widget_title_typography a.wp-color-result').css('background-color', '#ffffff');

		$('input#h1_typography_color').val('#f2f2f2');
		$('div#section-h1_typography a.wp-color-result').css('background-color', '#f2f2f2');

		$('input#h2_typography_color').val('#c5e5ea');
		$('div#section-h2_typography a.wp-color-result').css('background-color', '#c5e5ea');

		$('input#h3_typography_color').val('#ffffff');
		$('div#section-h3_typography a.wp-color-result').css('background-color', '#ffffff');

		$('input#h4_typography_color').val('#3790b3');
		$('div#section-h4_typography a.wp-color-result').css('background-color', '#3790b3');

		$('input#h5_typography_color').val('#b5b5b5');
		$('div#section-h5_typography a.wp-color-result').css('background-color', '#b5b5b5');

		$('input#header_logo').val(themeDir +'/images/style9/logo.png');
		$('#header_logo_image img').attr("src", themeDir +'/images/style9/logo.png');

		$('input#header_typography_color').val('#ec5006');
		$('div#section-header_typography a.wp-color-result').css('background-color', '#ec5006');

		$('input#tagline_typography_color').val('#c1cfd3');
		$('div#section-tagline_typography a.wp-color-result').css('background-color', '#c1cfd3');

		$('input#header_background_color').val('#1d2223');
		$('div#header_background_color *').css('background-color', '#1d2223');
		$('input#header_background').val(themeDir +'/images/style9/header_bg.png');
		$('#header_background img').attr("src", themeDir +'/images/style9/header_bg.png');
		$('#header_background_repeat option[value=repeat-x]').attr('selected', 'selected');
		$('#header_background_position option').eq(1).attr('selected', 'selected');
		$('#header_background_attachment option[value=scroll]').attr('selected', 'selected');

		window.alert(presetName + " is loaded! Please review and save your settings.");
	}
}  // end Style9

$("#img_layout_style_style10").click(changeStyle10);

	function changeStyle10(){
		var presetName = 'Style 10';
		var answer = confirm("Are you sure you want to load the " + presetName + " Preset?" + '\n' + "Only color, background, and logo settings will be replaced.")
		if (answer){

		$('input#body_background_color').val('#FFFFFF');
		$('div#section-body_background  a.wp-color-result').css('background-color', '#FFFFFF');

		$('input#topbar_bg').val('#2e2e2e');
		$('div#section-topbar_bg  a.wp-color-result').css('background-color', '#2e2e2e');

		$('input#header_background_color').val('#F5F5F5');
		$('div#section-header_background  a.wp-color-result').css('background-color', '#F5F5F5');

		$('input#body_typography_color').val('#383838');
		$('div#body_typography_color_picker *').css('background-color', '#383838');

		$('input#link_color').val('#800000');
		$('div#section-link_color  a.wp-color-result').css('background-color', '#800000');

		$('input#link_hover_color').val('#4d0000');
		$('div#section-link_hover_color  a.wp-color-result').css('background-color', '#4d0000');

		$('input#post_title_typography_color').val('#000000');
		$('div#section-post_title_typography a.wp-color-result').css('background-color', '#000000');

		$('input#widget_title_typography_color').val('#1a1a1a');
		$('div#section-widget_title_typography a.wp-color-result').css('background-color', '#1a1a1a');

		$('input#h1_typography_color').val('#111111');
		$('div#section-h1_typography a.wp-color-result').css('background-color', '#111111');

		$('input#h2_typography_color').val('#b30000');
		$('div#section-h2_typography a.wp-color-result').css('background-color', '#b30000');

		$('input#h3_typography_color').val('#2e2e2e');
		$('div#section-h3_typography a.wp-color-result').css('background-color', '#2e2e2e');

		$('input#h4_typography_color').val('#666666');
		$('div#section-h4_typography a.wp-color-result').css('background-color', '#666666');

		$('input#h5_typography_color').val('#333333');
		$('div#section-h5_typography a.wp-color-result').css('background-color', '#333333');

		$('input#header_logo').val(themeDir +'/images/style2/logo.png');
		$('#header_logo_image img').attr("src", themeDir +'/images/style2/logo.png');

		$('input#header_typography_color').val('#ec5006');
		$('div#section-header_typography a.wp-color-result').css('background-color', '#fff');

		$('input#tagline_typography_color').val('#c1cfd3');
		$('div#section-tagline_typography a.wp-color-result').css('background-color', '#eee');

		window.alert(presetName + " is loaded! Please review and save your settings.");
	}
}  // end Style10


	// Fade out the save message
	$('.fade').delay(1000).animate({height: 0, opacity: 0}, 'fast', function() {
        $(this).remove();
    });
	// Switches option sections
	$('.group').hide();
	var active_tab = '';
	if (typeof(localStorage) != 'undefined' ) {
		active_tab = localStorage.getItem("active_tab");
	}
	if (active_tab != '' && $(active_tab).length ) {
		$(active_tab).fadeIn();
	} else {
		$('.group:first').fadeIn();
	}
	$('.group .collapsed').each(function(){
		$(this).find('input:checked').parent().parent().parent().nextAll().each(
			function(){
				if ($(this).hasClass('last')) {
					$(this).removeClass('hidden');
						return false;
					}
				$(this).filter('.hidden').removeClass('hidden');
			});
	});
	if (active_tab != '' && $(active_tab + '-tab').length ) {
		$(active_tab + '-tab').addClass('nav-tab-active');
	}
	else {
		$('.nav-tab-wrapper a:first').addClass('nav-tab-active');
	}

	$('.nav-tab-wrapper a').click(function(evt) {
		$('.nav-tab-wrapper a').removeClass('nav-tab-active');
		$(this).addClass('nav-tab-active').blur();
		var clicked_group = $(this).attr('href');
		if (typeof(localStorage) != 'undefined' ) {
			localStorage.setItem("active_tab", $(this).attr('href'));
		}
		$('.group').hide();
		$(clicked_group).fadeIn();
		evt.preventDefault();

		// Editor Height (needs improvement)
		$('.wp-editor-wrap').each(function() {
			var editor_iframe = $(this).find('iframe');
			if ( editor_iframe.height() < 30 ) {
				editor_iframe.css({'height':'auto'});
			}
		});

	});

	$('.group .collapsed input:checkbox').click(unhideHidden);

	function unhideHidden(){
		if ($(this).attr('checked')) {
			$(this).parent().parent().parent().nextAll().removeClass('hidden');
		}
		else {
			$(this).parent().parent().parent().nextAll().each(
			function(){
				if ($(this).filter('.last').length) {
					$(this).addClass('hidden');
					return false;
					}
				$(this).addClass('hidden');
			});

		}
	}




	$('#use_logo_image').click(function() {
		$('#section-header_logo,#section-logo_width,#section-logo_height').fadeToggle(400);
		$('.section.section-info.text-header-none,#section-header_typography,#section-tagline_typography').fadeToggle(400);
	});

	if ($('#use_logo_image:checked').val() !== undefined) {
		$('#section-header_logo,#section-logo_width,#section-logo_height').show();
		$('.section.section-info.text-header-none,#section-header_typography,#section-tagline_typography').hide();
	}

	$('#use_custom_titletag').click(function() {
		$('#section-site_title,#section-site_tagline').fadeToggle(400);
	});

	if ($('#use_custom_titletag:checked').val() !== undefined) {
		$('#section-site_title,#section-site_tagline').show();
	}

	$('#show_post_thumbnails').click(function() {
		$('#section-thumbnail_action').fadeToggle(400);
	});

	if ($('#show_post_thumbnails:checked').val() !== undefined) {
		$('#section-thumbnail_action').show();
	}


	// Initially show/hide content options if responsive enabled/disabled
	var ContentType = $('input[name='+shortName+'\\[content_type\\]]');
	var ContentTypeSelected = ContentType.filter(':checked').val();

	if (ContentTypeSelected == 'content') {
		$('#section-display_readmore').hide();
	} else {
		$('#section-display_readmore').show();
	}

	// show if enabled is clicked
	$('#'+shortName+'-content_type-excerpt').click(function() {
		$('#section-display_readmore').fadeIn(400);
	});
	$('#'+shortName+'-content_type-none').click(function() {
		$('#section-display_readmore').fadeIn(400);
	});
	// hide if disabled is clicked
	$('#'+shortName+'-content_type-content').click(function() {
		$('#section-display_readmore').fadeOut(400);
	});



	// Initially show/hide menu options if responsive enabled/disabled
	var DesktopMobile = $('input[name='+shortName+'\\[mobile_support\\]]');
	var DesktopMobileSelected = DesktopMobile.filter(':checked').val();

	if (DesktopMobileSelected == 'desktop') {
		$('#section-mobile_selectmenu,#section-menu_text,#section-viewport_scale').hide();
	} else {
		$('#section-mobile_selectmenu,#section-menu_text,#section-viewport_scale').show();
	}

	// show if enabled is clicked
	$('#'+shortName+'-mobile_support-mobile').click(function() {
		$('#section-mobile_selectmenu,#section-menu_text,#section-viewport_scale').fadeIn(400);
		//check mobile_selectmenu by default
		$('#mobile_selectmenu').attr('checked','checked');
	});
	// hide if disabled is clicked
	$('#'+shortName+'-mobile_support-desktop').click(function() {
		//uncheck mobile_selectmenu if disabled
		$('#section-mobile_selectmenu,#section-menu_text,#section-viewport_scale').fadeOut(400);
		$('#mobile_selectmenu').removeAttr('checked');
	});


	// Initially show/hide menu options if responsive enabled/disabled
	var MenuPlacement = $('input[name='+shortName+'\\[mainmenu_placement\\]]');
	var MenuPlacementSelected = MenuPlacement.filter(':checked').val();

	if (MenuPlacementSelected == 'below') {
		$('#section-menu_h_offset,#section-menu_v_offset').hide();
	} else {
		$('#section-menu_h_offset,#section-menu_v_offset').show();
	}

	// show if enabled is clicked
	$('#'+shortName+'-mainmenu_placement-right').click(function() {
		$('#section-menu_h_offset,#section-menu_v_offset').fadeIn(400);
	});
	// hide if disabled is clicked
	$('#'+shortName+'-mainmenu_placement-below').click(function() {
		//uncheck mobile_selectmenu if disabled
		$('#section-menu_h_offset,#section-menu_v_offset').fadeOut(400);
	});

	// Mobile Logo
	$('#use_mobile_logo_image').click(function() {
		$('#section-mobile_header_logo,#section-mobile_logo_height,#section-mobile_logo_image_is_retina').fadeToggle(400);
	});

	if ($('#use_mobile_logo_image:checked').val() !== undefined) {
		$('#section-mobile_header_logo,#section-mobile_logo_height,#section-mobile_logo_image_is_retina').show();
	}



	// Theme Credits
	$('#st_credits').click(function() {
		$('#section-st_affid').fadeToggle(400);
	});

	if ($('#st_credits:checked').val() !== undefined) {
		$('#section-st_affid').show();
	}


	// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});

	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
	//$('#layout_style_nostyle.of-radio-img-radio').show();
	//$('#label_layout_style_nostyle.of-radio-img-label').show();

	$('#of-nav li:first').addClass('current');
	$('#of-nav li a').click(function(evt) {
		$('#of-nav li').removeClass('current');
		$(this).parent().addClass('current');
		var clicked_group = $(this).attr('href');
		$('.group').hide();
		$(clicked_group).fadeIn();
		evt.preventDefault();
	});
});

