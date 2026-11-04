(function ($) {
    'use strict';

    $(document).ready(function () {

        // Initialise a separate gallery for each portfolio tab
        $('.tab-pane').each(function () {

            $(this).find('.portfolio-image-popup').magnificPopup({

                type: 'image',

                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 2]
                },

                mainClass: 'mfp-fade',
                removalDelay: 300,
                closeOnContentClick: false,
                closeBtnInside: false,

                image: {
                    verticalFit: true
                }

            });

        });

    });

})(window.jQuery);