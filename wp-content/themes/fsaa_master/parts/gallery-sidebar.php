<?php

\NV\Theme::output_file_marker(__FILE__);
$gallery = get_field("gallery");
$gallery_html = '';
foreach ($gallery as $pic):
	$image_html = wp_get_attachment_image($pic['ID'], 'thumbnail');
	$gallery_html .= "<li><a href='#'>$image_html</a></li>";
endforeach;
$title = "<h2>Gallery</h2>";
print "
	$title
	<ul class='small-block-grid-1' id='gallery_pager'></ul>";
?>