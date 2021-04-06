<?php

// This file is part of BOINC.
// http://boinc.berkeley.edu
// Copyright (C) 2017 University of California
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

// utility functions for download links

function button_link_vbox(
    $vbox_url, $long_name, $vbox_size, $boinc_version, $vbox_version
) {
    echo sprintf('
        <a href="%s" class="btn btn-success"><font size=+1><u>%s</u></font>
        <br>%s (%.2f MB)
        <br><small>(BOINC %s, VirtualBox %s)</small></a>
        ',
        $vbox_url,
        tra("Download BOINC + VirtualBox"),
        // "for %s" identifies the operating system, e.g. "for Windows"
        tra("for %1", $long_name),
        $vbox_size,
        $boinc_version,
        $vbox_version
    );
    echo "
        &nbsp;
        &nbsp;
    ";
}

function button_link($url, $long_name, $size, $boinc_version, $green) {
    echo sprintf('
        <a href="%s" class="btn %s"><font size=+1><u>%s</u></font>
        <br>%s (%.2f MB)
        <br><small>(BOINC %s)</small></a>
        ',
        $url,
        $green?"btn-success":"btn-info",
        tra("Download BOINC"),
        tra("for %1", $long_name),
        $size,
        $boinc_version
    );
}

// Show download link(s) for the given platform,
// showing version and download size information.
// Show both VBox and non-VBox links if available.
//
function download_link(
    $client_info,
    $pname,
    $button=false,
        // show as button (else table row)
    $vbox_req=false
        // if vbox version is available, show only it
) {
    global $platforms;
    global $url_base;
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
    $size = number_format(filesize($path)/1000000, 2);

    if ($button) {
        if ($vbox_file && !$vbox_req) {
            echo tra("We recommend that you also install %1 VirtualBox %2, so your computer can work on science projects that require it.", "<a href=https://www.virtualbox.org/>", "</a>");
            echo " <a href=http://boinc.berkeley.edu/wiki/VirtualBox>";
            echo tra("Learn more about VirtualBox.");
            echo "</a>";
        }

        echo "<table width=100%><tr valign=top align=center><td>\n";

        if ($vbox_file) {
            button_link_vbox(
                $vbox_url, $long_name, $vbox_size, $num, $vbox_version
            );
        }
        if (!$vbox_file || !$vbox_req) {
            button_link($url, $long_name, $size, $num, !$vbox_file);
        }
        echo "</td></tr></table>\n";
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
            <td class=rowlineright><a href=$url>Download</a> ($size MB)</td>
            </tr>
        ";
    }
}

// take the client info string reported by web browser,
// and return best guess for platform
//
function client_info_to_platform($client_info) {
    if (strstr($client_info, 'Windows')) {
        if (strstr($client_info, 'Win64')||strstr($client_info, 'WOW64')) {
            return 'winx64';
        } else {
            return 'win';
        }
    } else if (strstr($client_info, 'Mac')) {
        // e.g.: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) ...
        if (strstr($client_info, 'PPC Mac OS X')) {
            return 'macppc';
        } else {
            $v = strstr($client_info, "Mac OS X ");
            if (!$v) {
                return 'mac';
            }
            $v = substr($v, strlen("Mac OS X "));
            $n = sscanf($v, "%d_%d", $maj, $min);
            if ($n != 2) {
                return "mac";
            }
            if ($maj > 10) {
                return "mac";
            }
            if ($maj < 10) {
                return null;
            }
            if ($min >= 9) {
                return 'mac';
            } else if ($min >= 7) {
                return 'mac_10_7';
            } else if ($min >= 4) {
                return 'mac32';
            }
            return null;
        }
    } else if (strstr($client_info, 'Android')) {
        // Check for Android before Linux,
        // since Android contains the Linux kernel and the
        // web browser user agent string lists Linux too.
        //
        return 'android';
    } else if (strstr($client_info, 'Linux')) {
        if (strstr($client_info, 'x86_64')) {
            return 'linuxx64';
        } else {
            return 'linux';
        }
    } else {
        return null;
    }
}

// same, but return long platform name
//
function client_info_to_platform_long($client_info) {
    switch (client_info_to_platform($client_info)) {
    case "winx64": return "windows_x86_64";
    case "win": return "windows_intelx86";
    case "mac": return "x86_64-apple-darwin";
    case "mac32": return "i686-apple-darwin";
    case "macppc": return "powerpc-apple-darwin";
    case "android": return "arm-android-linux-gnu";
    case "linuxx64": return "x86_64-pc-linux-gnu";
    case "linux": return "i686-pc-linux-gnu";
    }
    return null;
}

?>
