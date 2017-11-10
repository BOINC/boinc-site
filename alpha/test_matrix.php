<?php
require_once("test_util.inc");
require_once("../inc/util.inc");


$user = "";
$version = "";
$platform = "";
$show_all = get_str("show_all", true);

if ($show_all) {
    page_head("All test cases");
    echo "
        <a href=test_matrix.php>Show tests for current release</a>.
    ";
} else {
    page_head("Test cases for current release");
    echo "
        <a href=test_matrix.php?show_all=1>Show all tests</a>
    ";
}
echo "
    <p>
    If you experience problems with BOINC that are not covered
    by any of these tests, please email
    <a href=mailto:boinc_alpha@ssl.berkeley.edu>boinc_alpha@ssl.berkeley.edu</a>.
";

show_test_cases($user, $version, $platform, !$show_all);

page_tail();
?>
