#! /usr/bin/env php
<?php

// send a customized email to boinc alpha testers

require_once("../inc/phpmailer/class.phpmailer.php");
require_once("test_util.inc");

$mail = new PHPMailer();
$mail->IsSendmail();
$mail->From     = "rwalton@ssl.berkeley.edu";
$mail->FromName = "Rom Walton";
$mail->Subject  = "BOINC Alpha Testing";

$r = _mysql_query("select * from test_report");
while ($tr = _mysql_fetch_object($r)) {
	$upresent[$tr->userid] = true;
}

$r = _mysql_query("select * from user");
while ($user = _mysql_fetch_object($r)) {
	if (!$upresent[$user->id]) {
		$create_date = date("M d Y", $user->create_time);

		$html = "
<p>Dear $user->name:</p>
<p></p>
<p>We notice that since joining the BOINC Alpha Test project on $create_date,<br>
you have not yet reported any test results<br>
using our web-based reporting system:<br>
http://isaac.ssl.berkeley.edu/alpha/test_form.php</p>
<p>It's very important that you report results,<br>
even if you don't find any problems.<br>
We don't release BOINC software until it gets at least 5<br>
\"No bugs found\" reports for each test and computer type.</p>
<p>If you have any questions or problems with the BOINC Alpha<br>
testing process, please let me know.<br>
We rely on the help of volunteers like you to make sure that<br>
BOINC runs smoothly on all types of computers.</p>
<p>Thanks in advance,<br>
Rom Walton<br>
BOINC Development team</p>
<p></p>
";

		$message = "
Dear $user->name:\n
\n
We notice that since joining the BOINC Alpha Test project on $create_date,\n
you have not yet reported any test results\n
using our web-based reporting system:\n
http://isaac.ssl.berkeley.edu/alpha/test_form.php\n
\n
It's very important that you report results,\n
even if you don't find any problems.\n
We don't release BOINC software until it gets at least 5\n
\"No bugs found\" reports for each test and computer type.\n
\n
If you have any questions or problems with the BOINC Alpha\n
testing process, please let me know.\n
We rely on the help of volunteers like you to make sure that\n
BOINC runs smoothly on all types of computers.\n
\n
Thanks in advance,\n
Rom Walton\n
BOINC Development team\n
\n
";

		$mail->Body     = $html;
		$mail->AltBody  = $message;
		$mail->AddAddress("$user->email_addr", "$user->name");
		//$mail->AddAddress("rwalton@ssl.berkeley.edu", "Rom Walton");

		$mail->Send();
		$mail->ClearAllRecipients();
		
	}
}

?>
