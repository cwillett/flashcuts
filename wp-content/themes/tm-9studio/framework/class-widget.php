<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Insight_Posts_Widget extends WP_Widget {

	function __construct() {
		$widget_details = array(
			'classname'   => 'widget_insight_posts',
			'description' => esc_html__( 'The posts list with thumbnail widget.', 'tm-9studio' )
		);

		parent::__construct( 'insight_posts', esc_html__( '[Insight] Posts', 'tm-9studio' ), $widget_details );
	}

	function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$cat   = $instance['cat'];
		$num   = $instance['num'];
		$style = $instance['style'];
		echo wp_kses( $args['before_widget'], array(
			'aside'   => array( 'id' => array(), 'class' => array() ),
			'div'     => array( 'id' => array(), 'class' => array() ),
			'section' => array( 'id' => array(), 'class' => array() )
		) );
		if ( $cat == 'c1' ) {
			if ( ! empty( $title ) ) {
				echo wp_kses( $args['before_title'] . $title . $args['after_title'], array(
					'h3' => array( 'class' => array() )
				) );
			} else {
				echo wp_kses( $args['before_title'] . '&nbsp;' . $args['after_title'], array(
					'h3' => array( 'class' => array() )
				) );
			}
			$tmrp_args = array(
				'post_type'           => 'post',
				'ignore_sticky_posts' => 1,
				'posts_per_page'      => $num
			);
		} elseif ( $cat == 'c3' ) {
			if ( ! empty( $title ) ) {
				echo wp_kses( $args['before_title'] . $title . $args['after_title'], array(
					'h3' => array( 'class' => array() )
				) );
			} else {
				echo wp_kses( $args['before_title'] . '&nbsp;' . $args['after_title'], array(
					'h3' => array( 'class' => array() )
				) );
			}
			$sticky    = get_option( 'sticky_posts' );
			$tmrp_args = array(
				'post_type'      => 'post',
				'post__in'       => $sticky,
				'posts_per_page' => $num
			);
		} else {
			echo wp_kses( $args['before_title'] . '<a href="' . esc_url( get_catery_link( $cat ) ) . '" title="' . esc_attr( get_cat_name( $cat ) ) . '">' . get_cat_name( $cat ) . '</a>' . $args['after_title'], array(
				'h3' => array( 'class' => array() ),
				'a'  => array( 'href' => array(), 'title' => array() )
			) );
			$tmrp_args = array(
				'post_type'           => 'post',
				'cat'                 => $cat,
				'ignore_sticky_posts' => 1,
				'posts_per_page'      => $num
			);
		}
		$tmrp_query = new WP_Query( $tmrp_args );
		if ( $tmrp_query->have_posts() ) {
			while ( $tmrp_query->have_posts() ) {
				$tmrp_query->the_post();
				?>
				<div class="item">
					<div class="thumb">
						<?php if ( has_post_thumbnail() ) {
							if ( $style == 'bigger' ) {
								the_post_thumbnail( array( 120, 80 ) );
							} else {
								the_post_thumbnail( array( 100, 70 ) );
							}
						} ?>
					</div>
					<div class="info">
						<span class="date nd-font">
							<?php the_time( 'F j, Y' ); ?>
						</span>
						<span class="title nd-font">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php echo wp_trim_words( get_the_title(), 5, '...' ); ?>
							</a>
						</span>
					</div>
				</div>
				<?php
			}
		}
		wp_reset_postdata();
		echo wp_kses( $args['after_widget'], array(
			'aside'   => array(),
			'div'     => array(),
			'section' => array()
		) );
	}

	function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['cat']   = ( ! empty( $new_instance['cat'] ) ) ? strip_tags( $new_instance['cat'] ) : '';
		$instance['style'] = ( ! empty( $new_instance['style'] ) ) ? strip_tags( $new_instance['style'] ) : '';
		$instance['num']   = ( ! empty( $new_instance['num'] ) ) ? strip_tags( $new_instance['num'] ) : '';

		return $instance;
	}

	function form( $instance ) {
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = esc_html__( 'New title', 'tm-9studio' );
		}
		if ( isset( $instance['cat'] ) ) {
			$cat = $instance['cat'];
		} else {
			$cat = 'c1';
		}
		if ( isset( $instance['style'] ) ) {
			$style = $instance['style'];
		} else {
			$style = 'default';
		}
		if ( isset( $instance['num'] ) ) {
			$num = $instance['num'];
		} else {
			$num = 5;
		}
		?>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'tm-9studio' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'cat' ) ); ?>"><?php esc_html_e( 'Category:', 'tm-9studio' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'cat' ) ); ?>">
				<option value="c1" <?php
				if ( $cat == 'c1' ) {
					echo 'selected';
				}
				?>>Recent
				</option>
				<option value="c3" <?php
				if ( $cat == 'c3' ) {
					echo 'selected';
				}
				?>>Sticky
				</option>
				<?php
				$categories = get_categories( 'hide_empty=0' );
				if ( $categories ) {
					foreach ( $categories as $category ) {
						$sl = '';
						if ( $category->term_id == $cat ) {
							$sl = 'selected';
						}
						echo '<option value="' . esc_attr( $category->term_id ) . '" ' . $sl . '>' . esc_html__( 'Category: ', 'tm-9studio' ) . $category->name . '</option>';
					}
				}
				?>
			</select>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'num' ) ); ?>"><?php esc_html_e( 'Number:', 'tm-9studio' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'num' ) ); ?>">
				<?php
				for ( $i = 1; $i <= 40; $i ++ ) {
					$sl = '';
					if ( $i == $num ) {
						$sl = 'selected';
					}
					echo '<option value="' . esc_attr( $i ) . '" ' . $sl . '>' . $i . '</option>';
				}
				?>
			</select>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php esc_html_e( 'Style:', 'tm-9studio' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>">
				<option value="default" <?php
				if ( $style == 'default' ) {
					echo 'selected';
				}
				?>>Default
				</option>
				<option value="bigger" <?php
				if ( $style == 'bigger' ) {
					echo 'selected';
				}
				?>>Bigger
				</option>
			</select>
		</p>
		<?php
	}
}

