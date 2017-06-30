<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Initial OneClick import for this theme
 *
 * @package   InsightFramework
 */
class Insight_Import {

	/**
	 * The constructor.
	 */
	public function __construct() {
		// Import Demo
		add_filter( 'insight_core_import_demos', array( $this, 'import_demos' ) );

		// Import package url
		add_filter( 'insight_core_import_package_url', array( $this, 'import_package_url' ) );
	}

	/**
	 * Import Demo
	 *
	 * @since 0.9
	 */
	public function import_demos() {
		return array(
			'9studio2' => array(
				'screenshot' => INSIGHT_THEME_URI . '/screenshot.jpg',
				'name'       => '9studio 2.0',
				'url'        => 'http://api.insightstud.io/update/9studio/import/tm-9studio-9studio2.zip',
			),
		);
	}
}
