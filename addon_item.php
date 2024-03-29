<?php

require_once("docutil.php");
require_once("addon_data.php");

$platform = $_GET['platform'];
$item = $_GET['item'];

function show_item($y) {
    $d = gmdate("g:i A \U\T\C, F d Y", $y[7]);
    $file = $y[0];
    if (strstr($file, 'http://') || strstr($file, 'https://')) {
        $url = $file;
    } else {
        $url = "https://boinc.berkeley.edu/addons/$file";
    }

    old_page_head($y[1]);
    list_start();
    list_item(
        "Name<br><font size=-2>Click to download</font>",
        "<a href=\"$url\">".$y[1].'</a>');
    if (isset($y[2])) {
        list_item("Version", $y[2]);
    }
    if (isset($y[3])) {
        list_item("Summary", $y[3]);
    }
    if (isset($y[4])) {
        list_item("Origin",
            '<a href='.$y[4].'>'.$y[4].'</a>'
        );
    }
    if (isset($y[5])) {
        list_item("Platform", $y[5]);
    }
    if (isset($y[6])) {
        list_item("Description", $y[6]);
    }
    list_item("Date", $d);
    list_end();

    old_page_tail();
}

if ($platform == 'win') {
    $x = $win;
} else if ($platform == 'mac') {
    $x = $mac;
} else if ($platform == 'linux') {
    $x = $linux;
} else if ($platform == 'browser') {
    $x = $browser;
} else if ($platform == 'web') {
    $x = $web;
} else if ($platform == 'mobile') {
    $x = $mobile;
} else {
    boinc_error_page('bad name');
}

$found = false;
foreach ($x as $y) {
    if ($y[0] == $item) {
        show_item($y);
        $found = true;
        break;
    }
}
if (!$found) {
    boinc_error_page('bad item');
}

?>
