<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class;

$terms = get_terms( 'ic_our_team_group', array(
	'slug' => explode( ',', $our_team_group ),
) );

$row_items      = 12 / ( $number_per_row ? $number_per_row : 4 );
$item_col_class = 'col-md-' . $row_items;
?>

<div class="insight-team-filter <?php echo esc_attr( $el_class ) ?>">
	<?php if ( is_array( $terms ) && ( count( $terms ) > 0 ) ) { ?>
		<div class="insight-filter insight-filter-scroll">
			<ul>
				<li>
					<a class="active" data-filter="insight-all">
						<?php esc_html_e( '#All', 'tm-9studio' ) ?>
					</a>
				</li>
				<?php foreach ( $terms as $key => $term ): ?>
					<li>
						<a data-filter="<?php echo esc_attr( $term->slug ); ?>">
							<?php echo '#' . $term->name ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php } ?>
	<?php
	$params    = array(
		'posts_per_page'      => $number,
		'post_type'           => 'ic_our_team',
		'ignore_sticky_posts' => 1,
		'tax_query'           => array(
			'relation' => 'or',
			array(
				'taxonomy' => 'ic_our_team_group',
				'field'    => 'slug',
				'terms'    => explode( ',', $our_team_group )
			)
		),
	);
	$team_loop = new WP_Query( $params );
	?>
	<div class="insight-filter-items items row">
		<?php
		while ( $team_loop->have_posts() ) :
			$team_loop->the_post();
			$groups           = wp_get_post_terms( get_the_ID(), 'ic_our_team_group', array( "fields" => "all" ) );
			$item_group_class = '';
			if ( is_array( $groups ) && ( count( $groups ) > 0 ) ) {
				foreach ( $groups as $group ) {
					$item_group_class .= ' ' . $group->slug;
				}
			}
			?>
			<div class="insight-filter-item item <?php echo esc_attr( $item_col_class . $item_group_class ); ?>">
				<div class="insight-filter-item-inner">
					<div class="thumb">
						<?php
						if ( Insight_Helper::get_post_meta( 'info_has_profile' ) == 'yes' ) {
							echo '<a href="' . get_permalink() . '">';
							if ( $image_size == '01' ) {
								the_post_thumbnail( 'insight-our-team-01' );
							} else {
								the_post_thumbnail( 'insight-our-team-02' );
							}
							echo '</a>';
						} else {
							if ( $image_size == '01' ) {
								the_post_thumbnail( 'insight-our-team-01' );
							} else {
								the_post_thumbnail( 'insight-our-team-02' );
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
		endwhile;
		wp_reset_postdata();
		?>
	</div>
	<?php
	?>
</div>
