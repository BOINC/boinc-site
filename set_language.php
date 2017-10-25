<?php

$dir = getcwd();
chdir("/mydisks/a/users/boincadm/projects/dev/html/user");
require_once("../inc/translation.inc");
chdir("$dir");

$languages = get_supported_languages();
$lang = $_GET['lang'];
if (!in_array($lang, $languages) && $lang!="auto" && $lang!="en") {
    echo "Language $lang is not supported";
} else {
    setcookie('lang', $lang, time()+3600*24*365);
    header('Location: index.php');
}
?>
