<?php
$section  = 'navigation';
$priority = 1;

/*--------------------------------------------------------------
# Menu typography
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'navigation_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Typography', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'typography',
	'settings'  => 'menu_typo',
	'label'     => esc_html__( 'Font family', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => array(
		'font-family'    => Insight::FONT_SECONDARY,
		'variant'        => 'regular',
		'line-height'    => '1.5',
		'letter-spacing' => '0em',
	),
	'output'    => array(
		array(
			'element' => '.header .menu',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'menu_level_1_font_size',
	'label'     => esc_html__( 'Level 1 Font size', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 14,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.header .menu',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'menu_level_2_font_size',
	'label'     => esc_html__( 'Level 2 Font size', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 15,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.header .menu .sub-menu',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Level 1 spacing
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'navigation_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Spacing', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'navigation_lvl_1_padding_top',
	'label'     => esc_html__( 'Padding top', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 40,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 80,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '#menu .menu__container > li > a',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'navigation_lvl_1_padding_bottom',
	'label'     => esc_html__( 'Padding bottom', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 40,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 80,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '#menu .menu__container > li > a',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );


Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'navigation_lvl_1_padding_left',
	'label'     => esc_html__( 'Padding left', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 20,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 80,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '#menu .menu__container > li > a',
			'property' => 'padding-left',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'navigation_lvl_1_padding_right',
	'label'     => esc_html__( 'Padding right', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 20,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 80,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '#menu .menu__container > li > a',
			'property' => 'padding-right',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Level 1 color
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'navigation_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Color', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'color',
	'settings'  => 'menu_link_lv1_color',
	'label'     => esc_html__( 'Link normal', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => Insight::LINK_COLOR,
	'output'    => array(
		array(
			'element'  => '.menu a',
			'property' => 'color',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'color',
	'settings'  => 'menu_link_lv1_color_hover',
	'label'     => esc_html__( 'Link hover', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => Insight::PRIMARY_COLOR,
	'output'    => array(
		array(
			'element'  => '.menu a:hover',
			'property' => 'color',
		),
	),
) );

