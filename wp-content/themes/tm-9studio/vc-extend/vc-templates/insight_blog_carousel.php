<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

if ( $style ) {
	$el_class .= ' ' . $style;
}

$uid = uniqid( 'insight-blog-carousel-' );

if ( ( $number_posts > 0 ) && ( $number_posts < 25 ) ) {
	$params    = array(
		'posts_per_page'      => $number_posts,
		'post_type'           => 'post',
		'ignore_sticky_posts' => 1,
		'order_by'            => $order_by,
		'order'               => $order,
	);
	$blog_loop = new WP_Query( $params );
}
?>
<div class="insight-blog-carousel <?php echo esc_attr( $el_class ); ?>" id="<?php echo esc_attr( $uid ); ?>">
	<?php
	if ( $blog_loop->have_posts() ) {
		while ( $blog_loop->have_posts() ) {
			$blog_loop->the_post();
			if ( $style == 'style02' ) {
				?>
				<div class="blog-item">
					<div class="blog-item-inner">
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="blog-thumbnail">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'insight-post-grid' ); ?>
								</a>
							</div>
						<?php } ?>
						<div class="blog-info">
						<span class="blog-info-date">
							<?php Insight_Templates::posted_on_list(); ?>
						</span>
							<a href="<?php the_permalink(); ?>" class="blog-info-title">
								<?php the_title(); ?>
							</a>
							<div class="blog-info-meta">
								<?php Insight_Templates::metadata_standard( true, true, false ); ?>
							</div>
						</div>
					</div>
				</div>
				<?php
			} else { ?>
				<div class="blog-item">
					<?php
					echo '<a href="' . get_permalink() . '">';
					echo '<div class="blog-item-inner">';
					echo '<div class="time">' . get_the_time( 'M d, Y', get_the_ID() ) . '</div>';
					echo '<div class="title rd-font">';
					echo get_the_title();
					echo '</div>';
					echo '<div class="meta">';
					$view_count = Insight_Helper::get_post_views( get_the_ID() );
					echo '<span class="view">' . sprintf( _n( '%s View', '%s Views', $view_count, 'tm-9studio' ), $view_count ) . '</span>';
					$comment_count = get_comments_number( get_the_ID() );
					echo '<span class="comment">' . sprintf( _n( '%s Comment', '%s Comments', $comment_count, 'tm-9studio' ), $comment_count ) . '</span>';
					echo '</div>';
					echo '</div>';
					echo '</a>';
					?>
				</div>
				<?php
			}
		}
		wp_reset_postdata();
	}
	?>
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
						slidesToScroll: 1,
						<?php if ( $display_bullets == 'true' ) { ?>
						dots: true,
						<?php } else { ?>
						dots: false,
						<?php } ?>
					}
				}
			]
		} );
	} );
</script>
