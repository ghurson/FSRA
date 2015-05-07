<?php
\NV\Theme::output_file_marker(__FILE__);
$logo = get_field("site_logo", "options");
$logo_href = $logo['url'];
?>

<header>
    <div class="row collapse">
        <div id='site_logo' class="small-3 columns header_content_left">
            <a href='<?php print site_url(); ?>'>
                <img src='<?php print $logo_href; ?>' id='site_logo'/>
            </a>
        </div>
        <div class="large-9 columns header_content_right medium-text-center large-text-right hide-for-small-down">
            <?php wp_nav_menu(array(
                'depth' => 1
            )); ?>
        </div>
        <div id='make_a_donation'>
            <h6><a href='http://<?= the_field("donation_link", "options"); ?>' target="_blank">Make a Donation ></a>
            </h6>
        </div>
    </div>
    <nav class="top-bar show-for-small-only" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name">
                <h1><a href="#"></a></h1>
            </li>
            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>

        <section class="top-bar-section">
            <?php wp_nav_menu(array(
                'depth' => 1,
                'items_wrap'      => '<ul id="%1$s" class="">%3$s</ul>'
            )); ?>
        </section>
    </nav>
</header>