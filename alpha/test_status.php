<?php

require_once("test_util.inc");
require_once("../inc/util.inc");

page_head("Testing status");
tests_needed_text($html, $message);
echo $html;
page_tail();
?>
