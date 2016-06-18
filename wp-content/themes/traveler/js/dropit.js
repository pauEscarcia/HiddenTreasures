/*
 * Dropit v1.0
 * http://dev7studios.com/dropit
 *
 * Copyright 2012, Dev7studios
 * Free to use and abuse under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 */

;
(function($) {

    $.fn.dropit = function(method) {

        var methods = {

            init: function(options) {
                this.dropit.settings = $.extend({}, this.dropit.defaults, options);
                return this.each(function() {
                    var $el = $(this),
                        el = this,
                        settings = $.fn.dropit.settings;

                    // // Hide initial submenus
                    // $el.addClass('dropit')
                    //     .find('>' + settings.triggerParentEl + ':has(' + settings.submenuEl + ')').addClass('dropit-trigger')

                    // Open on click


                    $el.on(settings.action, settings.this, function() {

                        if ($(this).hasClass('active-drop')) {
                            $(this).removeClass('active-drop');
                            return false;
                        }
                        settings.beforeHide.call(this);
                        $('.active-drop').removeClass('active-drop');
                        settings.afterHide.call(this);
                        settings.beforeShow.call(this);
                        $(this).addClass('active-drop');
                        settings.afterShow.call(this);
                        var url=$(this).attr('href');
                        return false;
                    });

                    // Close if outside click
                    $(document).on('click', function() {
                        settings.beforeHide.call(this);
                        $('.active-drop').removeClass('active-drop').find('.dropit-submenu').hide();
                        settings.afterHide.call(this);
                    });

                    settings.afterLoad.call(this);
                });
            }

        }

        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method "' + method + '" does not exist in dropit plugin!');
        }

    }

    $.fn.dropit.defaults = {
        action: 'click', // The open action for the trigger
        submenuEl: 'ul', // The submenu element
        triggerEl: 'a', // The trigger element
        triggerParentEl: 'li', // The trigger parent element
        afterLoad: function() {}, // Triggers when plugin has loaded
        beforeShow: function() {}, // Triggers before submenu is shown
        afterShow: function() {}, // Triggers after submenu is shown
        beforeHide: function() {}, // Triggers before submenu is hidden
        afterHide: function() {} // Triggers before submenu is hidden
    }

    $.fn.dropit.settings = {}

})(jQuery);