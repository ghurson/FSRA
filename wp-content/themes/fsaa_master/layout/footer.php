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
        size_iframe();
        size_gallery_img();
    });

    $(window).load(function () {
        process_front_slideshow();
    })


    $(window).resize(function () {
        size_gallery_img();
        process_front_slideshow();
        size_iframe();
    })

    function  size_gallery_img(){

        var gallery = $("#gallery_display")
        if(gallery.length == 0) return false;

        var slides = gallery.find(".slide_image");

        slides.each(function(){
            $(this).width(gallery.width());
        })


    }

    function size_iframe() {
        var iframes = $("#content iframe");
        iframes.each(function () {
            $(this).height($(this).width() * .75);
        })
    }

    function process_header_menu() {
        var item = $("header .current_page_item, header .current_page_parent, header .post-type-archive .page-item-8, header .current-page-ancestor, .post-type-archive-news_item .menu-item-131");
        item.append("<div class='underscore'></div>");
        if ($(".post-type-archive").length) {
            $(".current_page_parent .underscore").remove();
        }
    }

    function process_front_slideshow() {

        if (!$('body').hasClass("home")) {
            return false
        }
        if ($(window).width() <= 641) {
            return false
        }

        var slides = $("#home_slideshow .home_slide");


        slides.each(function () {

            $(this).find(".slideshow_img").height('auto');

            img_height = $(this).find(".slideshow_img").height();
            text_height = $(this).find(".slideshow_text").height();
            console.log(img_height, text_height);

            if (text_height >= img_height) {
                $(this).find(".slideshow_img").height(text_height);
            } else {
                var text = $(this).find("h3");
                var box = text.parent().parent();
                var adj = (box.height() - text.height()) / 2;
                text.css("padding-top", adj + "px");
            }
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