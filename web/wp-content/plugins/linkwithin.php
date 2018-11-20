<?php
/*
Plugin Name: LinkWithin
Plugin URI: http://www.linkwithin.com/
Description: Displays recommended stories from your network
Version: 0.5
Author: LinkWithin
*/

function linkwithin_load_widget() {
    echo "<script type=\"text/javascript\">
    var linkwithin_site_id = 296;
    (function () {
        var elem = document.createElement('script');
        elem.type = 'text/javascript';
        elem.src = 'http://www.linkwithin.com/widget.js?rand=' + Math.random();
        document.getElementsByTagName('head')[0].appendChild(elem);
     })();
</script>
<a href=\"http://www.linkwithin.com/\"><img src=\"http://www.linkwithin.com/pixel.png\" alt=\"LinkWithin Related Stories Widget for Blogs\"></a>";
}

add_action('wp_footer', 'linkwithin_load_widget');
?>