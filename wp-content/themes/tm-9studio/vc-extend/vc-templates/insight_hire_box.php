<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

// Get link
$link_html   = '';
$link        = vc_build_link( $link );
$link_url    = ( isset( $link['url'] ) ) ? $link['url'] : '';
$link_text   = ( isset( $link['title'] ) ) ? $link['title'] : '';
$link_target = ( isset( $link['target'] ) && ! empty( $link['target'] ) ) ? $link['target'] : '_self';
$link_rel    = ( isset( $link['rel'] ) ) ? $link['rel'] : '';
if ( $style == 'style02' ) {
	?>
	<div class="insight-hire-box <?php echo esc_attr( $el_class . ' ' . $style ) ?>">
		<div class="row">
			<div class="col-md-8 insight-hire-box-left">
				<div class="image-text">
					<?php echo esc_html( $image_text ) ?>
				</div>
				<div class="image">
					<?php echo wp_get_attachment_image( $image, 'full' ); ?>
				</div>
			</div>
			<div class="col-md-4 insight-hire-box-right">
				<div class="title">
					<?php echo esc_html( $title ) ?>
				</div>
				<div class="text">
					<?php echo esc_html( $text ) ?>
				</div>
				<?php if ( $link_text != '' ) { ?>
					<div class="link">
						<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_html( $link_target ); ?>"
						   rel="<?php echo esc_html( $link_rel ); ?>">
							<?php echo esc_html( $link_text ); ?>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="insight-hire-box <?php echo esc_attr( $el_class . ' ' . $style ) ?>">
		<div class="title">
			<?php echo esc_html( $title ) ?>
		</div>
		<div class="text">
			<?php echo esc_html( $text ) ?>
		</div>
		<?php if ( $link_text != '' ) { ?>
			<div class="link">
				<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_html( $link_target ); ?>"
				   rel="<?php echo esc_html( $link_rel ); ?>">
					<?php echo esc_html( $link_text ); ?>
				</a>
			</div>
		<?php } ?>
	</div>
<?php } ?>
