<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'KFF_Attach_Field' ) ) {
	class KFF_Attach_Field {
		static function template( $field, $post_metas ) {

			$field['subtitle'] = isset( $field['subtitle'] ) ? '<p class="kungfu-form-sub-title">' . $field['subtitle'] . '</p>' : '';
			$field['desc']     = isset( $field['desc'] ) ? '<p class="kungfu-form-description">' . $field['desc'] . '</p>' : '';

			$value = isset( $post_metas[ $field['id'] ] ) && $post_metas[ $field['id'] ] != null ? $post_metas[ $field['id'] ] : '';

			$img = '';
			if ( ! empty( $value ) ) {
				$img = wp_get_attachment_image( $value, 'full' );
			}

			return sprintf( '
				<div class="kungfu-form-wrapper">
      		<div class="kungfu-form-title">
            <label class="kungfu-form-label">%s</label>%s
          </div>
      		<div class="kungfu-form-control">
						<div class="kungfu-attach-wrap">
							<div class="kungfu-media-image">%s</div>
							<p><input type="hidden" class="kungfu-media" name="%s" value="%s" /></p>
							<a class="kungfu-media-open kungfu-button success"><i class="fa fa-upload"></i>%s</a>
							<a class="kungfu-media-remove kungfu-button danger" style="display:%s"><i class="fa fa-trash-o"></i>%s</a>
						</div>
					</div>
				</div>',
				$field['title'],
				$field['subtitle'],
				$img,
				$field['id'],
				$value,
				__( 'Upload', 'insight-core' ),
				$value != '' ? 'inline-block' : 'none',
				__( 'Remove', 'insight-core' )
			);
		}

		static function enqueue_scripts() {
			// This function loads in the required media files for the media manager
			wp_enqueue_media();

			wp_enqueue_script( 'kungfu-attach', KFF_JS_URL . 'attach.js', array(
				'jquery-core'
			), false, true );
		}
	}
}