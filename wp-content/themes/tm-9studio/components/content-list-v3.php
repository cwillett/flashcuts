<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'blog-classic-style blog-list-v3' ); ?>>
	<?php if ( has_post_format( 'quote' ) ) { ?>
		<?php $quote = get_post_meta( $post->ID, '_format_quote_text', true ); ?>
		<?php if ( $quote ) { ?>
			<div class="post-quote">
				<div class="row">
					<div class="col-md-6">
						<span class="entry-meta">
							<?php Insight_Templates::posted_on_list(); ?>
						</span>
					</div>
					<div class="col-md-6 text-right">
						<div class="insight-list-categories nd-font">
							<?php echo get_the_category_list( esc_html__( ' ', 'tm-9studio' ) ) ?>
						</div>
					</div>
				</div>
				<blockquote>
					<a href="<?php the_permalink(); ?>"><h3 class="rd-font"><?php echo esc_attr( $quote ); ?></h3></a>
				</blockquote>

				<?php Insight_Templates::metadata_standard(); ?>
			</div>
		<?php } else { ?>
			<span class="entry-meta">
				<?php Insight_Templates::posted_on_list(); ?>
			</span>
			<a href="<?php the_permalink(); ?>"><?php the_title( '<h3 class="entry-title rd-font">', '</h3>' ); ?></a>
			<?php Insight_Templates::metadata_standard(); ?>
		<?php } ?>
	<?php } else { ?>

		<?php if ( has_post_thumbnail() ) { ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'insight-post-full' ); ?>
				</a>
				<div class="insight-list-categories nd-font">
					<?php echo get_the_category_list( esc_html__( ' ', 'tm-9studio' ) ) ?>
				</div>
			</div>
		<?php } ?>
		<div class="entry-desc">
			<a href="<?php the_permalink(); ?>"><?php the_title( '<h4 class="entry-title rd-font">', '</h4>' ); ?></a>

			<?php Insight_Templates::metadata_standard(); ?>

			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div>
			<div class="row">
				<div class="entry-more col-md-6">
					<?php echo '<a class="insight-btn" href="' . get_permalink() . '">' . esc_html__( 'Read more', 'tm-9studio' ) . '</a>'; ?>
				</div>
				<div class="entry-share col-md-6">
					<ul class="insight-social">
						<li class="facebook hint--top hint--bounce hint--success"
						    aria-label="<?php esc_html_e( 'Share on Facebook', 'tm-9studio' ) ?>">
							<a target="_blank"
							   href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>">
								<i class="fa fa-facebook"></i>
							</a>
						</li>
						<li class="twitter hint--top hint--bounce hint--success"
						    aria-label="<?php esc_html_e( 'Share on Twitter', 'tm-9studio' ) ?>">
							<a target="_blank"
							   href="http://twitter.com/share?text=<?php echo urlencode( get_the_title() ); ?>&url=<?php echo urlencode( get_permalink() ); ?>"><i
									class="fa fa-twitter"></i></a>
						</li>
						<li class="vine hint--top hint--bounce hint--success"
						    aria-label="<?php esc_html_e( 'Share on Google Plus', 'tm-9studio' ) ?>">
							<a target="_blank"
							   href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink() ); ?>"><i
									class="fa fa-google-plus"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>

	<?php } ?>
</div><!-- #post-## -->
