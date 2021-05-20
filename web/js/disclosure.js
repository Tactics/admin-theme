jQuery(function($) {
    $('.disclosure__header').click(function() {
        $(this).closest('.disclosure').toggleClass('disclosure--open');
    });
});

