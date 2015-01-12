<?php

// NOTE: the core client fetches download.php?xml=1 every so often;
// don't break this!!!

require_once("docutil.php");
require_once("versions.inc");
require_once("../html/inc/translation.inc");

$client_info = $_SERVER['HTTP_USER_AGENT'];

// show a download link as a button or table row
//
function download_link($pname, $button=false) {
    global $platforms;
    global $url_base;
    global $client_info;
    $p = $platforms[$pname];
    $v = latest_version($p);
    $file = $v['file'];
    if (array_key_exists('vbox_file', $v)) {
        $vbox_file = $v['vbox_file'];
        $vbox_version = $v['vbox_version'];
        $vbox_url = $url_base.$vbox_file;
        $vbox_path = "dl/$vbox_file";
        $vbox_size = number_format(filesize($vbox_path)/1000000, 2);
    } else {
        $vbox_file = null;
    }
    if (strstr($client_info, 'Windows NT 4') || strstr($client_info, 'Windows NT 5')) {
        $vbox_file = null;
    }
    $long_name = $p['name'];
    $num = $v['num'];
    $path = "dl/$file";
    $url = $url_base.$file;
    $dlink = "<a href=\"$url\">$file</a>";
    $s = number_format(filesize($path)/1000000, 2);

    if ($button) {
        if ($vbox_file) {
            echo tra("We recommend that you also install VirtualBox, so your computer can work on science projects that require it.");
            echo " <a href=wiki/VirtualBox>";
            echo tra("Learn more about VirtualBox.");
            echo "</a>";

            echo "<table><tr valign=top><td>\n";
            echo "
                <table cellpadding=10><tr valign=top><td class=button>
                <a href=\"$vbox_url\"><font size=4><u>"
                .tra("Download BOINC + VirtualBox")
                ."</u></font></a>
                <br>"
                .sprintf(tra("for %s"), $long_name)
                ." ($vbox_size MB)"
                ."<br><span class=note>"
                .sprintf(tra("BOINC %s"), $num)
                .", "
                .sprintf(tra("VirtualBox %s"), $vbox_version)
                ."</span></td></tr>
                </table>
            ";
            echo "</td><td>\n";
        }
        echo "
            <table cellpadding=10><tr valign=top><td class=button>
            <a href=\"$url\"><font size=4><u>".tra("Download BOINC")."</u></font></a>
            <br>"
            .sprintf(tra("for %s"), $long_name)
            ." ($s MB)"
            ."<br><span class=note>"
            .sprintf(tra("BOINC %s"), $num)
            ."</span></td></tr>
            </table>
        ";
        if ($vbox_file) {
            echo "</td></tr></table>\n";
        }
        if ($pname == 'linux'||$pname == 'linuxx64') {
            echo "<p>", linux_info();
        }
    } else {
        if ($vbox_file) {
            echo "<tr>
                <td class=rowlineleft>$long_name</td>
                <td class=rowline> $num (with Virtualbox $vbox_version)</td>
                <td class=rowlineright><a href=$vbox_url>Download</a> ($vbox_size MB)</td>
                </tr>
            ";
        }
        echo "<tr>
            <td class=rowlineleft>$long_name</td>
            <td class=rowline> $num</td>
            <td class=rowlineright><a href=$url>Download</a> ($s MB)</td>
            </tr>
        ";
    }
}

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

function show_download($pname) {
    echo "
        <table cellpadding=10><tr><td valign=top>
        ".tra("BOINC is a program that lets you donate your idle computer time to science projects like SETI@home, Climateprediction.net, Rosetta@home, World Community Grid, and many others.")
        ."  "
        .tra("After installing BOINC on your computer, you can connect it to as many of these projects as you like.")
        ."<p>"
        .tra("You may run this software on a computer only if you own the computer or have the permission of its owner.").
        "<p>"
    ;
    if ($pname == 'android') {
        echo "<b>"
            .tra("We recommend that you download BOINC from the Google Play Store or Amazon Appstore, not from here.")
            ." </b>
        ";
    }
    if ($pname) {
        download_link($pname, true);
    } else {
        list_start();
        list_heading_array(array(
            'Computer type',
            'BOINC version ',
            'Click to download'
        ));
        download_link('win');
        download_link('winx64');
        download_link('mac');
        download_link('macppc');
        download_link('linux');
        download_link('linuxx64');
        download_link('linuxcompat');
        download_link('android');
        list_end();
        echo "Linux users: BOINC is available as a package for many Linux distributions.  It is available for Linux/ARM as a package for Debian and Ubuntu for ARM, and Raspbian (for Raspberry Pi).";
    }
    if ($pname != 'android') {
        echo "
            <p>
            After downloading BOINC you must <b>install</b> it:
            typically this means double-clicking on the file icon
            when the download is finished.
        ";
    }
    echo "
        <p>
        <center>
        <a href=\"wiki/System_requirements\"><span class=nobr>".tra("System requirements")."</span></a>
        &middot; <a href=\"wiki/Release_Notes\"><span class=nobr>".tra("Release notes")."</span></a>
        &middot; <a href=\"wiki/BOINC_Help\"><span class=nobr>".tra("Help")."</span></a>
        &middot; <a href=download_all.php><span class=nobr>".tra("All versions")."</span></a>
        &middot; <a href=\"trac/wiki/VersionHistory\">".tra("Version history")."</a>
        &middot; <a href=http://boinc.berkeley.edu/wiki/GPU_computing>".tra("GPU computing")."</a>
        </center>
        </td>
        <td valign=top>
    ";
    show_pictures();
    echo "
        </td>
        </tr></table>
    ";
}

if (get_str2('xml')) {
    $args = strstr($_SERVER['REQUEST_URI'], '?');
    Header("Location: download_all.php$args");
    exit();
}

page_head(tra("BOINC: compute for science"));

if (get_str2('all_platforms')) {
    show_download(null);
} else if (strstr($client_info, 'Windows')) {
    if (strstr($client_info, 'Win64')||strstr($client_info, 'WOW64')) {
        show_download('winx64');
    } else {
        show_download('win');
    }
} else if (strstr($client_info, 'Mac')) {
	if (strstr($client_info, 'PPC Mac OS X')) {
		show_download('macppc');
	} else {
		show_download('mac');
	}
} else if (strstr($client_info, 'Android')) {
    // Check for Android before Linux,
    // since Android contains the Linux kernel and the
    // web browser user agent string lists Linux too.
    //
	show_download('android');
} else if (strstr($client_info, 'Linux')) {
	if (strstr($client_info, 'x86_64')) {
		show_download('linuxx64');
	} else {
		show_download('linux');
	}
} else {
    show_download(null);
}

page_tail(true);

?>
