<?php

// If xml=1 is specified, redirect to download_all.php
// the client fetches download.php?xml=1 every so often;
// so don't break this!!!
//
// Otherwise show a user-friendly 'Install BOINC' page
// for the platform in HTTP header

require_once("versions.inc");
require_once("download_util.inc");
require_once("../inc/translation.inc");

require_once("../inc/util.inc");

$apps = array(
    array('classic.jpg', 180, 143),
    array('cpdn_200.jpg', 200, 147),
    array('eah_200.png', 200, 150),
    array('rosetta_at_home.jpg', 200, 150),
    array('qah.200x150.png', 200, 150),
);

function show_pictures() {
    global $apps;
    shuffle($apps);
    $a0 = $apps[0];
    $a1 = $apps[1];
    $f0 = $a0[0];
    $f1 = $a1[0];
    echo "
        <div style=\"max-height: 300px\">
        <img src=\"images/mgrwork.png\" alt=\"BOINC manager\"><br>
        <div style=\"position:relative; top:-80px; left:30px\">
            <img src=\"images/$f0\" alt=\"BOINC project\"><br>
        </div>
        <div style=\"position:relative; top:-160px; left:70px\">
            <img src=\"images/$f1\" alt=\"BOINC project\"><br>
        </div>
        </div>
    ";
}

function show_download($client_info, $pname) {
    text_start();
    echo tra("BOINC is a program that lets you donate your idle computer time to science projects like Climateprediction.net, Rosetta@home, GPUGrid, and many others.");
    echo "\n";
    echo tra("After installing BOINC on your computer, you can connect it to as many of these projects as you like.");
    echo "\n<p><p>";
    if (strstr($pname, 'linux')) {
        show_button(
            'https://boinc.berkeley.edu/linux_install.php',
            'Instructions for Linux'
        );

    } else if ($pname) {
        download_link($client_info, $pname, true);
    } else {
        start_table();
        table_header(
            'Computer type',
            'BOINC version ',
            'Click to download'
        );
        download_link($client_info, 'winx64');
        download_link($client_info, 'win');
        download_link($client_info, 'mac');
        download_link($client_info, 'mac_10_7');
        download_link($client_info, 'mac32');
        download_link($client_info, 'macppc');
        //download_link($client_info, 'linux');
        //download_link($client_info, 'linuxx64');
        //download_link($client_info, 'linuxcompat');
        download_link($client_info, 'android');
        end_table();
        echo "Linux users: <a href=https://boinc.berkeley.edu/wiki/Installing_on_Linux>see Installation options</a>.";
    }
    echo "<p><ul>";
    switch ($pname) {
    case 'win':
    case 'mac':
        echo "
            <li>
            After downloading BOINC you must <b>install</b> it:
            typically this means double-clicking on the file icon
            when the download is finished.
        ";
    }
    echo "<li>\n".tra("When you first run BOINC, you will be asked to choose a project. For instructions, see the %1BOINC User Manual%2.", "<a href=https://boinc.berkeley.edu/wiki/User_manual>", "</a>");

    echo "<li>\n".tra("You may run this software on a computer only if you own the computer or have the permission of its owner.");
    echo "
        </ul>
        <hr>
        <center>
        <a href=\"wiki/System_requirements\"><span class=nobr>".tra("System requirements")."</span></a>
        &middot; <a href=https://github.com/BOINC/boinc/wiki/Client-release-notes><span class=nobr>".tra("Release notes")."</span></a>
        &middot; <a href=\"wiki/BOINC_Help\"><span class=nobr>".tra("Help")."</span></a>
        &middot; <a href=download_all.php><span class=nobr>".tra("All versions")."</span></a>
        &middot; <a href=http://boinc.berkeley.edu/wiki/GPU_computing>".tra("GPU computing")."</a>
        <p>
    ";
    show_pictures();
    echo "</center>";
    text_end();
}

if (get_str('xml', true)) {
    $args = strstr($_SERVER['REQUEST_URI'], '?');
    Header("Location: download_all.php$args");
    exit();
}

$client_info = get_str('user_agent', true);  // for debugging
if (!$client_info) {
    $client_info = $_SERVER['HTTP_USER_AGENT'];
}


$is_login_page = true;

page_head(tra("Install BOINC"));
if (get_str('all_platforms', true)) {
    show_download($client_info, null);
} else {
    show_download($client_info, client_info_to_platform($client_info));
}

page_tail(true);

?>
