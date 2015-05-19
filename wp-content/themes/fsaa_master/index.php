<?php
/**
 * DEFAULT TEMPLATE
 *
 * This is the global default template. If WordPress can't find a more appropriate, specific template file,
 * it will use this one.
 */
\NV\Theme::get_header();
\NV\Theme::output_file_marker(__FILE__);
get_template_part('parts/header', 'content');
?>
    <div id="container" class="row">

        <?php
        $page_obj = new page_content(get_the_ID());
        print $page_obj->is_gallery ? $page_obj->print_gallery() : $page_obj->print_html();

        ?>

    </div>
<?php
\NV\Theme::get_footer();
/*
?>

<div style="clear: both; float: left; width: 100%; background: white; height: 1px;"></div>

<div id='sidebar' class='small-3 columns'>
    <div class="blue_stripe"></div>
    <?php
    switch (get_the_ID()):
        case 5:
            print generate_about_sidebar();
            break;
        case 8:
            print generate_sidebar_archive('news_item');
            break;
        case 10:
            get_template_part("parts/gallery", "sidebar");
            break;
        case 14:
            $post = get_post(get_the_ID());
            print "<h1>$post->post_title</h1>";
            print apply_filters("the_content", $post->post_content);
            break;
    endswitch;
    if (get_query_var("monthnum")):
        generate_sidebar_archive();
    endif;
    ?>

</div>

<div id="content" class="small-9 columns">
    <?php


    switch (get_the_ID()):

        default:
            if (get_query_var("monthnum")):
                $post_query = new WP_Query(array(
                    'monthnum' => get_query_var("monthnum")
                ));
                \NV\Theme::custom_loop($post_query, 'parts/article', 'parts/article-empty');
                return;
            endif;
            \NV\Theme::loop('parts/page-content', 'parts/article-empty');
            break;
    endswitch;

    switch (get_the_ID()):
        case 10:
            get_template_part("parts/gallery", "container");
            break;
    endswitch;
    ?>
</div>
</div>

*/
