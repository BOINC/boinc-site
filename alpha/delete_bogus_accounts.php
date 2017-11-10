<?php

require_once("../inc/boinc_db.inc");
require_once("../inc/util.inc");

$emails = file("boinc_alpha_emails", FILE_IGNORE_NEW_LINES);
$users = BoincUser::enum("");
$ntotal = 0;
$nboth = 0;     // in email list and reported results
$nemail = 0;    // in email list but no results
$nreport = 0;   // results, but not in email list
$nneither = 0;  // neither

db_init();

$start_time = mktime(0, 0, 0, 8, 7, 2013);
$end_time = mktime(0, 0, 0, 8, 23, 2013);
foreach ($users as $user) {
    $r = _mysql_query("select count(*) as count from test_report where userid=$user->id");
    $x = _mysql_fetch_object($r);
    _mysql_free_result($r);
    $n = $x->count;
    if (0) {
        if ($n) continue;
        if ($user->create_time < $start_time) continue;
        if ($user->create_time > $end_time) continue;
        if (in_array($user->email_addr, $emails)) continue;
    }
    //$user->delete(); continue;
    if ($user->send_email) continue;
    echo "$user->email_addr (ID $user->id)\n";
    echo "   $n test results\n";
    echo "   joined ".date_str($user->create_time)."\n";
    $ntotal++;
    if (in_array($user->email_addr, $emails)) {
        echo "   in the email list\n";
        $n ? $nboth++ : $nemail++;
    } else {
        echo "   NOT in the email list\n";
        $n ? $nreport++ : $nneither++;
    }
}
echo "$ntotal accounts in the DB\n";
echo "$nboth reported results and in email list\n";
echo "$nemail in email list but no results\n";
echo "$nreport reported results but not in email list\n";
echo "$nneither no results and not in email list\n";

$n = count($emails) - $nboth - $nemail;
echo "\n$n in email list but no account\n";
?>
