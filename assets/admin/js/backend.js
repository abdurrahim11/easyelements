;
(function($) {
    "use strict";

    // Toggle modal when button is clicked
    $(document).on("click", '[data-attr-toggle="modal"]', function() {
        var targetModal = $(this).data("target");
        $(targetModal).fadeIn(); // Use fadeIn() for smooth animation
        $("body").css("overflow", "hidden"); // Hide scrollbar
    });

    // Close modal when close button is clicked
    $(".ele-modal-close").on("click", function() {
        $(this).closest(".ele-modal").fadeOut();
        setTimeout(function () {
            $("body").css("overflow", "auto");
        }, 300 )
    });




})(jQuery);