class Insight_Categories_Widget extends WP_Widget {

	function __construct() {
		$widget_details = array(
			'classname'   => 'widget_insight_categories',
			'description' => esc_html__( 'The categories list with posts count.', 'tm-9studio' )
		);

		parent::__construct( 'insight_categories', esc_html__( '[Insight] Categories', 'tm-9studio' ), $widget_details );
	}

	function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo wp_kses( $args['before_widget'], array(
			'aside'   => array( 'id' => array(), 'class' => array() ),
			'div'     => array( 'id' => array(), 'class' => array() ),
			'section' => array( 'id' => array(), 'class' => array() )
		) );
		echo wp_kses( $args['before_title'] . $title . $args['after_title'], array(
			'h3' => array( 'class' => array() )
		) );
		$categories = get_categories( 'hide_empty=0' );
		if ( $categories ) {
			foreach ( $categories as $category ) {
				echo '<div class="item"><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a><span>' . $category->count . '</span></div>';
			}
		}
		echo wp_kses( $args['after_widget'], array(
			'aside'   => array(),
			'div'     => array(),
			'section' => array()
		) );
	}

	function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

	function form( $instance ) {
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = esc_html__( 'New title', 'tm-9studio' );
		}
		?>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'tm-9studio' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<?php
	}
}

