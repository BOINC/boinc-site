<?php

require_once("../inc/db.inc");
require_once("../inc/util.inc");

$server = 0;
if (get_int("server", true)) {
        $server = 1;
}

require_once("test_util.inc");

$version = BoincDb::escape_string(get_str("version"));
$platform = get_str("platform", true);
$test_group = get_str("test_group", true);
$status = -1;
$status = get_int("status", true);

function show_report($r) {
    global $platform;
    $user = BoincUser::lookup_id($r->userid);
    $s = array();
    $s[0] = "OK";
    $s[1] = "minor bugs";
    $s[2] = "major bugs";
    $status = $s[$r->status];
    $p = lookup_platform($r->platform);
    $pn = $p[1];
    $tg = test_group_name($r->test_group);
    $c = $r->comment;
    if (!$c) $c = "<br>";
    $x = array(
        $user->name,
        $pn,
        $tg,
        $status,
        $r->mod_time,
    );
    if ($platform == "android") {
        $x[] = $r->product_name;
    }
    $x[] = $c;
    row_array($x);
}

page_head("Test results");

db_init();

$tr = array();
$query = "select * from $report_table where version='$version'";
$result = _mysql_query($query);
if (!$result) {
    echo _mysql_error();
    error_page("db error");
}
while ($r = _mysql_fetch_object($result)) {
    array_push($tr, $r);
}
_mysql_free_result($result);

start_table("table-striped");
$x = array(
    "User",
    "Platform",
    "Test group",
    "Status",
    "Time",
);
if ($platform == "android") {
    $x[] = "Device model";
}
$x[] = "Comment";
row_heading_array($x);

foreach($tr as $r) {
    if ($platform && $r->platform != $platform) continue;
    if ($test_group && $r->test_group != $test_group) continue;
    if ($status >= 0 && $r->status != $status) continue;

    show_report($r);
}

end_table();
page_tail();
?>
