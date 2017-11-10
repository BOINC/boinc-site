<?php

require_once("../inc/boinc_db.inc");
require_once("../inc/util.inc");

db_init();

page_head("Top BOINC Alpha testers");

start_table("width=600");

echo "<tr><td colspan=2>
Each version of the BOINC software is subjected about
<a href=test_matrix.php>70 separate tests</a>
on all the major platforms (Windows, Mac, and Linux).
BOINC relies on volunteer 'Alpha testers'
to perform these tests.
<p>
The following volunteers have reported
test results in the last 30 days.
<b>Many thanks to these people for their
help in improving the reliability of BOINC software.</b>
<p>
If you're interested in volunteering as an Alpha tester,
go <a href=http://boinc.berkeley.edu/trac/wiki/AlphaInstructions>here</a>.
</td></tr>
";
$t = time() - 30*86400;

$q = "select * from test_report where UNIX_TIMESTAMP(mod_time)>$t and status<>3";
$r = _mysql_query($q);
$count = array();
while ($rep = _mysql_fetch_object($r)) {
    if (array_key_exists($rep->userid, $count)) {
        $count[$rep->userid]++;
    } else {
        $count[$rep->userid] = 1;
    }
}

asort($count);
$count = array_reverse($count, true);

table_header("Name", "Test reports in last 30 days");
foreach ($count as $id=>$c) {
    $u = BoincUser::lookup_id($id);
    row2("<a href=show_user.php?userid=$u->id>$u->name</a>", $c);
}
end_table();
?>
