<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$pages = (array) vc_param_group_parse_atts( $pages );
$uid   = uniqid( 'insight-one-page-' );
?>
<div class="insight-one-page <?php echo esc_attr( $el_class ); ?>" id="<?php echo esc_attr( $uid ); ?>">
	<?php
	if ( count( $pages ) > 0 ) {
		foreach ( $pages as $page ) {
			?>
			<div class="insight-one-page-item">
				<div class="insight-one-page-item-inner"
				     style="background-image: url(<?php echo esc_url( Insight_Helper::img_fullsize( $page['background_image'] ) ) ?>);">
					<div class="text">
						<?php
						echo '<a href="' . get_permalink( $page['project'] ) . '">';
						echo '<div class="time">' . get_the_time( 'M d, Y', $page['project'] ) . '</div>';
						echo '<div class="title">';
						echo get_the_title( $page['project'] );
						echo '</div>';
						echo '<div class="meta">';
						$view_count = Insight_Helper::get_post_views( $page['project'] );
						echo '<span class="view">' . sprintf( _n( '%s View', '%s Views', $view_count, 'tm-9studio' ), $view_count ) . '</span>';
						$comment_count = get_comments_number( $page['project'] );
						echo '<span class="comment">' . sprintf( _n( '%s Comment', '%s Comments', $comment_count, 'tm-9studio' ), $comment_count ) . '</span>';
						echo '</div>';
						echo '</a>';
						?>
					</div>
					<div class="video">
						<div class="video-inner">
							<?php
							echo '<a href="' . esc_url( $page['video'] ) . '" data-poster="' . esc_url( wp_get_attachment_image_url( get_post_thumbnail_id( $page['project'] ), 'full' ) ) . '">';
							if ( $page['video'] != '' ) {
								echo '<span class="video-play"></span>';
							}
							if ( $page['image'] ) {
								echo wp_get_attachment_image( $page['image'], 'full' );
							} else {
								echo get_the_post_thumbnail( $page['project'], 'insight-project-list' );
							}
							echo '</a>';
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
	?>
</div>