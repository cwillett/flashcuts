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
 */
class Insight_Extras {

	/**
	 * The constructor.
	 */
	public function __construct() {
		// Adds custom classes to the array of body classes.
		add_filter( 'body_class', array( $this, 'body_classes' ) );
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	public function body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a class for mobile device
		if ( Insight::is_mobile() ) {
			$classes[] = 'mobile';
		}

		// Adds a class for tablet device
		if ( Insight::is_tablet() ) {
			$classes[] = 'tablet';
		}

		// Adds a class for handheld device
		if ( Insight::is_handheld() ) {
			$classes[] = 'handheld';
		}

		// Adds a class for desktop device
		if ( Insight::is_desktop() ) {
			$classes[] = 'desktop';
		}

		// Setup page layout use class
		if ( is_page() ) {
			// Add class by customizer
			$classes[] = 'page--' . Insight::setting( 'page_layout' );
			// Add class by page options
			$classes[] = 'page-private--' . Insight_Helper::get_post_meta( 'page_layout' );
		}

		// Setup page overlay header class
		if ( is_page() || is_singular( 'ic_our_team' ) || is_singular( 'ic_project' ) ) {
			// Page padding
			if ( Insight_Helper::get_post_meta( 'page_padding' ) == 'no' ) {
				$classes[] = 'no-padding';
			}
		}

		// Setup post layout use class
		if ( is_single() ) {
			$classes[] = 'post--' . Insight::setting( 'post_layout' );

			$classes[] = 'post--style--' . Insight_Helper::get_post_option( 'post_single_style' );
		}

		if ( ! is_search() && ( Insight_Helper::get_post_meta( 'body_class' ) != '' ) ) {
			$classes[] = Insight_Helper::get_post_meta( 'body_class' );
		}

		$classes[] = 'tm-9studio';

		return $classes;
	}

	/**
	 * @param $v
	 *
	 * @return int|string
	 */
	public function num_convt( $v ) {
		$l   = substr( $v, - 1 );
		$ret = substr( $v, 0, - 1 );

		switch ( strtoupper( $l ) ) {
			case 'P': // fall-through
			case 'T': // fall-through
			case 'G': // fall-through
			case 'M': // fall-through
			case 'K': // fall-through
				$ret *= 1024;
				break;
			default:
				break;
		}

		return $ret;
	}

}
