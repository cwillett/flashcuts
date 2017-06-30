<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper funtions
 *
 * @package   InsightFramework
 */
class Insight_Helper {

	static public $current_index;
	static public $img_width;
	static public $img_height;
	static public $class_name;

	public static function get_post_meta( $name, $default = false ) {
		$post_meta = unserialize( get_post_meta( get_the_ID(), 'insight_page_options', true ) );

		return isset( $post_meta[ $name ] ) ? $post_meta[ $name ] : $default;
	}

	public static function get_post_meta_by_id( $post_id, $name, $default = false ) {
		$post_meta = unserialize( get_post_meta( $post_id, 'insight_page_options', true ) );

		return isset( $post_meta[ $name ] ) ? $post_meta[ $name ] : $default;
	}

	public static function get_post_option( $name, $default = false ) {
		$post_meta = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );

		return isset( $post_meta[ $name ] ) ? $post_meta[ $name ] : $default;
	}

	public static function reset() {
		wp_reset_postdata();
	}

	/**
	 * @return array|int|WP_Error
	 */
	public static function get_all_menus() {
		$args      = array(
			'hide_empty' => true,
			'fields'     => 'id=>name',
			'slug'       => '',
		);
		$menus     = get_terms( 'nav_menu', $args );
		$menus[''] = esc_html__( 'Default Menu', 'tm-9studio' );

		return $menus;
	}

	/**
	 * @param bool $default_option
	 *
	 * @return array
	 */
	public static function get_registered_sidebars( $default_option = false ) {
		global $wp_registered_sidebars;
		$sidebars = array();
		if ( $default_option == true ) {
			$sidebars['default'] = esc_html__( 'Default', 'tm-9studio' );
		}
		foreach ( $wp_registered_sidebars as $sidebar ) {
			$sidebars[ $sidebar['id'] ] = $sidebar['name'];
		}

		return $sidebars;
	}

	/**
	 * @return array
	 */
	public static function get_rev_sliders() {
		global $wpdb;
		$revsliders = array(
			'' => esc_html__( 'Choose a slider', 'tm-9studio' ),
		);
		if ( function_exists( 'rev_slider_shortcode' ) ) {
			$results = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}revslider_sliders WHERE type != %s", 'template' ) );
			if ( ! empty( $results ) ) {
				foreach ( $results as $result ) {
					$revsliders[ $result->alias ] = $result->title;
				}
			}
		}

		return $revsliders;
	}

	/**
	 * Get list page layout
	 *
	 * @return array
	 */
	public static function get_list_page_layout() {
		return array(
			'fullwidth'       => INSIGHT_THEME_URI . '/assets/admin/images/1c.png',
			'content-sidebar' => INSIGHT_THEME_URI . '/assets/admin/images/2cr.png',
			'sidebar-content' => INSIGHT_THEME_URI . '/assets/admin/images/2cl.png',
		);
	}

	/**
	 *
	 * @return string
	 */
	public static function add_style( $style, $property, $value, $contain_value = '' ) {
		if ( empty( $style ) ) {
			$style = '';
		}
		$style .= $property . ':' . $contain_value . $value . $contain_value . ';';

		return $style;
	}

	/**
	 *
	 * @return string
	 */
	public static function apply_style( $style, $selector, $echo = true ) {
		if ( empty( $style ) ) {
			return;
		}
		$style = $selector . '{' . $style . '}';
		if ( $echo ) {
			self::add_style_to_head( $style );
		} else {
			return $style;
		}
	}

	/**
	 *
	 * @return string
	 */
	public static function add_style_to_head( $style, $echo = true ) {
		$script = '<script id=\'' . uniqid( 'custom-style-' ) . '\' type=\'text/javascript\'>';
		$script .= '(function($) {';
		$script .= '$(document).ready(function() {';
		$script .= '$("head").append("<style>' . str_replace( '"', "'", $style ) . '</style>");';
		$script .= '});';
		$script .= '})(jQuery);';
		$script .= '</script>';
		if ( $echo ) {
			echo '' . $script;
		} else {
			return $script;
		}
	}

	/**
	 *
	 * @return string
	 */
	public static function esc_js( $string ) {
		return str_replace( "\n", '\n', str_replace( '"', '\"', addcslashes( str_replace( "\r", '', (string) $string ), "\0..\37" ) ) );
	}

	/**
	 *
	 * @return string
	 */
	public static function base_decode( $string ) {
		if ( function_exists( 'insight_core_base_decode' ) ) {
			return insight_core_base_decode( $string );
		} else {
			return $string;
		}
	}

	/**
	 *
	 * @return string
	 */
	public static function rgbaToHexUltimate( $r, $g, $b ) {
		$hex = "#";
		$hex .= str_pad( dechex( $r ), 2, "0", STR_PAD_LEFT );
		$hex .= str_pad( dechex( $g ), 2, "0", STR_PAD_LEFT );
		$hex .= str_pad( dechex( $b ), 2, "0", STR_PAD_LEFT );

		return $hex;
	}

	/**
	 *
	 * @return context
	 */
	public static function output( $string ) {
		echo '' . $string;
	}

	/**
	 *
	 * @return string
	 */
	public static function img_fullsize( $id ) {
		$img = wp_get_attachment_image_src( $id, 'full' );

		return $img[0];
	}

	/**
	 *
	 * @return string
	 * $params array('height' => '', 'width' => '')
	 */
	public static function img_thumb( $id, $params ) {
		$size = 'full';
		if ( isset( $params['height'] ) && isset( $params['width'] ) ) {
			$size = array( $params['width'], $params['height'] );
		}
		$image = wp_get_attachment_image_src( $id, $size );

		return $image[0];
	}

	/**
	 *
	 * @return array
	 */
	public static function get_param( $param_name, $group = 'Design Options', $dependency = '' ) {
		$param = array();
		switch ( $param_name ) {
			case 'note':
				$param = array(
					'type'        => 'textarea',
					'heading'     => esc_html__( 'Note', 'tm-9studio' ),
					'param_name'  => 'note',
					'group'       => esc_html__( 'Note', 'tm-9studio' ),
					'description' => esc_html__( 'Describe more about this element. This text just appearance in the page editor for you more easy to manage the content.', 'tm-9studio' ),
					'admin_label' => true,
				);
				break;
			case 'el_class':
				$param = array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'tm-9studio' ),
					'param_name' => 'el_class',
				);
				break;
			case 'css':
				$param = array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS', 'tm-9studio' ),
					'param_name' => 'css',
					'group'      => $group,
				);
				break;
			case 'title':
				$param = array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title', 'tm-9studio' ),
					'param_name'  => 'title',
					'admin_label' => true,
				);
				break;
			case 'element_tag':
				$param = array(
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => 'Title element tag',
					'param_name'  => 'element_tag',
					'value'       => array(
						'Default' => '',
						'h1'      => 'h1',
						'h2'      => 'h2',
						'h3'      => 'h3',
						'h4'      => 'h4',
						'h5'      => 'h5',
						'h6'      => 'h6',
						'p'       => 'p',
						'div'     => 'div',
					),
					'save_always' => true,
					'description' => 'Select element tag.',
				);
				break;
			case 'content':
				$param = array(
					'type'        => 'textarea',
					'heading'     => esc_html__( 'Content', 'tm-9studio' ),
					'param_name'  => 'content',
					'admin_label' => true,
				);
				break;
			case 'our_team_group':
				return self::get_our_team_group();
				break;
			case 'post_categories':
				return self::get_post_categories();
				break;
			case 'post_categories_select':
				return self::get_post_categories( 'dropdown' );
				break;
			case 'gallery_categories':
				return self::get_gallery_categories();
				break;
			case 'project_categories':
				return self::get_project_categories();
				break;
		}

		return $param;
	}

	/**
	 *
	 * @return array
	 */
	public static function get_value_num( $min = 1, $max = 10, $default = 1 ) {
		$value_num                                          = array();
		$value_num[ esc_html__( 'Default', 'tm-9studio' ) ] = $default;
		for ( $i = $min; $i <= $max; $i ++ ) {
			$value_num[ $i ] = $i;
		}

		return $value_num;
	}

	/**
	 *
	 * @return array
	 */
	public static function fonticon( $fontname ) {
		$font_array = array();
		switch ( $fontname ) {
			case 'fontawesome':
				$font_array = array(
					'type'        => 'iconpicker',
					'heading'     => esc_html__( 'Icon', 'tm-9studio' ),
					'param_name'  => 'icon_fontawesome',
					'value'       => 'fa fa-adjust', // default value to backend editor admin_label
					'settings'    => array(
						'emptyIcon'    => false,
						// default true, display an "EMPTY" icon?
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
					),
					'dependency'  => array(
						'element' => 'icon_lib',
						'value'   => 'fontawesome',
					),
					'description' => esc_html__( 'Select icon from library.', 'tm-9studio' ),
				);
				break;

			case 'openiconic':
				$font_array = array(
					'type'        => 'iconpicker',
					'heading'     => esc_html__( 'Icon', 'tm-9studio' ),
					'param_name'  => 'icon_openiconic',
					'value'       => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
					'settings'    => array(
						'emptyIcon'    => false, // default true, display an "EMPTY" icon?
						'type'         => 'openiconic',
						'iconsPerPage' => 4000, // default 100, how many icons per/page to display
					),
					'dependency'  => array(
						'element' => 'icon_lib',
						'value'   => 'openiconic',
					),
					'description' => esc_html__( 'Select icon from library.', 'tm-9studio' ),
				);
				break;
			case 'typicons':
				$font_array = array(
					'type'        => 'iconpicker',
					'heading'     => esc_html__( 'Icon', 'tm-9studio' ),
					'param_name'  => 'icon_typicons',
					'value'       => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
					'settings'    => array(
						'emptyIcon'    => false, // default true, display an "EMPTY" icon?
						'type'         => 'typicons',
						'iconsPerPage' => 4000, // default 100, how many icons per/page to display
					),
					'dependency'  => array(
						'element' => 'icon_lib',
						'value'   => 'typicons',
					),
					'description' => esc_html__( 'Select icon from library.', 'tm-9studio' ),
				);
				break;
			case 'entypo':
				$font_array = array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'tm-9studio' ),
					'param_name' => 'icon_entypo',
					'value'      => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
					'settings'   => array(
						'emptyIcon'    => false, // default true, display an "EMPTY" icon?
						'type'         => 'entypo',
						'iconsPerPage' => 4000, // default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_lib',
						'value'   => 'entypo',
					),
				);
				break;
			case 'linecons':
				$font_array = array(
					'type'        => 'iconpicker',
					'heading'     => esc_html__( 'Icon', 'tm-9studio' ),
					'param_name'  => 'icon_linecons',
					'value'       => 'vc_li vc_li-heart', // default value to backend editor admin_label
					'settings'    => array(
						'emptyIcon'    => false, // default true, display an "EMPTY" icon?
						'type'         => 'linecons',
						'iconsPerPage' => 4000, // default 100, how many icons per/page to display
					),
					'dependency'  => array(
						'element' => 'icon_lib',
						'value'   => 'linecons',
					),
					'description' => esc_html__( 'Select icon from library.', 'tm-9studio' ),
				);
				break;
			case 'ionicons':
				$font_array = array(
					'type'        => 'iconpicker',
					'heading'     => esc_html__( 'Icon', 'tm-9studio' ),
					'param_name'  => 'icon_ionicons',
					'value'       => 'ion-ionic',
					'settings'    => array(
						'emptyIcon'    => false,
						'type'         => 'ionicons',
						'iconsPerPage' => 4000,
					),
					'dependency'  => array(
						'element' => 'icon_lib',
						'value'   => 'ionicons',
					),
					'description' => esc_html__( 'Select icon from library.', 'tm-9studio' ),
				);
				break;
			case '9studio':
				$font_array = array(
					'type'        => 'iconpicker',
					'heading'     => esc_html__( 'Icon', 'tm-9studio' ),
					'param_name'  => 'icon_9studio',
					'value'       => '9studio-apple',
					'settings'    => array(
						'emptyIcon'    => false,
						'type'         => '9studio',
						'iconsPerPage' => 40,
					),
					'dependency'  => array(
						'element' => 'icon_lib',
						'value'   => '9studio',
					),
					'description' => esc_html__( 'Select icon from library.', 'tm-9studio' ),
				);
				break;
		}

		return $font_array;
	}

	public static function get_our_team_group() {
		$terms = get_terms( 'ic_our_team_group', array(
			'hide_empty' => false,
		) );

		$categories = array();
		foreach ( $terms as $key => $term ) {
			$categories[ $term->name ] = $term->slug;
		}

		return array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Group', 'tm-9studio' ),
			'value'       => $categories,
			'param_name'  => 'our_team_group',
			'admin_label' => true,
		);
	}

	public static function get_post_categories( $type = 'checkbox' ) {
		$terms = get_terms( 'category', array(
			'hide_empty' => false,
		) );

		$categories = array();
		foreach ( $terms as $key => $term ) {
			$categories[ $term->name ] = $term->slug;
		}

		return array(
			'type'        => $type,
			'heading'     => esc_html__( 'Categories', 'tm-9studio' ),
			'value'       => $categories,
			'param_name'  => 'categories',
			'admin_label' => true,
		);
	}

	public static function get_gallery_categories( $dependency = '' ) {
		$terms      = get_terms( 'ic_gallery_category', array() );
		$categories = array();
		if ( isset( $terms ) && ! empty( $terms ) ) {
			foreach ( $terms as $key => $term ) {
				if ( isset( $term->slug ) ) {
					$categories[ $term->name ] = $term->slug;
				}
			}
		}

		return array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Categories', 'tm-9studio' ),
			'value'       => $categories,
			'param_name'  => 'categories',
			'admin_label' => true,
			'dependency'  => $dependency,
		);
	}

	public static function get_project_categories( $dependency = '' ) {
		$terms      = get_terms( 'ic_project_category', array() );
		$categories = array();
		if ( isset( $terms ) && ! empty( $terms ) ) {
			foreach ( $terms as $key => $term ) {
				if ( isset( $term->slug ) ) {
					$categories[ $term->name ] = $term->slug;
				}
			}
		}

		return array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Categories', 'tm-9studio' ),
			'value'       => $categories,
			'param_name'  => 'categories',
			'admin_label' => true,
			'dependency'  => $dependency,
		);
	}

	public static function get_gmap_iframe_with_id( $id = 'gmap' ) {
		$gmap_iframe = Insight::setting( 'footer_gmap_iframe' );
		$gmap_iframe = str_replace( '<iframe', '<iframe id="' . $id . '"', $gmap_iframe );

		return $gmap_iframe;
	}

	public static function get_post_views( $postID ) {
		$count_key = '_ic_view';
		$count     = get_post_meta( $postID, $count_key, true );
		if ( $count == '' ) {
			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, '0' );

			return '0';
		}

		return $count;
	}

	public static function set_post_views( $postID ) {
		$count_key = '_ic_view';
		$count     = get_post_meta( $postID, $count_key, true );
		if ( $count == '' ) {
			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, '0' );
		} else {
			$count ++;
			update_post_meta( $postID, $count_key, $count );
		}
	}
}
