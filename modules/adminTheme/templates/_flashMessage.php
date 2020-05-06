<div class="flash-alert">
    <div class="flash-alert__content">
        <?php echo $message; ?>
    </div>
    <span class="flash-alert__closer"><i class="fas fa-times"></i></span>
</div>

<script type="text/javascript">

    jQuery(function($){
        $('.flash-alert__closer').click(
            function()
            {
                $(this).closest('.flash-alert').remove();
            }
        );
    });

</script>
