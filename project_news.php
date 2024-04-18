<?php

// show recent news from BOINC projects

require_once("../inc/util.inc");
require_once("../inc/rss.inc");
require_once("../inc/project_news.inc");

page_head("News from BOINC Projects");
text_start();
echo "
    <p>Recent items from the news feeds of various BOINC projects.</p>
";

$items = get_rss_feed_cached("https://api.vcnews.info/rss", 3600);
if ($items) {
    show_rss_items($items, 0, 'rss_filter', 200);
}
text_end();
page_tail();
?>
