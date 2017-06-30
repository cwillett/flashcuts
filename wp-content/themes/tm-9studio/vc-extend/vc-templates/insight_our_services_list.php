<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$services = (array) vc_param_group_parse_atts( $services );
?>
<div class="insight-our-services-list <?php echo esc_attr( $el_class ); ?>">
	<div class="big-title">
		<?php
		if ( $link ) {
			echo '<a href="' . esc_url( $link ) . '">' . esc_html( $big_title ) . '</a>';
		} else {
			echo esc_html( $big_title );
		}
		?>
	</div>
	<div class="items">
		<?php
		if ( is_array( $services ) && ( count( $services ) > 0 ) ) {
			$i = 1;
			foreach ( $services as $service ) { ?>
				<div class="item">
					<span class="number">
						<?php
						if ( $i < 10 ) {
							echo esc_html( '0' . $i );
						} else {
							echo esc_html( $i );
						}
						?>
					</span>
					<?php if ( isset( $service['title'] ) && ! empty( $service['title'] ) ): ?>
						<span class="title">
							<?php echo esc_html( $service['title'] ); ?>
						</span>
					<?php endif; ?>
					<?php if ( isset( $service['content'] ) && ! empty( $service['content'] ) ): ?>
						<span class="content">
							<?php echo esc_html( $service['content'] ); ?>
						</span>
					<?php endif; ?>
				</div>
				<?php
				$i ++;
			}
		}
		?>
	</div>
</div>