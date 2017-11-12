<?php
require_once("server_util.inc");
require_once("../inc/util.inc");


$user = "";
$version = "";
$platform = "";

page_head("Test cases");
echo "
    <p>
    If you experience problems with BOINC that are not covered
    by any of these tests, please email
    <a href=mailto:boinc_dev@ssl.berkeley.edu>boinc_dev@ssl.berkeley.edu</a>.
";

show_test_cases($user, $version);

page_tail();
?>
