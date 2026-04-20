<?php

require_once("../inc/util.inc");
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

    page_head('BOINC Add-on: '.$y[1]);
    text_start();
    echo "
        This software complements BOINC
        but was not developed by the BOINC project
        and is not endorsed by BOINC. Use it at your own risk.
        <p>
    ";

    start_table('table-striped');
    table_row(
        "Name<br><font size=-2>Click to download</font>",
        "<a href=\"$url\">".$y[1].'</a>'
    );
    if (!empty($y[2])) {
        table_row("Version", $y[2]);
    }
    if (isset($y[3])) {
        table_row("Summary", $y[3]);
    }
    if (isset($y[4])) {
        table_row("Origin",
            '<a href='.$y[4].'>'.$y[4].'</a>'
        );
    }
    if (isset($y[5])) {
        table_row("Platform", $y[5]);
    }
    if (isset($y[6])) {
        table_row("Description", $y[6]);
    }
    table_row("Date", $d);
    end_table();
    text_end();

    page_tail();
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
} else if ($platform == 'desktop') {
    $x = $desktop;
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
