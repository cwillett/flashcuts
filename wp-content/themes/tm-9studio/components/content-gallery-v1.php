<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package tm-9studio
 */
$terms = get_the_terms( get_the_ID(), 'ic_gallery_category' );

$terms_slugs = array();
$terms_names = array();

foreach ( $terms as $term ) {
	$terms_slugs[] = $term->slug;
	$terms_names[] = $term->name;
}

Insight_Helper::$class_name = 'col-md-3';

if ( Insight_Helper::$current_index == 1 || Insight_Helper::$current_index == 7 ) {
	Insight_Helper::$class_name .= ' h-x2';
} elseif ( Insight_Helper::$current_index == 5 || Insight_Helper::$current_index == 6 ) {
	Insight_Helper::$class_name = 'col-md-6 x2';
} elseif ( Insight_Helper::$current_index == 0 ) {
	Insight_Helper::$class_name .= ' base-item';
}
?>
<div
	id="post-<?php the_ID(); ?>" <?php post_class( 'insight-gallery-item ' . esc_attr( implode( ' ', $terms_slugs ) ) . ' ' . Insight_Helper::$class_name ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<?php $img_id = get_post_thumbnail_id( get_the_ID() ); ?>
		<div class="insight-gallery-image">
			<a href="<?php echo esc_url( Insight_Helper::img_fullsize( $img_id ) ) ?>">
				<?php
				if ( Insight_Helper::$current_index == 1 || Insight_Helper::$current_index == 7 ) {
					the_post_thumbnail( 'insight-gallery-v202' );
				} else {
					the_post_thumbnail( 'insight-gallery-v201' );
				}
				?>
				<div class="desc-wrap">
					<div class="desc">
						<div class="title rd-font">
							<?php the_title() ?>
						</div>
						<div class="gallery-separator"></div>
						<div class="cates nd-font">
							<?php echo esc_html( implode( ', ', $terms_names ) ); ?>
						</div>
					</div>
				</div>
			</a>
		</div>
	<?php endif; ?>
</div><!-- #post-## -->
