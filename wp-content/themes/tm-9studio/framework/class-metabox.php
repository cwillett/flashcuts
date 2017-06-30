<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add Insight Metabox
 *
 * @package   InsightFramework
 * @since     0.9.8
 */
class Insight_Metabox {

	/**
	 * Insight_Metabox constructor.
	 */
	public function __construct() {
		// Add metabox for page
		add_filter( 'insight_core_meta_boxes', array( $this, 'register_meta_boxes' ) );
		add_action( 'vp_pfui_after_quote_meta', array( $this, 'quote_text_field' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}

	function admin_init() {
		$post_formats = get_theme_support( 'post-formats' );
		if ( ! empty( $post_formats[0] ) && is_array( $post_formats[0] ) ) {
			if ( in_array( 'quote', $post_formats[0] ) ) {
				add_action( 'save_post', array( $this, 'custom_save_post' ) );
			}
		}
	}

	function custom_save_post( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! defined( 'XMLRPC_REQUEST' ) ) {
			if ( isset( $_POST['_format_quote_text'] ) ) {
				update_post_meta( $post_id, '_format_quote_text', $_POST['_format_quote_text'] );
			}
		}
	}

	public function quote_text_field() {
		global $post;
		?>
		<div class="vp-pfui-elm-block">
			<label for="vp-pfui-format-quote-text"><?php esc_html_e( 'Quote', 'tm-9studio' ); ?></label>
			<textarea name="_format_quote_text" id="vp-pfui-format-quote-text" cols="30"
			          rows="10"><?php echo esc_attr( get_post_meta( $post->ID, '_format_quote_text', true ) ); ?></textarea>
		</div>
		<?php
	}

	/**
	 * Register Metabox
	 *
	 * @param $meta_boxes
	 *
	 * @return array
	 */
	public function register_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'id'         => 'insight_page_options',
			'title'      => esc_html__( 'Page Options', 'tm-9studio' ),
			'post_types' => array( 'page', 'post' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields'     => array(
				array(
					'type'  => 'tabpanel',
					'items' => array(
						array(
							'title'  => esc_attr__( 'Layout', 'tm-9studio' ),
							'icon'   => 'dashicons-layout',
							'fields' => array(
								array(
									'id'      => 'page_layout',
									'type'    => 'switch',
									'title'   => esc_html__( 'Layout', 'tm-9studio' ),
									'default' => 'default',
									'options' => array(
										'default'         => esc_html__( 'Default', 'tm-9studio' ),
										'fullwidth'       => esc_html__( 'Fullwidth', 'tm-9studio' ),
										'content-sidebar' => esc_html__( 'Content - Sidebar', 'tm-9studio' ),
										'sidebar-content' => esc_html__( 'Sidebar - Content', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'page_padding',
									'type'    => 'switch',
									'title'   => esc_html__( 'Padding top & bottom', 'tm-9studio' ),
									'desc'    => esc_html__( 'If choose yes, the page content will have the padding top & bottom is 120px.', 'tm-9studio' ),
									'default' => 'yes',
									'options' => array(
										'no'  => esc_html__( 'No', 'tm-9studio' ),
										'yes' => esc_html__( 'Yes', 'tm-9studio' )
									),
								),
								array(
									'id'    => 'body_class',
									'type'  => 'text',
									'title' => esc_attr__( 'Body class', 'tm-9studio' ),
								),
								array(
									'id'      => 'body_bg',
									'type'    => 'media',
									'title'   => esc_attr__( 'Custom background image', 'tm-9studio' ),
									'default' => '',
								),
							),
						),
						array(
							'title'  => esc_attr__( 'Header', 'tm-9studio' ),
							'icon'   => 'dashicons-welcome-widgets-menus',
							'fields' => array(
								array(
									'id'      => 'header_visibility',
									'title'   => esc_attr__( 'Header visibility', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'visible',
									'options' => array(
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'header_special',
									'type'    => 'switch',
									'title'   => esc_html__( 'Header special style', 'tm-9studio' ),
									'desc'    => esc_html__( 'Just should use Overlay Header or Minimal Header when the page has a slider on the top.', 'tm-9studio' ),
									'default' => 'none',
									'options' => array(
										'none'    => esc_html__( 'None', 'tm-9studio' ),
										'overlay' => esc_html__( 'Overlay', 'tm-9studio' ),
										'minimal' => esc_html__( 'Minimal', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'menu_display',
									'type'    => 'select',
									'title'   => esc_attr__( 'Primary menu', 'tm-9studio' ),
									'default' => '',
									'options' => Insight_Helper::get_all_menus(),
								),
								array(
									'id'      => 'custom_logo',
									'type'    => 'media',
									'title'   => esc_attr__( 'Custom logo', 'tm-9studio' ),
									'default' => '',
								),
								array(
									'id'      => 'custom_sticky_logo',
									'type'    => 'media',
									'title'   => esc_attr__( 'Custom sticky logo', 'tm-9studio' ),
									'default' => '',
								),
								array(
									'id'      => 'revolution_slider',
									'type'    => 'select',
									'title'   => esc_attr__( 'Top slider', 'tm-9studio' ),
									'default' => '',
									'options' => Insight_Helper::get_rev_sliders(),
								),

							),
						),
						array(
							'title'  => esc_attr__( 'Title & Breadcrumbs', 'tm-9studio' ),
							'icon'   => 'dashicons-welcome-widgets-menus',
							'fields' => array(
								array(
									'id'      => 'title_visibility',
									'title'   => esc_attr__( 'Title visibility', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'visible',
									'options' => array(
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'custom_title_style',
									'type'    => 'switch',
									'title'   => esc_html__( 'Title style', 'tm-9studio' ),
									'default' => 'default-style',
									'options' => array(
										'default-style' => esc_html__( 'Default', 'tm-9studio' ),
										'big-style'     => esc_html__( 'Big', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'custom_title',
									'type'    => 'text',
									'title'   => esc_attr__( 'Custom title', 'tm-9studio' ),
									'default' => '',
								),
								array(
									'id'      => 'custom_title_bg_image',
									'type'    => 'media',
									'title'   => esc_attr__( 'Custom title background image', 'tm-9studio' ),
									'default' => '',
								),
								array(
									'id'      => 'breadcrumbs_visibility',
									'type'    => 'switch',
									'title'   => esc_attr__( 'Breadcrumbs visibility', 'tm-9studio' ),
									'desc'    => esc_html__( 'If you hide the title section, breadcrumbs will be hidden.', 'tm-9studio' ),
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
							),
						),
						array(
							'title'  => esc_attr__( 'Sidebar', 'tm-9studio' ),
							'icon'   => 'dashicons-index-card',
							'fields' => array(
								array(
									'id'      => 'page_sidebar',
									'type'    => 'select',
									'title'   => esc_html__( 'Page sidebar', 'tm-9studio' ),
									'desc'    => esc_html__( 'Choose a custom sidebar for your page', 'tm-9studio' ),
									'default' => 'default',
									'options' => Insight_Helper::get_registered_sidebars( true ),
								),
							),
						),
						array(
							'title'  => esc_attr__( 'Newsletter', 'tm-9studio' ),
							'icon'   => 'dashicons-feedback',
							'fields' => array(
								array(
									'id'      => 'newsletter_visibility',
									'title'   => esc_attr__( 'Newsletter visibility', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'newsletter_style',
									'title'   => esc_attr__( 'Newsletter style', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'style01',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'style01' => esc_html__( 'Style 01', 'tm-9studio' ),
										'style02' => esc_html__( 'Style 02', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'newsletter_bg',
									'type'    => 'media',
									'title'   => esc_attr__( 'Custom background image', 'tm-9studio' ),
									'default' => '',
								),
							),
						),
						array(
							'title'  => esc_attr__( 'Footer', 'tm-9studio' ),
							'icon'   => 'dashicons-feedback',
							'fields' => array(
								array(
									'id'      => 'footer_visibility',
									'title'   => esc_attr__( 'Footer visibility', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'footer_style',
									'title'   => esc_attr__( 'Footer style', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'style01' => esc_html__( 'Style 01 (Light)', 'tm-9studio' ),
										'style02' => esc_html__( 'Style 02 (Dark)', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'footer_logo',
									'type'    => 'media',
									'title'   => esc_attr__( 'Custom footer logo', 'tm-9studio' ),
									'default' => '',
								),
							),
						),
						array(
							'title'  => esc_attr__( 'Copyright', 'tm-9studio' ),
							'icon'   => 'dashicons-feedback',
							'fields' => array(
								array(
									'id'      => 'copyright_visibility',
									'title'   => esc_attr__( 'Copyright visibility', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'copyright_style',
									'title'   => esc_attr__( 'Copyright style', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'style01' => esc_html__( 'Style 01 (Light)', 'tm-9studio' ),
										'style02' => esc_html__( 'Style 02 (Dark)', 'tm-9studio' ),
									),
								),
							),
						),
					),
				),
			),
		);

		$meta_boxes[] = array(
			'id'         => 'insight_post_options',
			'title'      => esc_html__( 'Post Options', 'tm-9studio' ),
			'post_types' => array( 'post' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields'     => array(
				array(
					'type'  => 'tabpanel',
					'items' => array(
						array(
							'title'  => esc_attr__( 'Style', 'tm-9studio' ),
							'icon'   => 'dashicons-admin-customizer',
							'fields' => array(
								array(
									'id'      => 'post_single_style',
									'type'    => 'switch',
									'title'   => esc_html__( 'Style', 'tm-9studio' ),
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Style 01 (Default)', 'tm-9studio' ),
										'style02' => esc_html__( 'Style 02', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'custom_title_bg',
									'type'    => 'media',
									'title'   => esc_attr__( 'Custom title background', 'tm-9studio' ),
									'default' => '',
								),
								array(
									'id'      => 'featured_image_visibility',
									'type'    => 'switch',
									'title'   => esc_html__( 'Featured image visibility', 'tm-9studio' ),
									'default' => 'visible',
									'options' => array(
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
							),
						),
					),
				),
			),
		);

		$meta_boxes[] = array(
			'id'         => 'insight_page_options',
			'title'      => esc_html__( 'Our Team Options', 'tm-9studio' ),
			'post_types' => array( 'ic_our_team' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields'     => array(
				array(
					'type'  => 'tabpanel',
					'items' => array(
						array(
							'title'  => esc_attr__( 'Info', 'tm-9studio' ),
							'icon'   => 'dashicons-id-alt',
							'fields' => array(
								array(
									'id'      => 'info_tagline',
									'type'    => 'text',
									'title'   => esc_attr__( 'Tagline', 'tm-9studio' ),
									'default' => esc_attr__( 'Designer', 'tm-9studio' ),
								),
								array(
									'id'      => 'info_has_profile',
									'type'    => 'switch',
									'title'   => esc_html__( 'Single profile page enable', 'tm-9studio' ),
									'desc'    => esc_html__( 'If choose Yes, this member will have link to the profile page', 'tm-9studio' ),
									'default' => 'yes',
									'options' => array(
										'yes' => esc_html__( 'Yes', 'tm-9studio' ),
										'no'  => esc_html__( 'No', 'tm-9studio' ),
									),
								),
							),
						),
						array(
							'title'  => esc_attr__( 'Socials', 'tm-9studio' ),
							'icon'   => 'dashicons-admin-links',
							'fields' => array(
								array(
									'id'    => 'social_facebook',
									'type'  => 'text',
									'title' => esc_attr__( 'Facebook', 'tm-9studio' ),
								),
								array(
									'id'    => 'social_twitter',
									'type'  => 'text',
									'title' => esc_attr__( 'Twitter', 'tm-9studio' ),
								),
								array(
									'id'    => 'social_googleplus',
									'type'  => 'text',
									'title' => esc_attr__( 'Google Plus', 'tm-9studio' ),
								),
								array(
									'id'    => 'social_youtube',
									'type'  => 'text',
									'title' => esc_attr__( 'Youtube', 'tm-9studio' ),
								),
								array(
									'id'    => 'social_vimeo',
									'type'  => 'text',
									'title' => esc_attr__( 'Vimeo', 'tm-9studio' ),
								),
							),
						),
						array(
							'title'  => esc_attr__( 'Layout', 'tm-9studio' ),
							'icon'   => 'dashicons-layout',
							'fields' => array(
								array(
									'id'      => 'page_padding',
									'type'    => 'switch',
									'title'   => esc_html__( 'Padding top & bottom', 'tm-9studio' ),
									'desc'    => esc_html__( 'If choose yes, the page content will have the padding top & bottom is 120px.', 'tm-9studio' ),
									'default' => 'yes',
									'options' => array(
										'no'  => esc_html__( 'No', 'tm-9studio' ),
										'yes' => esc_html__( 'Yes', 'tm-9studio' )
									),
								),
								array(
									'id'    => 'body_class',
									'type'  => 'text',
									'title' => esc_attr__( 'Body class', 'tm-9studio' ),
								),
							),
						),
						array(
							'title'  => esc_attr__( 'Title & Breadcrumbs', 'tm-9studio' ),
							'icon'   => 'dashicons-welcome-widgets-menus',
							'fields' => array(
								array(
									'id'      => 'title_visibility',
									'title'   => esc_attr__( 'Title visibility', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'visible',
									'options' => array(
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'custom_title_style',
									'type'    => 'switch',
									'title'   => esc_html__( 'Title style', 'tm-9studio' ),
									'default' => 'default-style',
									'options' => array(
										'default-style' => esc_html__( 'Default', 'tm-9studio' ),
										'big-style'     => esc_html__( 'Big', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'custom_title',
									'type'    => 'text',
									'title'   => esc_attr__( 'Custom title', 'tm-9studio' ),
									'default' => '',
								),
								array(
									'id'      => 'custom_title_bg_image',
									'type'    => 'media',
									'title'   => esc_attr__( 'Custom title background image', 'tm-9studio' ),
									'default' => '',
								),
								array(
									'id'      => 'breadcrumbs_visibility',
									'type'    => 'switch',
									'title'   => esc_attr__( 'Breadcrumbs visibility', 'tm-9studio' ),
									'desc'    => esc_html__( 'If you hide the title section, breadcrumbs will be hidden.', 'tm-9studio' ),
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
							),
						),
						array(
							'title'  => esc_attr__( 'Newsletter', 'tm-9studio' ),
							'icon'   => 'dashicons-feedback',
							'fields' => array(
								array(
									'id'      => 'newsletter_visibility',
									'title'   => esc_attr__( 'Newsletter visibility', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'newsletter_style',
									'title'   => esc_attr__( 'Newsletter style', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'style01',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'style01' => esc_html__( 'Style 01', 'tm-9studio' ),
										'style02' => esc_html__( 'Style 02', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'newsletter_bg',
									'type'    => 'media',
									'title'   => esc_attr__( 'Custom background image', 'tm-9studio' ),
									'default' => '',
								),
							),
						),
						array(
							'title'  => esc_attr__( 'Footer', 'tm-9studio' ),
							'icon'   => 'dashicons-feedback',
							'fields' => array(
								array(
									'id'      => 'footer_visibility',
									'title'   => esc_attr__( 'Footer visibility', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'footer_style',
									'title'   => esc_attr__( 'Footer style', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'style01' => esc_html__( 'Style 01 (Light)', 'tm-9studio' ),
										'style02' => esc_html__( 'Style 02 (Dark)', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'footer_logo',
									'type'    => 'media',
									'title'   => esc_attr__( 'Custom footer logo', 'tm-9studio' ),
									'default' => '',
								),
							),
						),
						array(
							'title'  => esc_attr__( 'Copyright', 'tm-9studio' ),
							'icon'   => 'dashicons-feedback',
							'fields' => array(
								array(
									'id'      => 'copyright_visibility',
									'title'   => esc_attr__( 'Copyright visibility', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'copyright_style',
									'title'   => esc_attr__( 'Copyright style', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'style01' => esc_html__( 'Style 01 (Light)', 'tm-9studio' ),
										'style02' => esc_html__( 'Style 02 (Dark)', 'tm-9studio' ),
									),
								),
							),
						),
					),
				),
			),
		);

		$meta_boxes[] = array(
			'id'         => 'insight_page_options',
			'title'      => esc_html__( 'Project Options', 'tm-9studio' ),
			'post_types' => array( 'ic_project' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields'     => array(
				array(
					'type'  => 'tabpanel',
					'items' => array(
						array(
							'title'  => esc_attr__( 'Project', 'tm-9studio' ),
							'icon'   => 'dashicons-layout',
							'fields' => array(
								array(
									'id'      => 'featured',
									'type'    => 'switch',
									'title'   => esc_html__( 'Set featured', 'tm-9studio' ),
									'desc'    => esc_html__( 'Set this project is featured?', 'tm-9studio' ),
									'default' => 'no',
									'options' => array(
										'no'  => esc_html__( 'No', 'tm-9studio' ),
										'yes' => esc_html__( 'Yes', 'tm-9studio' )
									),
								),
							),
						),
						array(
							'title'  => esc_attr__( 'Layout', 'tm-9studio' ),
							'icon'   => 'dashicons-layout',
							'fields' => array(
								array(
									'id'      => 'page_padding',
									'type'    => 'switch',
									'title'   => esc_html__( 'Padding top & bottom', 'tm-9studio' ),
									'desc'    => esc_html__( 'If choose yes, the page content will have the padding top & bottom is 120px.', 'tm-9studio' ),
									'default' => 'yes',
									'options' => array(
										'no'  => esc_html__( 'No', 'tm-9studio' ),
										'yes' => esc_html__( 'Yes', 'tm-9studio' )
									),
								),
								array(
									'id'    => 'body_class',
									'type'  => 'text',
									'title' => esc_attr__( 'Body class', 'tm-9studio' ),
								),
							),
						),
						array(
							'title'  => esc_attr__( 'Title & Breadcrumbs', 'tm-9studio' ),
							'icon'   => 'dashicons-welcome-widgets-menus',
							'fields' => array(
								array(
									'id'      => 'title_visibility',
									'title'   => esc_attr__( 'Title visibility', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'visible',
									'options' => array(
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'custom_title_style',
									'type'    => 'switch',
									'title'   => esc_html__( 'Title style', 'tm-9studio' ),
									'default' => 'default-style',
									'options' => array(
										'default-style' => esc_html__( 'Default', 'tm-9studio' ),
										'big-style'     => esc_html__( 'Big', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'custom_title',
									'type'    => 'text',
									'title'   => esc_attr__( 'Custom title', 'tm-9studio' ),
									'default' => '',
								),
								array(
									'id'      => 'custom_title_bg_image',
									'type'    => 'media',
									'title'   => esc_attr__( 'Custom title background image', 'tm-9studio' ),
									'default' => '',
								),
								array(
									'id'      => 'breadcrumbs_visibility',
									'type'    => 'switch',
									'title'   => esc_attr__( 'Breadcrumbs visibility', 'tm-9studio' ),
									'desc'    => esc_html__( 'If you hide the title section, breadcrumbs will be hidden.', 'tm-9studio' ),
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
							),
						),
						array(
							'title'  => esc_attr__( 'Newsletter', 'tm-9studio' ),
							'icon'   => 'dashicons-feedback',
							'fields' => array(
								array(
									'id'      => 'newsletter_visibility',
									'title'   => esc_attr__( 'Newsletter visibility', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'newsletter_style',
									'title'   => esc_attr__( 'Newsletter style', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'style01',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'style01' => esc_html__( 'Style 01', 'tm-9studio' ),
										'style02' => esc_html__( 'Style 02', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'newsletter_bg',
									'type'    => 'media',
									'title'   => esc_attr__( 'Custom background image', 'tm-9studio' ),
									'default' => '',
								),
							),
						),
						array(
							'title'  => esc_attr__( 'Footer', 'tm-9studio' ),
							'icon'   => 'dashicons-feedback',
							'fields' => array(
								array(
									'id'      => 'footer_visibility',
									'title'   => esc_attr__( 'Footer visibility', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'footer_style',
									'title'   => esc_attr__( 'Footer style', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'style01' => esc_html__( 'Style 01 (Light)', 'tm-9studio' ),
										'style02' => esc_html__( 'Style 02 (Dark)', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'footer_logo',
									'type'    => 'media',
									'title'   => esc_attr__( 'Custom footer logo', 'tm-9studio' ),
									'default' => '',
								),
							),
						),
						array(
							'title'  => esc_attr__( 'Copyright', 'tm-9studio' ),
							'icon'   => 'dashicons-feedback',
							'fields' => array(
								array(
									'id'      => 'copyright_visibility',
									'title'   => esc_attr__( 'Copyright visibility', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'visible' => esc_html__( 'Visible', 'tm-9studio' ),
										'hidden'  => esc_html__( 'Hidden', 'tm-9studio' ),
									),
								),
								array(
									'id'      => 'copyright_style',
									'title'   => esc_attr__( 'Copyright style', 'tm-9studio' ),
									'type'    => 'switch',
									'default' => 'default',
									'options' => array(
										'default' => esc_html__( 'Default', 'tm-9studio' ),
										'style01' => esc_html__( 'Style 01 (Light)', 'tm-9studio' ),
										'style02' => esc_html__( 'Style 02 (Dark)', 'tm-9studio' ),
									),
								),
							),
						),
					),
				),
			),
		);

		return $meta_boxes;
	}

}
