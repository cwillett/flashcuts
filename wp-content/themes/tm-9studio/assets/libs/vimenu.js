/*! ViMenu jQuery Plugin - v1 - December 22, 2016
 * http://www.nguyentrangdong.me/ViMenu
 * Copyright Dong Nguyen
 */

(function($) {

    $.fn.vimenu = function(options) {
        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            target: "#mobile",
            classActive: "vimenu-open-left",
			elementClassActive: "body",
			close: "#close-menu",
			eventActive: "click",
			eventDeactive: "click",
        }, options);

        return this.each(function() {
            var _self = $(this),
				_target = $(settings.target),
				_close = $(settings.close),
				_elementClassActive = $(settings.elementClassActive);
			if(_self.data('target') !== '' && _self.data('target') !== undefined) {
				_target = $(_self.data('target'));
			}

            _self.on(settings.eventActive, function(e) {
                _elementClassActive.addClass( settings.classActive );
				e.stopPropagation();
            });

            _close.on(settings.eventDeactive, function(e) {
				_elementClassActive.removeClass( settings.classActive );
				e.stopPropagation();
            });

        });

    };

}(jQuery));
