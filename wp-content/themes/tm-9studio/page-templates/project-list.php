<?php
/*
Template Name: Project List
*/

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
				global $wp_query;
				$paged     = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$args      = array(
					'post_type' => 'ic_project',
					'paged'     => $paged
				);
				$the_query = new WP_Query( $args );
				$tmp_query = $wp_query;
				$wp_query  = null;
				$wp_query  = $the_query;
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						get_template_part( 'components/content', 'project-list' );
					}
					Insight::paging_nav();
					wp_reset_query();
				} else {
					get_template_part( 'components/content', 'none' );
				}
				?>
			</div>
		</div>
	</div>
<?php
get_footer();
