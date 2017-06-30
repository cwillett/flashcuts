<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Insight Static Classes
 *
 * @package   InsightFramework
 * @since     0.9.1
 */
class Insight {

	//fixme: change value as you want
	const FONT_PRIMARY = 'Lato';
	const FONT_SECONDARY = 'Montserrat';
	const FONT_THIRD = 'Merriweather';
	const PRIMARY_COLOR = '#da0e2b';
	const TEXT_COLOR = '#696969';
	const LINK_COLOR = '#333333';
	const WHITE_COLOR = '#fff';
	const BLACK_COLOR = '#000';
	const TRANSPARENT_COLOR = 'rgba(255,255,255,0)';

	/**
	 * is_tablet
	 *
	 * @since 0.9.8
	 * @return bool
	 */
	public static function is_tablet() {
		return Insight_Detect::instance()->isTablet();
	}

	/**
	 * is_mobile
	 *
	 * @since 0.9.8
	 * @return bool
	 */
	public static function is_mobile() {
		if ( self::is_tablet() ) {
			return false;
		}

		return Insight_Detect::instance()->isMobile();
	}

	/**
	 * is_handheld
	 *
	 * @since 0.9.8
	 * @return bool
	 */
	public static function is_handheld() {
		return ( self::is_mobile() || self::is_tablet() );
	}

	/**
	 * is_desktop
	 *
	 * @since 0.9.8
	 * @return bool
	 */
	public static function is_desktop() {
		return ! self::is_handheld();
	}

	/**
	 * Insight settings for Kirki
	 *
	 * @since 0.9.1
	 *
	 * @param string $setting
	 *
	 * @return mixed
	 */
	public static function setting( $setting = '' ) {
		$settings = Kiki::get_option( 'theme', $setting );

		return $settings;
	}

	/**
	 * Requirement one file.
	 *
	 * @since 0.9.1
	 *
	 * @param string $file Enter your file path here (included .php)
	 */
	public static function require_file( $file = '' ) {
		$path = INSIGHT_THEME_DIR . DS . $file;
		if ( file_exists( $path ) ) {
			require_once( $path );
		} else {
			wp_die( esc_html__( 'Could not load theme file: ', 'tm-9studio' ) . $path );
		}
	}

	/**
	 * Primary Menu
	 *
	 * @since 0.9.7
	 */
	public static function menu_primary() {
		if ( class_exists( 'InsightCore_WalkerNavMenu' ) && has_nav_menu( 'primary' ) ) {
			wp_nav_menu( array(
				'menu'           => Insight_Helper::get_post_meta( 'menu_display' ),
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'menu__container',
				'walker'         => new InsightCore_WalkerNavMenu
			) );
		} else {
			wp_nav_menu( array(
				'menu_id'         => 'primary-menu',
				'theme_location'  => 'primary',
				'container'       => '',
				'container_class' => '',
				'menu_class'      => 'menu__container'
			) );
		}
	}

	/**
	 * Logo
	 *
	 * @since 0.9.7
	 */
	public static function branding_logo( $mobile = false ) {
		if ( $mobile ) {
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" id="branding_logo_mobile">
				<img class="mobile-logo-image"
				     src="<?php echo esc_url( Insight::setting( 'mobile_logo' ) ); ?>"
				     alt="<?php echo esc_attr( Insight::setting( 'logo_alt' ) ); ?>"
				     title="<?php echo esc_attr( Insight::setting( 'logo_title' ) ); ?>"/>
			</a>
			<?php
		} else {
			// Normal logo
			if ( Insight_Helper::get_post_meta( 'custom_logo' ) != '' ) {
				$logo_url   = esc_url( Insight_Helper::get_post_meta( 'custom_logo' ) );
				$logo_class = 'custom_logo';
			} elseif ( Insight::setting( 'branding_logo_image' ) != '' ) {
				$logo_url   = esc_url( Insight::setting( 'branding_logo_image' ) );
				$logo_class = 'branding_logo_image';
			} else {
				$logo_url   = esc_url( INSIGHT_THEME_URI . '/assets/images/logo_dark.png' );
				$logo_class = 'default_logo';
			}
			// Sticky logo
			if ( Insight_Helper::get_post_meta( 'custom_sticky_logo' ) != '' ) {
				$logo_sticky_url = esc_url( Insight_Helper::get_post_meta( 'custom_sticky_logo' ) );
			} elseif ( Insight::setting( 'sticky_header_logo' ) != '' ) {
				$logo_sticky_url = esc_url( Insight::setting( 'sticky_header_logo' ) );
			} else {
				$logo_sticky_url = '';
			}
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" id="branding_logo">
				<img class="logo-image <?php echo esc_attr( $logo_class ); ?>" src="<?php echo esc_url( $logo_url ); ?>"
					<?php echo 'data-normal="' . esc_url( $logo_url ) . '"'; ?> <?php echo 'data-sticky="' . esc_url( $logo_sticky_url ) . '"'; ?>
					 alt="<?php echo esc_attr( Insight::setting( 'logo_alt' ) ); ?>"
					 title="<?php echo esc_attr( Insight::setting( 'logo_title' ) ); ?>"/>
			</a>
			<?php
		}
	}

