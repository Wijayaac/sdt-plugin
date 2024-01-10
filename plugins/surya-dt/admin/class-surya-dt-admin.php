<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://wijayaac.netlify.app/
 * @since      1.0.0
 *
 * @package    Surya_Dt
 * @subpackage Surya_Dt/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Surya_Dt
 * @subpackage Surya_Dt/admin
 * @author     Kadek wijaya <wijayatesting.app@gmail.com>
 */
class Surya_Dt_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->custom_fields();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Surya_Dt_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Surya_Dt_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/surya-dt-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Surya_Dt_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Surya_Dt_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/surya-dt-admin.js', array('jquery'), $this->version, false);
	}

	public function custom_fields()
	{
		if (!class_exists('ReduxFramework') && file_exists(plugin_dir_path(__FILE__) . 'redux-framework/redux-core/framework.php')) {
			require_once(plugin_dir_path(__FILE__) . 'redux-framework/redux-core/framework.php');
		}

		if (!class_exists('Redux')) {
			return;
		}

		$opt_name = 'sdt_test';

		$theme = wp_get_theme(); // For use with some settings. Not necessary.

		$args = array(
			'display_name'         => $theme->get('Name'),
			'display_version'      => $theme->get('Version'),
			'menu_title'           => esc_html__('Surya DT', 'sdt-plugin'),
			'customizer'           => true,
		);

		Redux::set_args($opt_name, $args);

		Redux::set_section(
			$opt_name,
			array(
				'title'  => esc_html__('Basic Field', 'sdt-plugin'),
				'id'     => 'basic',
				'icon'   => 'el el-home',
				'desc' 	 => esc_html__('Use this short code in the page/post :  [sdt_shortcode]', 'sdt-plugin'),
				'fields' => array(
					// TODO: add field for google maps API Key in string format
					array(
						'id'       => 'opt-api-key',
						'type'     => 'text',
						'title'    => esc_html__('Google Maps API Key', 'sdt-plugin'),
						'desc'     => esc_html__('Google Maps API Key', 'sdt-plugin'),
						'subtitle' => esc_html__('Google Maps API Key', 'sdt-plugin'),
						'hint'     => array(
							'content' => 'Google Maps API Key',
						)
					),
					// TODO: add field for URL KML file in string format
					array(
						'id'       => 'opt-kml-url',
						'type'     => 'text',
						'title'    => esc_html__('KML URL', 'sdt-plugin'),
						'desc'     => esc_html__('KML URL', 'sdt-plugin'),
						'subtitle' => esc_html__('KML URL', 'sdt-plugin'),
						'hint'     => array(
							'content' => 'KML URL',
						)
					),
					// TODO: add field for CTA link inside location in string format
					array(
						'id'       => 'opt-cta-link-inside',
						'type'     => 'text',
						'title'    => esc_html__('CTA Link area Inside', 'sdt-plugin'),
						'desc'     => esc_html__('CTA Link area Inside', 'sdt-plugin'),
						'subtitle' => esc_html__('CTA Link area Inside', 'sdt-plugin'),
						'hint'     => array(
							'content' => 'CTA Link',
						)
					),
					// TODO: add field for CTA link outside location in string format
					array(
						'id'       => 'opt-cta-link-outside',
						'type'     => 'text',
						'title'    => esc_html__('CTA Link area Outside', 'sdt-plugin'),
						'desc'     => esc_html__('CTA Link area Outside', 'sdt-plugin'),
						'subtitle' => esc_html__('CTA Link area Outside', 'sdt-plugin'),
						'hint'     => array(
							'content' => 'CTA Link',
						)
					),
					// TODO: Add field optional for longitude and latitude in string format
					array(
						'id'       => 'opt-latitude',
						'type'     => 'text',
						'title'    => esc_html__('Latitude', 'sdt-plugin'),
						'desc'     => esc_html__('Latitude', 'sdt-plugin'),
						'subtitle' => esc_html__('Latitude', 'sdt-plugin'),
						'default' => '-37.81230754760852',
						'hint'     => array(
							'content' => 'Latitude Optional if you want set the initial center location',
						)
					),
					array(
						'id'       => 'opt-longitude',
						'type'     => 'text',
						'title'    => esc_html__('Longitude', 'sdt-plugin'),
						'desc'     => esc_html__('Longitude', 'sdt-plugin'),
						'subtitle' => esc_html__('Longitude', 'sdt-plugin'),
						'default' => '144.9624813912677',
						'hint'     => array(
							'content' => 'Longitude Optional if you want set the initial center location',
						)
					),
				)
			)
		);
	}
}
