<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . $css_class . ' ' . $style;

$members = explode( ',', $members );
$uid     = uniqid( 'insight-team-carousel-' );
?>

<div class="insight-team-carousel <?php echo esc_attr( $el_class ) ?>" id="<?php echo esc_attr( $uid ); ?>">
	<?php if ( is_array( $members ) && ( count( $members ) > 0 ) ) {
		$params    = array(
			'posts_per_page'      => 24,
			'post_type'           => 'ic_our_team',
			'ignore_sticky_posts' => 1,
			'post__in'            => $members,
		);
		$team_loop = new WP_Query( $params );
		if ( $team_loop->have_posts() ) {
			while ( $team_loop->have_posts() ) {
				$team_loop->the_post();
				?>
				<div class="team-carousel-item item">
					<div class="insight-filter-item-inner">
						<div class="thumb">
							<?php
							if ( Insight_Helper::get_post_meta( 'info_has_profile' ) == 'yes' ) {
								echo '<a href="' . get_permalink() . '">';
								if ( $image_size == '02' ) {
									the_post_thumbnail( 'insight-our-team-02' );
								} else {
									the_post_thumbnail( 'insight-our-team-01' );
								}
								echo '</a>';
							} else {
								if ( $image_size == '02' ) {
									the_post_thumbnail( 'insight-our-team-02' );
								} else {
									the_post_thumbnail( 'insight-our-team-01' );
								}
							}
							?>
						</div>
						<div class="info">
							<div class="name">
								<?php
								if ( Insight_Helper::get_post_meta( 'info_has_profile' ) == 'yes' ) {
									echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
								} else {
									the_title();
								}
								?>
							</div>
							<div class="tagline">
								<?php echo Insight_Helper::get_post_meta( 'info_tagline' ); ?>
							</div>
							<div class="socials">
								<?php
								if ( Insight_Helper::get_post_meta( 'social_facebook' ) != '' ) {
									echo '<a href="' . esc_url( Insight_Helper::get_post_meta( 'social_facebook' ) ) . '">' . esc_html__( 'Facebook', 'tm-9studio' ) . '</a>';
								}
								if ( Insight_Helper::get_post_meta( 'social_twitter' ) != '' ) {
									echo '<a href="' . esc_url( Insight_Helper::get_post_meta( 'social_twitter' ) ) . '">' . esc_html__( 'Twitter', 'tm-9studio' ) . '</a>';
								}
								if ( Insight_Helper::get_post_meta( 'social_googleplus' ) != '' ) {
									echo '<a href="' . esc_url( Insight_Helper::get_post_meta( 'social_googleplus' ) ) . '">' . esc_html__( 'Google+', 'tm-9studio' ) . '</a>';
								}
								if ( Insight_Helper::get_post_meta( 'social_youtube' ) != '' ) {
									echo '<a href="' . esc_url( Insight_Helper::get_post_meta( 'social_youtube' ) ) . '">' . esc_html__( 'Youtube', 'tm-9studio' ) . '</a>';
								}
								if ( Insight_Helper::get_post_meta( 'social_vimeo' ) != '' ) {
									echo '<a href="' . esc_url( Insight_Helper::get_post_meta( 'social_vimeo' ) ) . '">' . esc_html__( 'Vimeo', 'tm-9studio' ) . '</a>';
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
		}
		wp_reset_postdata();
	} ?>
</div>
<script>
	jQuery( document ).ready( function( $ ) {
		$( '#<?php echo esc_attr( $uid ); ?>' ).slick( {
			infinite: true,
			slidesToShow: <?php echo esc_js( $slides_to_display ); ?>,
			slidesToScroll: <?php echo esc_js( $slides_to_display ); ?>,

			<?php if ( $display_bullets == 'true' ) { ?>
			dots: true,
			<?php } else { ?>
			dots: false,
			<?php } ?>

			arrows: false,

			<?php if ( $enable_autoplay == 'true' ) { ?>
			autoplay: true,
			<?php } else { ?>
			autoplay: false,
			<?php } ?>

			responsive: [
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		} );
	} );
</script>