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

echo "Opening dist lits fine...\n";
$f = fopen("/mydisks/a/users/boincadm/boinc_alpha/boinc-android-email.txt", "r");
if ($f) {
    while (($email_addr = fgets($f, 4096)) !== false) {
        echo "Emailing: $email_addr\n";

		$html = "
<p></p>
<p>Howdy Folks,</p>

<p>Please disregard if you have already logged test results to http://boinc.berkeley.edu/alpha/</p>

<p>A few days ago we pushed out a new build of the Android software that contains a revamped attach process and social media sharing features.</p>

<p>Please review the test matrix for the Android GUI here:<br>
http://boinc.berkeley.edu/alpha/test_matrix.php</p>

<p>Specifically we need to test attaching to each project in the project list and attaching to Ralph@home (Rosetta@home's test project).  You can manually attach to the test project using http://ralph.bakerlab.org/ for the project URL.</p>
<p>We would also like to cover the cases where people use two or more email addresses with valid and invalid passwords across multiple projects and properly handling attaching to World Community Grid in combination with other BOINC projects.</p>
<p>Be the first to brag to your friends about using your device for science by using our new social media features.  After attaching to a project or account manager you can share with your favorite social media network.</p>

<p>Please report your test results to:<br>
http://boinc.berkeley.edu/alpha/test_form.php?version=7.4.14</p>

<p>Please include which projects you tested against.</p>

<p>If you have not already created an account to report test results, please follow this link to create a new account:<br>
http://boinc.berkeley.edu/alpha/create_account_form.php</p>

<p>Thanks in advance,<br>
Rom Walton<br>
BOINC Development team</p>
<p></p>
";

		$message = "
\n
Howdy Folks,\n
\n
Please disregard if you have already logged test results to http://boinc.berkeley.edu/alpha/</p>\n
\n
A few days ago we pushed out a new build of the Android software that contains a revamped attach process and social media sharing features.\n
\n
Please review the test matrix for the Android GUI here:\n
http://boinc.berkeley.edu/alpha/test_matrix.php\n
\n
Specifically we need to test attaching to each project in the project list and attaching to Ralph@home (Rosetta@home's test project).  You can manually attach to the test project using http://ralph.bakerlab.org/ for the project URL.\n
\n
We would also like to cover the cases where people use two or more email addresses with valid and invalid passwords across multiple projects and properly handling attaching to World Community Grid in combination with other BOINC projects.\n
\n
Be the first to brag to your friends about using your device for science by using our new social media features.  After attaching to a project or account manager you can share with your favorite social media network.\n
\n
Please report your test results to:\n
http://boinc.berkeley.edu/alpha/test_form.php?version=7.4.14\n
\n
Please include which projects you tested against.\n
\n
If you have not already created an account to report test results, please follow this link to create a new account:\n
http://boinc.berkeley.edu/alpha/create_account_form.php\n
\n
Thanks in advance,\n
Rom Walton\n
BOINC Development team\n
\n
";

		$mail->Body     = $html;
		$mail->AltBody  = $message;
		$mail->AddAddress("$email_addr", "$email_addr");
		//$mail->AddAddress("rwalton@ssl.berkeley.edu", "Rom Walton");

		$mail->Send();
		$mail->ClearAllRecipients();

    }
    fclose($f);
}

?>
