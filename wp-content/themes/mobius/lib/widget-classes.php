<?php
/*
Plugin Name: Widget Classes
Plugin URI: http://blog.aizatto.com/widget-classes
Description: Allows you to add classes to widgets
Author: Ezwan Aizat Bin Abdullah Faiz
Author URI: http://aizatto.com
Version: 0.1
License: LGPLv2
*/

// wp-includes/widgets.php:273

class WidgetClasses {
	/**
     * Ideally all classes are children of the WP_Widget class.
     *
     * Sometimes they are not, for example 'twitter-for-wordpress' and 'akismet'.
     *
     * For these widgets which avoid using WP_Widget class, they circumvent a hook which
     * allows me to append the CSS Class form to the bottom of the widget.
     *
     * Instead we intercept the hook, and have it call our own function, which
     * will allow us to inject our the form into the widget.
	 */
	public static function sidebar_admin_setup() {
		global $wp_registered_widget_controls;

		foreach ($wp_registered_widget_controls as $widget_id => $options) {
			if (is_array($options['callback'])) {
				continue;
			}

			$wp_registered_widget_controls[$widget_id]['_params']   = $wp_registered_widget_controls[$widget_id]['params'];
			$wp_registered_widget_controls[$widget_id]['_callback'] = $wp_registered_widget_controls[$widget_id]['callback'];
			//$wp_registered_widget_controls[$widget_id]['params']   = $widget_id;
			//$wp_registered_widget_controls[$widget_id]['callback'] = array(__CLASS__, 'intercept');
			$wp_registered_widget_controls[$widget_id]['params']   = $wp_registered_widget_controls[$widget_id]['params'];
			$wp_registered_widget_controls[$widget_id]['callback'] = $wp_registered_widget_controls[$widget_id]['callback'];
			// echo '<pre>';
			// print_r($options);
			// echo '</pre>';
		}
	}

	/**
     * Injects the CSS class into the 'before_widget' value
     */
	public static function dynamic_sidebar_params($params) {
		global $wp_registered_sidebars, $wp_registered_widgets;

		$widget_id = $params[0]['widget_id'];
		$widget = $wp_registered_widgets[$widget_id];

		if (! is_array($widget['callback'])) {
			$options = get_option('widget_classes', array());

			if (! array_key_exists($widget_id, $options)) {
				return $params;
			}

			$class = $options[$widget_id];

		// } else {
		} elseif (is_object($widget['callback'][0]) && is_callable( array($widget['callback'][0], 'get_settings') )) {
			$instance = $widget['callback'][0]->get_settings();
			// $instance	= get_option($widget['callback'][0]->option_name);

			if (! array_key_exists($params[1]['number'], $instance)) {
				return $params;
			}

			$instance = $instance[$params[1]['number']];

			if (! is_array($instance) || ! array_key_exists('class', $instance)) {
				return $params;
			}

			$class = $instance['class'];
		}

		$classname_ = '';
		foreach ( (array) $widget['classname'] as $cn ) {
			if ( is_string($cn) )
				$classname_ .= '_' . $cn;
			elseif ( is_object($cn) )
				$classname_ .= '_' . get_class($cn);

		}
		$classname_ = ltrim($classname_, '_');
		$classname_ .= ' ' . $class;

		$before_widget = $wp_registered_sidebars[$params[0]['id']]['before_widget'];
		$params[0]['before_widget'] = sprintf($before_widget, $widget['id'], $classname_);

		// if (isset($options[$widget_id])) {
		// 	echo '<pre>';
		// 	print_r($options[$widget_id]);
		// 	print_r($classname_);
		// 	echo '</pre>';
		// }

		return $params;
	}

	/**
     * Our hook which allows us to intercept and inject into widgets which
     * do not use WP_Widget
     */

	public static function intercept($widget_id) {
		global $wp_registered_widget_controls;
		$args = func_get_args();


		if (function_exists('dynwid_add_widget_control')) {
		$widget_id = $args[0]['widget_id'];
		} else {
		$widget_id = $args[0];
		}

		$callback = $wp_registered_widget_controls[$widget_id]['_callback'];
		$params   = $wp_registered_widget_controls[$widget_id]['_params'];
		$return   = call_user_func_array($callback, $params);

		$options = get_option('widget_classes', array());

		if (!array_key_exists($widget_id, $options)) {
			$options[$widget_id] = '';
		}

		$old_class = $new_class = $options[$widget_id];

		if (array_key_exists($widget_id . '-class', $_POST)) {
			$new_class = $options[$widget_id] = $_POST[$widget_id . '-class'];
		}

		WidgetClasses::widgetform($widget_id . '-class', $widget_id . '-class', $new_class);

		if ($old_class != $new_class) {
			update_option('widget_classes', $options);
		}
		// echo '<pre>';
		// print_r($options[$widget_id]);
		// echo '</pre>';

		return $return;

	}

	/**
     * Hook used by WP_Widget and its children
     */
	public static function in_widget_form($widget, $return, $instance) {
		$instance = wp_parse_args( (array) $instance, array( 'class' => '' ) );
		$class = strip_tags($instance['class']);

		$return = null;
		WidgetClasses::widgetform($widget->get_field_id('class'), $widget->get_field_name('class'), $class);
	}

	/**
     * Simple form to expose the CSS Class form.
     */
	public static function widgetform($id, $name, $value) {
	?>
		<p>
			<label>
				Widget Style:
				<select id="<?php echo $id; ?>" name="<?php echo $name; ?>">
					<option value="S" <?php if ($value == "S") {echo "selected=\"selected\"";}?>>Default (unstyled)</option>
					<option value="S1" <?php if ($value == "S1") {echo "selected=\"selected\"";}?>>Style 1</option>
					<option value="S2" <?php if ($value == "S2") {echo "selected=\"selected\"";}?>>Style 2</option>
					<option value="S3" <?php if ($value == "S3") {echo "selected=\"selected\"";}?>>Style 3</option>
				</select>
			</label>
		</p>
<?php
	}

	/**
     * Hook used by WP_Widget and its children
     */
	public static function widget_update_callback($instance, $new_instance, $old_instance, $widget) {
		if (array_key_exists('class', $new_instance)) {
			$instance['class'] = str_replace(',', ' ', $new_instance['class']);
		}

		return $instance;
	}
}
add_action('in_widget_form',         array('WidgetClasses', 'in_widget_form'), 15, 4);
add_filter('widget_update_callback', array('WidgetClasses', 'widget_update_callback'), 15, 4);
add_filter('dynamic_sidebar_params', array('WidgetClasses', 'dynamic_sidebar_params'));
add_filter('sidebar_admin_setup',    array('WidgetClasses', 'sidebar_admin_setup'));

?>