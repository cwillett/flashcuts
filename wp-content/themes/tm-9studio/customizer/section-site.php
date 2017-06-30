<?php
$section  = 'site';
$priority = 1;

Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'site_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Back to top', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'enable_backtotop',
	'label'       => esc_html__( 'Enable', 'tm-9studio' ),
	'description' => esc_html__( 'Enable this option to show the "back to top" button.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );

/*--------------------------------------------------------------
# Layout
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'site_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Layout', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'site_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="desc">' . esc_html__( 'Easily adjust your site\'s layout.', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'     => 'radio-image',
	'settings' => 'page_layout',
	'label'    => esc_html__( 'Page', 'tm-9studio' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'fullwidth',
	'choices'  => Insight_Helper::get_list_page_layout(),
) );

Kiki::add_field( 'theme', array(
	'type'     => 'radio-image',
	'settings' => 'post_layout',
	'label'    => esc_html__( 'Post', 'tm-9studio' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'content-sidebar',
	'choices'  => Insight_Helper::get_list_page_layout(),
) );

Kiki::add_field( 'theme', array(
	'type'     => 'radio-image',
	'settings' => 'archive_layout',
	'label'    => esc_html__( 'Archive', 'tm-9studio' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'content-sidebar',
	'choices'  => Insight_Helper::get_list_page_layout(),
) );

Kiki::add_field( 'theme', array(
	'type'     => 'radio-image',
	'settings' => 'search_layout',
	'label'    => esc_html__( 'Search', 'tm-9studio' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'content-sidebar',
	'choices'  => Insight_Helper::get_list_page_layout(),
) );

Kiki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'hide_sidebar_mobile',
	'label'       => esc_html__( 'Hide Sidebar on Mobile', 'tm-9studio' ),
	'description' => esc_html__( 'Enable this option to hide the sidebar on mobile screen.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 0,
) );

/*--------------------------------------------------------------
# Main color
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'site_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Main color', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'color',
	'settings'  => 'primary_color',
	'label'     => esc_html__( 'Primary color', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => Insight::PRIMARY_COLOR,
	'output'    => array(
		array(
			'element'  => implode( ',', array(
				'.insight-separator--icon i',
				'.insight-title .insight-title--subtitle',
				'.icon-boxes--icon',
				'.insight-about2 .link',
				'.insight-process--step--icon',
				'.blog-list-style .entry-more a:hover',
				'.footer.style01 .widget ul li a:hover, .footer.style02 .widget ul li a:hover',
				'.copyright .copyright-right ul li a:hover',
				'.insight-icon',
				'.insight-accordion .item .title .icon i',
				'blog.grid .blog-grid-style .entry-more a:hover',
				'.insight-about--carousel a span',
				'.insight-blog.grid_has_padding .blog-grid-style .entry-more a:hover',
				'.insight-about3 .row-bottom .about3-quote span',
				'.insight-about3 .row-bottom .about3-quote span',
				'.insight-about3 .about3-title h1, .insight-about3 .about3-title .sub-title',
				'.insight-our-services .icon',
				'#menu .menu__container .sub-menu li.menu-item-has-children:hover:after, #menu .menu__container .children li.menu-item-has-children:hover:after, #menu .menu__container > ul .sub-menu li.menu-item-has-children:hover:after, #menu .menu__container > ul .children li.menu-item-has-children:hover:after',
				'.insight-our-services .more',
				'#menu .menu__container .sub-menu li a:hover, #menu .menu__container .children li a:hover, #menu .menu__container > ul .sub-menu li a:hover, #menu .menu__container > ul .children li a:hover',
				'#right-slideout .widget.insight-core-bmw ul li a:hover, #right-slideout .widget.widget_nav_menu ul li a:hover',
				'.insight-gallery .insight-gallery-image .desc-wrap .icon',
				'.blog-grid .blog-grid-style .entry-more a:hover',
				'#menu .menu__container li.current-menu-item > a, #menu .menu__container li.current-menu-ancestor > a, #menu .menu__container li.current-menu-parent > a, #menu .menu__container > ul li.current-menu-item > a, #menu .menu__container > ul li.current-menu-ancestor > a, #menu .menu__container > ul li.current-menu-parent > a',
				'.mobile-menu > ul.menu li a:hover',
				'input[type="submit"]:hover',
				'.breadcrumbs ul li a:hover',
				'.post-quote blockquote .fa-quote-left, .post-quote blockquote .fa-quote-right',
				'.single .content .content-area .entry-footer .tags a:hover',
				'.single .content .comments-area .comment-list li article .reply a:hover',
				'.single .content .entry-nav .left:hover i, .single .content .entry-nav .right:hover i',
				'.newsletter-style01 form input[type="submit"]:hover',
				'.blog-grid .blog-grid-style .entry-more a:hover, .insight-blog.grid .blog-grid-style .entry-more a:hover, .insight-blog.grid_has_padding .blog-grid-style .entry-more a:hover',
				'button:hover, .insight-btn:hover, body.page .comments-area .comment-form input[type="submit"]:hover, .single .content .comments-area .comment-form input[type="submit"]:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover',
				'.insight-video .title1',
				'.dark-style .menu a:hover, .header-social a:hover',
				'.blog-grid .blog-grid-style .entry-more a:hover, .insight-blog.grid .blog-grid-style .entry-more a:hover, .insight-blog.grid_has_padding .blog-grid-style .entry-more a:hover',
				'.insight-pagination a.current, .insight-pagination span.current, .insight-pagination span:hover',
				'a:hover .entry-title',
			) ),
			'property' => 'color',
		),
		array(
			'element'  => implode( ',', array(
				'.st-bg',
				'.insight-process--step--icon:hover',
				'.insight-process--step--icon:hover .order',
				'.insight-process--small-icon',
				'.blog-list-style .entry-title:before',
				'.footer .mc4wp-form input[type="submit"]',
				'.hint--success:after',
				'#menu .mega-menu .wpb_text_column ul li.sale a:after',
				'.insight-accordion .item.active .title, .insight-accordion .item:hover .title',
				'button, input[type="button"], input[type="reset"], input[type="submit"]',
				'.footer .footer-social a:hover',
				'#right-slideout .widget.insight-socials .socials a:hover',
				'.icon-boxes.icon_on_top:hover .icon-boxes--title:after',
				'.top-search',
				'.insight-btn',
				'.insight-team-member:hover .name:after',
				'.insight-social a:hover',
				'.insight-social-icons a:hover',
				'button, .insight-btn, body.page .comments-area .comment-form input[type="submit"], .single .content .comments-area .comment-form input[type="submit"], input[type="button"], input[type="reset"], input[type="submit"]',
				'.insight-social a:hover',
				'.insight-video .btn-container a, .insight-video .btn-container a:before',
				'.widget-area .widget.widget_insight_categories .item:hover span',
				'.widget-area .widget.widget_tag_cloud a:hover',
				'.insight-dot-style01:after',
			) ),
			'property' => 'background-color',
		),
		array(
			'element'  => implode( ',', array(
				'.insight-about--carousel a:before',
				'.insight-gallery .insight-gallery-image .desc-wrap',
				'button, input[type="button"], input[type="reset"], input[type="submit"]',
				'.widget-area .widget.widget_search .search-form input[type="search"]:focus',
				'.widget-area .widget.widget_tag_cloud a:hover',
				'.footer .footer-social a:hover',
				'.growl a.cookie_notice_ok',
				'#menu .menu__container .sub-menu, #menu .menu__container .children, #menu .menu__container > ul .sub-menu, #menu .menu__container > ul .children',
				'#right-slideout .widget .widget-title',
				'#right-slideout .widget.insight-socials .socials a:hover',
				'.insight-btn',
				'.insight-social-icons a:hover',
				'button, .insight-btn, body.page .comments-area .comment-form input[type="submit"], .single .content .comments-area .comment-form input[type="submit"], input[type="button"], input[type="reset"], input[type="submit"]',
				'.insight-social a:hover',
				'button:hover, .insight-btn:hover, body.page .comments-area .comment-form input[type="submit"]:hover, .single .content .comments-area .comment-form input[type="submit"]:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover',
			) ),
			'property' => 'border-color',
		),
		array(
			'element'  => implode( ',', array(
				'#menu .menu__container .sub-menu li a:hover, #menu .menu__container .children li a:hover, #menu .menu__container > ul .sub-menu li a:hover, #menu .menu__container > ul .children li a:hover',
			) ),
			'property' => 'border-bottom-color',
		),
		array(
			'element'  => implode( ',', array(
				'.pri-color',
				'.primary-color',
				'.primary-color-hover:hover',
			) ),
			'property' => 'color',
			'suffix'   => ' !important'
		),
		array(
			'element'  => implode( ',', array(
				'.primary-background-color',
				'.primary-background-color-hover:hover',
				'.growl a.cookie_notice_ok:hover',
			) ),
			'property' => 'background-color',
			'suffix'   => ' !important'
		),
		array(
			'element'  => implode( ',', array(
				'.primary-border-color',
				'.primary-border-color-hover:hover',
			) ),
			'property' => 'border-color',
			'suffix'   => ' !important'
		),
		array(
			'element'  => implode( ',', array(
				'.hint--success.hint--top:before',
			) ),
			'property' => 'border-top-color',
		),
		array(
			'element'  => implode( ',', array(
				'.hint--success.hint--right:before',
			) ),
			'property' => 'border-right-color',
		),
		array(
			'element'  => implode( ',', array(
				'.hint--success.hint--bottom:before',
			) ),
			'property' => 'border-bottom-color',
		),
		array(
			'element'  => implode( ',', array(
				'.hint--success.hint--left:before',
			) ),
			'property' => 'border-left-color',
		),
	),
) );

/*--------------------------------------------------------------
# Link color
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'site_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Link color', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'color',
	'settings'  => 'link_color',
	'label'     => esc_html__( 'Normal', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => Insight::TEXT_COLOR,
	'output'    => array(
		array(
			'element'  => 'a',
			'property' => 'color',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'color',
	'settings'  => 'link_color_hover',
	'label'     => esc_html__( 'Hover', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => Insight::PRIMARY_COLOR,
	'output'    => array(
		array(
			'element'  => 'a:hover',
			'property' => 'color',
		),
	),
) );

/*--------------------------------------------------------------
# Body typography
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'site_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Body typography', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'        => 'typography',
	'settings'    => 'site_body_typo',
	'label'       => esc_html__( 'Font family', 'tm-9studio' ),
	'description' => esc_html__( 'These settings control the typography for all body text.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Insight::FONT_PRIMARY,
		'variant'        => 'regular',
		'color'          => Insight::TEXT_COLOR,
		'line-height'    => '1.8',
		'letter-spacing' => '0em',
	),
	'output'      => array(
		array(
			'element' => 'body',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'body_font_size',
	'label'     => esc_html__( 'Font size', 'tm-9studio' ),
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
			'element'  => 'body',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'site_heading_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Secondary font', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'typography',
	'settings'  => 'secondary_fontfamily',
	'label'     => esc_html__( 'Font family', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => array(
		'font-family' => Insight::FONT_SECONDARY,
	),
	'output'    => array(
		array(
			'element' => implode( ',', array(
				'.nd-font',
				'.font-secondary',
				'.font-2nd',
				'.single .content .content-area figure.alignleft .wp-caption-text',
				'button',
				'.insight-btn',
				'input[type="button"]',
				'input[type="reset"]',
				'input[type="submit"]',
			) ),
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'site_heading_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Third font', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'typography',
	'settings'  => 'third_fontfamily',
	'label'     => esc_html__( 'Font family', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => array(
		'font-family' => Insight::FONT_THIRD,
	),
	'output'    => array(
		array(
			'element' => implode( ',', array(
				'.font-third',
				'.font-3rd',
				'.rd-font',
			) ),
		),
	),
) );

/*--------------------------------------------------------------
# Normal heading
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'site_heading_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Normal heading typography', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'        => 'typography',
	'settings'    => 'heading_typo',
	'label'       => esc_html__( 'Font family', 'tm-9studio' ),
	'description' => esc_html__( 'These settings control the typography for all heading text.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Insight::FONT_SECONDARY,
		'variant'        => '700',
		'color'          => '#333333',
		'line-height'    => '1.3',
		'letter-spacing' => '0',
	),
	'output'      => array(
		array(
			'element' => 'h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h1_font_size',
	'label'       => esc_html__( 'Font size', 'tm-9studio' ),
	'description' => esc_html__( 'H1', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 56,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h1,.h1',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h2_font_size',
	'description' => esc_html__( 'H2', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 40,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h2,.h2',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h3_font_size',
	'description' => esc_html__( 'H3', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 34,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h3,.h3',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h4_font_size',
	'description' => esc_html__( 'H4', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 24,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h4,.h4',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h5_font_size',
	'description' => esc_html__( 'H5', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 18,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h5,.h5',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h6_font_size',
	'description' => esc_html__( 'H6', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 14,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h6,.h6',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );
