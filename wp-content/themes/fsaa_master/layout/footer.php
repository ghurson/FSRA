</div>
</div>

<?php get_template_part('parts/footer', 'content'); ?>

<!-- start wp_footer() hooks -->
<?php wp_footer(); ?>
<!-- end wp_footer() hooks -->

<script type='text/javascript'>
    $(document).foundation();

    $(function () {
        process_header_menu();
        process_front_slideshow();
        $(".fancybox").fancybox();
    });


    function process_header_menu() {
        var item = $("header .current_page_item, header .current_page_parent, header .post-type-archive .page-item-8, header .current-page-ancestor, .post-type-archive-news_item .menu-item-131");
        item.append("<div class='underscore'></div>");
        if ($(".post-type-archive").length) {
            $(".current_page_parent .underscore").remove();
        }
    }

    function process_front_slideshow() {

        var slides = $("#home_slideshow .home_slide");

        slides.each(function () {
            var text = $(this).find("h3");
            var box = text.parent().parent();
            var adj = (box.height() - text.height()) / 2;
            text.css("padding-top", adj + "px");
        });
    }

    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-56578116-1', 'auto');
    ga('send', 'pageview');

</script>


</body>
</html>