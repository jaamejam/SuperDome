<?php
/// Ads Widget

class adsWidget extends WP_Widget
{


function adsWidget(){
$widget_ops = array('classname' => 'widget_ads_widget', 'description' => __( "125px Banner Ads") );
$control_ops = array('width' => 200, 'height' => 200);
$this->WP_Widget('adswidget125', __('125px Ads'), $widget_ops, $control_ops);
}


function widget($args, $instance){
extract($args);
// $images_path = site_url('/wp-content/uploads/');

$adOne = empty($instance['adOne']) ? 'Ad1' : $instance['adOne'];
$adOneLink = empty($instance['adOneLink']) ? 'link' : $instance['adOneLink'];
$adOneTarget = $instance['adOneTarget'] ? 'target="blank"' : '';
$adOneEnable = empty($instance['adOneEnable']) ? 'false' : 'true';

$adTwo = empty($instance['adTwo']) ? 'Ad1' : $instance['adTwo'];
$adTwoLink = empty($instance['adTwoLink']) ? 'link' : $instance['adTwoLink'];
$adTwoTarget = $instance['adTwoTarget'] ? 'target="blank"' : '';
$adTwoEnable = empty($instance['adTwoEnable']) ? 'false' : 'true';

$adThree = empty($instance['adThree']) ? 'Ad1' : $instance['adThree'];
$adThreeLink = empty($instance['adThreeLink']) ? 'link' : $instance['adThreeLink'];
$adThreeTarget = $instance['adThreeTarget'] ? 'target="blank"' : '';
$adThreeEnable = empty($instance['adThreeEnable']) ? 'false' : 'true';

$adFour = empty($instance['adFour']) ? 'Ad1' : $instance['adFour'];
$adFourLink = empty($instance['adFourLink']) ? 'link' : $instance['adFourLink'];
$adFourTarget = $instance['adFourTarget'] ? 'target="blank"' : '';
$adFourEnable = empty($instance['adFourEnable']) ? 'false' : 'true';

$adFive = empty($instance['adFive']) ? 'Ad1' : $instance['adFive'];
$adFiveLink = empty($instance['adFiveLink']) ? 'link' : $instance['adFiveLink'];
$adFiveTarget = $instance['adFiveTarget'] ? 'target="blank"' : '';
$adFiveEnable = empty($instance['adFiveEnable']) ? 'false' : 'true';

$adSix = empty($instance['adSix']) ? 'Ad1' : $instance['adSix'];
$adSixLink = empty($instance['adSixLink']) ? 'link' : $instance['adSixLink'];
$adSixTarget = $instance['adSixTarget'] ? 'target="blank"' : '';
$adSixEnable = empty($instance['adSixEnable']) ? 'false' : 'true';

echo $before_widget;

echo '<div class="ad-box">';
// Ads One and Two
if ($adOneEnable == 'true' || $adTwoEnable == 'true') {
echo '<div class="ad125">';
}
if ($adOneEnable == 'true') {
echo '<a href="'. $adOneLink .'"' .$adOneTarget.'><img src="'. $adOne .'" alt="" /></a>';
}
if ($adTwoEnable == 'true') {
echo '<a href="'. $adTwoLink .'"' .$adTwoTarget.'><img src="'. $adTwo .'" class="last" alt="" /></a>';
}
if ($adOneEnable == 'true' || $adTwoEnable == 'true') {
echo '</div>';
echo '<div class="clearfix"></div>';
}



// Ads Three and Four
if ($adThreeEnable == 'true' || $adFourEnable == 'true') {
echo '<div class="ad125">';
}
if ($adThreeEnable == 'true') {
echo '<a href="'. $adThreeLink .'"' .$adThreeTarget.'><img src="'. $adThree .'" alt="" /></a>';
}
if ($adFourEnable == 'true') {
echo '<a href="'. $adFourLink .'"' .$adFourTarget.'><img src="'. $adFour .'" class="last" alt="" /></a>';
}
if ($adThreeEnable == 'true' || $adFourEnable == 'true') {
echo '</div>';
echo '<div class="clearfix"></div>';
}

// Ads Five and Six
if ($adFiveEnable == 'true' || $adSixEnable == 'true') {
echo '<div class="ad125">';
}
if ($adFiveEnable == 'true') {
echo '<a href="'. $adFiveLink .'"' .$adFiveTarget.'><img src="'. $adFive .'" alt="" /></a>';
}
if ($adSixEnable == 'true') {
echo '<a href="'. $adSixLink .'"' .$adSixTarget.'><img src="'. $adSix .'" class="last" alt="" /></a>';
}
if ($adFiveEnable == 'true' || $adSixEnable == 'true') {
echo '</div>';
echo '<div class="clearfix"></div>';
}
echo '</div>';
echo $after_widget;

} // widget

/*
* Save Widget Settings
*/

function update($new_instance, $old_instance){
  $instance = $old_instance;

  $instance['adOne'] = strip_tags(stripslashes($new_instance['adOne']));
  $instance['adOneLink'] = strip_tags(stripslashes($new_instance['adOneLink']));
  $instance['adOneEnable'] = $new_instance['adOneEnable'];
  $instance['adOneTarget'] = $new_instance['adOneTarget'];

	$instance['adTwo'] = strip_tags(stripslashes($new_instance['adTwo']));
	$instance['adTwoLink'] = strip_tags(stripslashes($new_instance['adTwoLink']));
  $instance['adTwoEnable'] = $new_instance['adTwoEnable'];
	$instance['adTwoTarget'] = $new_instance['adTwoTarget'];

	$instance['adThree'] = strip_tags(stripslashes($new_instance['adThree']));
	$instance['adThreeLink'] = strip_tags(stripslashes($new_instance['adThreeLink']));
  $instance['adThreeEnable'] = $new_instance['adThreeEnable'];
	$instance['adThreeTarget'] = $new_instance['adThreeTarget'];

	$instance['adFour'] = strip_tags(stripslashes($new_instance['adFour']));
	$instance['adFourLink'] = strip_tags(stripslashes($new_instance['adFourLink']));
  $instance['adFourEnable'] = $new_instance['adFourEnable'];
	$instance['adFourTarget'] = $new_instance['adFourTarget'];

	$instance['adFive'] = strip_tags(stripslashes($new_instance['adFive']));
	$instance['adFiveLink'] = strip_tags(stripslashes($new_instance['adFiveLink']));
  $instance['adFiveEnable'] = $new_instance['adFiveEnable'];
	$instance['adFiveTarget'] = $new_instance['adFiveTarget'];

	$instance['adSix'] = strip_tags(stripslashes($new_instance['adSix']));
	$instance['adSixLink'] = strip_tags(stripslashes($new_instance['adSixLink']));
  $instance['adSixEnable'] = $new_instance['adSixEnable'];
	$instance['adSixTarget'] = $new_instance['adSixTarget'];

	return $instance;
} // update

/**
 * Creates the edit form for the widget.
*/

function form($instance){
  //Defaults
$images_path = site_url('/wp-content/uploads/');
$instance = wp_parse_args( (array) $instance, array(
		'adOne'=>'http://placehold.it/125x125',
		'adOneLink'=>"http://",
		'adOneEnable'=>'',
		'adOneTarget'=>'',
		'adTwo'=>'http://placehold.it/125x125',
		'adTwoLink'=>"http://",
		'adTwoEnable'=>'',
		'adTwoTarget'=>'',
		'adThree'=>'http://placehold.it/125x125',
		'adThreeEnable'=>'',
		'adThreeLink'=>"http://",
		'adThreeTarget'=>'',
		'adFour'=>'http://placehold.it/125x125',
		'adFourEnable'=>'',
		'adFourLink'=>"http://",
		'adFourTarget'=>'',
		'adFive'=>'http://placehold.it/125x125',
		'adFiveEnable'=>'',
		'adFiveLink'=>"http://",
		'adFiveTarget'=>'',
		'adSix'=>'http://placehold.it/125x125',
		'adSixEnable'=>'',
		'adSixLink'=>"http://",
		'adSixTarget'=>''
		));

	$adOne = htmlspecialchars($instance['adOne']);
	$adOneLink = htmlspecialchars($instance['adOneLink']);
	$adOneEnable = $instance['adOneEnable'] ? 'checked="checked"' : '';
	$adOneTarget = $instance['adOneTarget'] ? 'checked="checked"' : '';

	$adTwo = htmlspecialchars($instance['adTwo']);
	$adTwoLink = htmlspecialchars($instance['adTwoLink']);
	$adTwoEnable = $instance['adTwoEnable'] ? 'checked="checked"' : '';
	$adTwoTarget = $instance['adTwoTarget'] ? 'checked="checked"' : '';

	$adThree = htmlspecialchars($instance['adThree']);
	$adThreeLink = htmlspecialchars($instance['adThreeLink']);
	$adThreeEnable = $instance['adThreeEnable'] ? 'checked="checked"' : '';
	$adThreeTarget = $instance['adThreeTarget'] ? 'checked="checked"' : '';

	$adFour = htmlspecialchars($instance['adFour']);
	$adFourLink = htmlspecialchars($instance['adFourLink']);
	$adFourEnable = $instance['adFourEnable'] ? 'checked="checked"' : '';
	$adFourTarget = $instance['adFourTarget'] ? 'checked="checked"' : '';

	$adFive = htmlspecialchars($instance['adFive']);
	$adFiveLink = htmlspecialchars($instance['adFiveLink']);
	$adFiveEnable = $instance['adFiveEnable'] ? 'checked="checked"' : '';
	$adFiveTarget = $instance['adFiveTarget'] ? 'checked="checked"' : '';

	$adSix = htmlspecialchars($instance['adSix']);
	$adSixLink = htmlspecialchars($instance['adSixLink']);
	$adSixEnable = $instance['adSixEnable'] ? 'checked="checked"' : '';
	$adSixTarget = $instance['adSixTarget'] ? 'checked="checked"' : '';


  # Output the options
	// echo '<p><strong>Image paths are relative to:</strong><br /> '.$images_path.'</p>';
	# Ad 1
  echo '<h3>Ad One</h3>';
  echo '<hr style="background-color:#ccc;border:0px solid #fff;height:1px;" />';
  echo '<p><label for="' . $this->get_field_name('adOne') . '">' . __('Ad One Image:') . ' <input style="width: 225px;" id="' . $this->get_field_id('adOne') . '" name="' . $this->get_field_name('adOne') . '" type="text" value="'.  $adOne . '" /></label></p>';
  echo '<p><label for="' . $this->get_field_name('adOneLink') . '">' . __('Ad One URL:') . ' <input style="width: 225px;" id="' . $this->get_field_id('adOneLink') . '" name="' . $this->get_field_name('adOneLink') . '" type="text" value="'.  $adOneLink . '" /></label></p>';
	echo '<input class="checkbox" type="checkbox"' .$adOneEnable.' id="' . $this->get_field_id('adOneEnable') . '" name="' . $this->get_field_name('adOneEnable') . '" />';
	echo '<label for="'.$this->get_field_id('adOneEnable') .'"> '. __('Enabled') .'</label><br />';
	echo '<input class="checkbox" type="checkbox"' .$adOneTarget.' id="' . $this->get_field_id('adOneTarget') . '" name="' . $this->get_field_name('adOneTarget') . '" />';
	echo '<label for="'.$this->get_field_id('adOneTarget') .'"> '. __('Open in New Window') .'</label><br />';

  # Ad 2
  echo '<h3>Ad Two</h3>';
	echo '<hr style="background-color:#ccc;border:0px solid #fff;height:1px;" />';
	echo '<p><label for="' . $this->get_field_name('adTwo') . '">' . __('Ad Two Image:') . ' <input style="width: 225px;" id="' . $this->get_field_id('adTwo') . '" name="' . $this->get_field_name('adTwo') . '" type="text" value="'.  $adTwo . '" /></label></p>';
	echo '<p><label for="' . $this->get_field_name('adTwoLink') . '">' . __('Ad Two URL:') . ' <input style="width: 225px;" id="' . $this->get_field_id('adTwoLink') . '" name="' . $this->get_field_name('adTwoLink') . '" type="text" value="'.  $adTwoLink . '" /></label></p>';
	echo '<input class="checkbox" type="checkbox"' .$adTwoEnable.' id="' . $this->get_field_id('adTwoEnable') . '" name="' . $this->get_field_name('adTwoEnable') . '" />';
	echo '<label for="'.$this->get_field_id('adTwoEnable') .'"> '. __('Enabled') .'</label><br />';
	echo '<input class="checkbox" type="checkbox"' .$adTwoTarget.' id="' . $this->get_field_id('adTwoTarget') . '" name="' . $this->get_field_name('adTwoTarget') . '" />';
	echo '<label for="'.$this->get_field_id('adTwoTarget') .'"> '. __('Open in New Window') .'</label><br />';

  # Ad 3
  echo '<h3>Ad Three</h3>';
	echo '<hr style="background-color:#ccc;border:0px solid #fff;height:1px;" />';
	echo '<p><label for="' . $this->get_field_name('adThree') . '">' . __('Ad Three Image:') . ' <input style="width: 225px;" id="' . $this->get_field_id('adThree') . '" name="' . $this->get_field_name('adThree') . '" type="text" value="'.  $adThree . '" /></label></p>';
	echo '<p><label for="' . $this->get_field_name('adThreeLink') . '">' . __('Ad Three URL:') . ' <input style="width: 225px;" id="' . $this->get_field_id('adThreeLink') . '" name="' . $this->get_field_name('adThreeLink') . '" type="text" value="'.  $adThreeLink . '" /></label></p>';
	echo '<input class="checkbox" type="checkbox"' .$adThreeEnable.' id="' . $this->get_field_id('adThreeEnable') . '" name="' . $this->get_field_name('adThreeEnable') . '" />';
	echo '<label for="'.$this->get_field_id('adThreeEnable') .'"> '. __('Enabled') .'</label><br />';
	echo '<input class="checkbox" type="checkbox"' .$adThreeTarget.' id="' . $this->get_field_id('adThreeTarget') . '" name="' . $this->get_field_name('adThreeTarget') . '" />';
	echo '<label for="'.$this->get_field_id('adThreeTarget') .'"> '. __('Open in New Window') .'</label><br />';

  # Ad 4
  echo '<h3>Ad Four</h3>';
	echo '<hr style="background-color:#ccc;border:0px solid #fff;height:1px;" />';
	echo '<p><label for="' . $this->get_field_name('adFour') . '">' . __('Ad Four Image:') . ' <input style="width: 225px;" id="' . $this->get_field_id('adFour') . '" name="' . $this->get_field_name('adFour') . '" type="text" value="'.  $adFour . '" /></label></p>';
	echo '<p><label for="' . $this->get_field_name('adFourLink') . '">' . __('Ad Four URL:') . ' <input style="width: 225px;" id="' . $this->get_field_id('adFourLink') . '" name="' . $this->get_field_name('adFourLink') . '" type="text" value="'.  $adFourLink . '" /></label></p>';
	echo '<input class="checkbox" type="checkbox"' .$adFourEnable.' id="' . $this->get_field_id('adFourEnable') . '" name="' . $this->get_field_name('adFourEnable') . '" />';
	echo '<label for="'.$this->get_field_id('adFourEnable') .'"> '. __('Enabled') .'</label><br />';
	echo '<input class="checkbox" type="checkbox"' .$adFourTarget.' id="' . $this->get_field_id('adFourTarget') . '" name="' . $this->get_field_name('adFourTarget') . '" />';
	echo '<label for="'.$this->get_field_id('adFourTarget') .'"> '. __('Open in New Window') .'</label><br />';

	#Ad 5
  echo '<h3>Ad Five</h3>';
	echo '<hr style="background-color:#ccc;border:0px solid #fff;height:1px;" />';
	echo '<p><label for="' . $this->get_field_name('adFive') . '">' . __('Ad Five Image:') . ' <input style="width: 225px;" id="' . $this->get_field_id('adFive') . '" name="' . $this->get_field_name('adFive') . '" type="text" value="'.  $adFive . '" /></label></p>';
	echo '<p><label for="' . $this->get_field_name('adFiveLink') . '">' . __('Ad Five URL:') . ' <input style="width: 225px;" id="' . $this->get_field_id('adFiveLink') . '" name="' . $this->get_field_name('adFiveLink') . '" type="text" value="'.  $adFiveLink . '" /></label></p>';
	echo '<input class="checkbox" type="checkbox"' .$adFiveEnable.' id="' . $this->get_field_id('adFiveEnable') . '" name="' . $this->get_field_name('adFiveEnable') . '" />';
	echo '<label for="'.$this->get_field_id('adFiveEnable') .'"> '. __('Enabled') .'</label><br />';
	echo '<input class="checkbox" type="checkbox"' .$adFiveTarget.' id="' . $this->get_field_id('adFiveTarget') . '" name="' . $this->get_field_name('adFiveTarget') . '" />';
	echo '<label for="'.$this->get_field_id('adFiveTarget') .'"> '. __('Open in New Window') .'</label><br />';

	#Ad 6
  echo '<h3>Ad Six</h3>';
	echo '<hr style="background-color:#ccc;border:0px solid #fff;height:1px;" />';
	echo '<p><label for="' . $this->get_field_name('adSix') . '">' . __('Ad Six Image:') . ' <input style="width: 225px;" id="' . $this->get_field_id('adSix') . '" name="' . $this->get_field_name('adSix') . '" type="text" value="'.  $adSix . '" /></label></p>';
	echo '<p><label for="' . $this->get_field_name('adSixLink') . '">' . __('Ad Six URL:') . ' <input style="width: 225px;" id="' . $this->get_field_id('adSixLink') . '" name="' . $this->get_field_name('adSixLink') . '" type="text" value="'.  $adSixLink . '" /></label></p>';
	echo '<input class="checkbox" type="checkbox"' .$adSixEnable.' id="' . $this->get_field_id('adSixEnable') . '" name="' . $this->get_field_name('adSixEnable') . '" />';
	echo '<label for="'.$this->get_field_id('adSixEnable') .'"> '. __('Enabled') .'</label><br />';
	echo '<input class="checkbox" type="checkbox"' .$adSixTarget.' id="' . $this->get_field_id('adSixTarget') . '" name="' . $this->get_field_name('adSixTarget') . '" />';
	echo '<label for="'.$this->get_field_id('adSixTarget') .'"> '. __('Open in New Window') .'</label><br />';

} // form

} // END class


