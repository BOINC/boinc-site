<?php

require_once("../inc/db.inc");
require_once("../inc/util.inc");
require_once("test_util.inc");

db_init();

$user = get_logged_in_user();
$platform = BoincDb::escape_string(get_str("platform"));
$version = BoincDb::escape_string(get_str("version"));
$product_name = get_str("product_name", true);

$p = lookup_platform($platform);
$pname = $p[1];
page_head("Report test results for $version ($pname)");

echo "
	Please do as many tests as possible.
    <p>
	If you experience problems with BOINC that are not exercised
	by any of these tests, please email
	<a href=mailto:boinc_alpha@ssl.berkeley.edu>boinc_alpha@ssl.berkeley.edu</a>.
";

echo "
    <p>
    <form action=test_action.php>
    <input type=hidden name=platform value=$platform>
    <input type=hidden name=version value=$version>
    <input type=hidden name=product_name value=\"$product_name\">
";

show_test_groups($user, $version, $platform);

echo "
    <p>
    <input type=submit value='Report results'>
    </form>
    <script language=\"JavaScript\" type=\"text/javascript\" src=\"wz_tooltip.js\"></script>
";

page_tail();

?>

