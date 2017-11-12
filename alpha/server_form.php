<?php

require_once("../inc/db.inc");
require_once("../inc/util.inc");
require_once("server_util.inc");

db_init();

$user = get_logged_in_user();
$v = current_version();
$version = $v[0];

page_head("Report test results for $version");

echo "
	Please do as many tests as possible.
    <p>
	If you experience problems with BOINC that are not exercised
	by any of these tests, please email
	<a href=mailto:boinc_dev@ssl.berkeley.edu>boinc_dev@ssl.berkeley.edu</a>.
";

echo "
    <p>
    <form action=server_action.php>
    <input type=hidden name=version value=$version>
";

show_test_groups($user, $version);

echo "
    <p>
    <input type=submit value='Report results'>
    </form>
    <script language=\"JavaScript\" type=\"text/javascript\" src=\"wz_tooltip.js\"></script>
";

page_tail();

?>