function adsWidgetInit() {register_widget('adsWidget');}
add_action('widgets_init', 'adsWidgetInit');
// End Ads Widget


// Flickr Widget

class flickrWidget extends WP_Widget {

function flickrWidget() {
	$widget_ops = array('classname' => 'widget_flickr_widget', 'description' => __( "Displays Flickr photos in your sidebars.") );
	$control_ops = array('width' => 200, 'height' => 200);
	$this->WP_Widget('flickrWidget', __('Flickr Photos'), $widget_ops, $control_ops);
} // flickrWidget

function widget($args, $instance){

extract($args);
$id = empty($instance['id']) ? '' : $instance['id'];
$number = empty($instance['number']) ? '' : $instance['number'];

echo $before_widget;

echo '<div class="widget flickr">';
echo '<h3 class="widget-title"><span><span class="flickr-logo">flick<b>r</b></span> photostream</span></h3>';
echo '<div class="clear"></div>';
echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$number.'&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user='.$id.'"></script>';
echo '</div>';

echo $after_widget;

} // widget


/*
* Save Flickr Widget Settings
*/

function update($new_instance, $old_instance){

  $instance = $old_instance;

  $instance['id'] = strip_tags(stripslashes($new_instance['id']));

	$instance['number'] = strip_tags(stripslashes($new_instance['number']));

	return $instance;
} // update


/**
 * Creates the edit form for the widget.
*/

function form($instance){
  //Defaults
$instance = wp_parse_args( (array) $instance, array(
		'id'=>'',
		'number'=>"6"
		));

	$id= htmlspecialchars($instance['id']);
	$number= htmlspecialchars($instance['number']);


  # Output the options
  // echo '<h3>Flickr</h3>';
	echo '<p>get your Flickr ID from <a onclick="window.open(this.href); return false;" href="http://www.idgettr.com">idGettr</a></p>';
  echo '<p><label for="' . $this->get_field_name('id') . '">' . __('Flickr ID:') . ' <input style="width: 225px;" id="' . $this->get_field_id('id') . '" name="' . $this->get_field_name('id') . '" type="text" value="'.  $id . '" /></label></p>';

  echo '<p><label for="' . $this->get_field_name('number') . '">' . __('Number of Photos:') . ' <input style="width: 225px;" id="' . $this->get_field_id('number') . '" name="' . $this->get_field_name('number') . '" type="text" value="'.  $number . '" /></label></p>';


} // form
} // class
function flickrWidgetInit() {register_widget('flickrWidget');}
add_action('widgets_init', 'flickrWidgetInit');


