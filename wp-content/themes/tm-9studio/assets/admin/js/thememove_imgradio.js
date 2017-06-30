if (_.isUndefined(window.vc)) {
    var vc = {atts: {}};
}

jQuery(document).ready(function ($) {
    $('.imgradio label').click(function () {
        $(this).addClass('selected').siblings().removeClass('selected');
		var $radio = $(this).prev('input[type=radio]');
        var $target = $(this).closest('.imgradio').find('.wpb_vc_param_value');
        $target.val( $radio.val() );
		$target.trigger('change');
    });
});
