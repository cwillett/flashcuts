<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class;

if ( $images == '' ) {
	return;
}

$images = explode( ',', $images );
$i      = - 1;

$data_slick = array();

if ( $dots == 'yes' ) {
	$data_slick['dots'] = true;
}
if ( $autoplay == 'yes' ) {
	$data_slick['autoplay'] = true;
}
$data_slick['arrows'] = true;

$data_slick['slidesToShow']   = (int) $slides_per_row;
$data_slick['slidesToScroll'] = (int) $slides_per_row;
$data_slick['responsive']     = array(
	array(
		'breakpoint' => 480,
		'settings'   => array(
			'slidesToShow'   => 2,
			'slidesToScroll' => 2
		)
	),
);

?>

<div class="insight-carousel <?php echo esc_attr( $el_class ) ?>"
     data-slick='<?php echo wp_json_encode( $data_slick ) ?>'>

	<?php
	foreach ( $images as $attach_id ) :
		$i ++;
		if ( $attach_id > 0 ) {
			if ( $custom_image_size == 'yes' ) {
				$image = Insight_Helper::img_fullsize( $attach_id );
			} else {
				$image = Insight_Helper::img_fullsize( $attach_id );
			}
		} else {
			continue;
		}
		?>
		<div class="insight-carousel--slide">
			<img src="<?php echo esc_url( $image ) ?>" alt=""/>
		</div>
	<?php endforeach; ?>
</div>