// End Flickr Widget


//================================ Social Networks Widget ===================================


class socialWidget extends WP_Widget {


function socialWidget(){
$widget_ops = array('classname' => 'widget_ads_widget', 'description' => __( "Adds links to your favorite social networks.") );
$control_ops = array('width' => 200, 'height' => 200);
$this->WP_Widget('socialwidget', __('Social Networks'), $widget_ops, $control_ops);
}


function widget($args, $instance){

extract($args);

$socialTitle = empty($instance['socialTitle']) ? 'Connect' : $instance['socialTitle'];
$Flickr = empty($instance['Flickr']) ? '' : $instance['Flickr'];
$GooglePlus = empty($instance['GooglePlus']) ? '' : $instance['GooglePlus'];
$Pinterest = empty($instance['Pinterest']) ? '' : $instance['Pinterest'];
$FaceBook = empty($instance['FaceBook']) ? '' : $instance['FaceBook'];
$Twitter = empty($instance['Twitter']) ? '' : $instance['Twitter'];
$LinkedIn = empty($instance['LinkedIn']) ? '' : $instance['LinkedIn'];
$YouTube = empty($instance['YouTube']) ? '' : $instance['YouTube'];

echo $before_widget;
echo $before_title;
echo $socialTitle;
echo $after_title;

echo '<div class="widget social">';
echo '<ul id="stpl_social">';

if (!empty($Flickr)) {echo '<li class="stpl_flickr"><a rel="external" href="'.$Flickr.'">'. __('Follow on Flickr!') .'</a></li>';}
if (!empty($GooglePlus)) {echo '<li class="stpl_gplus"><a rel="external" href="'.$GooglePlus.'">'. __('Follow on Google+') .'</a></li>';}
if (!empty($Pinterest)) {echo '<li class="stpl_pinterest"><a rel="external" href="'.$Pinterest.'">'. __('Follow on Pinterest!') .'</a></li>';}
if (!empty($FaceBook)) {echo '<li class="stpl_facebook"><a rel="external" href="'.$FaceBook.'">'. __('Follow on Facebook!') .'</a></li>';}
if (!empty($Twitter)) {echo '<li class="stpl_twitter"><a rel="external" href="'.$Twitter.'">'. __('Follow on Twitter!') .'</a></li>';}
if (!empty($LinkedIn)) {echo '<li class="stpl_linkedin"><a rel="external" href="'.$LinkedIn.'">'. __('Follow on LinkedIn!') .'</a></li>';}
if (!empty($YouTube)) {echo '<li class="stpl_youtube"><a rel="external" href="'.$YouTube.'">'. __('Follow on YouTube!') .'</a></li>';}
echo '</ul>';
echo '</div>';

echo $after_widget;

} // widget

/*
* Save Widget Settings
*/

function update($new_instance, $old_instance){
  $instance = $old_instance;
  $instance['socialTitle'] = strip_tags(stripslashes($new_instance['socialTitle']));
  $instance['Flickr'] = strip_tags(stripslashes($new_instance['Flickr']));
  $instance['GooglePlus'] = strip_tags(stripslashes($new_instance['GooglePlus']));
  $instance['Pinterest'] = strip_tags(stripslashes($new_instance['Pinterest']));
  $instance['FaceBook'] = strip_tags(stripslashes($new_instance['FaceBook']));
  $instance['Twitter'] = strip_tags(stripslashes($new_instance['Twitter']));
  $instance['LinkedIn'] = strip_tags(stripslashes($new_instance['LinkedIn']));
  $instance['YouTube'] = strip_tags(stripslashes($new_instance['YouTube']));
return $instance;
} // update

/**
 * Creates the edit form for the widget.
*/

function form($instance){
  //Defaults
$instance = wp_parse_args( (array) $instance, array(
		'Flickr'=>'http://flickr.com/',
		'GooglePlus'=>'https://plus.google.com/',
		'Pinterest'=>'http://pinterest.com/',
		'FaceBook'=>"http://facebook.com/",
		'Twitter'=>'http://twitter.com/',
		'LinkedIn'=>'http://linkedin.com/',
		'YouTube'=>'http://youtube.com/'
		));

	$socialTitle = htmlspecialchars($instance['socialTitle']);
	$Flickr = htmlspecialchars($instance['Flickr']);
	$GooglePlus = htmlspecialchars($instance['GooglePlus']);
	$Pinterest = htmlspecialchars($instance['Pinterest']);
	$FaceBook = htmlspecialchars($instance['FaceBook']);
	$Twitter = htmlspecialchars($instance['Twitter']);
	$LinkedIn = htmlspecialchars($instance['LinkedIn']);
	$YouTube = htmlspecialchars($instance['YouTube']);


  # Output the options
  // Widget Title
  echo '<p><label for="' . $this->get_field_name('socialTitle') . '">' . __('Title:') . ' <input style="width: 225px;" id="' . $this->get_field_id('socialTitle') . '" name="' . $this->get_field_name('socialTitle') . '" type="text" value="'.  $socialTitle . '" /></label></p>';
  echo '<hr style="background-color:#ccc;border:0px solid #fff;height:1px;" />';

  // echo '<h3>Flickr</h3>';
  echo '<p><label for="' . $this->get_field_name('Flickr') . '">' . __('Flickr') . ' <input style="width: 225px;" id="' . $this->get_field_id('Flickr') . '" name="' . $this->get_field_name('Flickr') . '" type="text" value="'.  $Flickr . '" /></label></p>';
  echo '<hr style="background-color:#ccc;border:0px solid #fff;height:1px;" />';

  // echo '<h3>GooglePlus</h3>';
  echo '<p><label for="' . $this->get_field_name('GooglePlus') . '">' . __('Google Plus') . ' <input style="width: 225px;" id="' . $this->get_field_id('GooglePlus') . '" name="' . $this->get_field_name('GooglePlus') . '" type="text" value="'.  $GooglePlus . '" /></label></p>';
  echo '<hr style="background-color:#ccc;border:0px solid #fff;height:1px;" />';

  // echo '<h3>Pinterest</h3>';
  echo '<p><label for="' . $this->get_field_name('Pinterest') . '">' . __('Pinterest') . ' <input style="width: 225px;" id="' . $this->get_field_id('Pinterest') . '" name="' . $this->get_field_name('Pinterest') . '" type="text" value="'.  $Pinterest . '" /></label></p>';
  echo '<hr style="background-color:#ccc;border:0px solid #fff;height:1px;" />';

  // echo '<h3>FaceBook</h3>';
  echo '<p><label for="' . $this->get_field_name('FaceBook') . '">' . __('FaceBook') . ' <input style="width: 225px;" id="' . $this->get_field_id('FaceBook') . '" name="' . $this->get_field_name('FaceBook') . '" type="text" value="'.  $FaceBook . '" /></label></p>';
  echo '<hr style="background-color:#ccc;border:0px solid #fff;height:1px;" />';

  // echo '<h3>Twitter</h3>';
  echo '<p><label for="' . $this->get_field_name('Twitter') . '">' . __('Twitter') . ' <input style="width: 225px;" id="' . $this->get_field_id('Twitter') . '" name="' . $this->get_field_name('Twitter') . '" type="text" value="'.  $Twitter . '" /></label></p>';
  echo '<hr style="background-color:#ccc;border:0px solid #fff;height:1px;" />';

  // echo '<h3>LinkedIn</h3>';
  echo '<p><label for="' . $this->get_field_name('LinkedIn') . '">' . __('LinkedIn') . ' <input style="width: 225px;" id="' . $this->get_field_id('LinkedIn') . '" name="' . $this->get_field_name('LinkedIn') . '" type="text" value="'.  $LinkedIn . '" /></label></p>';
  echo '<hr style="background-color:#ccc;border:0px solid #fff;height:1px;" />';

  echo '<p><label for="' . $this->get_field_name('YouTube') . '">' . __('YouTube') . ' <input style="width: 225px;" id="' . $this->get_field_id('YouTube') . '" name="' . $this->get_field_name('YouTube') . '" type="text" value="'.  $YouTube . '" /></label></p>';
  echo '<hr style="background-color:#ccc;border:0px solid #fff;height:1px;" />';

} // form

} // END class


