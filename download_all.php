<?php

// This file is part of BOINC.
// https://boinc.berkeley.edu
// Copyright (C) 2025 University of California
//
// BOINC is free software; you can redistribute it and/or modify it
// under the terms of the GNU Lesser General Public License
// as published by the Free Software Foundation,
// either version 3 of the License, or (at your option) any later version.
//
// BOINC is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// See the GNU Lesser General Public License for more details.
//
// You should have received a copy of the GNU Lesser General Public License
// along with BOINC.  If not, see <http://www.gnu.org/licenses/>.

// show information about downloadable BOINC client software
//
// URL options:
// xml=1            Show results as XML
// dev=1            Show "development" versions
// exp=1            Show "experimental" versions
// min_version=x    show no versions earlier than x
// max_version=x    show no versions later than x
// version=x        show version x
// platform=x       show only versions for platform x (win/mac/linux/solaris)

require_once("../inc/util.inc");

$experimental = get_str("exp", true);
require_once("versions.inc");

$is_login_page = true;

$xml = get_str("xml", true);
$dev = get_str("dev", true);
$pname = get_str("platform", true);
$min_version = get_str("min_version", true);
$max_version = get_str("max_version", true);
$version = get_str("version", true);
$type_name = get_str("type", true);
if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $client_info = $_SERVER['HTTP_USER_AGENT'];
} else {
    $client_info = "";
}

if ($pname && !array_key_exists($pname, $platforms)) {
    error_page("platform not found");
}

// if not XML, dev defaults to 1
//
if (!$xml) {
    if ($dev === null) $dev=1;
}

function dl_item($x, $y) {
    echo "<tr><td valign=top  align=right width=\"30%\">$x</td>
        <td>$y</td></tr>
    ";
}

function version_url($file) {
    global $url_base;
    return $url_base.$file;
}

function show_detail($v) {
    $num = $v["num"];
    $file = $v["file"];
    $status = $v["status"];
    $path = "dl/$file";
    $url = version_url($v['file']);
    $dlink = "<a href=$url>$file</a>";
    $s = number_format(filesize($path)/1000000, 2);
    $date = $v["date"];
    $type = type_text($v["type"]);

    table_start();
    dl_item("File (click to download)", "$dlink ($s MB)");
    dl_item("Version number", $num);
    dl_item("Release date", $date);
    table_end();
}


function show_version_xml($v, $p) {
    $path = "dl/".$v["file"];
    echo sprintf(
'<version>
    <platform>%s</platform>
    <dbplatform>%s</dbplatform>
    <description>%s</description>
    <date>%s</date>
    <version_num>%s</version_num>
    <installer>%s</installer>
',
        $p["name"],
        $p["dbname"],
        $v["status"],
        $v["date"],
        $v["num"],
        type_text($v["type"])
    );
    if ($v['file']) {
        echo sprintf(
'    <url>%s</url>
    <filename>%s</filename>
    <size_mb>%s</size_mb>
',
            version_url($v['file']),
            $v["file"],
            number_format(filesize($path)/1000000, 2)
        );
    }
    if (false && array_key_exists('vbox_file', $v)) {
        $path = "dl/".$v["vbox_file"];
        echo sprintf(
'    <vbox_version>%s</vbox_version>
    <vbox_url>%s</vbox_url>
    <vbox_filename>%s</vbox_filename>
    <vbox_size_mb>%s</vbox_size_mb>
',
            $v['vbox_version'],
            version_url($v['vbox_file']),
            $v['vbox_file'],
            number_format(filesize($path)/1000000, 2)
        );
    }
    if (array_key_exists('min_os_version', $v)) {
        echo sprintf("    <min_os_version>%s</min_os_version>\n", $v['min_os_version']);
    }
    if (array_key_exists('max_os_version', $v)) {
        echo sprintf("    <max_os_version>%s</max_os_version>\n", $v['max_os_version']);
    }
    echo '</version>
';
}

function show_version($pname, $i, $v) {
    if (!$v) return;
    $num = $v["num"];
    $file = $v["file"];
    $status = $v["status"];
    if (is_dev($v)) {
        $status = $status."
            <br><span class=dev>
            (MAY BE UNSTABLE - USE ONLY FOR TESTING)
            </span>
        ";
    }
    $path = "dl/$file";
    $s = number_format(filesize($path)/1000000, 2);
    $date = $v["date"];
    $type = $v["type"];
    $type_text = type_text($type);
    $url = version_url($v['file']);

    $link = "";
    if ($v['type'] == 'linux_pkg') {
        $link = '<a href=linux_install.php><b>Package installation instructions</b></a>';
    } else {
        if (false && array_key_exists('vbox_file', $v)) {
            $vbox_file = $v['vbox_file'];
            $vbox_version = $v['vbox_version'];
            $vbox_url = version_url($vbox_file);
            $vbox_path = "dl/$vbox_file";
            $vbox_size = number_format(filesize($vbox_path)/1000000, 2);
            $link = "<a href=\"$vbox_url\"><b>Download BOINC + VirtualBox $vbox_version</b></a> ($vbox_size MB)<br>";
        }
        $link .= "<a href=\"$url\"><b>Download</b></a> ($s MB)";
    }
    echo "<tr>
        <td>$num</td>
        <td>$status</td>
        <td>$link</td>
        <td>$date</td>
        </tr>
    ";
}

