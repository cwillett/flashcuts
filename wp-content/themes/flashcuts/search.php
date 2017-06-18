<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

	<h1>Search Results:</h1>
	<?php get_template_part( 'loop', 'search' ); ?>

<?php else : ?>

	<h1>Nothing found.</h1>
	No results found.
	<?php get_search_form(); ?>

<?php endif; ?>

<?php get_footer(); ?>