class Insight_Instagram_Widget extends WP_Widget {
	function __construct() {
		parent::__construct( 'insight_instagram', esc_html__( '[Insight] Instagram', 'tm-9studio' ), array(
			'classname'   => 'widget_insight_instagram',
			'description' => esc_html__( 'Displays latest Instagram photos.', 'tm-9studio' )
		) );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title               = isset( $instance['title'] ) ? $instance['title'] : '';
		$username            = isset( $instance['username'] ) ? $instance['username'] : '';
		$offset              = ( isset( $instance['offset'] ) && ! empty( $instance['offset'] ) ) ? $instance['offset'] : '0';
		$number_items        = isset( $instance['number_items'] ) ? $instance['number_items'] : '6';
		$number_items_row    = isset( $instance['number_items_row'] ) ? $instance['number_items_row'] : '3';
		$show_likes_comments = isset( $instance['show_likes_comments'] ) ? $instance['show_likes_comments'] : '';
		$target_blank        = isset( $instance['target_blank'] ) ? $instance['target_blank'] : '';
		$square_media        = isset( $instance['square_media'] ) ? $instance['square_media'] : 'on';

		$output = $args['before_widget'];
		$output .= $args['before_title'] . $title . $args['after_title'];
		$output .= '<div class="insight-instagram-wrap">';
		if ( ! empty( $username ) ) {
			$media_array = $this->scrape_instagram( $username, $number_items, $square_media, $offset );
			if ( is_wp_error( $media_array ) ) {
				$output .= '<div class="insight-instagram-error">' . $media_array->get_error_message() . '</div>';
			} else {
				$output .= '<div class="insight-instagram-row row">';
				$j   = 1;
				$col = 12 / intval( $number_items_row );
				foreach ( $media_array as $item ) {
					$output .= '<div class="item col-xs-' . $col . '">';
					$output .= '<a href="' . esc_url( $item['link'] ) . '" target="' . ( $target_blank == 'on' ? '_blank' : '_self' ) . '">';
					if ( 'on' == $show_likes_comments ) {
						$output .= '<div class="item-info">';
						$output .= '<span class="likes">' . $item['likes'] . '</span>';
						$output .= '<span class="comments">' . $item['comments'] . '</span>';
						$output .= '</div>';
					}
					$output .= '<img src="' . esc_url( $item['thumbnail'] ) . '" alt="' . esc_html__( 'Instagram', 'tm-9studio' ) . '" class="item-image"/>';
					$output .= '</a>';
					$output .= '</div>';
					if ( ( $j % $number_items_row == 0 ) && ( $j < count( $media_array ) ) ) {
						$output .= '</div><div class="insight-instagram-row row">';
					}
					$j ++;
				}
				$output .= '</div>';
			}
		}

		$output .= '</div>';
		$output .= $args['after_widget'];

		echo wp_kses( $output, array(
			'h3'   => array(
				'class' => array(),
			),
			'div'  => array(
				'id'    => array(),
				'class' => array(),
			),
			'span' => array(
				'id'    => array(),
				'class' => array(),
			),
			'a'    => array(
				'href'   => array(),
				'target' => array(),
				'id'     => array(),
				'class'  => array(),
				'title'  => array(),
			),
			'img'  => array(
				'src'   => array(),
				'alt'   => array(),
				'id'    => array(),
				'class' => array(),
			)
		) );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']               = strip_tags( $new_instance['title'] );
		$instance['username']            = strip_tags( $new_instance['username'] );
		$instance['number_items']        = strip_tags( $new_instance['number_items'] );
		$instance['number_items_row']    = strip_tags( $new_instance['number_items_row'] );
		$instance['offset']              = strip_tags( $new_instance['offset'] );
		$instance['show_likes_comments'] = strip_tags( $new_instance['show_likes_comments'] );
		$instance['target_blank']        = strip_tags( $new_instance['target_blank'] );
		$instance['square_media']        = strip_tags( $new_instance['square_media'] );

		return $instance;
	}

