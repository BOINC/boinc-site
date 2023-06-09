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
$platform = BoincDb::escape_string(get_str("platform"));
$version = BoincDb::escape_string(get_str("version"));
$product_name = BoincDb::escape_string(get_str("product_name"));
lookup_version($version);

foreach ($all_test_groups as $t) {
    $sname = $t[0]."_status";
    $cname = $t[0]."_comment";

    $status = null;
    $comment = null;
    $status = get_str($sname, true);
    if (is_null($status)) continue;
    $status = BoincDb::escape_string($status);
    $comment = BoincDb::escape_string(get_str($cname, true));

    $query = "select * from $report_table where userid=$user->id and version='$version' and platform='$platform' and test_group='$t[0]'";
    $result = _mysql_query($query);
    $tr = _mysql_fetch_object($result);
    if ($tr) {
        $query = "update $report_table set status=$status, comment='$comment' where userid=$user->id and version='$version' and platform='$platform' and test_group='$t[0]'";
        $retval = _mysql_query($query);
        echo "<br>$t[1]: updating existing report\n";
    } else {
        $query = "insert into $report_table (userid, version, platform, test_group, status, comment, product_name) values ($user->id, '$version', '$platform', '$t[0]', $status, '$comment', '$product_name')";
        $retval = _mysql_query($query);
    }
    if (!$retval) {
        echo _mysql_error();
        error_page("db error");
    }
}

page_head("Test report accepted");
echo "
    <p>
    Test report accepted - thank you.
    <p>
    <a href=test_form.php>Submit more test results</a>
";
page_tail();
?>
