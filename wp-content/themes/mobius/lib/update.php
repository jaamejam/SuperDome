<?php

//add_thickbox();
function st_update_modal() {
	wp_enqueue_style('thickbox');
	wp_enqueue_script('thickbox');
}
add_action('admin_enqueue_scripts', 'st_update_modal');

add_filter('pre_set_site_transient_update_themes', 'check_for_update');

$api_url 		= 'http://update.simplethemes.com/';
$theme 			= wp_get_theme();
$parent 		= $theme->parent();
$parent_theme 	= $theme['Template']; // parent theme directory
$theme_version 	= $parent['Version'];
$theme_base 	= $theme->get('Template');
$theme_name 	= $theme['Name'];

function check_for_update($checked_data) {
	global $wp_version, $theme_version, $theme_base, $api_url;

	$request = array(
		'slug' => $theme_base,
		'version' => $theme_version
	);

	// Check for Updates
	$send_for_check = array(
		'body' => array(
			'action' => 'theme_update',
			'request' => serialize($request),
			'api-key' => md5(get_bloginfo('url'))
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
	);

	$raw_response = wp_remote_post($api_url, $send_for_check);

	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
		$response = unserialize($raw_response['body']);

	// Feed the update data into WP updater
	if (!empty($response))
		$checked_data->response[$theme_base] = $response;

	return $checked_data;
}



// Theme info screen
add_filter('themes_api', 'my_theme_api_call', 10, 3);

function my_theme_api_call($def, $action, $args) {
	global $theme_base, $api_url, $theme_version, $api_url;

	if ($args->slug != $theme_base)
		return false;

	// Get the current version

	$args->version = $theme_version;
	$request_string = prepare_request($action, $args);
	$request = wp_remote_post($api_url, $request_string);

	if (is_wp_error($request)) {
		$res = new WP_Error('themes_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
	} else {
		$res = unserialize($request['body']);

		if ($res === false)
			$res = new WP_Error('themes_api_failed', __('An unknown error occurred'), $request['body']);
	}

	return $res;
}

// Admin Notice

function st_admin_notice(){
	if(isset($_GET['update_check']) && !isset($_GET['settings-updated'])) {
		set_site_transient('update_themes', null);

		// Get some theme info

		$theme 			= wp_get_theme();
		$parent 		= $theme->parent();
		$parent_theme 	= $theme->get('Template'); // parent theme directory
		$theme_version 	= $parent['Version'];
		$theme_base 	= $theme->get('Template');
		$theme_name 	= $theme['Name'];


		// echo '<pre>';
		// print_r($theme->parent()['Version']);
		// echo '</pre>';

		// Remote Theme Info
		$object = check_for_update($checked_data);
		$item = array($object->response);
		$update = $item[0][$parent_theme];
		$remote_version = $update['new_version'];
		$details_url = add_query_arg(array('TB_iframe' => 'true'),$update['url']);
		$update_url = wp_nonce_url('update.php?action=upgrade-theme&amp;theme=' . urlencode($parent_theme), 'upgrade-theme_' . $parent_theme);
		$update_onclick = 'onclick="if ( confirm(\'' . esc_js( __("Updating will overwrite the parent theme.  'Cancel' to stop, 'OK' to update.") ) . '\') ) {return true;}return false;"';


		// Update Available
		if (!is_multisite() && $remote_version && $remote_version > $theme_version) {
			if (!current_user_can('update_themes'))
				$message	= sprintf( '<p><strong>' . __('There is a new version of %1$s available. <a href="%2$s" class="thickbox" title="%1$s">View version %3$s details</a>.') . '</strong></p>', $parent_theme, $details_url, $update['new_version']);
			else if ( empty($update['package']) )
				$message	= sprintf( '<p><strong>' . __('There is a new version of %1$s available. <a href="%2$s" class="thickbox" title="%1$s">View version %3$s details</a>. <em>Automatic update is unavailable for this theme.</em>') . '</strong></p>', $parent_theme, $details_url, $update['new_version']);
			else
				$message	= sprintf( '<p><strong>' . __('There is a new version of %1$s available. <a href="%2$s" class="thickbox" title="%1$s">View version %3$s details</a> or <a href="%4$s" %5$s>update automatically</a>.') . '</strong></p>', $parent_theme, $details_url, $update['new_version'], $update_url, $update_onclick );
		}


		// Theme is up to date
		if (is_null($remote_version)) {
			$message	.= '<p><strong>Your theme is up to date!</strong></p>';
      		$message	.= '<p>'.ucfirst($parent_theme).' version '.$theme_version.'</p>';
		}

	  echo '<div class="updated" style="margin:1.5em 0;">'.$message.'</div>';
		// Debug
		// var_dump($item);
		// print_r($item);

	} // endif
}
add_action('admin_notices', 'st_admin_notice');



if (is_admin())
	$current = get_transient('update_themes');
	// print '<h1>Update: '.$current.'</h1>';
	//set_site_transient('update_themes', null);
?>