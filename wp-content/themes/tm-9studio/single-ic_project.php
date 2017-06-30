<?php
get_header();
?>
<?php Insight::page_title(); ?>
	<div class="container">
		<div id="primary" class="content-area project-content-area row">
			<div id="main" class="main col-md-12" role="main">
				<?php
				while ( have_posts() ) : the_post();
					Insight_Helper::set_post_views( get_the_ID() );
					the_content();
				endwhile;
				?>
			</div>
		</div>
	</div>
<?php
get_footer();
