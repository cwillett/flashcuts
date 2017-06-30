<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Setup for customizer of this theme
 *
 * @package   InsightFramework
 */
class Insight_Customize {

	/**
	 * The constructor.
	 */
	public function __construct() {
		// Build URL for customizer.
		add_filter( 'kirki/values/get_value', array( $this, 'kirki_db_get_theme_mod_value' ), 10, 2 );

		// Force load all variants and subsets.
		add_action( 'after_setup_theme', array( $this, 'load_all_variants_and_subsets' ) );

		// Remove unused native sections and controls.
		add_action( 'customize_register', array( $this, 'remove_customizer_sections' ) );

		// Load customizer sections when all widgets init
		add_action( 'widgets_init', array( $this, 'load_customizer' ), 99 );
	}

	/**
	 * Load Customizer.
	 */
	public function load_customizer() {
		Insight::require_file( 'customizer/customizer.php' );
	}

	/**
	 * Active Callback functions
	 *
	 * @since  0.9.2
	 * @access public
	 */

	public static function return_is_page() {
		return is_page();
	}

	/**
	 * Remove unused native sections and controls
	 *
	 * @since 0.9.3
	 *
	 * @param $wp_customize
	 */
	public function remove_customizer_sections( $wp_customize ) {
		$wp_customize->remove_section( 'nav' );
		$wp_customize->remove_section( 'colors' );
		$wp_customize->remove_section( 'background_image' );
		$wp_customize->remove_section( 'header_image' );
		$wp_customize->remove_control( 'blogdescription' );
		$wp_customize->remove_control( 'display_header_text' );
	}

	/**
	 * Force load all variants and subsets
	 *
	 * @since 0.9
	 */
	public function load_all_variants_and_subsets() {
		if ( class_exists( 'Kirki_Fonts_Google' ) ) {
			Kirki_Fonts_Google::$force_load_all_variants = true;
		}
	}

	/**
	 * Build URL for customizer
	 *
	 * @since  0.9
	 * @access public
	 *
	 * @param $value
	 * @param $setting
	 *
	 * @return mixed
	 */
	public function kirki_db_get_theme_mod_value( $value, $setting ) {
		static $settings;

		/*
		 * Setup url.
		 */
		if ( is_null( $settings ) ) {
			$settings = array();
			if ( ! empty( $_GET ) ) {
				foreach ( $_GET as $key => $query_value ) {
					if ( ! empty( Kirki::$fields[ $key ] ) ) {
						$settings[ $key ] = $query_value;
						if ( is_array( Kirki::$fields[ $key ] ) && 'kirki-preset' == Kirki::$fields[ $key ]['type'] && ! empty( Kirki::$fields[ $key ]['choices'] ) && ! empty( Kirki::$fields[ $key ]['choices'][ $query_value ] ) && ! empty( Kirki::$fields[ $key ]['choices'][ $query_value ]['settings'] ) ) {
							foreach ( Kirki::$fields[ $key ]['choices'][ $query_value ]['settings'] as $kirki_setting => $kirki_value ) {
								$settings[ $kirki_setting ] = $kirki_value;
							}
						}
					}
				}
			}
		}

		if ( isset ( $settings[ $setting ] ) ) {
			return $settings[ $setting ];
		}

		return $value;
	}

}
