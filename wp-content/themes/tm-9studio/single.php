<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package tm-9studio
 */

get_header();

if ( ( Insight_Helper::get_post_meta( 'page_layout' ) == 'default' ) || ( Insight_Helper::get_post_meta( 'page_layout' ) == '' ) ) {
	$post_layout = Insight::setting( 'post_layout' );
} else {
	$post_layout = Insight_Helper::get_post_meta( 'page_layout' );
}
?>

<?php
$custom_title_bg = Insight_Helper::get_post_option( 'custom_title_bg' );
if ( ! empty( $custom_title_bg ) ) :
	?>
	<style>
		html .single.single-post .content .page-title {
			background-image: url("<?php echo esc_attr($custom_title_bg) ?>");
		}
	</style>
	<?php
endif;
?>

<?php Insight::page_title(); ?>
	<div class="container">
		<div id="primary" class="content-area row">
			<?php if ( $post_layout == 'sidebar-content' ) {
				get_sidebar();
			} ?>
			<div id="main"
			     class="main <?php echo esc_attr( $post_layout == 'content-sidebar' || $post_layout == 'sidebar-content' ? 'col-md-9' : 'col-md-12' ); ?>"
			     role="main">
				<?php
				while ( have_posts() ) : the_post();
					// set view_count
					Insight_Helper::set_post_views( get_the_ID() );

					get_template_part( 'components/content', 'single' );
					if ( ( Insight::setting( 'single_post_author' ) == 1 ) && ( get_the_author_meta( 'description' ) != '' ) ) {
						get_template_part( 'components/content', 'author' );
					}
					if ( Insight::setting( 'single_post_nav' ) == 1 ) {
						get_template_part( 'components/content', 'nav' );
					}
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile; // End of the loop.
				?>
			</div>
			<?php if ( $post_layout == 'content-sidebar' ) {
				get_sidebar();
			} ?>
		</div>
	</div>
<?php
get_footer();