	/**
	 * Footer Logo
	 *
	 * @since 0.9.7
	 */
	public static function footer_logo() {
		// Normal logo
		if ( is_singular() && ( Insight_Helper::get_post_meta( 'footer_logo' ) != '' ) ) {
			$logo_url = esc_url( Insight_Helper::get_post_meta( 'footer_logo' ) );
		} elseif ( Insight::setting( 'footer_logo' ) != '' ) {
			$logo_url = esc_url( Insight::setting( 'footer_logo' ) );
		}
		if ( $logo_url != '' ) {
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" id="footer_logo">
				<img class="footer-logo-image" src="<?php echo esc_url( $logo_url ); ?>"
				     alt="<?php bloginfo( 'name' ); ?>"/>
			</a>
			<?php
		}
	}

	/**
	 * Adds custom attributes to the array of body attributes.
	 *
	 * @since 0.9.8
	 */
	public static function body_attributes() {
		$attr = array();

		$bg = '';

		if ( Insight_Helper::get_post_meta( 'body_bg' ) !== '' ) {
			$bg = Insight_Helper::get_post_meta( 'body_bg' );
		}
		$attr[] = 'data-bg="' . $bg . '"';
		$attr   = apply_filters( 'body_attributes', $attr );

		echo join( ' ', $attr );

	}

	/**
	 * Adds custom attributes to the array of top bar attributes.
	 *
	 * @since 0.9.6
	 */
	public static function topbar_attributes() {
		$attr   = array();
		$attr[] = 'class="topbar"';

		echo join( ' ', $attr );
	}

	/**
	 * Adds custom attributes to the array of header attributes.
	 *
	 * @since 0.9.1
	 */
	public static function header_attributes() {
		$type  = self::setting( 'header_type' );
		$class = 'header header-desktop ' . $type;
		if ( Insight_Helper::get_post_meta( 'header_special' ) == 'overlay' ) {
			$class .= ' header-overlay';
		}
		if ( Insight_Helper::get_post_meta( 'header_special' ) == 'minimal' ) {
			$class .= ' header-minimal';
		}
		$attr   = array();
		$attr[] = 'class="' . $class . '"';
		$attr   = apply_filters( 'header_attributes', $attr );

		echo join( ' ', $attr );
	}

	/**
	 * Adds custom attributes to the array of branding attributes.
	 *
	 * @since 0.9.6
	 */
	public static function branding_attributes() {
		$attr   = array();
		$attr[] = 'class="branding"';

		$attr = apply_filters( 'branding_attributes', $attr );

		echo join( ' ', $attr );
	}

	/**
	 * Adds custom attributes to the array of navigation attributes.
	 *
	 * @since 0.9.6
	 */
	public static function navigation_attributes() {
		$attr   = array();
		$attr[] = 'class="navigation"';

		echo join( ' ', $attr );
	}

	/**
	 * Adds custom attributes to the array of footer attributes.
	 *
	 * @since 0.9.1
	 */
	public static function footer_attributes() {
		if ( ( Insight_Helper::get_post_meta( 'footer_style' ) != '' ) && ( Insight_Helper::get_post_meta( 'footer_style' ) != 'default' ) ) {
			$style = Insight_Helper::get_post_meta( 'footer_style' );
		} else {
			$style = self::setting( 'footer_style' );
		}

		$attr   = array();
		$attr[] = 'class="footer ' . $style . '"';

		echo join( ' ', $attr );
	}

