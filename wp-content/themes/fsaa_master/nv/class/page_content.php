<?php

class page_content
{

    public $content_html;
    public $post_item;
    public $sidebar;
    public $content_blue_stripe;
    public $ancestory;
    public $page_id;


    public function __construct($id = false)
    {

        $this->ancestory = get_post_ancestors($id);
        $this->setup_post_item($id);
        $this->build_sidebar($id);
        if ($id):
            $this->page_id = $id;
        endif;
        if ($this->ancestory[0] == 10):
            $this->build_content_blue_stripe();
            $this->load_gallery();
            $this->sidebar->load_gallery_sidebar();
        else:
            $this->switchboard($id);
        endif;
    }

    public function switchboard($id)
    {
        switch ($id):

            case 'home':
                $this->build_archive_page('post');
                $this->sidebar->load_archive('post');
                break;

            case 5:
                $this->build_content_blue_stripe();
                $this->sidebar->load_about_sidebar();
                $this->insert_page_content();
                break;

            case 8:
                $this->build_archive_page('news_item');
                $this->sidebar->load_archive('news_item');
                break;

            case 10:
                $this->build_gallery_landing();
                break;

            case 14:
                $this->build_content_blue_stripe();
                $this->load_contact();
                $this->sidebar->load_contact_sidebar();
                break;

            default:
                $this->build_content_blue_stripe();
                $this->insert_page_content();
                $this->sidebar->build_default_sidebar();
                break;

        endswitch;

    }

    public function build_archive_page($type)
    {
        $archive_query = new WP_Query(array(
            'post_type' => $type,
            'paged' => get_query_var('paged')
        ));
        if ($archive_query->posts):
            foreach ($archive_query->posts as $post):
                $post = get_post($post->ID);
                $_title = "<h3>$post->post_title</h3>";
                $_author_name = get_the_author();
                $_time = get_the_time("F jS, Y", $post->ID);
                $_byline = "<p>Posted by: $_author_name | Posted on $_time</p>";
                $_content = apply_filters("the_content", $post->post_content);
                $_permalink = get_permalink(get_the_ID());
                $_read_more = !is_single($post) && $post->post_type != 'news_item' ? "<p class='text-right'><a href='$_permalink'>READ FULL POST ></a></p>" : "";
                $this->content_html .= "
                    <article class='post_excerpt'>
                        <div class='blue_stripe'></div>
                        $_title $_byline $_content $_read_more
                    </article>
                ";
            endforeach;
        endif;
        if (function_exists('wp_pagenavi')):
//            $this->content_html .= "<p>pagenavi needed</p>";
            ob_start();
            wp_pagenavi(array('query' => $archive_query));
            $this->content_html .= ob_get_clean();
        endif;

    }

    public function insert_page_content()
    {
        $_content = apply_filters("the_content", $this->post_item->post_content);
        $this->content_html .= "
            <h1>{$this->post_item->post_title}</h1>
            $_content
            ";
    }

    public function load_contact()
    {
        $_title = get_field("map_title", $this->page_id);
        $_loc = get_field("marker_location", $this->page_id);
        $this->content_html .= "
			<h1 style='position: relative; z-index: 2;'>$_title</h1>
			<div id='google_map' style='height: 500px;'></div>


			<script type='text/javascript'>
				function initialize() {
					var mapOptions = {
						center: {lat: -4.7494, lng: 55.483918},
						zoom: 14
					};
					var map = new google.maps.Map(document.getElementById('google_map'), mapOptions);
					var myLatlng = new google.maps.LatLng({$_loc['lat']}, {$_loc['lng']});
					var marker = new google.maps.Marker({
						position: myLatlng,
						map: map
					});



					var infowindow = new google.maps.InfoWindow({
						content: '<p style=\'color: black\'>Four Seasons<br />Resort Seychelles</p>'
					});

					google.maps.event.addListener(marker, 'click', function() {
						infowindow.open(map, marker);
					});

				}
				google.maps.event.addDomListener(window, 'load', initialize);
			</script>
		";
    }

    public function build_content_blue_stripe()
    {
        $this->content_blue_stripe = "<div class='blue_stripe'></div>";
    }

    public function build_sidebar($id)
    {
        $this->sidebar = new page_sidebar($id);
    }

    public function build_gallery_landing()
    {

        $this->content_html .= "<div class='blue_stripe' id='gallery_blue_stripe'></div>";
        $this->content_html .= "<h1>Gallery</h1>";

        $gallery_query = new WP_Query(array(
            'posts_per_page' => -1,
            'post_parent' => 10,
            'post_type' => 'page'
        ));

        $this->content_html .= "<ul id='gallery_selector' class='small-block-grid-4'>";

        if ($gallery_query->posts):
            foreach ($gallery_query->posts as $post):
                $_pl = get_permalink($post->ID);
                $_tnid = get_post_thumbnail_id($post->ID);
                $_img = wp_get_attachment_image($_tnid, 'Gallery Thumbnail');
                $this->content_html .= "<li><a href='$_pl'>$_img <span class='title'>$post->post_title</span></a></li>";
            endforeach;
        endif;

        $this->content_html .= "</ul>";


    }

    public function load_gallery()
    {
        $gallery = get_field("gallery", $this->page_id);
        $gallery_html = '';
        foreach ($gallery as $pic):
            $_image = wp_get_attachment_image_src($pic['ID'], 'Gallery Main');
            $_thumbnail = wp_get_attachment_image_src($pic['ID'], 'Gallery Thumbnail');
            $_full = wp_get_attachment_image_src($pic['ID'], 'large');
            $_post = get_post($pic['ID']);
            $_title = "<h3>$_post->post_title</h3>";
            $_caption = apply_filters("the_content", $_post->post_excerpt);
            $gallery_html .= "
			<div
				class='slide'
				data-thumbnail='{$_thumbnail[0]}'
			>
				$_title
				<a
				    href='{$_full[0]}'
				    class='fancybox'
				    rel='gallery'
				    title='$_caption'
                >
				<div
					class='slide_image'
					style='background-image: url({$_image[0]})'
				></div>
				</a>
				$_caption
			</div>";
        endforeach;
        $this->content_html .= "
	<div
		id='gallery_display'
		class='cycle-slideshow'
		data-cycle-timeout=0
		data-cycle-log=false
		data-cycle-slides='.slide'
		data-cycle-pager='#gallery_pager'
        data-cycle-pager-template='<li><img src=\"{{thumbnail}}\" /></li>'
		data-cycle-next='#gallery_next'
		data-cycle-prev='#gallery_prev'
	>
		<div id='gallery_next'></div>
		<div id='gallery_prev'></div>
		$gallery_html
	</div>";
    }

    public function setup_post_item($id)
    {
        $this->post_item = get_post($id);
    }

    public function print_html()
    {
        switch ($this->post_item->ID):
            case 10:
                $content_cols = 12;
                break;

            default:
                if ($this->sidebar->has_content):
                    $sidebar_html = $this->sidebar->return_html();
                else:
                    $sidebar_html = '';
                    $content_center = 'small-centered';
                endif;

                $content_cols = 9;
                break;

        endswitch;


        print "
            $sidebar_html
            <div id='content' class='small-$content_cols columns $content_center'>
                <article class='post_excerpt'>
                    $this->content_blue_stripe
                    $this->content_html
                </article>
            </div>
        ";
    }

}