function socialWidgetInit() {register_widget('socialWidget');}
add_action('widgets_init', 'socialWidgetInit');
// End Social Widget


//================================ Popular Posts Widget ===================================


class PopularPostsSidebar extends WP_Widget {


function PopularPostsSidebar(){
$widget_ops = array('classname' => 'widget_popwidget', 'description' => __( "Displays your most popular posts.") );
$control_ops = array('width' => 200, 'height' => 200);
$this->WP_Widget('popularwidget', __('Popular Posts'), $widget_ops, $control_ops);
}


function widget($args, $instance){

extract($args);

$PopCount = empty($instance['PopCount']) ? '5' : $instance['PopCount'];
$PopTitle = empty($instance['PopTitle']) ? 'Popular Posts' : $instance['PopTitle'];

echo $before_widget;
echo $before_title;
echo $PopTitle;
echo $after_title;


echo '<ul class="popular_posts">';

global $wpdb;
      $now = gmdate("Y-m-d H:i:s",time());
      $lastmonth = gmdate("Y-m-d H:i:s",gmmktime(date("H"), date("i"), date("s"), date("m")-12,date("d"),date("Y")));
      $popularposts = "SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS 'pop' FROM $wpdb->posts, $wpdb->comments WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish' AND post_date < '$now' AND post_date > '$lastmonth' AND comment_status = 'open' GROUP BY $wpdb->comments.comment_post_ID ORDER BY pop DESC LIMIT $PopCount";
      $posts = $wpdb->get_results($popularposts);
      $popular = '';
      if($posts) {
          foreach($posts as $post){
            $post_title = stripslashes($post->post_title);
             $guid = get_permalink($post->ID);
		      $first_post_title=substr($post_title,0,56);

			echo '<li><a href="'.$guid.'" title="'.$post_title.'">'.$first_post_title.'</a></li>';
		} // end foreach
	} // endif
			echo '</ul>';

echo $after_widget;

} // widget

/*
* Save Widget Settings
*/

function update($new_instance, $old_instance){

  $instance = $old_instance;

  $instance['PopCount'] = strip_tags(stripslashes($new_instance['PopCount']));
  $instance['PopTitle'] = strip_tags(stripslashes($new_instance['PopTitle']));

	return $instance;
} // update

/**
 * Creates the edit form for the widget.
*/

function form($instance){
  //Defaults
$instance = wp_parse_args( (array) $instance, array('PopCount'=>'5'));

	$PopCount = htmlspecialchars($instance['PopCount']);


  # Output the options
  echo '<p><label for="' . $this->get_field_name('PopTitle') . '">' . __('Title:') . ' <input style="width: 225px;" id="' . $this->get_field_id('PopTitle') . '" name="' . $this->get_field_name('PopTitle') . '" type="text" value="'.  $PopTitle . '" /></label></p>';
  echo '<p><label for="' . $this->get_field_name('PopCount') . '">' . __('Number of articles to display:') . ' <input style="width: 225px;" id="' . $this->get_field_id('PopCount') . '" name="' . $this->get_field_name('PopCount') . '" type="text" value="'.  $PopCount . '" /></label></p>';

} // form

} // END class


