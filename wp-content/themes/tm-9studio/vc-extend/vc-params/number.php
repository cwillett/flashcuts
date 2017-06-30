<?php
/**
 * Class Insight_Param_Number
 *
 * @package tm-9studio
 */

/*
 * Example
    array(
        'type'       => 'number',
        'heading'    => esc_html__( 'Number field', 'tm-9studio' ),
        'param_name' => 'number_field',
        'value'      => 100,
        'min'        => 10,
        'max'        => 100,
        'step'       => 1,
        'suffix'     => 'px',
    ),
*/
if ( ! class_exists( 'Insight_Param_Number' ) ) {

	class Insight_Param_Number {

		private $settings = array();

		private $value = '';

		/**
		 * @param $settings
		 * @param $value
		 */
		public function __construct( $settings, $value ) {
			$this->settings = $settings;
			$this->value    = $value;
		}

		public function render() {
			$param_name = isset( $this->settings['param_name'] ) ? $this->settings['param_name'] : '';
			$min        = isset( $this->settings['min'] ) ? $this->settings['min'] : '';
			$max        = isset( $this->settings['max'] ) ? $this->settings['max'] : '';
			$step       = isset( $this->settings['step'] ) ? $this->settings['step'] : '';
			$suffix     = isset( $this->settings['suffix'] ) ? $this->settings['suffix'] : '';

			$output = '<div class="tm_number">';
			$output .= '<input type="button" value="-" class="minus" />';
			$output .= '<input type="number" min="' . esc_attr( $min ) . '"' . ' max="' . esc_attr( $max ) . '"' . ' step="' . esc_attr( $step ) . '"' . ' class="wpb_vc_param_value ' . esc_attr( $param_name ) . '"' . ' name="' . esc_attr( $param_name ) . '"' . ' value="' . esc_attr( $this->value ) . '" />';
			$output .= '<input type="button" value="+" class="plus" />' . '<span>' . $suffix . '</span>';
			$output .= '</div>';

			return $output;
		}
	}
}

if ( class_exists( 'Insight_Param_Number' ) ) {

	function insight_param_number_settings_field( $settings, $value ) {

		$number = new Insight_Param_Number( $settings, $value );

		return $number->render();
	}

	WpbakeryShortcodeParams::addField( 'number', 'insight_param_number_settings_field', INSIGHT_THEME_URI . '/assets/admin/js/thememove_number.js' );
}
