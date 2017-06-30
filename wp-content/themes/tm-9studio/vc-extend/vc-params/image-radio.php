<?php
/**
 * Class Insight_Param_ImgRadio
 *
 * @package InsightStudio
 */

/*
 * Example
	array(
		'type'       => 'imgradio',
		'heading'    => esc_html__( 'Style', 'tm-9studio' ),
		'param_name' => 'imgrad-style',
		'value'     => array(
				'style1' => array(
					'img' => 'https://cdn1.iconfinder.com/data/icons/clothes-accesories-2/96/Glasses-2-128.png',
					'title' => 'Style 1',
				),
				'style2' => 'https://cdn1.iconfinder.com/data/icons/hipster-style-2/96/Mustache-7-128.png',
				'style3' => array(
					'img' => 'https://cdn1.iconfinder.com/data/icons/clothes-accesories-2/96/Blouse-128.png',
					'title' => 'Style 3',
				),
			),
		)
*/
if ( ! class_exists( 'Insight_Param_ImgRadio' ) ) {

	class Insight_Param_ImgRadio {

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
			$values     = isset( $this->settings['value'] ) ? $this->settings['value'] : '';

			// if( empty($value) && isset($this->settings['std']) && !empty($this->settings['std']) ) {
			// 	$this->value = $this->settings['std'];
			// }

			$output = '<div class="imgradio">';
			foreach ( $values as $value => $label ) {
				$title = '';
				if ( is_array( $label ) ) {
					$title = 'data-balloon-pos="up" data-balloon-length="small" data-balloon="' . $label['title'] . '" ';
					$label = $label['img'];
				}
				$radio_id = uniqid( 'imgrad-' );
				$checked  = ( $value == $this->value ) ? 'checked="checked"' : '';
				$selected = ( $value == $this->value ) ? 'class="selected"' : '';
				//$param_class = ( $value == $this->value ) ? 'class="wpb_vc_param_value"' : '';

				$output .= '<input type="radio" name="rdimg-' . $param_name . '" id="' . $radio_id . '" ' . $checked . ' value="' . $value . '" data-target="#' . $param_name . '" />';
				$output .= '<label ' . $selected . ' for="' . $radio_id . '">';
				$output .= '<div ' . $title . ' ><img src="' . $label . '" /></div>';
				$output .= '</label>';
			}
			$output .= '<input type="hidden" name="' . $param_name . '" value="' . $this->value . '" class="wpb_vc_param_value" />';;
			$output .= '</div>';

			return $output;
		}
	}
}

if ( class_exists( 'Insight_Param_ImgRadio' ) ) {

	function ist_imgradio_settings_field( $settings, $value ) {

		$radio = new Insight_Param_ImgRadio( $settings, $value );

		return $radio->render();
	}

	WpbakeryShortcodeParams::addField( 'imgradio', 'ist_imgradio_settings_field', INSIGHT_THEME_URI . '/assets/admin/js/thememove_imgradio.js' );
}
