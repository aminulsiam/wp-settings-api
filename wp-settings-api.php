<?php

/**
 * Plugin Name wordpress settings api
 *
 * @package     PluginPackage
 * @author      Aminul haq siam
 * @license     GPL
 *
 * @wordpress-plugin
 * Plugin Name: wp-settings-api
 * Plugin URI:  https://example.com/plugin-name
 * Description: WP settings api class for easily create settings api
 * Version:     1.0.0
 * Author:      Aminul haq mallik
 * Author URI:  https://example.com
 * Text Domain: wp_settings_api
 * License:     GPL
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


/**
 *  Include the main class file
 */
require_once plugin_dir_path(__FILE__) . "src/class.wp-settings-api.php";


/**
 *  Instance the main class
 *
 *  No @param
 */
new WP_Settings_Api();