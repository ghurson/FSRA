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
<div class="row">
	<div 
		id="home_slideshow" 
		class="cycle-slideshow"
		data-cycle-slides=".home_slide"
		data-cycle-prev='#home_slideshow_left'
		data-cycle-next='#home_slideshow_right'
		data-cycle-log=false
		data-cycle-timeout=0
		>


		<?php
		$slides = get_field("slideshow");

		foreach ($slides as $slide):
			$caption = $slide['caption'];
			$caption_html = "<div class='medium-3 columns slideshow_text' ><h3>$caption</h3></div>";

			$image_id = $slide['image'];
			$image = wp_get_attachment_image( $image_id, 'Home Slideshow' );
			$image_src = wp_get_attachment_image_src( $image_id, 'Home Slideshow' );
			$image_html = "<div class='medium-9 columns slideshow_img' style='background-image:url({$image_src[0]})'></div>";

			print "<div class='home_slide small-12 columns'>$caption_html $image_html</div>";

		endforeach;
		?>


		<div id='home_slideshow_left'></div>
		<div id='home_slideshow_right'></div>


	</div>
</div>

<div id="home_content" class="row collapse">
	<div id='home_left' class="medium-4 columns">
		<div class='blue_stripe'></div>
		<?php print the_field("left_field"); ?>
	</div>
	<div id='home_middle' class="medium-4 columns">
		<div class='blue_stripe'></div>
		<?php print the_field("middle_field"); ?>
	</div>
	<div id='home_right' class="medium-4 columns">
		<div class='blue_stripe'></div>
		<?php print the_field("right_field"); ?>
	</div>
</div>

<?php \NV\Theme::get_footer(); ?>