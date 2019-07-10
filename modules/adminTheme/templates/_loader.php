<script type='text/javascript'>
    jQuery.noConflict();
    jQuery.aantalRequests = 0;

    // En voor jQuery Ajax (we zitten in overgangsperiode)
    jQuery(document).ajaxStart(function()
    {
        jQuery.aantalRequests++;
        if (jQuery.aantalRequests > 0)
        {
            let $loader = jQuery('.ajax-loader');
            $loader.css('opacity', '1');
            $loader.animate({
                "width": "50%"
            }, "slow", false);
        }
    });

    // En voor jQuery Ajax (we zitten in overgangsperiode)
    jQuery(document).ajaxStop(function()
    {
        jQuery.aantalRequests--;
        if ((jQuery.aantalRequests < 1) && ((typeof(Ajax) == 'undefined') || Ajax.activeRequestCount == 0))
        {
            let $loader = jQuery('.ajax-loader');
            $loader.animate({
                "width": "100%"
            }, "slow");

            $loader.animate({
                "opacity": "0"
            }, "slow");
            $loader.animate({'width': '0%'}, "fast");
        }
    });
</script>

<div class="ajax-loader">
    <div class="ajax-loader__bar"></div>
</div>