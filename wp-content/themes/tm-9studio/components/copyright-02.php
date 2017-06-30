<div <?php Insight::copyright_attributes() ?>>
	<div class="container-fluid">
		<div class="copyright-container">
			<div class="row row-xs-center">
				<div class="col-md-4 copyright-left rd-font">
					<?php echo wp_kses( Insight::setting( 'copyright_text' ), array(
						'a'      => array(
							'href'  => array(),
							'class' => array(),
							'title' => array(),
						),
						'strong' => array(),
						'span'   => array(),
					) ); ?>
				</div>
				<div class="col-md-4 copyright-center text-center">
					<?php Insight::footer_logo(); ?>
				</div>
				<div class="col-md-4 copyright-right rd-font">
					<?php echo wp_kses( Insight::setting( 'copyright_text2' ), array(
						'a'      => array(
							'href'  => array(),
							'class' => array(),
							'title' => array(),
						),
						'strong' => array(),
						'span'   => array(),
					) ); ?>
				</div>
			</div>
		</div>
	</div>
</div>
