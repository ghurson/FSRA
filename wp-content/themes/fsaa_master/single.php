<?php
/**
 * Single TEMPLATE
 *
 */
\NV\Theme::get_header();
\NV\Theme::output_file_marker(__FILE__);
get_template_part('parts/header', 'content');
?>
<div id="container" class="row">
	<div id='sidebar' class='small-3 columns'>
		<div class="blue_stripe"></div>
		<?php	print generate_sidebar_archive(); ?>
	</div>
	<div id="content" class="small-9 columns">
		<?php \NV\Theme::loop('parts/article', 'parts/article-empty'); ?>
	</div>
</div>
<?php
\NV\Theme::get_footer();