function show_platform($short_name, $p, $dev) {
    global $min_version;
    global $max_version;
    $long_name = $p["name"];
    $description = $p["description"];
    echo "<a name=\"$short_name\"></a>\n";
    if (array_key_exists('url', $p)) {
        $url = $p["url"];
        $long_name .= " <a href=$url><span class=description>details</span></a>";
    }
    row1("<center><font size=+2>$long_name</font><br><small>$description</small></center>", 99, "bg-primary");
    foreach ($p["versions"] as $i=>$v) {
        if ($min_version && version_compare($v['num'], $min_version, "<")) continue;
        if ($max_version && version_compare($v['num'], $max_version, ">")) continue;
        if (!$dev && is_dev($v)) continue;
        show_version($short_name, $i, $v);
    }
}

// $short_name is e.g. 'winx64'
// $p is a structure with list of versions (see versions.inc)
// if $dev, show development versions as well as release
//
function show_platform_xml($short_name, $p, $dev) {
    foreach ($p["versions"] as $i=>$v) {
        if (!$dev && is_dev($v)) continue;
        // show only those versions that have existed for over three days.
        // Gives us time to address any showstoppers
        // found by the early adopters
        //
        //if (!$dev && ((time() - strtotime($v["date"])) <= 86400*3)) continue;
        show_version_xml($v, $p);
    }
}

// show details on a version if URL indicates
//
if ($pname && $version) {
    $p = $platforms[$pname];
    $long_name = $p["name"];
    $va = $p["versions"];
    foreach ($va as $v) {
        if ($v['num'] == $version && $type_name==$v['type']) {
            page_head("BOINC version $version for $long_name");
            show_detail($v);
            page_tail();
            exit();
        }
    }
    error_page( "version not found\n");
}

// some platforms are special cases for download.php;
// don't show them in download_all
//
function skip_platform_web($short_name) {
    if ($short_name == 'mac_arm') return true;
    if ($short_name == 'mac_10_10_plus') return true;
    if ($short_name == 'mac_10_9_plus') return true;
    return false;
}
function skip_platform_xml($short_name) {
    if ($short_name == 'mac_10_10_plus') return true;
    if ($short_name == 'mac_10_9_plus') return true;
    return false;
}

if ($xml) {
    header('Content-type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>
<versions>
";
    if (FALSE === strpos($client_info, '6.8.')) {
        foreach($platforms as $short_name=>$p) {
            if (skip_platform_xml($short_name)) continue;
            show_platform_xml($short_name, $p, $dev);
        }
    }
    echo sprintf(
        "<boinc_buda_runner_version>%d</boinc_buda_runner_version>\n",
        boinc_buda_runner_version()
    );
    echo "
</versions>
";
} else {
    if ($pname) {
        $p = $platforms[$pname];
        $name = $p['name'];
        page_head("Download BOINC client software for $name");
        start_table("table-striped");
        show_platform($pname, $p, $dev);
        end_table();
    } else {
        page_head("Download BOINC client software");
        echo "
            <p>
            <font color=red>NOTE</font>: versions before 7.18 may require
            <a href=ca_bundle.php>updating the CA bundle file</a>
            in order to communicate with some projects.
            <p>
            You can also
            <a href=https://github.com/BOINC/boinc/wiki/Download-executables>
            download executables from GitHub</a>.
        ";
        start_table("table-striped");
        foreach($platforms as $short_name=>$p) {
            if (skip_platform_web($short_name)) continue;
            show_platform($short_name, $p, $dev);
        }
        end_table();
        echo "
            <h3>Other platforms</h3>
            If your computer is not of one of these types, you can
            <a href=\"wiki/Anonymous_platform\">make your own client software</a>.
        ";
    }
    echo "
        <hr size=1>
        The information on this page can be
        <a href=\"https://github.com/BOINC/boinc/wiki/DownloadInfo\">
        restricted by platform and/or version number,
        or presented  in XML format</a>.
    ";
    page_tail();
}

?>
