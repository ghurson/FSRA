<?php
// Load the NV library
require_once 'nv/NV.php';
require_once 'nv/class/page_sidebar.php';
require_once 'nv/class/page_content.php';

// Initialize the NV library (also returns requirements check)
if (NV::init()) {
    // ADD OTHER CODE HERE
}

function register_news_item()
{

    $labels = array(
        'name' => 'News Items',
        'singular_name' => 'News Item',
        'menu_name' => 'News Items',
        'parent_item_colon' => 'Parent Item:',
        'all_items' => 'All Items',
        'view_item' => 'View Item',
        'add_new_item' => 'Add New Item',
        'add_new' => 'Add New',
        'edit_item' => 'Edit Item',
        'update_item' => 'Update Item',
        'search_items' => 'Search Item',
        'not_found' => 'Not found',
        'not_found_in_trash' => 'Not found in Trash',
    );
    $args = array(
        'label' => 'news_item',
        'description' => 'Items for Latest News Section',
        'labels' => $labels,
        'supports' => array('title', 'editor', 'author'),
        'hierarchical' => false,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('news_item', $args);

    $labels = array(
        'name' => 'Staff',
        'singular_name' => 'Staff',
        'menu_name' => 'Staff',
        'parent_item_colon' => 'Parent Staff:',
        'all_items' => 'All Staff',
        'view_item' => 'View Staff',
        'add_new_item' => 'Add New Staff',
        'add_new' => 'Add New',
        'edit_item' => 'Edit Staff',
        'update_item' => 'Update Staff',
        'search_items' => 'Search Staff',
        'not_found' => 'Not found',
        'not_found_in_trash' => 'Not found in Trash',
    );
    $args = array(
        'label' => 'staff',
        'description' => 'Items for Staff Section',
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail',),
        'hierarchical' => false,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('staff', $args);
}

// Hook into the 'init' action
add_action('init', 'register_news_item', 0);

add_image_size('Home Slideshow', 685, 320, true);
add_image_size('Gallery Main', 685, 465);
add_image_size('Gallery Thumbnail', 196, 102, true);

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Global Options',
        'menu_title' => 'Global Options',
        'menu_slug' => 'global-options',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

function generate_sidebar_archive($type = 'post', $var = false)
{
    global $wpdb, $month;
    $op = '';
    $years = $wpdb->get_col("SELECT DATE_FORMAT(post_date_gmt, '%Y')
	FROM $wpdb->posts
	WHERE post_type = '$type' AND post_status = 'publish'
	GROUP BY DATE_FORMAT(post_date_gmt, '%Y')
	ORDER BY post_date_gmt DESC");

    switch ($type):
        case 'news_item':
            $name = 'News Archives';
            break;
        default:
            $name = 'Blog Archives';
            break;
    endswitch;

    $op .= "<h2>$name</h2>";

    if ($years && count($years) > 0) {
        foreach ($years as $y) {
            $op .= "
			<div class='wrap'>
				<div class='year'>$y</div>
            ";
            $months = $wpdb->get_col("SELECT DATE_FORMAT(post_date_gmt, '%m')
            FROM $wpdb->posts
            WHERE post_type = '$type' AND post_status = 'publish'
            AND DATE_FORMAT(post_date_gmt, '%Y') = $y
            GROUP BY DATE_FORMAT(post_date_gmt, '%Y-%m')
            ORDER BY post_date_gmt DESC");

            if ($months) {
                $url = get_site_url();
                $link_type = $type == 'post' ? 'blog' : $type;
                $op .= "<ul id='sidebar_archive'>";
                foreach ($months as $m) :
                    $text = $month[zeroise($m, 2)];
                    $op .= "<li><a href='$url/$link_type/$y/$m'>$text</a></li>";
                endforeach;

                $op .= "</ul>";
            }
            $op .= "</div>";
        }
    }

    if ($print):
        print $op;
    else:
        return $op;
    endif;

}

function prefix_archive_rule()
{
    add_rewrite_rule('news_item/([^/]+)/([^/]+)/?$', 'index.php?year=$matches[1]&post_type=news_item&monthnum=$matches[2]&m=$matches[2]', 'top');
    add_rewrite_rule('latest-news/page/([^/]+)/?$', 'index.php?post_type=news_item&post_archive=true&page=$matches[1]', 'top');
    add_rewrite_rule('blog/page/([^/]+)/?$', 'index.php?page_archive=true&paged=$matches[1]', 'top');
    add_rewrite_rule('blog/([^/]+)/([^/]+)/?$', 'index.php?year=$matches[1]&post_type=post&monthnum=$matches[2]', 'top');
}

add_action('init', 'prefix_archive_rule');

function prefix_register_query_var($vars)
{
    $vars[] = 'page_archive';
    $vars[] = 'post_type';
    $vars[] = 'y';
    $vars[] = 'm';
    return $vars;
}

add_filter('query_vars', 'prefix_register_query_var');

add_filter('template_include', function ($path) {
    if (get_query_var('post_archive'))
        return get_template_directory() . '/archive.php';

    return $path;
});

function generate_about_sidebar($var = false)
{
    $_op = '';
    $_op .= '<h3>About the Team</h3>';
    $staff = new WP_Query(array(
        'post_type' => 'staff',
        'posts_per_page' => -1
    ));
    if ($staff->found_posts):
        foreach ($staff->posts as $person):
            $position = get_field("position", $person->ID);
            $content = apply_filters("the_content", $person->post_content);
            $img = get_the_post_thumbnail($person->ID, 'full');
            $op = "
				<div class='person'>
					$img
					<h6>$person->post_title | $position</h6>
					$content
				</div>
			";
            $_op .= $op;
        endforeach;
    endif;
    if ($var):
        return $_op;
    else:
        print $_op;
    endif;
}
