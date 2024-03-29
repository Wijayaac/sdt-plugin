<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://https://wijayaac.netlify.app/
 * @since      1.0.0
 *
 * @package    Surya_Dt
 * @subpackage Surya_Dt/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Surya_Dt
 * @subpackage Surya_Dt/public
 * @author     Kadek wijaya <wijayatesting.app@gmail.com>
 */
class Surya_Dt_Public
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/surya-dt-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/surya-dt-public.js', array('jquery'), $this->version, false);

		if (!class_exists('Redux')) {
			return;
		}

		$apiKey = Redux::get_option('sdt_test', 'opt-api-key');

		// Define an array to store the script details
		$scripts = array(
			array(
				'handle' => 'google-maps',
				'src' => 'https://maps.googleapis.com/maps/api/js?key=' . $apiKey,
				'deps' => array(),
			),
			array(
				'handle' => 'geoxml3',
				'src' => 'https://cdn.jsdelivr.net/gh/geocodezip/geoxml3/polys/geoxml3.js',
				'deps' => array('google-maps'),
			),
			array(
				'handle' => 'epolyv3',
				'src' => plugin_dir_url(__FILE__) . 'js/v3_epoly.js',
				'deps' => array('google-maps', 'geoxml3'),
			)
		);

		// Loop through the scripts array and register/enqueue the scripts
		foreach ($scripts as $script) {
			wp_register_script($script['handle'], $script['src'], $script['deps'], $this->version, false);
			wp_enqueue_script($script['handle']);
		}
	}
}
