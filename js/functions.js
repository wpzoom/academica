/**
 * Theme functions file
 */
(function ($) {
    var $document = $(document);
    var $window = $(window);


    /**
    * Document ready (jQuery)
    */
    $(function () {

        /**
         * Activate superfish menu with accessibility support.
         */
        $('.sf-menu').superfish({
            'speed': 'fast',
            'delay' : 0,
            'animation': {
                'height': 'show'
            }
        });

        /**
         * Improve keyboard navigation for menu
         */
        $('.sf-menu a').on('focus blur', function() {
            $(this).parents('li').toggleClass('sfHover');
        });

        /**
         * Activate jQuery.mmenu with accessibility support.
         */
        var $menu = $("#menu-main-slide");
        var $toggle = $(".navbar-toggle");
        
        $menu.mmenu({
            "slidingSubmenus": false,
            "extensions": [
                "theme-dark",
                "pageshadow",
                "border-full"
            ]
        });

        /**
         * Handle mobile menu accessibility
         */
        var mmenuAPI = $menu.data("mmenu");
        if (mmenuAPI) {
            mmenuAPI.bind("open:finish", function() {
                $toggle.attr("aria-expanded", "true");
            });
            
            mmenuAPI.bind("close:finish", function() {
                $toggle.attr("aria-expanded", "false");
            });
        }

    });

})(jQuery);
