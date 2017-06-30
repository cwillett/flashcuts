<?php
get_header();
?>
<?php Insight::page_title(); ?>
	<div class="container">
		<div id="primary" class="content-area row">
			<div id="main"
			     class="main col-md-12"
			     role="main">
				<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'components/content', 'page' );
				endwhile; // End of the loop.
				?>
			</div>
		</div>
	</div>
<?php
get_footer();
