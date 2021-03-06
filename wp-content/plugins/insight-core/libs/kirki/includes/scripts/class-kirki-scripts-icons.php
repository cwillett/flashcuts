<?php
/**
 * Try to automatically generate the script necessary for adding icons to panels & section
 *
 * @package     Kirki
 * @category    Core
 * @author      Aristeides Stathopoulos
 * @copyright   Copyright (c) 2016, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       2.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kirki_Scripts_Icons' ) ) {

	/**
	 * Adds scripts for icons in sections & panels.
	 */
	class Kirki_Scripts_Icons {

		/**
		 * The script generated for ALL fields
		 *
		 * @static
		 * @access public
		 * @var string
		 */
		public static $icons_script = '';

		/**
		 * Whether the script has already been added to the customizer or not.
		 *
		 * @static
		 * @access public
		 * @var bool
		 */
		public static $script_added = false;

		/**
		 * The class constructor
		 */
		public function __construct() {
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'enqueue_script' ), 99 );
		}

		/**
		 * This works on a per-field basis.
		 * Once created, the script is added to the $icons_script property.
		 *
		 * @static
		 * @access public
		 *
		 * @param array $args The field definition.
		 *
		 * @return void
		 */
		public static function generate_script( $args = array() ) {

			// If "icon" is not specified then no need to proceed.
			if ( ! isset( $args['icon'] ) || '' === $args['icon'] ) {
				return;
			}

			// If the panel or section ID is not defined then early exit.
			if ( ! isset( $args['id'] ) ) {
				return;
			}

			$element = '#accordion-panel-' . $args['id'] . ' > h3, #accordion-panel-' . $args['id'] . ' .panel-title';
			if ( false !== strpos( $args['icon'], 'dashicons' ) ) {
				$args['icon'] = 'dashicons ' . $args['icon'];
			}

			$script = '$("' . $element . '").prepend(\'<span class="' . esc_attr( $args['icon'] ) . '" style="vertical-align:text-bottom"></span> \');';

			if ( false === strpos( self::$icons_script, $script ) ) {
				self::$icons_script .= $script;
			}

		}

		/**
		 * Format the script in a way that will be compatible with WordPress.
		 */
		public function enqueue_script() {
			if ( ! self::$script_added && '' !== self::$icons_script ) {
				self::$script_added = true;
				// @codingStandardsIgnoreStart
				echo '<script>jQuery(document).ready(function($) { "use strict"; ' . self::$icons_script . '});</script>';
				// @codingStandardsIgnoreEnd
			}
		}
	}
}
