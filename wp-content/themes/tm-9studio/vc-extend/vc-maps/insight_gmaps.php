<?php

class WPBakeryShortCode_Insight_Gmaps extends WPBakeryShortCode {
	public function __construct( $settings ) {
		parent::__construct( $settings );
		$this->jsScripts();
	}

	public function jsScripts() {
		wp_enqueue_script( 'insight-js-maps', '//maps.google.com/maps/api/js?key=AIzaSyAaYLhJA_5UU2UMd7y2rNL82wEbs10vLww&sensor=false&amp;language=en' );
		wp_enqueue_script( 'insight-js-gmap3', INSIGHT_THEME_URI . '/assets/libs/gmap3/gmap3.min.js' );
	}
}

vc_map( array(
	'name'     => esc_html__( 'Google Maps', 'tm-9studio' ),
	'base'     => 'insight_gmaps',
	'category' => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'     => 'tm-shortcode-ico default-icon',
	'params'   => array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Address or Coordinate', 'tm-9studio' ),
			'admin_label' => true,
			'param_name'  => 'address',
			'value'       => '48.8566140,2.1000000',
			'description' => esc_html__( 'Enter address or coordinate.', 'tm-9studio' ),
		),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Marker icon', 'tm-9studio' ),
			'param_name'  => 'marker_icon',
			'description' => esc_html__( 'Choose a image for marker address', 'tm-9studio' ),
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => esc_html__( 'Marker Information', 'tm-9studio' ),
			'param_name'  => 'content',
			'description' => esc_html__( 'Content for info window', 'tm-9studio' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Height', 'tm-9studio' ),
			'param_name'  => 'map_height',
			'value'       => '480',
			'description' => esc_html__( 'Enter map height (in pixels or percentage)', 'tm-9studio' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Width', 'tm-9studio' ),
			'param_name'  => 'map_width',
			'value'       => '100%',
			'description' => esc_html__( 'Enter map width (in pixels or percentage)', 'tm-9studio' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Zoom level', 'tm-9studio' ),
			'param_name'  => 'zoom',
			'value'       => '14',
			'description' => esc_html__( 'Map zoom level', 'tm-9studio' ),
		),
		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Enable Map zoom', 'tm-9studio' ),
			'param_name' => 'zoom_enable',
			'value'      => array(
				esc_html__( 'Enable', 'tm-9studio' ) => 'enable'
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Map type', 'tm-9studio' ),
			'admin_label' => true,
			'param_name'  => 'map_type',
			'description' => esc_html__( 'Choose a map type', 'tm-9studio' ),
			'value'       => array(
				esc_html__( 'Roadmap', 'tm-9studio' )   => 'roadmap',
				esc_html__( 'Satellite', 'tm-9studio' ) => 'satellite',
				esc_html__( 'Hybrid', 'tm-9studio' )    => 'hybrid',
				esc_html__( 'Terrain', 'tm-9studio' )   => 'terrain',
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Map style', 'tm-9studio' ),
			'admin_label' => true,
			'param_name'  => 'map_style',
			'description' => esc_html__( 'Choose a map style. This approach changes the style of the Roadmap types (base imagery in terrain and satellite views is not affected, but roads, labels, etc. respect styling rules', 'tm-9studio' ),
			'value'       => array(
				esc_html__( 'Default', 'tm-9studio' )          => 'default',
				esc_html__( 'Grayscale', 'tm-9studio' )        => 'style1',
				esc_html__( 'Subtle Grayscale', 'tm-9studio' ) => 'style2',
				esc_html__( 'Apple Maps-esque', 'tm-9studio' ) => 'style3',
				esc_html__( 'Pale Dawn', 'tm-9studio' )        => 'style4',
				esc_html__( 'Muted Blue', 'tm-9studio' )       => 'style5',
				esc_html__( 'Paper', 'tm-9studio' )            => 'style6',
				esc_html__( 'Light Dream', 'tm-9studio' )      => 'style7',
				esc_html__( 'Retro', 'tm-9studio' )            => 'style8',
				esc_html__( 'Avocado World', 'tm-9studio' )    => 'style9',
				esc_html__( 'Facebook', 'tm-9studio' )         => 'style10',
				esc_html__( 'Shades of Grey', 'tm-9studio' )   => 'style11',
				esc_html__( '9studio', 'tm-9studio' )          => '9studio',
				esc_html__( 'Custom', 'tm-9studio' )           => 'custom'
			)
		),
		array(
			'type'       => 'textarea_raw_html',
			'heading'    => esc_html__( 'Map style snippet', 'tm-9studio' ),
			'param_name' => 'map_style_snippet',
			'dependency' => array(
				'element' => 'map_style',
				'value'   => 'custom',
			)
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'tm-9studio' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you want to use multiple Google Maps in one page, please add a class name for them.', 'tm-9studio' ),
		),
	)
) );
