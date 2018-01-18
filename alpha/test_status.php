<?php

require_once("../inc/util.inc");

$server = 0;
if (get_int("server", true)) {
    $server = 1;
}

require_once("test_util.inc");

page_head("Testing status");
tests_needed_text($html, $message);
echo $html;
page_tail();
?>
