<?php \NV\Theme::output_file_marker(__FILE__); ?>

<footer>
	<div class="row collapse">
		<div id='footer_text' class="large-7 columns small-text-center large-text-left">
			<h6>&copy; <?php print date("Y"); ?> A WiseOceans project at Four Seasons Resort Seychelles</h6>
            <?php wp_nav_menu(array(
                'depth' => 1,
                'theme_location' => 'primary'
            )); ?>
		</div>
		<div id='footer_logos' class="large-5 columns small-text-center large-text-right">
			<?php
			$logos = get_field("footer_logos","options");
			foreach($logos as $logo):
				$logo_id = $logo['image'];
				$link = $logo['link'];
				$logo_html = wp_get_attachment_image($logo_id, 'full');
				$op = "<a href='http://$link' target='_blank'>$logo_html</a>";
				print $op;
			endforeach;
			?>
		</div>
	</div>
</footer>