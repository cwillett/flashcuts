<?php
get_header();
if ( ( Insight_Helper::get_post_meta( 'page_layout' ) == 'default' ) || ( Insight_Helper::get_post_meta( 'page_layout' ) == '' ) ) {
	$page_layout = Insight::setting( 'page_layout' );
} else {
	$page_layout = Insight_Helper::get_post_meta( 'page_layout' );
}
?>
<?php Insight::page_title(); ?>
	<div class="container">
		<div id="primary" class="content-area row">
			<div id="main" class="main col-md-12 project-list-style">
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						get_template_part( 'components/content', 'project-list' );
					}
					Insight::paging_nav();
				} else {
					get_template_part( 'components/content', 'none' );
				}
				?>
			</div>
		</div>
	</div>
<?php
get_footer();
