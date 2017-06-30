<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class;

$menu_add_param = (array) vc_param_group_parse_atts( $menu_add_param );

if ( empty( $menu_add_param ) ) {
	return;
}

$current_link = get_permalink();
$ic_cat       = '';
if ( isset( $_GET['cat'] ) && ! empty( $_GET['cat'] ) ) {
	$ic_cat = $_GET['cat'];
}
?>
<div class="insight-menu-add-param <?php echo esc_attr( $el_class ) ?>">
	<ul>
		<?php foreach ( $menu_add_param as $key => $menu ) {
			$slug         = $menu['categories'];
			$categorie    = get_category_by_slug( $slug );
			$class_active = '';
			if ( $ic_cat == $slug ) {
				$class_active = 'active';
			}
			// Get icon
			$icon_html   = '';
			$custom_icon = ( isset( $menu['custom_icon'] ) ) ? $menu['custom_icon'] : '';
			extract( $menu );
			if ( $custom_icon != "" && $icon_type == "custom" ) {
				if ( is_numeric( $custom_icon ) ) {
					$custom_icon_src = wp_get_attachment_url( $custom_icon );
				} else {
					$custom_icon_src = $custom_icon;
				}
				$icon_html .= '<img src="' . esc_url( $custom_icon_src ) . '" alt="">';
			} else {
				$iconClass = isset( ${"icon_" . $icon_lib} ) ? esc_attr( ${"icon_" . $icon_lib} ) : 'ionic';
				$icon_html .= "<i class='" . $iconClass . "' ></i>";
			}
			?>
			<li><a class="<?php echo esc_attr( $class_active ) ?>"
			       href="<?php echo esc_attr( add_query_arg( array( 'cat' => $slug ), $current_link ) ) ?>">
					<?php Insight_Helper::output( $icon_html ) ?>
					<span><?php echo esc_html( $categorie->cat_name ) ?></span></a></li>
			<?php
		} ?>
	</ul>
</div>