	function form( $instance ) {
		$title               = isset( $instance['title'] ) ? $instance['title'] : '';
		$username            = isset( $instance['username'] ) ? $instance['username'] : '';
		$number_items        = isset( $instance['number_items'] ) ? $instance['number_items'] : '6';
		$number_items_row    = isset( $instance['number_items_row'] ) ? $instance['number_items_row'] : '3';
		$offset              = isset( $instance['offset'] ) ? $instance['offset'] : '0';
		$show_likes_comments = isset( $instance['show_likes_comments'] ) ? $instance['show_likes_comments'] : '';
		$target_blank        = isset( $instance['target_blank'] ) ? $instance['target_blank'] : '';
		$square_media        = isset( $instance['square_media'] ) ? $instance['square_media'] : 'on';
		?>

		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'tm-9studio' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
			       value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username', 'tm-9studio' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>"
			       value="<?php echo esc_attr( $username ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'number_items' ) ); ?>"><?php esc_html_e( 'Number of items', 'tm-9studio' ) ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'number_items' ) ); ?>"
			        name="<?php echo esc_attr( $this->get_field_name( 'number_items' ) ); ?>">
				<?php
				for ( $i = 1; $i < 13; $i ++ ) {
					echo '<option value="' . $i . '" ' . ( $number_items == $i ? 'selected' : '' ) . '>' . $i . '</option>';
				}
				?>

			</select>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'number_items_row' ) ); ?>"><?php esc_html_e( 'Number of items per row', 'tm-9studio' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'number_items_row' ) ); ?>"
			        name="<?php echo esc_attr( $this->get_field_name( 'number_items_row' ) ); ?>">
				<?php
				for ( $i = 1; $i < 5; $i ++ ) {
					echo '<option value="' . $i . '" ' . ( $number_items_row == $i ? 'selected' : '' ) . '>' . $i . '</option>';
				}
				?>
			</select>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>"><?php esc_html_e( 'Offset', 'tm-9studio' ) ?></label>
			<?php
			echo '<input id="' . esc_attr( $this->get_field_id( 'offset' ) ) . '" type="number" name="' . esc_attr( $this->get_field_name( 'offset' ) ) . '" value="' . $offset . '">';
			?>
		</p>
		<p>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_likes_comments' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'show_likes_comments' ) ); ?>" <?php checked( $show_likes_comments, 'on' ); ?> />
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'show_likes_comments' ) ); ?>"><?php esc_html_e( 'Show likes and comments', 'tm-9studio' ) ?></label>
		</p>
		<p>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'target_blank' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'target_blank' ) ); ?>" <?php checked( $target_blank == 'on' ); ?> />
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'target_blank' ) ); ?>"><?php esc_html_e( 'Open links in new page', 'tm-9studio' ) ?></label>
		</p>
		<p>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'square_media' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'square_media' ) ); ?>" <?php checked( $square_media == 'on' ); ?> />
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'square_media' ) ); ?>"><?php esc_html_e( 'Show square media', 'tm-9studio' ) ?></label>
		</p>
		<?php
	}

	/**
	 * Quick-and-dirty Instagram web scrape
	 * based on https://gist.github.com/cosmocatalano/4544576
	 *
	 * @param     $username
	 * @param int $slice
	 *
	 * @return array|WP_Error
	 */
	public function scrape_instagram( $username, $slice, $square_media, $offset = 0 ) {

		$username = strtolower( $username );

		if ( false === ( $instagram = get_transient( 'instagram-media-new-' . sanitize_title_with_dashes( $username . '-' . $square_media ) ) ) ) {

			$remote = wp_remote_get( 'http://instagram.com/' . trim( $username ) );

			if ( is_wp_error( $remote ) ) {
				return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'tm-9studio' ) );
			}

			if ( 200 != wp_remote_retrieve_response_code( $remote ) ) {
				return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'tm-9studio' ) );
			}

			$shards      = explode( 'window._sharedData = ', $remote['body'] );
			$insta_json  = explode( ';</script>', $shards[1] );
			$insta_array = json_decode( $insta_json[0], true );

			if ( ! $insta_array ) {
				return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'tm-9studio' ) );
			}

			// old style
			if ( isset( $insta_array['entry_data']['UserProfile'][0]['userMedia'] ) ) {
				$media_arr = $insta_array['entry_data']['UserProfile'][0]['userMedia'];
				$type      = 'old';
				// new style
			} else if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
				$media_arr = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
				$type      = 'new';
			} else {
				return new WP_Error( 'bad_josn_2', esc_html__( 'Instagram has returned invalid data.', 'tm-9studio' ) );
			}

			if ( ! is_array( $media_arr ) ) {
				return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'tm-9studio' ) );
			}

			switch ( $type ) {
				case 'old':
					$instagram = $this->get_media_old_style( $username, $media_arr );
					break;
				default:
					$instagram = $this->get_media_new_style( $media_arr, $square_media );
					break;
			}

			// do not set an empty transient - should help catch private or empty accounts
			if ( ! empty( $instagram ) ) {
				$instagram = insight_core_base_encode( serialize( $instagram ) );
				set_transient( 'instagram-media-new-' . sanitize_title_with_dashes( $username . '-' . $square_media ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * 2 ) );
			}
		}

		if ( ! empty( $instagram ) ) {

			$instagram = unserialize( insight_core_base_decode( $instagram ) );

			return array_slice( $instagram, $offset, $slice );;

		} else {

			return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'tm-9studio' ) );

		}
	}

	/**
	 * @param $username
	 * @param $media_arr
	 *
	 * @return array
	 */
	public function get_media_old_style( $username, $media_arr ) {

		$instagram = array();

		foreach ( $media_arr as $media ) {

			if ( $media['user']['username'] == $username ) {

				$media['link']                          = preg_replace( '/^http:/i', '', $media['link'] );
				$media['images']['thumbnail']           = preg_replace( '/^http:/i', '', $media['images']['thumbnail'] );
				$media['images']['standard_resolution'] = preg_replace( '/^http:/i', '', $media['images']['standard_resolution'] );
				$media['images']['low_resolution']      = preg_replace( '/^http:/i', '', $media['images']['low_resolution'] );

				$instagram[] = array(
					'link'      => $media['link'],
					'comments'  => $this->round_number( $media['comments']['count'] ),
					'likes'     => $this->round_number( $media['likes']['count'] ),
					'thumbnail' => $media['images']['thumbnail']['url'],
					'large'     => $media['images']['standard_resolution']['url'],
					'small'     => $media['images']['low_resolution']['url'],
				);
			}
		}

		return $instagram;
	}

	/**
	 * @param $media_arr
	 *
	 * @return array
	 */
	public function get_media_new_style( $media_arr, $square_media ) {

		$instagram = array();

		foreach ( $media_arr as $media ) {

			$image_src = ( 'on' == $square_media ) ? 'thumbnail_src' : 'display_src';

			$media[ $image_src ] = preg_replace( '/^http:/i', '', $media[ $image_src ] );

			$instagram[] = array(
				'link'      => '//instagram.com/p/' . $media['code'],
				'comments'  => $this->round_number( $media['comments']['count'] ),
				'likes'     => $this->round_number( $media['likes']['count'] ),
				'thumbnail' => $media[ $image_src ],
			);
		}

		return $instagram;
	}

	/**
	 * Generate rounded number
	 * Example: 11200 --> 11K
	 *
	 * @param $number
	 *
	 * @return string
	 */
	public function round_number( $number ) {
		if ( $number > 999 && $number <= 999999 ) {
			$result = floor( $number / 1000 ) . ' K';
		} elseif ( $number > 999999 ) {
			$result = floor( $number / 1000000 ) . ' M';
		} else {
			$result = $number;
		}

		return $result;
	}
} // end class

