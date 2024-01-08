<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://wijayaac.netlify.app/
 * @since      1.0.0
 *
 * @package    Surya_Dt
 * @subpackage Surya_Dt/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Surya_Dt
 * @subpackage Surya_Dt/includes
 * @author     Kadek wijaya <wijayatesting.app@gmail.com>
 */
class Surya_Dt_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'surya-dt',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
