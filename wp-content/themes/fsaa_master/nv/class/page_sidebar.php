<?php

class page_sidebar
{

    public $html;
    public $post;
    public $has_content;

    public function __construct($id)
    {
        $this->post = get_post($id);
        $this->has_content = true;

    }

    public function load_gallery_sidebar()
    {
        $title = "<h2>{$this->post->post_title}</h2>";
        $this->html .= "$title <ul class='small-block-grid-1' id='gallery_pager'></ul>";
    }

    public function load_archive($type)
    {
        $this->html .= generate_sidebar_archive($type, true);
    }

    public function load_about_sidebar()
    {
        $this->html .= generate_about_sidebar(true);
    }

	public function load_contact_sidebar(){
		$this->html .= apply_filters("the_content", $this->post->post_content);
	}

    public function build_default_sidebar(){
        $_content = get_field("sidebar_content", $this->post->ID);

        if($_content):
            $this->has_content = true;
            $this->html .= apply_filters("the_content", $_content);
        else:
            $this->has_content = false;
        endif;
    }

    public function return_html()
    {
        return "
            <div id='sidebar' class='medium-4 large-3 columns'>
                <div class='blue_stripe'></div>
                $this->html
            </div>
        ";
    }

}