	/**
	 * Adds custom attributes to the array of copyright attributes.
	 *
	 * @since 0.9.1
	 */
	public static function copyright_attributes() {
		if ( ( Insight_Helper::get_post_meta( 'copyright_style' ) != '' ) && ( Insight_Helper::get_post_meta( 'copyright_style' ) != 'default' ) ) {
			$style = Insight_Helper::get_post_meta( 'copyright_style' );
		} else {
			$style = self::setting( 'copyright_style' );
		}

		$type = 'type-' . self::setting( 'copyright_type' );

		$attr   = array();
		$attr[] = 'class="copyright ' . $style . ' ' . $type . '"';

		echo join( ' ', $attr );
	}

	/**
	 * Social Icons
	 *
	 * @since 0.9.3
	 */
	public static function social_icons( $hint = true ) {
		$social_link = self::setting( 'social_link' );
		if ( ! empty( $social_link ) ) {
			foreach ( $social_link as $key => $row_values ) {
				if ( $hint ) { ?>
					<a class="hint--top hint--bounce hint--success"
					   aria-label="<?php echo esc_html( $row_values['tooltip'] ); ?>"
					   href="<?php echo esc_url( $row_values['link_url'] ) ?>">
						<i class="fa <?php echo esc_attr( $row_values['icon_class'] ); ?>"></i>
					</a>
				<?php } else { ?>
					<a href="<?php echo esc_url( $row_values['link_url'] ) ?>">
						<i class="fa <?php echo esc_attr( $row_values['icon_class'] ); ?>"></i>
					</a>
				<?php }
			}
		}
	}

	/**
	 * Add revolution slider
	 *
	 * @since 0.9.7
	 */
	public static function slider() {
		if ( function_exists( 'rev_slider_shortcode' ) && Insight_Helper::get_post_meta( 'revolution_slider' ) != '' ) {
			putRevSlider( Insight_Helper::get_post_meta( 'revolution_slider' ) );
		}
	}

	/**
	 * Get sidebar
	 *
	 * @param $position
	 *
	 * @since 0.9.7
	 */
	public static function sidebar( $position ) {
		if ( Insight_Helper::get_post_meta( $position ) != 'default' ) {
			if ( is_active_sidebar( Insight_Helper::get_post_meta( $position ) ) ) {
				dynamic_sidebar( Insight_Helper::get_post_meta( $position ) );
			}
		} else {
			if ( is_active_sidebar( $position ) ) {
				dynamic_sidebar( $position );
			}
		}
	}

