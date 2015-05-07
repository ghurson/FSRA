<?php
/**
 * ARTICLE PART (NO COMMENTS)
 *
 * This part can be used IN THE LOOP to output a single article (sans comments).
 */
?>
<article id="article-<?php the_ID() ?>" class="<?php echo implode(get_post_class(), ' ') ?> post_excerpt">
	<div class='blue_stripe'></div>
	<?php
		$post = get_post(get_the_ID());
		$_title = "<h3>$post->post_title</h3>";
		$_author_name = get_the_author();
		$_time = get_the_time("F jS, Y");
		$_byline = "<p>Posted by: $_author_name | Posted on $_time</p>";
		$_content = apply_filters("the_content", $post->post_content);
		$_permalink = get_permalink(get_the_ID());
		$_read_more = !is_single($post) && $post->post_type != 'news_item' ? "<p class='text-right'><a href='$_permalink'>READ FULL POST ></a></p>" : "";
		
		print "$_title $_byline $_content $_read_more";
	?>
		
</article>