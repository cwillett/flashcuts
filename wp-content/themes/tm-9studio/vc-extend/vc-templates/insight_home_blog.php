<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
?>
<div class="insight-home-blog <?php echo esc_attr( $el_class ); ?>">
	<div class="row">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					<div class="blog-wrap blog-01">
						<?php
						if ( $blog_01 ) {
							echo '<a href="' . get_permalink( $blog_01 ) . '">';
							echo '<div class="row">';
							if ( $image_01 ) {
								echo '<div class="col-md-6 col-image"><div class="image">' . wp_get_attachment_image( $image_01, 'full' ) . '</div></div>';
							} else {
								echo '<div class="col-md-6 col-image"><div class="image">' . get_the_post_thumbnail( $blog_01, 'insight-post-grid' ) . '</div></div>';
							}
							echo '<div class="col-md-6 col-text">';
							echo '<div class="time">' . get_the_time( 'M d, Y', $blog_01 ) . '</div>';
							echo '<div class="title">' . get_the_title( $blog_01 ) . '</div>';
							echo '<div class="meta">';
							$view_count = Insight_Helper::get_post_views( $blog_01 );
							echo '<span class="view">' . sprintf( _n( '%s View', '%s Views', $view_count, 'tm-9studio' ), $view_count ) . '</span>';
							$comment_count = get_comments_number( $blog_01 );
							echo '<span class="comment">' . sprintf( _n( '%s Comment', '%s Comments', $comment_count, 'tm-9studio' ), $comment_count ) . '</span>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</a>';
						}
						?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="blog-wrap blog-03">
						<?php
						if ( $blog_03 ) {
							echo '<a href="' . get_permalink( $blog_03 ) . '">';
							echo '<div class="row">';
							if ( has_post_format( 'quote', $blog_03 ) ) {
								echo '<div class="col-md-12 col-quote">' . get_the_post_thumbnail( $blog_04, 'insight-post-grid' );
								echo '<div class="text">';
								echo '<div class="time">' . get_the_time( 'M d, Y', $blog_03 ) . '</div>';
								echo '<div class="title">';
								$quote = get_post_meta( $blog_03, '_format_quote_text', true );
								echo esc_html( $quote );
								echo '</div>';
								echo '<div class="meta">';
								$view_count = Insight_Helper::get_post_views( $blog_03 );
								echo '<span class="view">' . sprintf( _n( '%s View', '%s Views', $view_count, 'tm-9studio' ), $view_count ) . '</span>';
								$comment_count = get_comments_number( $blog_03 );
								echo '<span class="comment">' . sprintf( _n( '%s Comment', '%s Comments', $comment_count, 'tm-9studio' ), $comment_count ) . '</span>';
								echo '</div>';
								echo '</div>';
								echo '</div>';
							} else {
								echo '<div class="col-md-12 col-image"><div class="image">' . get_the_post_thumbnail( $blog_03, 'insight-post-grid' ) . '</div></div>';
							}
							echo '</div>';
							echo '</a>';
						}
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="blog-wrap blog-04">
						<?php
						if ( $blog_04 ) {
							echo '<a href="' . get_permalink( $blog_04 ) . '">';
							echo '<div class="row">';
							echo '<div class="col-md-12 col-image"><div class="image">';
							if ( has_post_format( 'video', $blog_04 ) ) {
								echo '<span class="video-play"></span>';
							}
							if ( $image_04 ) {
								echo wp_get_attachment_image( $image_04, 'full' );
							} else {
								echo get_the_post_thumbnail( $blog_04, 'insight-post-grid' );
							}
							echo '</div></div>';
							echo '</div>';
							echo '</a>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="blog-wrap blog-02">
				<?php
				if ( $blog_02 ) {
					echo '<a href="' . get_permalink( $blog_02 ) . '">';
					echo '<div class="row">';
					if ( $image_02 ) {
						echo '<div class="col-md-12 col-image"><div class="image">' . wp_get_attachment_image( $image_02, 'full' ) . '</div></div>';
					} else {
						echo '<div class="col-md-12 col-image"><div class="image">' . get_the_post_thumbnail( $blog_02, 'insight-post-grid' ) . '</div></div>';
					}
					echo '<div class="col-md-12 col-text">';
					echo '<div class="time">' . get_the_time( 'M d, Y', $blog_02 ) . '</div>';
					echo '<div class="title">' . get_the_title( $blog_02 ) . '</div>';
					echo '<div class="meta">';
					$view_count = Insight_Helper::get_post_views( $blog_02 );
					echo '<span class="view">' . sprintf( _n( '%s View', '%s Views', $view_count, 'tm-9studio' ), $view_count ) . '</span>';
					$comment_count = get_comments_number( $blog_02 );
					echo '<span class="comment">' . sprintf( _n( '%s Comment', '%s Comments', $comment_count, 'tm-9studio' ), $comment_count ) . '</span>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
					echo '</a>';
				}
				?>
			</div>
		</div>
	</div>
</div>