	/**
	 * Page title
	 *
	 * @since 0.9.7
	 */
	public static function page_title() {
		if ( ( Insight_Helper::get_post_meta( 'title_visibility' ) == 'default' ) || ( Insight_Helper::get_post_meta( 'title_visibility' ) == '' ) ) {
			$show_title = Insight::setting( 'title_visibility' );
		} else {
			$show_title = Insight_Helper::get_post_meta( 'title_visibility' ) == 'visible' ? '1' : '0';
		}
		if ( $show_title == '1' ) {
			if ( Insight_Helper::get_post_meta( 'custom_title_bg_image' ) ) {
				$page_title_style = 'background-image: url(' . Insight_Helper::get_post_meta( 'custom_title_bg_image' ) . ') !important;';
				Insight_Helper::apply_style( $page_title_style, '.page-title' );
			}

			$style_custom = '';
			if ( is_singular() && ( Insight_Helper::get_post_meta( 'custom_title' ) != '' ) ) {
				$style_custom = 'page-custom-title';
			}
			echo '<div class="page-title ' . esc_attr( $style_custom . ' ' . Insight_Helper::get_post_meta( 'custom_title_style' ) ) . '"><div class="container">';
			// Title
			if ( is_home() || is_front_page() ) {
				echo '<div class="title">' . esc_html__( 'Home', 'tm-9studio' ) . '</div>';
			} elseif ( ( is_page() || is_single() ) ) {
				if ( Insight_Helper::get_post_meta( 'custom_title' ) != '' ) {
					echo '<h1 class="title">' . wp_kses( Insight_Helper::get_post_meta( 'custom_title' ), array( 'span' => array() ) ) . '</h1>';
				} else {
					if ( get_post_type() == 'post' ) {
						echo '<div class="title">' . esc_html( 'Blog', 'tm-9studio' ) . '</div>';
					} else {
						the_title( '<div class="title">', '</div>' );
					}
				}
			} elseif ( is_search() ) {
				echo '<h1 class="title">' . esc_html__( 'Search results for: ', 'tm-9studio' ) . get_search_query() . '</h1>';
			} elseif ( is_archive() ) {
				the_archive_title( '<h1 class="title">', '</h1>' );
			} else {
				the_title( '<h1 class="title">', '</h1>' );
			}
			// Breadcrumbs
			if ( ( Insight_Helper::get_post_meta( 'breadcrumbs_visibility' ) == 'default' ) || ( Insight_Helper::get_post_meta( 'breadcrumbs_visibility' ) == '' ) ) {
				$show_breadcrumbs = Insight::setting( 'breadcrumbs_visibility' );
			} else {
				$show_breadcrumbs = Insight_Helper::get_post_meta( 'breadcrumbs_visibility' ) == 'visible' ? '1' : '0';
			}
			if ( $show_breadcrumbs == '1' ) {
				Insight::breadcrumbs();
			}
			echo '</div></div>';
		}
	}

	/**
	 * Breadcrumbs
	 *
	 * @since 0.9.7
	 */
	public static function breadcrumbs() {
		if ( ( Insight_Helper::get_post_meta( 'breadcrumbs_visibility' ) == 'default' ) || ( Insight_Helper::get_post_meta( 'breadcrumbs_visibility' ) == '' ) ) {
			$breadcrumbs_visibility = self::setting( 'breadcrumbs_visibility' ) ? 'visible' : 'hidden';
		} else {
			$breadcrumbs_visibility = Insight_Helper::get_post_meta( 'breadcrumbs_visibility' );
		}
		if ( $breadcrumbs_visibility != 'hidden' ) {
			if ( function_exists( 'insight_core_breadcrumb' ) ) {
				echo '<div class="breadcrumbs">';
				echo wp_kses( insight_core_breadcrumb( array( 'home_label' => esc_html__( 'Home', 'tm-9studio' ) ) ), array(
					'ul' => array(
						'class' => array(),
					),
					'li' => array(
						'class' => array(),
					),
					'a'  => array(
						'class' => array(),
						'href'  => array(),
						'title' => array(),
					),
				) );
				echo '</div>';
			}
		}
	}

	/**
	 * Paging Navigation
	 *
	 * @since 0.9.7
	 */
	public static function paging_nav() {
		global $wp_query, $wp_rewrite;

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = esc_url( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $wp_query->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__( 'Previous', 'tm-9studio' ),
			'next_text' => esc_html__( 'Next', 'tm-9studio' ),
		) );

		if ( $links ) :

			?>
			<div class="pagination insight-pagination loop-pagination nd-font">
				<?php echo wp_kses( $links, array(
					'span' => array(
						'class' => array()
					),
					'a'    => array(
						'href'  => array(),
						'class' => array(),
						'title' => array()
					)
				) ); ?>
			</div><!-- .pagination -->
			<?php
		endif;
	}

	/**
	 * Paging Navigation
	 *
	 * @since 0.9.7
	 */
	public static function paging_nav_gallery( $wp_query = '' ) {
		global $wp_rewrite;

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = esc_url( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $wp_query->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__( 'Previous', 'tm-9studio' ),
			'next_text' => esc_html__( 'Next', 'tm-9studio' ),
		) );

		if ( $links ) :

			?>
			<div class="pagination insight-pagination loop-pagination nd-font">
				<?php echo wp_kses( $links, array(
					'span' => array(
						'class' => array()
					),
					'a'    => array(
						'href'  => array(),
						'class' => array(),
						'title' => array()
					)
				) ); ?>
			</div><!-- .pagination -->
			<?php
		endif;
	}
}