function PopularPostsInit() {register_widget('PopularPostsSidebar');}
add_action('widgets_init', 'PopularPostsInit');
// End Popular Posts


// Slideshow Widget

// First create the widget for the admin panel
class custom_post_widget extends WP_Widget {


	function custom_post_widget() {
		$widget_ops = array('description' => __('Displays slideshow in a widget', 'custom-post-widget'));
		$control_ops = array('width' => 200, 'height' => 200);
		$this->WP_Widget('custom_post_widget', __('Featured Slider', 'custom-post-widget'), $widget_ops, $control_ops);
	}


	function widget($args, $instance) {
		extract($args);
		$termId  = ( $instance['custom_post_id'] != '' ) ? esc_attr($instance['custom_post_id']) : __('Find', 'custom-post-widget');
		$termName = get_term_by( 'id', $termId,'slidecategory' );
		$term = $termName->name;

		// Variables from the widget settings.
		$slidereffect = $instance['slideshow_type'];
		if ($slidereffect == "Crossfade") {$effect = "crossfade";}
		if ($slidereffect == "Fade") {$effect = "fade";}
		if ($slidereffect == "Slide") {$effect = "slide";}

		$width      = $instance['slideshow_width'];
		$height     = $instance['slideshow_height'];
		$autoheight = $instance['slideshow_autoheight'];
		$speed      = $instance['slideshow_speed'];
		$autoplay   = $instance['slideshow_autoplay'];
		$pagination = $instance['slideshow_pagination'];
		$prevnext   = $instance['slideshow_prevnext'];

		$content = st_cycle_slider($termId,$width,$height,$effect,$speed,$pagination,$prevnext,$autoplay,$autoheight);

		echo $before_widget;
		echo '<div id="st_slider">';
		echo do_shortcode($content); // This is where the actual content of the custom post is being displayed
		echo $after_widget;
		echo '</div>';
		echo '<div class="clear"></div>';
	}

