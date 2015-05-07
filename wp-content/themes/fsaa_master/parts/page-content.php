<?php
/**
 * ARTICLE PART (NO COMMENTS)
 *
 * This part can be used IN THE LOOP to output a single article (sans comments).
 */
\NV\Theme::output_file_marker(__FILE__); 
?>
<article id="article-<?php the_ID() ?>" class="<?php echo implode(get_post_class(), ' ') ?> post_excerpt">
	<div class="blue_stripe"></div>
	<?php 
	switch(get_the_ID()):
		case 14:
			get_template_part("parts/google","map");
			break;
		
		case 10:
			break;
		
		default:
			the_title("<h3>","</h3>");
			the_content();
			break;
	endswitch;
	?>
</article>