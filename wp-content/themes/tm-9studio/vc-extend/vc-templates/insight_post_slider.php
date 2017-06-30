<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class;

$slides = (array) vc_param_group_parse_atts( $slides );

if ( empty( $slides ) ) {
	return;
}

$slider_nav = '';

?>
<div class="insight-post-slider <?php echo esc_attr( $el_class ) ?>">
	<div class="post-slider">
		<?php
		foreach ( $slides as $key => $slide ) {
			extract( $slide );
			$image = Insight_Helper::img_fullsize( $slide_bg_image );

			// Get style
			$style = '';
			if ( ! empty( $image ) ) {
				$style .= 'background-image: url(' . $image . ')';
			}

			$selector = uniqid( 'insight-slide-' );

			$params = array(
				'p' => $post_id,
			);

			$loop = new WP_Query( $params );

			?>
			<div id="<?php echo esc_attr( $selector ) ?>" class="item">
				<div class="container">
					<div class="row">
						<?php
						Insight_Helper::apply_style( $style, '#' . $selector );

						if ( $loop->have_posts() ) {
							while ( $loop->have_posts() ) {
								$loop->the_post();
								?>
								<div <?php post_class( 'col-md-6 blog-classic-style blog-list-v3' );
								?>>
									<div class="insight-list-categories nd-font">
										<?php echo get_the_category_list( esc_html__( ' ', 'tm-9studio' ) ) ?>
									</div>
									<div class="entry-desc">
										<a href="<?php the_permalink();
										?>"><?php the_title( '<h3 class="entry-title nd-font">', '</h3>' );
											?></a>

										<?php Insight_Templates::metadata_standard();
										?>

										<div class="entry-content">
											<p><?php echo wp_trim_words( get_the_excerpt(), 20 );
												?></p>
										</div>
									</div>
								</div><!-- #post-## -->
								<?php
								$img = wp_get_attachment_image_src( $slide_bg_image, 'insight-post-list' );
								if ( isset( $img[0] ) ) {
									$img = $img[0];
								}
								$slider_nav .= '<li class="slider-nav-item" data-slide="' . esc_attr( $key ) . '">';
								$slider_nav .= '<div class="thumb">';
								$slider_nav .= '<img src="' . esc_attr( $img ) . '" alt="" />';
								$slider_nav .= '</div>';
								$slider_nav .= '<div class="desc nd-font"><div class="slider-nav-cats">' . get_the_category_list( esc_html__( ' ', 'tm-9studio' ) ) . '</div>';
								$slider_nav .= '<h6 class="slider-nav-title">' . get_the_title( get_the_ID() ) . '</h6>';
								$slider_nav .= '</div></li>';
							}
							wp_reset_postdata();
						}
						?>
					</div>
				</div>
			</div>
			<?php

		}
		?>
	</div>
	<ul class="slider-nav-container">
		<?php Insight_Helper::output( $slider_nav ) ?>
	</ul>
</div>
