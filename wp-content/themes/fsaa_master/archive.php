<?php
/**
 * Archive TEMPLATE
 *
 */
\NV\Theme::get_header();
\NV\Theme::output_file_marker(__FILE__);
get_template_part('parts/header', 'content');
?>
    <div id="container" class="row">
        <div id='sidebar' class='small-3 columns'>
            <div class='blue_stripe'></div>
            <?php print generate_sidebar_archive(get_query_var("post_type")); ?>
        </div>
        <div id="content" class="small-9 columns">
            <?php
            $news_query = new WP_Query(array(
                'post_type' => get_query_var("post_type"),
                'year' => get_query_var("year"),
                'monthnum' => get_query_var("monthnum"),
                'paged' => get_query_var("page")
            ));
            \NV\Theme::custom_loop($news_query, 'parts/article', 'parts/article-empty');
            if (function_exists('wp_pagenavi')):
                wp_pagenavi(array('query' => $news_query));
            endif;
            ?>
        </div>
    </div>
<?php
global $wp_query;
\NV\Theme::get_footer();
