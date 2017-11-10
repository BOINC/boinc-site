<?php

// send reminder emails to alpha testers

require_once("../inc/phpmailer/class.phpmailer.php");
require_once("../inc/test_util.inc");

// if user reported result after this, don't send email
//
$min_time = time() - 60*86400;

$cv = current_version();
$fl = fraction_left($cv);
$pd = number_format(100*(1-$fl), 0);
$cv = $cv[0];

$mail = new PHPMailer();
$mail->IsSendmail();
$mail->From     = "romw@romwnet.org";
$mail->FromName = "Rom Walton";
$mail->Subject  = "BOINC Alpha testing";

function send_reminder($user, $join, $n, $latest) {
    global $mail, $cv, $pd;
    $opt_out_url = opt_out_url($user);
    $message = <<<EOT
Dear $user->name:

Please help us complete the testing of BOINC version $cv.
To do this:

- Download the version $cv software from
  http://boinc.berkeley.edu/download_all.php

- Perform the tests described at
  http://boinc.berkeley.edu/alpha/test_matrix.php
  Do whatever tests you can; you don't need to do all of them.

- Report the outcomes of your tests - positive or negative - at
  http://boinc.berkeley.edu/alpha/test_form.php

We need positive test results to be confident that BOINC will
work correctly on the wide range of volunteer computers.
We release a version only when we have
at least 5 positive results for each test and computer type.

The testing of version $cv is currently $pd% complete.
When this reaches 100% we can release it to the public.

Your BOINC Alpha testing history is:

Joined: $join
Number of test results reported: $n
Last test result reported: $latest

The BOINC Alpha email list is used to announce new versions for testing
and to discuss bugs and design issues.
If you are not subscribed to the email list, we encourage you to do: visit
http://lists.ssl.berkeley.edu/mailman/listinfo/boinc_alpha

Thanks for your help.

Rom Walton
BOINC Project
UC Berkeley

If you don't want to get emails about BOINC Alpha test, go here:
$opt_out_url
EOT;
    $mail->Body     = $message;
    //$mail->AltBody  = $message;
    $mail->AddAddress("$user->email_addr", "$user->name");

    $mail->Send();
    $mail->ClearAllRecipients();
}

function nresults($user) {
     $r = _mysql_query("select count(*) as count from test_report where userid=$user->id");
     $x = _mysql_fetch_object($r);
     _mysql_free_result($r);
     return $x->count;
}

function latest_result($user) {
     $r = _mysql_query("select max(UNIX_TIMESTAMP(mod_time)) as latest from test_report where userid=$user->id");
     $x = _mysql_fetch_object($r);
     _mysql_free_result($r);
     return $x->latest;
}

function do_user($user) {
    global $min_time;
    $n = nresults($user);
    if ($n) {
		$latest = date("d M Y", latest_result($user));
        if ($latest > $min_time) return;
    } else {
        $latest = "---";
    }
    $create_date = date("d M Y", $user->create_time);
    send_reminder($user, $create_date, $n, $latest);
}

db_init();

$r = _mysql_query("select * from user where send_email<>0");
//$r = _mysql_query("select * from user where id=1");
while ($user = _mysql_fetch_object($r)) {
    do_user($user);
}

?>
