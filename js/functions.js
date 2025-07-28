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
         * Activate jQuery.mmenu.
         */
        $("#menu-main-slide").mmenu({
            "slidingSubmenus": false,
            "extensions": [
                "theme-dark",
                "pageshadow",
                "border-full"
            ]
        })

    });

})(jQuery);
