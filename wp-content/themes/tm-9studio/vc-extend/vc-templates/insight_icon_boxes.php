<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class . ' ' . $style;

// Get icon
$icon_html = '';
if ( $custom_icon != '' && $icon_type == 'custom' ) {
	if ( is_numeric( $custom_icon ) ) {
		$custom_icon_src = wp_get_attachment_url( $custom_icon );
	} else {
		$custom_icon_src = $custom_icon;
	}
	$icon_html .= '<img src="' . esc_url( $custom_icon_src ) . '" alt="">';
} else {
	$icon_class = isset( ${'icon_' . $icon_lib} ) ? esc_attr( ${'icon_' . $icon_lib} ) : 'ionic';
	$icon_html .= "<i class='" . $icon_class . "' ></i>";
}

// Get element tag
if ( empty( $element_tag ) ) {
	$element_tag = 'h5';
}

// Get link
if ( isset( $link ) && ! empty( $link ) ) {
	$link        = vc_build_link( $link );
	$link_url    = ( isset( $link['url'] ) ) ? $link['url'] : '';
	$link_text   = ( isset( $link['title'] ) ) ? $link['title'] : '';
	$link_target = ( isset( $link['target'] ) && ! empty( $link['target'] ) ) ? $link['target'] : '_self';
	$link_rel    = ( isset( $link['rel'] ) ) ? $link['rel'] : '';
}
?>

<?php
// small_icon
if ( $style == 'small_icon' ) { ?>
	<div class="icon-boxes <?php echo esc_attr( $el_class ) ?>">
		<div class="icon-boxes--inner">
			<?php if ( $display_icon == 'yes' ): ?>
				<div class="icon-boxes--icon"><?php Insight_Helper::output( $icon_html ) ?></div>
			<?php endif; ?>
			<<?php echo esc_attr( $element_tag ) ?> class="icon-boxes--title nd-font">
			<?php echo esc_html( $title ) ?>
		</<?php echo esc_attr( $element_tag ) ?>>
		<div class="icon-boxes--content"><?php Insight_Helper::output( $content ) ?></div>
	</div>
	</div>
<?php } ?>
<?php
// icon_on_left
if ( $style == 'icon_on_left' ) { ?>
	<div class="icon-boxes <?php echo esc_attr( $el_class ) ?>">
		<?php
		$style_cl = '';
		if ( $icon_text != '' ) {
			$style_cl = 'text-icon nd-font';
		} ?>
		<?php if ( $display_icon == 'yes' ): ?>
			<div class="icon-boxes--icon <?php echo esc_attr( $style_cl ) ?>">
				<?php
				if ( $icon_text != '' ) {
					Insight_Helper::output( '<span class="inner">' . $icon_text . '</span>' );
				} else {
					Insight_Helper::output( $icon_html );
				}
				?>
			</div>
		<?php endif; ?>
		<div class="icon-boxes--inner">
			<?php echo '<' . esc_attr( $element_tag ) . ' class="icon-boxes--title nd-font">'; ?>
			<?php echo esc_html( $title ) ?>
			<?php echo '</' . esc_attr( $element_tag ) . '>'; ?>
			<div class="icon-boxes--content"><?php Insight_Helper::output( $content ) ?></div>
		</div>
	</div>
<?php } ?>
<?php
// icon_on_top or icon_on_top_2
if ( $style == 'icon_on_top' || $style == 'icon_on_top_2' ) { ?>
	<?php
	$style          = '';
	$selector_style = uniqid( 'selector_style-' );
	if ( ! empty( $icon_bg ) ) {
		$style = 'background-image: url("' . wp_get_attachment_url( $icon_bg ) . '")';
		Insight_Helper::apply_style( $style, '#' . $selector_style );
	}
	?>
	<div class="icon-boxes <?php echo esc_attr( $el_class ) ?>">
		<?php if ( $display_icon == 'yes' ): ?>
			<div class="icon-boxes--icon"
			     id="<?php echo esc_attr( $selector_style ) ?>"><?php Insight_Helper::output( $icon_html ) ?></div>
		<?php endif; ?>
		<div class="icon-boxes--inner">
			<?php echo '<' . esc_attr( $element_tag ) . ' class="icon-boxes--title nd-font">'; ?>
			<?php echo esc_html( $title ) ?>
			<?php echo '</' . esc_attr( $element_tag ) . '>'; ?>
			<div class="icon-boxes--content"><?php Insight_Helper::output( $content ) ?></div>
			<?php
			if ( ! empty( $readmore_link ) ) {
				echo '<div class="icon-boxes--link"><a href="' . $readmore_link . '"><span class="ion-android-arrow-forward"></span></a></div>';
			}
			?>
		</div>
	</div>
<?php } ?>
