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
        <div class="large-9 columns header_content_right medium-text-center large-text-right">
            <?php wp_nav_menu(array(
                'depth' => 1
            )); ?>
        </div>
        <div id='make_a_donation'>
            <h6><a href='http://<?= the_field("donation_link", "options"); ?>' target="_blank">Make a Donation ></a>
            </h6>
        </div>
    </div>
    <nav class="top-bar" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name">
                <h1><a href="#">My Site</a></h1>
            </li>
            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>

        <section class="top-bar-section">
            <!-- Right Nav Section -->
            <ul class="right">
                <li class="active"><a href="#">Right Button Active</a></li>
                <li class="has-dropdown">
                    <a href="#">Right Button Dropdown</a>
                    <ul class="dropdown">
                        <li><a href="#">First link in dropdown</a></li>
                        <li class="active"><a href="#">Active link in dropdown</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Left Nav Section -->
            <ul class="left">
                <li><a href="#">Left Nav Button</a></li>
            </ul>
        </section>
    </nav>
</header>