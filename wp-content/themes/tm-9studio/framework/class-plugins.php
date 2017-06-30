<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin installation and activation for WordPress themes
 *
 * @package InsightFramework
 * @since   0.9.7
 */
class Insight_Register_Plugins {

	/**
	 * Insight_Register_Plugins constructor.
	 */
	public function __construct() {
		add_filter( 'insight_core_tgm_plugins', array( $this, 'register_required_plugins' ) );
	}

	public function register_required_plugins() {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
			array(
				'name'     => esc_html__( 'Insight Core', 'tm-9studio' ),
				'slug'     => 'insight-core',
				'source'   => 'http://api.insightstud.io/update/9studio/plugins/insight-core-143.zip',
				'version'  => '1.4.3',
				'required' => true,
			),
			array(
				'name'     => esc_html__( 'Visual Composer', 'tm-9studio' ),
				'slug'     => 'js_composer',
				'source'   => 'https://bitbucket.org/digitalcreative/thememove-plugins/raw/ef2ed0e05410ea71af3b258eb5152b8f61ba3808/js_composer.zip',
				'version'  => '5.1.1',
				'required' => true,
			),
			array(
				'name'     => esc_html__( 'Revolution Slider', 'tm-9studio' ),
				'slug'     => 'revslider',
				'source'   => 'https://bitbucket.org/digitalcreative/thememove-plugins/raw/ef2ed0e05410ea71af3b258eb5152b8f61ba3808/revslider.zip',
				'version'  => '5.4.2',
				'required' => true,
			),
			array(
				'name'     => 'Vafpress Post Formats UI',
				'slug'     => 'vafpress-post-formats-ui-develop',
				'source'   => 'http://api.insightstud.io/update/9studio/plugins/vafpress-post-formats-ui-develop.zip',
				'required' => true,
				'version'  => '1.5',
			),
			array(
				'name'     => esc_html__( 'MailChimp for WordPress', 'tm-9studio' ),
				'slug'     => 'mailchimp-for-wp',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Contact Form 7', 'tm-9studio' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			),
		);

		return $plugins;
	}

}
