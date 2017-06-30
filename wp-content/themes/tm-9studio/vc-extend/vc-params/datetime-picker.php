<?php
/*
 * Example http://xdsoft.net/jqplugins/datetimepicker/
	array(
	 		"type"        => "datetimepicker",
	 		"class"       => "",
	 		'admin_label' => true,
	 		"heading"     => esc_html__( "Target Time For Countdown", "tm-9studio" ),
	 		"param_name"  => "datetime",
	 		"value"       => "",
	 		"description" => esc_html__( "Date and time format (yyyy/mm/dd hh:mm).", "tm-9studio" ),
	 		"settings"    => array(
	 			'minDate' => 0,
	 		),
	 	)
*/
if ( ! class_exists( 'Insight_Param_DateTimePicker' ) ) {
	class Insight_Param_DateTimePicker {
		function __construct() {
			if ( class_exists( 'WpbakeryShortcodeParams' ) ) {
				WpbakeryShortcodeParams::addField( 'datetimepicker', array( $this, 'date_time_picker' ) );

				if ( is_admin() ) {
					wp_enqueue_style( 'datetime-picker', INSIGHT_THEME_URI . '/assets/admin/libs/datetimepicker/jquery.datetimepicker.css' );
					wp_enqueue_script( 'datetime-picker', INSIGHT_THEME_URI . '/assets/admin/libs/datetimepicker/jquery.datetimepicker.full.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
				}
			}
		}

		function date_time_picker( $settings, $value ) {
			$dependency = '';
			$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
			$type       = isset( $settings['type'] ) ? $settings['type'] : '';
			$class      = isset( $settings['class'] ) ? $settings['class'] : '';
			$settings   = isset( $settings['settings'] ) ? $settings['settings'] : array();

			$uni = uniqid( 'datetimepicker-' . rand() );

			$output = '<div class="">';
			$output .= '<input id="datetimepicker-' . $uni . '" name="' . $param_name . '" value="' . $value . '" type="text" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" />';
			$output .= '</div>';
			$output .= '<script>
							jQuery("#datetimepicker-' . $uni . '").datetimepicker( ' . wp_json_encode( $settings ) . ' );
						</script>';

			return $output;
		}

	}
}

if ( class_exists( 'Insight_Param_DateTimePicker' ) ) {
	$Insight_Param_DateTimePicker = new Insight_Param_DateTimePicker();
}
