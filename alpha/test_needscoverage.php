#! /usr/bin/env php
<?php

// send a summary email to boinc_alpha

require_once("../inc/phpmailer/class.phpmailer.php");
require_once("test_util.inc");

$version = current_version();
$vn = $version[0];
tests_needed_text($html, $message);

$mail = new PHPMailer();
$mail->IsSendmail();
$mail->From     = "boincadm@ssl.berkeley.edu";
$mail->FromName = "BOINC Administrator";
$mail->Subject  = "Testing status report ($vn)";
$mail->Body     = $html;
$mail->AltBody  = $message;
$mail->AddAddress("boinc_alpha@ssl.berkeley.edu", "BOINC Alpha Email List");
$mail->Send();

echo "<pre>\n";
echo "$message";
echo "</pre>\n";

?>
