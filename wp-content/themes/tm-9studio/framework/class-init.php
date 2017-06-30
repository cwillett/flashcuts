<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Initial setup for this theme
 *
 * @package   InsightFramework
 */
class Insight_Init {

	static private $_instance = null;

	/**
	 * The constructor.
	 */
	private function __construct() {
		// Load define
		$this->define();

		// Prevents this theme from running on WordPress versions prior to 4.3
		new Insight_Compatible();

		// Setup security
		new Insight_Security();

		// Instantiates the Insight_Enqueue object
		new Insight_Enqueue();

		//This is a wrapper class for Kirki
		new Kiki();

		// Instantiates the Insight_Customize
		new Insight_Customize();

		// Instantiates the Insight_Extras
		new Insight_Extras();

		// Instantiates the Insight_Import
		new Insight_Import();

		// Instantiates the Insight_Register_Plugins
		new Insight_Register_Plugins();

		// Instantiates the Insight_Metabox
		new Insight_Metabox();

		// Instantiates Insight_Functions
		new Insight_Functions();

		// Add custom field for menu item
		new Insight_Menu();

		// Adjust the content-width
		add_action( 'after_setup_theme', array( $this, 'content_width' ), 0 );

		// Load the theme's textdomain
		add_action( 'after_setup_theme', array( $this, 'load_theme_textdomain' ) );

		// Register navigation menus
		add_action( 'after_setup_theme', array( $this, 'register_nav_menus' ) );

		// Add theme supports
		add_action( 'after_setup_theme', array( $this, 'add_theme_supports' ) );

		// Register widget areas
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );

		// Support editor style
		add_editor_style( array( 'editor-style.css' ) );

		// Core filters
		add_filter( 'insight_core_info', array( $this, 'core_info' ) );

