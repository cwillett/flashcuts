<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package   InsightFramework
 */
class Insight_Templates {

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	public static function posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() ) );

		$posted_on = sprintf( esc_html_x( '%s', 'post date', 'tm-9studio' ), $time_string );

		$categories_list = get_the_category_list( esc_html__( ', ', 'tm-9studio' ) );

		echo '<span class="posted-on"><i class="ion-calendar"></i> ' . $posted_on . '</span><span class="categories"><i class="ion-folder"></i> ' . $categories_list . '</span><span class="comment"><i class="ion-chatbubble-working"></i> ' . get_comments_number_text( '0', '1', '%' ) . '</span>'; // WPCS: XSS OK.
	}

	public static function posted_on_list() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() ) );

		$posted_on = sprintf( esc_html_x( '%s', 'post date', 'tm-9studio' ), $time_string );

		echo '<span class="posted-on">' . $posted_on . '</span>';
	}

	public static function metadata_standard( $view = true, $like = true, $comment = true ) {
		?>
		<div class="meta">
			<?php
			if ( $view ) {
				$view_count = Insight_Helper::get_post_views( get_the_ID() );
				echo '<span class="view">' . sprintf( _n( '%s View', '%s Views', $view_count, 'tm-9studio' ), $view_count ) . '</span>';
			}
			if ( $like ) {
				echo '<span class="like">' . getPostLikeLink( get_the_ID() ) . '</span>';
			}
			if ( $comment ) {
				echo '<span class="comment">';
				comments_number( '0 Comment', '1 Comment', '% Comments' );
				echo '</span>';
			}
			?>
		</div>
		<?php
	}

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	public static function entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', ', ' );
			?>
			<div class="row">
				<div class="col-md-6">
					<?php if ( has_tag() ) : ?>
						<div class="tags nd-font">
							<span class="tag-icon ion-ios-pricetags"></span>
							<?php echo wp_kses( $tags_list, array( 'a' => array( 'href' => array() ) ) ); ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="entry-share col-md-6 text-right">
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
			<?php
		}
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'tm-9studio' ), esc_html__( '1 Comment', 'tm-9studio' ), esc_html__( '% Comments', 'tm-9studio' ) );
			echo '</span>';
		}
	}

	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	public static function categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'thememove_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'thememove_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so categorized_blog should return false.
			return false;
		}
	}

}
