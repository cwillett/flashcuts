<?php
if ( ! class_exists( 'Insight_Param_Social_Links' ) ) {
	/**
	 * Class Insight_Param_Social_Links
	 *
	 * @package tm-9studio
	 */
	class Insight_Param_Social_Links {

		private $settings = array();

		private $value = '';

		private $social_networks = array();

		/**
		 * @param $settings
		 * @param $value
		 */
		public function __construct( $settings, $value ) {
			$this->settings = $settings;
			$this->value    = $value;

			$this->social_networks = array(
				'amazon'        => esc_html( 'Amazon', 'tm-9studio' ),
				'500px'         => esc_html( '500px', 'tm-9studio' ),
				'behance'       => esc_html( 'Behance', 'tm-9studio' ),
				'bitbucket'     => esc_html( 'Bitbucket', 'tm-9studio' ),
				'codepen'       => esc_html( 'Codepen', 'tm-9studio' ),
				'dashcube'      => esc_html( 'Dashcube', 'tm-9studio' ),
				'delicious'     => esc_html( 'Delicious', 'tm-9studio' ),
				'deviantart'    => esc_html( 'DeviantArt', 'tm-9studio' ),
				'digg'          => esc_html( 'Digg', 'tm-9studio' ),
				'dribbble'      => esc_html( 'Dribbble', 'tm-9studio' ),
				'facebook'      => esc_html( 'Facebook', 'tm-9studio' ),
				'flickr'        => esc_html( 'Flickr', 'tm-9studio' ),
				'foursquare'    => esc_html( 'Foursquare', 'tm-9studio' ),
				'github'        => esc_html( 'Github', 'tm-9studio' ),
				'google-plus'   => esc_html( 'Google+', 'tm-9studio' ),
				'instagram'     => esc_html( 'Instagram', 'tm-9studio' ),
				'linkedin'      => esc_html( 'Linkedin', 'tm-9studio' ),
				'odnoklassniki' => esc_html( 'Odnoklassniki', 'tm-9studio' ),
				'pinterest'     => esc_html( 'Pinterest', 'tm-9studio' ),
				'qq'            => esc_html( 'QQ', 'tm-9studio' ),
				'rss'           => esc_html( 'RSS', 'tm-9studio' ),
				'reddit'        => esc_html( 'Reddit', 'tm-9studio' ),
				'skype'         => esc_html( 'Skype', 'tm-9studio' ),
				'slack'         => esc_html( 'Slack', 'tm-9studio' ),
				'soundcloud'    => esc_html( 'Soundcloud', 'tm-9studio' ),
				'stumbleupon'   => esc_html( 'StumbleUpon', 'tm-9studio' ),
				'tripadvisor'   => esc_html( 'Tripadvisor', 'tm-9studio' ),
				'tumblr'        => esc_html( 'Tumblr', 'tm-9studio' ),
				'twitch'        => esc_html( 'Twitch', 'tm-9studio' ),
				'twitter'       => esc_html( 'Twitter', 'tm-9studio' ),
				'vine'          => esc_html( 'Vine', 'tm-9studio' ),
				'weibo'         => esc_html( 'Weibo', 'tm-9studio' ),
				'wikipedia-w'   => esc_html( 'Wikipedia', 'tm-9studio' ),
				'whatsapp'      => esc_html( 'WhatsApp', 'tm-9studio' ),
				'wordpress'     => esc_html( 'Wordpress', 'tm-9studio' ),
				'yahoo'         => esc_html( 'Yahoo', 'tm-9studio' ),
				'youtube-play'  => esc_html( 'Youtube', 'tm-9studio' ),
			);
		}

		/**
		 * @return array
		 */
		private function getData() {
			$data     = preg_split( '/\s+/', $this->value );
			$data_arr = array();

			foreach ( $data as $d ) {
				$pieces = explode( '|', $d );
				if ( count( $pieces ) == 2 ) {
					$key              = $pieces[0];
					$link             = $pieces[1];
					$data_arr[ $key ] = $link;
				}
			}

			return $data_arr;
		}

		private function getLink( $key ) {
			$link_arr = $this->getData();
			foreach ( $link_arr as $key1 => $link ) {
				if ( $key == $key1 ) {
					return $link;
				}
			}

			return '';
		}

		/**
		 * Render HTML
		 *
		 * @return string
		 */
		public function render() {
			$html = '';
			$html .= '<div class="tm_social_links" data-social-links="true">
              <input name="' . esc_attr( $this->settings['param_name'] ) . '" class="wpb_vc_param_value ' . esc_attr( $this->settings['param_name'] ) . ' ' . esc_attr( $this->settings['type'] ) . '_field" type="hidden" value="' . esc_attr( $this->value ) . '"/>
             <table class="vc_table tm_table tm_social-links-table">
              <tr data-social="">
                <th>' . esc_html__( 'Social Network', 'tm-9studio' ) . '</th>
                <th>' . esc_html__( 'Link', 'tm-9studio' ) . '</th>
              </tr>
            ';
			foreach ( $this->social_networks as $key => $social ) {
				$html .= '
            <tr data-social="' . $key . '">
                <td class="tm_social tm_social--' . $key . '">
                    <label><span><i class="fa fa-' . $key . '"></i>' . $social . '</span></label>
                </td>
                <td>
                    <input type="text" name="' . $key . '" class="social_links_field" value="' . $this->getLink( $key ) . '' . '">
                </td>
            </tr>';
			}


			$html .= '</table></div>';

			return $html;
		}
	}
}

if ( class_exists( 'Insight_Param_Social_Links' ) ) {
	/**
	 * Register params
	 *
	 * @param $settings
	 * @param $value
	 *
	 * @return string
	 */
	function insight_param_social_links_settings_field( $settings, $value ) {
		$social_links = new Insight_Param_Social_Links( $settings, $value );

		return $social_links->render();
	}

	WpbakeryShortcodeParams::addField( 'social_links', 'insight_param_social_links_settings_field', INSIGHT_THEME_URI . '/assets/admin/js/thememove_social_links.js' );
}
