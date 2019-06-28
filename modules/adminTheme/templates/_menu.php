<nav class="dashboard-menu dashboard-menu--closed">

    <div class="dashboard-menu__container">
        <?php
        foreach($menu_config as $block)
        {
            $items = array();

            if(empty($block)) {
                continue;
            }

            foreach($block['items'] as $item)
            {
                if(isset($item['section']) && ! myAppConfig::isSectionActive($item['section'])) { continue; }
                if(isset($item['feature']) && ! myAppConfig::hasFeature($item['feature'])) { continue; }

                if ($item['credential'] == '' || $sf_user->hasCredential($item['credential'], false))
                {
                    $items[] = $item['link'];
                }
            }

            if (! count($items))
            {
                continue;
            }

            if(isset($block['section']) && ! myAppConfig::isSectionActive($block['section'])) { continue; }
            if(isset($block['feature']) && ! myAppConfig::hasFeature($block['feature'])) { continue; }


            echo "<div class='dashboard-menu__item dashboard-menu__item--closed'>\n";
            echo "<div class='dashboard-menu__header'>";
            echo "<div class='dashboard-menu__title-icon'>";
            echo "<i class='". $block['icon'] . "'></i>";
            echo "</div>";
            echo "<h1 class='dashboard-menu__title'>";
            echo $block['title'];
            echo "</h1>";
            echo "</div>";

            echo "<div class='dashboard-menu__links'>";
            echo "<ul>";
            foreach ($items as $item) {
                echo "<li class=\"dashboard-menu__link\">{$item}</li>";
            }
            echo "</ul>";
            echo "</div>";
            echo "</div>\n\n";

        }
        ?>

    </div>

    <div class="dashboard-menu__toggle"></div>
</nav>

<script type="text/javascript">
    jQuery(function($)
    {
        $('.dashboard-menu__item').click(function(){
            $(this).toggleClass('dashboard-menu__item--closed');
            $(this).toggleClass('dashboard-menu__item--open');
        })
    });
</script>