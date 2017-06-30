<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package tm-9studio
 */

$post_single_style = Insight_Helper::get_post_option( 'post_single_style' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_format( 'quote' ) ): ?>
		<?php $quote = get_post_meta( $post->ID, '_format_quote_text', true ); ?>
		<?php if ( $quote ) { ?>
			<div class="post-quote">
				<blockquote>
					<h5 class="rd-font"><?php echo esc_html( $quote ); ?></h5>
				</blockquote>
			</div>
		<?php } ?>
	<?php elseif ( has_post_format( 'video' ) ) : ?>
		<div class="post-video">
			<?php $video = get_post_meta( get_the_ID(), '_format_video_embed', true ); ?>
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="single-post-thumbnail">
					<div class="insight-light-video">
						<a href="<?php echo esc_url( $video ); ?>">
							<?php the_post_thumbnail( 'insight-post-full' ); ?>
						</a>
					</div>
					<div class="insight-list-categories nd-font">
						<?php echo get_the_category_list( esc_html__( ' ', 'tm-9studio' ) ) ?>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php elseif ( has_post_format( 'audio' ) ) : ?>
		<div class="post-audio">
			<?php $audio = get_post_meta( $post->ID, '_format_audio_embed', true ); ?>
			<?php if ( wp_oembed_get( $audio ) ) { ?>
				<?php echo wp_oembed_get( $audio ); ?>
			<?php } else { ?>
				<?php echo "" . $audio; ?>
			<?php } ?>
		</div>
	<?php elseif ( has_post_thumbnail() && Insight_Helper::get_post_option( 'featured_image_visibility' ) != 'hidden' ) : ?>
		<div class="single-post-thumbnail">
			<?php
			if ( $post_single_style == 'style02' ) {
				the_post_thumbnail( 'insight-post-full-style02' );
			} else {
				the_post_thumbnail( 'insight-post-full' );
			}
			?>
			<div class="insight-list-categories nd-font">
				<?php echo get_the_category_list( esc_html__( ' ', 'tm-9studio' ) ) ?>
			</div>
		</div>
	<?php endif;
	the_title( '<h4 class="entry-title rd-font">', '</h4>' );

	if ( 'post' === get_post_type() ) {
		Insight_Templates::metadata_standard();
	}
	?>
	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses( esc_html__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'tm-9studio' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tm-9studio' ),
			'after'  => '</div>',
		) );
		?>
	</div>
	<?php get_template_part( 'components/content', 'footer' ); ?>
</article><!-- #post-## -->
