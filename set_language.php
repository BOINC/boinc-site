<?php

$dir = getcwd();
chdir("/mydisks/a/users/boincadm/projects/dev/html/user");
require_once("../inc/util.inc");
require_once("../inc/translation.inc");
chdir("$dir");

$languages = get_supported_languages();
$lang = sanitize_tags(get_str("lang", true));

if (!in_array($lang, $languages) && $lang!="auto" && $lang!="en") {
    echo "Language $lang is not supported";
} else {
    send_cookie('lang', $lang, true);
    header('Location: index.php');
}
?>
