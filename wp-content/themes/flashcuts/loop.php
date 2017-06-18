<?php /* NO POSTS */ ?>
<?php if ( ! have_posts() ) : ?>

	<h1>Not found.</h1>
	No results found.
	<?php get_search_form(); ?>

<?php endif; ?>



 
<?php /* LOOP */ ?>
<?php while ( have_posts() ) : the_post(); ?>

	<h1><?php the_title(); ?></h1>
	<?php the_content(); ?>

<?php endwhile; ?>



 
<?php /* POST NAV */ ?>

<br></br>
<?php // wp_pagenavi(); // ?>