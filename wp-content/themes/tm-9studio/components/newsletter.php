<?php
if ( ! defined( 'WPCF7_VERSION' ) ) {
	return;
}
$newsletter_style = ( Insight_Helper::get_post_meta( 'newsletter_style' ) != '' ) && ( Insight_Helper::get_post_meta( 'newsletter_style' ) != 'default' ) ? Insight_Helper::get_post_meta( 'newsletter_style' ) : Insight::setting( 'newsletter_style' );
$newsletter_bg    = Insight_Helper::get_post_meta( 'newsletter_bg' ) != '' ? Insight_Helper::get_post_meta( 'newsletter_bg' ) : Insight::setting( 'newsletter_background_image' );
?>
<div id="footer-newsletter" class="footer-newsletter <?php echo esc_attr( $newsletter_style ); ?>"
     data-bg="<?php echo esc_url( $newsletter_bg ); ?>">
	<div class="container">
		<div class="row row-xs-center">
			<div class="col-md-1">&nbsp;</div>
			<div class="col-md-4 footer-newsletter-left">
				<?php echo esc_html( Insight::setting( 'newsletter_text' ) ); ?>
			</div>
			<div class="col-md-6 footer-newsletter-right">
				<?php echo do_shortcode( Insight::setting( 'newsletter_shortcode' ) ); ?>
			</div>
			<div class="col-md-1">&nbsp;</div>
		</div>
	</div>
</div>
