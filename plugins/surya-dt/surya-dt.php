<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://wijayaac.netlify.app/
 * @since             1.0.0
 * @package           Surya_Dt
 *
 * @wordpress-plugin
 * Plugin Name:       Surya DT Test
 * Plugin URI:        https://wijayaac (Kadek Wijaya) · GitHub
 * Description:       Plugins Test for Shopify Dev application
 * Version:           1.0.0
 * Author:            Kadek wijaya
 * Author URI:        https://https://wijayaac.netlify.app//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       surya-dt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('SURYA_DT_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-surya-dt-activator.php
 */
function activate_surya_dt()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-surya-dt-activator.php';
	Surya_Dt_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-surya-dt-deactivator.php
 */
function deactivate_surya_dt()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-surya-dt-deactivator.php';
	Surya_Dt_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_surya_dt');
register_deactivation_hook(__FILE__, 'deactivate_surya_dt');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-surya-dt.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_surya_dt()
{

	$plugin = new Surya_Dt();
	$plugin->run();
}
run_surya_dt();
