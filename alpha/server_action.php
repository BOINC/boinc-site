<?php

require_once("../inc/db.inc");
require_once("../inc/util.inc");

require_once("server_util.inc");
require_once("server_test.inc");

db_init();

$user = get_logged_in_user();
$version = BoincDb::escape_string(get_str("version"));
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

    $query = "select * from server_report where userid=$user->id and version='$version' and test_group='$t[0]'";
    $result = _mysql_query($query);
    $tr = _mysql_fetch_object($result);
    if ($tr) {
        $query = "update server_report set status=$status, comment='$comment' where userid=$user->id and version='$version' and test_group='$t[0]'";
        $retval = _mysql_query($query);
        echo "<br>$t[1]: updating existing report\n";
    } else {
        //echo "inserting";
        $query = "insert into server_report (userid, version, test_group, status, comment) values ($user->id, '$version', '$t[0]', $status, '$comment')";

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
