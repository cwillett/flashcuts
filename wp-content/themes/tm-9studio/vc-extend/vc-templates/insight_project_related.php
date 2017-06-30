<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$pid = get_the_ID();
?>
<div class="insight-project-related">
	<?php
	if ( is_singular( 'ic_project' ) ) {
		echo '<div class="related-title">' . ( $title != '' ? esc_html( $title ) : esc_html__( 'Related Projects', 'tm-9studio' ) ) . '</div>';
		$params       = array(
			'posts_per_page'      => $number,
			'post_type'           => 'ic_project',
			'ignore_sticky_posts' => 1,
			'post__not_in'        => array( $pid ),
		);
		$project_loop = new WP_Query( $params );
		if ( $project_loop->have_posts() ) {
			echo '<div class="items">';
			while ( $project_loop->have_posts() ) {
				$project_loop->the_post();
				?>
				<div class="item">
					<div class="item-inner">
						<div class="thumb">
							<a href="<?php echo get_permalink(); ?>">
								<?php the_post_thumbnail( 'insight-project-list' ); ?>
							</a>
						</div>
						<div class="info">
							<div class="title">
								<a href="<?php echo get_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</div>
							<?php
							$project_categories = wp_get_post_terms( get_the_ID(), 'ic_project_category', array( "fields" => "all" ) );
							if ( is_array( $project_categories ) && ( count( $project_categories ) > 0 ) ) {
								echo '<div class="category">';
								foreach ( $project_categories as $project_category ) {
									echo '<a href="' . get_term_link( $project_category ) . '">' . esc_html( $project_category->name ) . '</a>';
								}
								echo '</div>';
							}
							?>
						</div>
					</div>
				</div>
				<?php
			}
			echo '</div>';
		}
		wp_reset_postdata();
		?>
		<?php
	} else {
		esc_html_e( 'This shortcode just for single project page.', 'tm-9studio' );
	}
	?>
</div>
<script>
	jQuery( document ).ready( function( $ ) {
		$( '.insight-project-related .items' ).slick( {
			infinite: true,
			slidesToShow: <?php echo esc_js( $slides_to_display ); ?>,
			slidesToScroll: <?php echo esc_js( $slides_to_display ); ?>,

			<?php if ( $display_bullets == 'true' ) { ?>
			dots: true,
			<?php } else { ?>
			dots: false,
			<?php } ?>

			<?php if ( $display_arrows == 'true' ) { ?>
			arrows: true,
			<?php } else { ?>
			arrows: false,
			<?php } ?>

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
