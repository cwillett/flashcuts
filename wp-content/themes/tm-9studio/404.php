<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package tm-9studio
 */

get_header(); ?>
	<div class="container">
		<div id="primary" class="content-area">
			<div class="content-404">
				<h3><?php esc_html_e( 'Opps! Page not found!', 'tm-9studio' ); ?></h3>
				<img src="<?php echo esc_url( Insight::setting( '404_image' ) ); ?>"
				     alt="<?php bloginfo( 'name' ); ?>"/>
				<span><?php echo sprintf( '%s <a href="%s">%s</a>', esc_html__( 'Please go back to', 'tm-9studio' ), site_url(), esc_html__( 'Homepage', 'tm-9studio' ) ); ?></span>
			</div>
			<a class="contact-404" href="<?php echo esc_url( Insight::setting( '404_contact_url' ) ); ?>">
				<?php esc_html_e( 'Contact us', 'tm-9studio' ); ?>
			</a>
			<div class="follow-404">
				<div class="follow-404-socials">
					<?php Insight::social_icons( false ); ?>
				</div>
				<div class="follow-404-text"><?php esc_html_e( 'Follow me', 'tm-9studio' ); ?></div>
			</div>
		</div>
	</div>
<?php
get_footer();
