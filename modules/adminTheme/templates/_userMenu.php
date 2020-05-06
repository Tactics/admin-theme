<section class="user-menu user-menu--closed">
    <div class="user-menu__toggler">
        <i class="fas fa-user"></i>
    </div>

    <?php if ($sf_user->getAttribute('bekijk_archief', false)): ?>
        <div class="user-menu__status user-menu__status--archived"></div>
    <?php endif; ?>

    <div class="user-menu__links">
        <ul>
            <li>
                <?php echo __('U bent ingelogd als');?>:<br> <?php echo link_to_if($sf_user->controleerToegangTotPersoon($sf_user->getPersoon()), $sf_user->getPersoon()->getNaam(), 'persoon/show?id=' . $sf_user->getPersoon()->getId(), array('style' => "font-weight:bold;")); ?>
                <?php if ($sf_user->getSecurityLevel()) : ?>
                    <span style='color:#E12D39;'>[<?php echo strToUpper($sf_user->getSecurityLevel());?>]</span>
                <?php endif ?>
            </li>

            <?php
            if ($sf_user->isSuperAdmin())
            {
                echo '<li class="user-menu__link"><a href="#" class="change-user"><i class="fal fa-user-secret"></i> ' . __('Aanmelden als...') . '</a></li>';
            }
            ?>

            <?php if (!empty($languages)): ?>
                <li class="user-menu__link">
                    <a class="toggle-nested-list" href="#"><i class="fas fa-caret-right"></i> Taal</a>
                    <ul class="user-menu__nested-links user-menu__nested-links--closed">
                        <?php
                        foreach ($languages as $url => $label) {
                            echo '<li class="user-menu__link"><a href="' . url_for($url) . '">' . $label . '</a></li>';
                        }
                        ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php
            /** @var array $actions */
            foreach ($actions as $url => $label){
                echo '<li class="user-menu__link"><a href="' . $url . '">' . $label . '</a></li>';
            }
            ?>
        </ul>
    </div>
</section>

<script type="text/javascript">

    jQuery(function($){
        $('.change-user').click(
            function()
            {
                var user_id = prompt('Aanmelden als een andere gebruiker.  Geeft het gebruikersnummer op.');
                if (user_id)
                {
                    document.location = "<?php echo url_for($changeUserUrl); ?>".replace('999', user_id);
                }
            }
        );

        $('.user-menu').click(function(){
            $(this).toggleClass('user-menu--closed');
        });

        $('.toggle-nested-list').click(function(e) {
            e.stopImmediatePropagation();
            let icon = $(this).find('i');
            icon.toggleClass('fa-caret-right');
            icon.toggleClass('fa-caret-down');
            $(this).closest('.user-menu__link').find('.user-menu__nested-links').toggleClass('user-menu__nested-links--closed');
        })
    });

</script>
