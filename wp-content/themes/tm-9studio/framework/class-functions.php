<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package   InsightFramework
 * @since     0.9.7
 */
class Insight_Functions {

	/**
	 * Insight_Functions constructor.
	 */
	public function __construct() {
		// Add mobile menu template before body tag
		add_action( 'wp_footer', array( $this, 'mobile_menu' ) );

		// Add custom JS
		add_action( 'wp_footer', array( $this, 'custom_js' ) );

		// Add extra JS
		add_action( 'wp_footer', array( $this, 'extra_js' ) );

		// #Backtotop
		add_action( 'wp_footer', array( $this, 'scroll_top' ) );

		// VC ajax search
		add_action( 'wp_ajax_vc_ajax_search', array( $this, 'vc_ajax_search' ) );
		add_action( 'wp_ajax_nopriv_vc_ajax_search', array( $this, 'vc_ajax_search' ) );
	}

	function vc_ajax_search() {
		$q            = isset( $_GET['q'] ) ? $_GET['q'] : '';
		$ajax_type    = urldecode( isset( $_GET['ajax_type'] ) ? $_GET['ajax_type'] : 'post_type' );
		$ajax_get     = urldecode( isset( $_GET['ajax_get'] ) ? $_GET['ajax_get'] : 'post' );
		$ajax_field   = urldecode( isset( $_GET['ajax_field'] ) ? $_GET['ajax_field'] : 'id' );
		$ajax_get_arr = explode( ',', $ajax_get );
		$arr          = array();
		if ( $ajax_type == 'post_type' ) {
			$params = array(
				'posts_per_page'      => 10,
				'post_type'           => $ajax_get_arr,
				'ignore_sticky_posts' => 1,
				's'                   => $q,
			);
			$loop   = new WP_Query( $params );
			if ( $loop->have_posts() ) {
				while ( $loop->have_posts() ) {
					$loop->the_post();
					$arr[] = array(
						'id'   => get_the_ID(),
						'name' => get_the_title(),
					);
				}
			}
			wp_reset_postdata();
		} elseif ( $ajax_type == 'taxonomy' ) {
			$terms = get_terms( array(
				'taxonomy'   => $ajax_get_arr,
				'hide_empty' => false,
			) );
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( $ajax_field == 'id' ) {
						$arr[] = array(
							'id'   => $term->term_id,
							'name' => $term->name,
						);
					} elseif ( $ajax_field == 'slug' ) {
						$arr[] = array(
							'id'   => $term->slug,
							'name' => $term->name,
						);
					}
				}
			}
		}
		echo json_encode( $arr );
		die();
	}

	/**
	 * Call mobile menu template
	 */
	public function mobile_menu() {
		if ( Insight::is_handheld() ) {
			get_template_part( 'components/mobile' );
		}
	}

	/**
	 * Load custom JS
	 */
	public function custom_js() {
		if ( Insight::setting( 'custom_js_enable' ) == 1 ) {
			echo '<script class="custom-js">' . Insight::setting( 'custom_js' ) . '</script>';
		}
	}

	/**
	 * Scroll to top JS
	 */
	public function scroll_top() {
		?>
		<?php if ( Insight::setting( 'enable_backtotop' ) == 1 ) : ?>
			<a class="scrollup"><i class="ion-android-arrow-up"></i></a>
			<script>
				jQuery( document ).ready( function( $ ) {
					var $window = $( window );
					// Scroll up
					var $scrollup = $( '.scrollup' );

					$window.scroll( function() {
						if ( $window.scrollTop() > 100 ) {
							$scrollup.addClass( 'show' );
						} else {
							$scrollup.removeClass( 'show' );
						}
					} );
					$scrollup.on( 'click', function( evt ) {
						$( "html, body" ).animate( {scrollTop: 0}, 600 );
						evt.preventDefault();
					} );
				} );
			</script>
		<?php endif; ?>
		<?php
	}

	/**
	 * Extra JS
	 */
	public function extra_js() {
		if ( Insight::setting( 'header_sticky_enable' ) == 1 ) {
			?>
			<script>
				jQuery( document ).ready( function( $ ) {
					var hh = $( '.header' ).outerHeight();
					var offset = $( '.header' ).offset();
					$( ".header" ).headroom(
						{
							offset: offset.top,
							onTop: function() {
								if ( jQuery( '.logo-image' ).attr( 'data-normal' ) != '' ) {
									jQuery( '.logo-image' ).attr( 'src', jQuery( '.logo-image' ).attr( 'data-normal' ) );
								}
								if ( ! jQuery( 'header' ).hasClass( 'header-overlay' ) ) {
									jQuery( '#content' ).css( 'margin-top', 0 );
								}
							},
							onNotTop: function() {
								if ( jQuery( '.logo-image' ).attr( 'data-sticky' ) != '' ) {
									jQuery( '.logo-image' ).attr( 'src', jQuery( '.logo-image' ).attr( 'data-sticky' ) );
								}
								if ( ! jQuery( 'header' ).hasClass( 'header-overlay' ) ) {
									jQuery( '#content' ).css( 'margin-top', hh );
								}
							},
						}
					);
				} );
			</script>
			<?php
		}
	}
}
