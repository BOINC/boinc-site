<?php
require_once("../inc/db.inc");
require_once("../inc/util.inc");

$server = 0;
if (get_int("server", true)) {
    $server = 1;
}

require_once("test_util.inc");

db_init();

$user = get_logged_in_user();
$version = get_str("version", true);
if (!$version) {
	$v = current_version();
    $version = $v[0];
}
lookup_version($version);

page_head("Report test results for $version");
echo "
    Use this form for reporting test results
    for version $version of the BOINC client.
    Fill out this form separately for each platform you tested.
    <p>
    <form action=test_form2.php>
    <input type=hidden name=version value=$version>
    <input type=hidden name=server value=$server>
    <p>
    Which platform did you test on?
    <br>
";
    $have_android = show_platform_select($version);
    if ($have_android) {
        echo "
            <br>If Android, device model: <input type=text name=product_name>
            <br><font size=-2>e.g. Samsung Galaxy S4</font>
        ";
    }
echo "
    <p>
    <input type=submit value='Continue'>
    </form>
    <hr>
    <p>To report results for a different version, select
    a version and click 'Change version'.
    <form action=test_form.php>
";
    show_version_select();
echo "
    <p>
    <input type=submit value='Change version'>
    </form>
";

page_tail();
?>
