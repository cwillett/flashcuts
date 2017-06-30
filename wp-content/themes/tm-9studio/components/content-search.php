<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package tm-9studio
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'blog-classic-style style-02' ); ?>>
	<div class="row">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="col-md-5">
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( array( 370, 250 ) ); ?>
					</a>
				</div>
			</div>
		<?php } ?>
		<div class="entry-desc col-md-7">
			<div class="entry-meta nd-font">
				<?php Insight_Templates::posted_on_list(); ?>
			</div>
			<a href="<?php the_permalink(); ?>"><?php the_title( '<h5 class="entry-title nd-font">', '</h5>' ); ?></a>
			<div class="entry-content">
				<?php echo '<p>' . get_the_excerpt() . '</p>'; ?>
			</div>
			<div class="row">
				<div class="entry-more col-md-12">
					<?php echo '<a href="' . get_permalink() . '">' . esc_html__( '/ Read more', 'tm-9studio' ) . '</a>'; ?>
				</div>
			</div>
		</div>
	</div>
</div><!-- #post-## -->