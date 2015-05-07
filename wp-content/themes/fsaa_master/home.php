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
    $page_content = new page_content('home');
    $page_content->print_html();
    ?>
</div>
<?php
\NV\Theme::get_footer();
