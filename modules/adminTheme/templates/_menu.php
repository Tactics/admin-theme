<nav id="dashboard-menu" class="dashboard-menu dashboard-menu--closed">

    <div class="dashboard-menu__filter">
        <input type="text" name="filter" placeholder="Filter menu">
    </div>

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
            echo "<i class='". $block['icon'] . "' title=\"" . $block["title"] . "\"></i>";
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
<script src="/adminTheme/js/mousetrap.min.js"></script>
<script src="/adminTheme/js/mousetrap-global-bind.min.js"></script>
<script type="text/javascript">
    jQuery(function($)
    {
        $('.dashboard-menu__header').click(function () {
            let $this = $(this).closest('.dashboard-menu__item');
            let $navigation = $this.closest('nav');

            // is Main navigation closed? Open it!
            if ($navigation.hasClass('dashboard-menu--closed'))
            {
                $navigation.removeClass('dashboard-menu--closed');
                $navigation.addClass('dashboard-menu--open');

                // Open the clicked sub-menu, don't close it if already open.
                $this.removeClass('dashboard-menu__item--closed');
                $this.addClass('dashboard-menu__item--open');
            }
            else
            {
                $this.toggleClass('dashboard-menu__item--closed');
                $this.toggleClass('dashboard-menu__item--open');
            }
        });

        $('.dashboard-menu__toggle').click(function () {
            tacticsMenu.toggle();
        });

        var $node = $('#dashboard-menu');

        var tacticsMenu = {
            show: function(e)
            {
                if (e) e.preventDefault();

                $node.removeClass('dashboard-menu--closed');
                $node.addClass('dashboard-menu--open');

                $node.find('.dashboard-menu__filter input').focus().val('');
            },

            hide: function(e)
            {
                if (e) e.preventDefault();

                $node.find('.dashboard-menu__item').each(function () {
                    $(this).show();
                    $(this).removeClass('dashboard-menu__item--open');
                    $(this).addClass('dashboard-menu__item--closed');
                    $(this).find('ul li').show();
                });
                $node.find('.dashboard-menu__filter input').val('');
                $node.addClass('dashboard-menu--closed');
                $node.removeClass('dashboard-menu--open');

            },

            toggle: function()
            {
                if ($node.hasClass('dashboard-menu--open'))
                {
                    tacticsMenu.hide();
                }
                else
                {
                    tacticsMenu.show();
                }
            },

            down: function(e)
            {
                if ($node.hasClass('dashboard-menu--open'))
                {
                    e.preventDefault();
                }

                var currentFocus = $(':focus');
                var activeLinks = $node.find('ul li:visible a');
                var currentIndex = activeLinks.index(currentFocus) + 1;
                if (currentIndex >= activeLinks.size())
                {
                    $node.find('.dashboard-menu__filter input').focus();
                }
                else
                {
                    activeLinks.get(currentIndex).focus();
                }
            },

            up: function(e)
            {
                if ($node.hasClass('dashboard-menu--open'))
                {
                    e.preventDefault();
                }

                var currentFocus = $(':focus');
                var activeLinks = $node.find('ul a:visible');
                var currentIndex = activeLinks.index(currentFocus) - 1;
                if (currentIndex < 0)
                {
                    $node.find('.dashboard-menu__filter input').focus();
                }
                else
                {
                    activeLinks.get(currentIndex).focus();
                }
            }
        };

        /*
        Toggle menu via button or shortcuts
        */
        Mousetrap.bind('m', tacticsMenu.show);
        Mousetrap.bindGlobal('esc', tacticsMenu.hide);
        Mousetrap.bindGlobal('down', tacticsMenu.down);
        Mousetrap.bindGlobal('up', tacticsMenu.up);

        $node.find('.dashboard-menu__filter input').keyup(function(){
            var searchString = $(this).val();

            if (searchString.length)
            {
                var tokens = searchString.split(' ');
                var matchingNodes = $node.find('ul li').hide();

                for(var i in tokens)
                {
                    matchingNodes = matchingNodes.filter(':icontains(\'' + tokens[i] + '\')');
                }
                matchingNodes.closest('.dashboard-menu__item')
                    .removeClass('dashboard-menu__item--closed')
                    .addClass('dashboard-menu__item--open');
                matchingNodes.show();

                $node.find('.dashboard-menu__item').each(function(){
                    $(this).show();
                    if (!$(this).find('ul li:visible').length)
                    {
                        $(this).hide();
                    }
                });
            }
            else
            {
                $node.find('.dashboard-menu__item').each(function(){
                    $(this).removeClass('dashboard-menu__item--closed').addClass('dashboard-menu__item--open').show();
                    $(this).find('ul li').show();
                });
            }
        });

    });

    // An implementation of a case-insensitive contains pseudo
    // made for all versions of jQuery
    // From: https://github.com/jquery/sizzle/wiki/Sizzle-Documentation
    (function( $ ) {
        function icontains( elem, text ) {
            return (
                elem.textContent ||
                elem.innerText ||
                $( elem ).text() ||
                ""
            ).toLowerCase().indexOf( (text || "").toLowerCase() ) > -1;
        }

        $.expr[':'].icontains = $.expr.createPseudo ?
            $.expr.createPseudo(function( text ) {
                return function( elem ) {
                    return icontains( elem, text );
                };
            }) :
            function( elem, i, match ) {
                return icontains( elem, match[3] );
            };

    })( jQuery );
</script>
