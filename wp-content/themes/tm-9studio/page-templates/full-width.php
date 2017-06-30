<?php
/*
Template Name: Full Width
*/

get_header();
if ( ( Insight_Helper::get_post_meta( 'page_layout' ) == 'default' ) || ( Insight_Helper::get_post_meta( 'page_layout' ) == '' ) ) {
	$layout = Insight::setting( 'page_layout' );
} else {
	$layout = Insight_Helper::get_post_meta( 'page_layout' );
}
?>
<?php Insight::page_title(); ?>
	<div class="container-fuild">
		<div id="primary" class="content-area">
			<div id="main" class="main">
				<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'components/content', 'page' );
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile; // End of the loop.
				?>
			</div>
		</div>
	</div>
<?php
get_footer();
