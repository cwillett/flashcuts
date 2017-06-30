<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class ) . ' type-' . $type . ' style-' . $style . ' color-' . $color;
?>
<div class="insight-our-services <?php echo esc_attr( $el_class ); ?>">
	<?php
	if ( $link != '' ) {
		echo '<a href="' . esc_url( $link ) . '">';
	} ?>
	<div class="row insight-our-services-inner <?php echo esc_attr( $type == 'image' ? 'row-xs-center' : '' ); ?>">
		<?php if ( $type == 'icon' ) { ?>
			<div class="col-md-3 col-icon">
				<div class="icon">
					<?php
					$icon_class = isset( ${'icon_' . $icon_lib} ) ? esc_attr( ${'icon_' . $icon_lib} ) : 'ionic';
					echo '<i class="' . esc_attr( $icon_class ) . '"></i>';
					?>
				</div>
			</div>
			<div class="col-md-9 col-text">
				<div class="text">
					<div class="title">
						<?php echo esc_html( $title ); ?>
					</div>
					<div class="content">
						<?php echo esc_html( $content ); ?>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<div class="col-md-6 col-image">
				<?php echo wp_get_attachment_image( $image, 'full' ); ?>
			</div>
			<div class="col-md-6 col-text">
				<div class="text">
					<div class="title">
						<?php echo esc_html( $title ); ?>
					</div>
					<div class="content">
						<?php echo esc_html( $content ); ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php
	if ( $link != '' ) {
		echo '</a>';
	}
	?>
</div>