	function update( $new_instance, $old_instance ) {
		$termId  = ( $instance['custom_post_id'] != '' ) ? esc_attr($instance['custom_post_id']) : __('Find', 'custom-post-widget');
		$instance = $old_instance;

		$instance['custom_post_id'] = strip_tags($new_instance['custom_post_id']);
		// Initialize
		$instance['slideshow_type'] = $new_instance['slideshow_type'];

		$instance['slideshow_width'] = strip_tags( $new_instance['slideshow_width'] );

		$instance['slideshow_height'] = strip_tags( $new_instance['slideshow_height'] );
		$instance['slideshow_autoheight'] = strip_tags( $new_instance['slideshow_autoheight'] );

		$instance['slideshow_speed'] = $new_instance['slideshow_speed'];
		$instance['slideshow_autoplay'] = $new_instance['slideshow_autoplay'];
		$instance['slideshow_pagination'] = $new_instance['slideshow_pagination'];
		$instance['slideshow_prevnext'] = $new_instance['slideshow_prevnext'];

		return $instance;
	}


	function form($instance) {
		$custom_post_id       = esc_attr($instance['custom_post_id']);
		$slideshow_type       = esc_attr($instance['slideshow_type']);
		$slideshow_width      = esc_attr($instance['slideshow_width']);
		$slideshow_height     = esc_attr($instance['slideshow_height']);
		$slideshow_autoheight = esc_attr($instance['slideshow_autoheight']);
		$slideshow_speed      = esc_attr($instance['slideshow_speed']);
		$slideshow_autoplay   = esc_attr($instance['slideshow_autoplay']);
		$slideshow_pagination = esc_attr($instance['slideshow_pagination']);
		$slideshow_prevnext   = esc_attr($instance['slideshow_prevnext']);

		/* Set up some default widget settings. */
		$defaults = array( 'slideshow_width' => ('960'), 'slideshow_height' => ('350'));
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
			<label for="<?php echo $this->get_field_id('custom_post_id'); ?>"> <?php echo __('Featured Slider to Display:', 'custom-post-widget') ?>
				<select class="widefat" id="<?php echo $this->get_field_id('custom_post_id'); ?>" name="<?php echo $this->get_field_name('custom_post_id'); ?>">
				<?php
				// Category Selector
				$myterms = get_terms('slidecategory');
				$st_getTerms = array();
				foreach ($myterms as $term_list) {
				$st_getTerms [$term_list->term_id] = $term_list->name;
				$currentID = $term_list->term_id;
				if($currentID == $custom_post_id)
					$extra = 'selected' and
					$widgetExtraTitle = $term_list->name;
				else
					$extra = '';
					echo '<option value="'.$currentID.'" '.$extra.'>'.$term_list->name.'</option>';
				}
				if (empty($term_list->name)) {
					echo '<option value="empty">No slideshows available</option>';
				}
				?>
				</select>
			</label>
		</p>

		<fieldset>
			<legend>Slideshow Effect</legend>
			<select id="<?php echo $this->get_field_id( 'slideshow_type' ); ?>" name="<?php echo $this->get_field_name( 'slideshow_type' ); ?>" class="widefat" style="width:100%;">
					 <option <?php if ( 'Slide' == $instance['slideshow_type'] ) echo 'selected="selected"'; ?>>Slide</option>
					 <option <?php if ( 'Fade' == $instance['slideshow_type'] ) echo 'selected="selected"'; ?>>Fade</option>
					 <option <?php if ( 'Crossfade' == $instance['slideshow_type'] ) echo 'selected="selected"'; ?>>Crossfade</option>
				</select>
		</fieldset>

			<p>
				<label for="<?php echo $this->get_field_id( 'slideshow_width' ); ?>">Slideshow Width</label><br />
				<input type="text" id="<?php echo $this->get_field_id( 'slideshow_width' ); ?>" name="<?php echo $this->get_field_name( 'slideshow_width' ); ?>" value="<?php echo $instance['slideshow_width']; ?>">
				<br />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'slideshow_height' ); ?>">Slideshow Height</label><br />
				<input type="text" id="<?php echo $this->get_field_id( 'slideshow_height' ); ?>" name="<?php echo $this->get_field_name( 'slideshow_height' ); ?>" value="<?php echo $instance['slideshow_height']; ?>">
				<br />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'slideshow_autoheight' ); ?>">Auto Height</label><br />
				<select id="<?php echo $this->get_field_id( 'slideshow_autoheight' ); ?>" name="<?php echo $this->get_field_name( 'slideshow_autoheight' ); ?>" class="widefat" style="width:100%;">
						<option <?php if ( 'true' == $instance['slideshow_autoheight'] ) echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $instance['slideshow_autoheight'] ) echo 'selected="selected"'; ?>>false</option>
				</select>

				<br />
			</p>


		<fieldset>
					<legend>Slideshow Speed (transtion length)</legend>
					<select id="<?php echo $this->get_field_id( 'slideshow_speed' ); ?>" name="<?php echo $this->get_field_name( 'slideshow_speed' ); ?>" class="widefat" style="width:100%;">
							 <option <?php if ( '1000' == $instance['slideshow_speed'] ) echo 'selected="selected"'; ?>>1000</option>
							 <option <?php if ( '700' == $instance['slideshow_speed'] ) echo 'selected="selected"'; ?>>700</option>
							 <option <?php if ( '600' == $instance['slideshow_speed'] ) echo 'selected="selected"'; ?>>600</option>
							 <option <?php if ( '500' == $instance['slideshow_speed'] ) echo 'selected="selected"'; ?>>500</option>
							 <option <?php if ( '400' == $instance['slideshow_speed'] ) echo 'selected="selected"'; ?>>400</option>
							 <option <?php if ( '300' == $instance['slideshow_speed'] ) echo 'selected="selected"'; ?>>300</option>
							 <option <?php if ( '200' == $instance['slideshow_speed'] ) echo 'selected="selected"'; ?>>200</option>
					</select>

		</fieldset>

		<fieldset>
					<legend>Auto Play (slide duration in ms)</legend>
					<select id="<?php echo $this->get_field_id( 'slideshow_autoplay' ); ?>" name="<?php echo $this->get_field_name( 'slideshow_autoplay' ); ?>" class="widefat" style="width:100%;">
					<option <?php if ( 'false' == $instance['slideshow_autoplay'] ) echo 'selected="selected"'; ?>value="false">Paused</option>
					<option <?php if ( '1000' == $instance['slideshow_autoplay'] ) echo 'selected="selected"'; ?>>1000</option>
					<option <?php if ( '2000' == $instance['slideshow_autoplay'] ) echo 'selected="selected"'; ?>>2000</option>
					<option <?php if ( '3000' == $instance['slideshow_autoplay'] ) echo 'selected="selected"'; ?>>3000</option>
					<option <?php if ( '4000' == $instance['slideshow_autoplay'] ) echo 'selected="selected"'; ?>>4000</option>
					<option <?php if ( '5000' == $instance['slideshow_autoplay'] ) echo 'selected="selected"'; ?>>5000</option>
					<option <?php if ( '6000' == $instance['slideshow_autoplay'] ) echo 'selected="selected"'; ?>>6000</option>
					<option <?php if ( '7000' == $instance['slideshow_autoplay'] ) echo 'selected="selected"'; ?>>7000</option>
					<option <?php if ( '8000' == $instance['slideshow_autoplay'] ) echo 'selected="selected"'; ?>>8000</option>
					<option <?php if ( '9000' == $instance['slideshow_autoplay'] ) echo 'selected="selected"'; ?>>9000</option>
					<option <?php if ( '10000' == $instance['slideshow_autoplay'] ) echo 'selected="selected"'; ?>>10000</option>
					</select>
		</fieldset>

		<fieldset>
					<legend>Show Pagination</legend>
					<select id="<?php echo $this->get_field_id( 'slideshow_pagination' ); ?>" name="<?php echo $this->get_field_name( 'slideshow_pagination' ); ?>" class="widefat" style="width:100%;">
						<option <?php if ( 'true' == $instance['slideshow_pagination'] ) echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $instance['slideshow_pagination'] ) echo 'selected="selected"'; ?>>false</option>
					</select>
		</fieldset>

		<fieldset>
			<legend>Show Prev/Next Arrows</legend>
					<select id="<?php echo $this->get_field_id( 'slideshow_prevnext' ); ?>" name="<?php echo $this->get_field_name( 'slideshow_prevnext' ); ?>" class="widefat" style="width:100%;">
						<option <?php if ( 'true' == $instance['slideshow_prevnext'] ) echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $instance['slideshow_prevnext'] ) echo 'selected="selected"'; ?>>false</option>
					</select>
		</fieldset>


		<?php
	}
} // end class
function sliderWidgetInit() {register_widget('custom_post_widget');}
add_action('widgets_init', 'sliderWidgetInit');
// End Slider Widget


?>