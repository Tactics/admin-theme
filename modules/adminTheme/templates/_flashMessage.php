<div class="flash-alert <?php echo $type ?>">
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

    function remove() {
        flashmessages = document.querySelectorAll('.flash-alert');
        flashmessages.forEach(element => {
            element.classList.add('remove');
        });
        setTimeout(function() {
            flashmessages.forEach(element => {
                element.remove();
            });
        }, 450)
    }

    // setTimeout(remove, 5000);
</script>