function insight_widgets_init() {
	register_widget( 'Insight_Posts_Widget' );
	register_widget( 'Insight_Categories_Widget' );
	register_widget( 'Insight_Instagram_Widget' );
}

add_action( 'widgets_init', 'insight_widgets_init' );

if ( ! class_exists( 'TM_Aboutme_Widget' ) ) {

	add_action( 'widgets_init', 'load_thememove_aboutme_widget' );

	function load_thememove_aboutme_widget() {
		register_widget( 'TM_Aboutme_Widget' );
	}

	// Enqueue script
	function tm_aboutme_enqueue( $hook ) {
		if ( $hook != 'widgets.php' ) {
			return;
		}

		wp_enqueue_script( 'media-upload' );
		wp_enqueue_media();
	}

	add_action( 'admin_enqueue_scripts', 'tm_aboutme_enqueue' );

	/**
	 * Aboutme Widget by ThemeMove
	 *
	 * @property mixed data
	 */
	class TM_Aboutme_Widget extends WP_Widget {

		private $social_networks = array();
		private $social_links = array();

		private function parse_social_links( $array ) {

			foreach ( $this->social_networks as $key => $val ) {
				if ( isset( $array[ $key ] ) ) {
					$this->social_links[ $key ] = $array[ $key ];
				}
			}
		}

		/*
		 * Register widget with WordPress
		 */
		function __construct() {
			parent::__construct( 'tm_aboutme', esc_html__( '[Insight] - About me', 'tm-9studio' ), array( 'description' => esc_html__( 'Display your basic description and social networks', 'tm-9studio' ) ) );

			$this->social_networks = array(
				'amazon'        => esc_html__( 'Amazon', 'tm-9studio' ),
				'500px'         => esc_html__( '500px', 'tm-9studio' ),
				'behance'       => esc_html__( 'Behance', 'tm-9studio' ),
				'bitbucket'     => esc_html__( 'Bitbucket', 'tm-9studio' ),
				'codepen'       => esc_html__( 'Codepen', 'tm-9studio' ),
				'dashcube'      => esc_html__( 'Dashcube', 'tm-9studio' ),
				'delicious'     => esc_html__( 'Delicious', 'tm-9studio' ),
				'deviantart'    => esc_html__( 'DeviantArt', 'tm-9studio' ),
				'digg'          => esc_html__( 'Digg', 'tm-9studio' ),
				'dribbble'      => esc_html__( 'Dribbble', 'tm-9studio' ),
				'facebook'      => esc_html__( 'Facebook', 'tm-9studio' ),
				'flickr'        => esc_html__( 'Flickr', 'tm-9studio' ),
				'foursquare'    => esc_html__( 'Foursquare', 'tm-9studio' ),
				'github'        => esc_html__( 'Github', 'tm-9studio' ),
				'google-plus'   => esc_html__( 'Google+', 'tm-9studio' ),
				'instagram'     => esc_html__( 'Instagram', 'tm-9studio' ),
				'linkedin'      => esc_html__( 'Linkedin', 'tm-9studio' ),
				'envelope-o'    => esc_html__( 'Mail', 'tm-9studio' ),
				'odnoklassniki' => esc_html__( 'Odnoklassniki', 'tm-9studio' ),
				'pinterest'     => esc_html__( 'Pinterest', 'tm-9studio' ),
				'qq'            => esc_html__( 'QQ', 'tm-9studio' ),
				'rss'           => esc_html__( 'RSS', 'tm-9studio' ),
				'reddit'        => esc_html__( 'Reddit', 'tm-9studio' ),
				'skype'         => esc_html__( 'Skype', 'tm-9studio' ),
				'slack'         => esc_html__( 'Slack', 'tm-9studio' ),
				'soundcloud'    => esc_html__( 'Soundcloud', 'tm-9studio' ),
				'stumbleupon'   => esc_html__( 'StumbleUpon', 'tm-9studio' ),
				'tripadvisor'   => esc_html__( 'Tripadvisor', 'tm-9studio' ),
				'tumblr'        => esc_html__( 'Tumblr', 'tm-9studio' ),
				'twitch'        => esc_html__( 'Twitch', 'tm-9studio' ),
				'twitter'       => esc_html__( 'Twitter', 'tm-9studio' ),
				'vine'          => esc_html__( 'Vine', 'tm-9studio' ),
				'weibo'         => esc_html__( 'Weibo', 'tm-9studio' ),
				'wikipedia-w'   => esc_html__( 'Wikipedia', 'tm-9studio' ),
				'whatsapp'      => esc_html__( 'WhatsApp', 'tm-9studio' ),
				'wordpress'     => esc_html__( 'Wordpress', 'tm-9studio' ),
				'yahoo'         => esc_html__( 'Yahoo', 'tm-9studio' ),
				'youtube-play'  => esc_html__( 'Youtube', 'tm-9studio' ),
			);
		}

		function widget( $args, $instance ) {
			extract( $args );

			Insight_Helper::output( $args['before_widget'] );

			$output = '<div class="insight-aboutme">';

			if ( $instance['image_src'] ) {
				$output .= '<div class="avatar">';
				$output .= '<img src="' . esc_attr( $instance['image_src'] ) . '" alt="" />';
				$output .= '<h2 class="about-title pri-color">' . $instance['title'] . '</h2>';
				$output .= '</div>';
			}

			if ( $instance['description'] ) {
				$output .= '<div class="desc">';
				$output .= $instance['description'];
				$output .= '</div>';
			}

			$this->parse_social_links( $instance );

			if ( ! empty( $this->social_links ) ) {
				$output .= '<ul class="insight-social">';
				foreach ( $this->social_links as $key => $link ) {
					if ( $link != '' ) {

						if ( 'envelope-o' == $key ) {
							$link = 'mailto:' . $link;
						}

						$output .= '<li class="tm-aboutme__social__item tm-aboutme__social__item--' . esc_attr( $instance['social_shape'] ) . '">';
						$output .= '<a href="' . esc_url( $link ) . '" class="tm-aboutme__social__link" target="' . ( $instance['link_new_page'] == 'on' ? '_blank' : '_self' ) . '">';
						$output .= '<i class="fa fa-' . esc_attr( $key ) . ' tm-aboutme__social__icon"></i>';
						$output .= '</a>';
						$output .= '</li>';
					}
				}

				$output .= '</ul>';
			}
			$output .= '</div>';

			Insight_Helper::output( $output );

			Insight_Helper::output( $args['after_widget'] );
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title']         = strip_tags( $new_instance['title'] );
			$instance['image_src']     = strip_tags( $new_instance['image_src'] );
			$instance['description']   = $new_instance['description'];
			$instance['link_new_page'] = strip_tags( $new_instance['link_new_page'] );

			foreach ( $this->social_networks as $key => $val ) {
				$instance[ $key ] = strip_tags( $new_instance[ $key ] );
			}

			return $instance;
		}

		function form( $instance ) {

			// Set up default settings
			$default = array(
				'title'         => '',
				'image_src'     => '',
				'description'   => '',
				'link_new_page' => 'on',
			);

			foreach ( $this->social_networks as $key => $social ) {
				$default[ $key ] = '';
			}

			$instance = wp_parse_args( (array) $instance, $default );

			?>

			<p>
				<label
					for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'tm-9studio' ); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				       value="<?php echo esc_attr( $instance['title'] ); ?>"/>
			</p>
			<p>
				<label
					for="<?php echo esc_attr( $this->get_field_id( 'image_src' ) ); ?>"><?php esc_html_e( 'Image', 'tm-9studio' ); ?></label><br/>
				<img class="tm-about-me__img" src="<?php echo esc_url( $instance['image_src'] ); ?>"/>
				<input type="hidden" class="input-img"
				       name="<?php echo esc_attr( $this->get_field_name( 'image_src' ) ); ?>"
				       id="<?php echo esc_attr( $this->get_field_id( 'image_src' ) ); ?>"
				       value="<?php echo esc_attr( $instance['image_src'] ); ?>"/>
				<a href="#" class="select-img" style=""><?php esc_html_e( 'Select Image', 'tm-9studio' ); ?></a>
			</p>
			<p class="help"><?php esc_html_e( 'Select images from media library.', 'tm-9studio' ); ?></p>

			<p>
				<label
					for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Description', 'tm-9studio' ); ?></label>
				<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"
				          name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"
				          rows="8"><?php Insight_Helper::output( $instance['description'] ); ?></textarea>
			</p>

			<p>
				<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'link_new_page' ) ); ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'link_new_page' ) ); ?>" <?php checked( $instance['link_new_page'], 'on' ); ?> />
				<label
					for="<?php echo esc_attr( $this->get_field_id( 'link_new_page' ) ); ?>"><?php esc_html_e( 'Open links in new page', 'tm-9studio' ) ?></label>
			</p>
			<p>
				<label><?php esc_html_e( 'Social links', 'tm-9studio' ); ?></label>
			<div class="tm_social_links tm_social_links--widget" data-social-links="true">
				<table class="tm_table tm_social-links-table widefat">
					<tr>
						<th><strong><?php esc_html_e( 'Social Network', 'tm-9studio' ); ?></strong></th>
						<th><strong><?php esc_html_e( 'Link', 'tm-9studio' ); ?></strong></th>
					</tr>
					<?php
					foreach ( $this->social_networks as $key => $social ) {
						?>
						<tr>
							<td class="tm tm_social tm_social--<?php echo esc_attr( $key ); ?>">
								<span><i
										class="fa fa-<?php echo esc_attr( $key ) ?>"></i><?php Insight_Helper::output( $social ); ?></span>
							</td>
							<td>
								<input type="text" name="<?php echo esc_attr( $this->get_field_name( $key ) ) ?>"
								       id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
								       value="<?php echo esc_attr( $instance[ $key ] ); ?>">
							</td>
						</tr>
						<?php
					}
					?>
				</table>
			</div>
			</p>
			<script type="text/javascript">
				jQuery( document ).ready( function( i ) {
					i( document ).on( "click", "a.select-img", function( e ) {
						var n;
						return e.preventDefault(), n ? void n.open() : (
							n = wp.media.frames.file_frame = wp.media( {
								title: jQuery( this ).data( "uploader_title" ),
								button: {
									text: jQuery( this ).data( "uploader_button_text" )
								},
								multiple: ! 1
							} ), n.on( "select", function() {
								attachment = n.state().get( "selection" ).first().toJSON();
								var e = attachment.url;
								i( "img.tm-about-me__img" ).attr( "src", e ), i( ".input-img" ).val( e )
							} ), void n.open()
						)
					} )
				} );
			</script>
			<?php
		}
	} // end class
} // end if
