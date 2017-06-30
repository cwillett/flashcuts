<?php
/**
 * Load Insight Framework.
 *
 * @since 0.9.4
 */

require_once( get_template_directory() . '/framework/class-posttypes.php' );
require_once( get_template_directory() . '/framework/class-compatible.php' );
require_once( get_template_directory() . '/framework/class-customize.php' );
require_once( get_template_directory() . '/framework/class-detect.php' );
require_once( get_template_directory() . '/framework/class-enqueue.php' );
require_once( get_template_directory() . '/framework/class-extras.php' );
require_once( get_template_directory() . '/framework/class-fonticon.php' );
require_once( get_template_directory() . '/framework/class-functions.php' );
require_once( get_template_directory() . '/framework/class-helper.php' );
require_once( get_template_directory() . '/framework/class-import.php' );
require_once( get_template_directory() . '/framework/class-init.php' );
require_once( get_template_directory() . '/framework/class-kirki.php' );
require_once( get_template_directory() . '/framework/class-metabox.php' );
require_once( get_template_directory() . '/framework/class-plugins.php' );
require_once( get_template_directory() . '/framework/class-security.php' );
require_once( get_template_directory() . '/framework/class-static.php' );
require_once( get_template_directory() . '/framework/class-templates.php' );
require_once( get_template_directory() . '/framework/class-widget.php' );
require_once( get_template_directory() . '/framework/class-menu.php' );
require_once( get_template_directory() . '/framework/class-statistics.php' );
require_once( get_template_directory() . '/framework/class-like.php' );

require_once( get_template_directory() . '/framework/tgm-plugin-activation.php' );
require_once( get_template_directory() . '/framework/tgm-plugin-registration.php' );

// Extend VC
if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {
	require_once( get_template_directory() . '/vc-extend/index.php' );
}

/**
 * Init the theme
 *
 * @since 0.9.4
 */
Insight_Init::instance();