		// Remove width | height attr of images
		add_filter( 'post_thumbnail_html', array( $this, 'remove_thumbnail_dimensions' ), 10 );
	}

	/**
	 * Define constant
	 *
	 * @since 0.9.2
	 */
	public function define() {
		$theme = wp_get_theme();

		if ( ! empty( $theme['Template'] ) ) {
			$theme = wp_get_theme( $theme['Template'] );
		}

		define( 'INSIGHT_SITE_HOME', esc_url( get_home_url( '/' ) ) );
		define( 'INSIGHT_THEME_NAME', $theme['Name'] );
		define( 'INSIGHT_THEME_SLUG', $theme['Template'] );
		define( 'INSIGHT_THEME_VERSION', $theme['Version'] );
		define( 'INSIGHT_THEME_DIR', get_template_directory() );
		define( 'INSIGHT_THEME_URI', get_template_directory_uri() );
		define( 'INSIGHT_CHILD_THEME_URI', get_stylesheet_directory_uri() );
		define( 'INSIGHT_CHILD_THEME_DIR', get_stylesheet_directory() );

		if ( ! defined( 'DS' ) ) {
			define( 'DS', DIRECTORY_SEPARATOR );
		}
	}

	/**
	 * Registers the Menus.
	 *
	 * @access public
	 */
	public function register_nav_menus() {
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'right'     => esc_html__( 'Right', 'tm-9studio' ),
			'primary'   => esc_html__( 'Primary', 'tm-9studio' ),
			'copyright' => esc_html__( 'Copyright', 'tm-9studio' ),
		) );
	}

	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 *
	 * @access public
	 */
	public function load_theme_textdomain() {
		load_theme_textdomain( 'tm-9studio', INSIGHT_THEME_DIR . '/languages' );
	}

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @access public
	 * @global int $content_width
	 */
	public function content_width() {
		$GLOBALS['content_width'] = apply_filters( 'content_width', 640 );
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @access public
	 */
	public function add_theme_supports() {
		/*
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'insight-post-small', 80, 80, true );
		add_image_size( 'insight-post-full', 840, 420, true );
		add_image_size( 'insight-post-full-style02', 1170, 520, true );
		add_image_size( 'insight-post-list', 330, 240, true );
		add_image_size( 'insight-post-grid', 370, 270, true );
		add_image_size( 'insight-post-masonry', 370, 370, true );
		add_image_size( 'insight-project-list', 585, 380, true );

		add_image_size( 'insight-gallery-masonry01', 370, 480, true );
		add_image_size( 'insight-gallery-masonry02', 370, 224, true );
		add_image_size( 'insight-gallery-masonry03', 370, 370, true );
		add_image_size( 'insight-gallery-masonry04', 770, 400, true );

		add_image_size( 'insight-gallery-v201', 944, 626, true );
		add_image_size( 'insight-gallery-v202', 467, 630, true );

		add_image_size( 'insight-our-team-01', 310, 450, array( 'left', 'top' ) );
		add_image_size( 'insight-our-team-02', 270, 290, array( 'left', 'top' ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		/*
		 * Set up the WordPress core custom background feature.
		 */
		add_theme_support( 'custom-background', apply_filters( 'custom_background_args', array(
			'default-color' => '#ffffff',
			'default-image' => '',
		) ) );

		/*
		 * Support selective refresh for widget
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'insight-core' );

		add_theme_support( 'insight-kungfu' );

		add_theme_support( 'insight-megamenu' );

		add_theme_support( 'insight-sidebar' );

		add_theme_support( 'insight-metabox' );
	}

	function widgets_init() {
		register_sidebar( array(
			'id'            => 'sidebar',
			'name'          => esc_html__( 'Sidebar', 'tm-9studio' ),
			'description'   => esc_html__( 'Add widgets here.', 'tm-9studio' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'id'            => 'sidebar-blogger',
			'name'          => esc_html__( 'Sidebar Blogger', 'tm-9studio' ),
			'description'   => esc_html__( 'Add widgets here.', 'tm-9studio' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'id'            => 'header-03_left',
			'name'          => esc_html__( 'Header 03 Left', 'tm-9studio' ),
			'description'   => esc_html__( 'Add widgets here.', 'tm-9studio' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'id'            => 'right_slideout',
			'name'          => esc_html__( 'Right Slide Out', 'tm-9studio' ),
			'description'   => esc_html__( 'Add widgets here.', 'tm-9studio' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'id'            => 'footer_01',
			'name'          => esc_html__( 'Footer Column 01', 'tm-9studio' ),
			'description'   => esc_html__( 'Add widgets here.', 'tm-9studio' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'id'            => 'footer_02',
			'name'          => esc_html__( 'Footer Column 02', 'tm-9studio' ),
			'description'   => esc_html__( 'Add widgets here.', 'tm-9studio' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'id'            => 'footer_03',
			'name'          => esc_html__( 'Footer Column 03', 'tm-9studio' ),
			'description'   => esc_html__( 'Add widgets here.', 'tm-9studio' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'id'            => 'footer_04',
			'name'          => esc_html__( 'Footer Column 04', 'tm-9studio' ),
			'description'   => esc_html__( 'Add widgets here.', 'tm-9studio' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}


	function remove_thumbnail_dimensions( $html ) {
		$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );

		return $html;
	}

	/**
	 * Core info
	 *
	 * @param $info
	 *
	 * @return mixed
	 */
	public function core_info( $info ) {
		$info['support'] = 'http://support.thememove.com';
		$info['faqs']    = 'http://support.thememove.com/support/solutions';
		$info['docs']    = 'http://document.thememove.com/9studio-document';
		$info['api']     = 'http://api.insightstud.io/update/9studio';
		$info['icon']    = INSIGHT_THEME_URI . '/assets/images/favicon.png';
		$info['desc']    = 'Thank you for using our theme, please reward it a full five-star &#9733;&#9733;&#9733;&#9733;&#9733; rating.';
		$info['tf']      = 'https://themeforest.net/item/nine-studio-a-film-maker-studio-agency-blogger-wordpress-theme/19303651';

		return $info;
	}

	/**
	 * Singleton for global accessing.
	 *
	 * @return self
	 */
	public static function instance() {
		if ( self::$_instance == null ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

}
