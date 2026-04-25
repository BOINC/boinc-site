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

function button_link($url, $long_name, $size, $boinc_version, $green=true) {
    echo sprintf('
        <a href="%s" class="btn" %s><font size=+1><u>%s</u></font>
        <br>%s (%.2f MB)
        <br><small>(BOINC %s)</small></a>
        ',
        $url,
        $green?'style="background-color:seagreen; color:white"'
            :'style="background-color:steelblue; color:white"',
        tra("Download BOINC"),
        tra("for %1", $long_name),
        $size,
        $boinc_version
    );
}

// Show download link(s) for the given platform,
// showing version and download size information.
//
function download_link(
    $pname,
    $button=false       // show as button (else table row)
) {
    global $platforms;
    global $url_base;
    $p = $platforms[$pname];
    $v = latest_version($p);
    $file = $v['file'];

    $long_name = $p['name'];
    $num = $v['num'];
    $path = "dl/$file";
    $url = $url_base.$file;
    $dlink = "<a href=\"$url\">$file</a>";
    $size = number_format(filesize($path)/1000000, 2);

    if ($button) {
        echo "<center>";

        echo "<p><p>";
        button_link($url, $long_name, $size, $num);
        if ($pname == 'mac') {
            echo "<br><br>This version of BOINC requires MacOS 10.13 or later.<br>For older versions of MacOS, go <a href=download_all.php>here</a>.";
        }
        echo "</center>";
        if ($pname == 'linux'||$pname == 'linuxx64') {
            echo "<p>", linux_info();
        }
    } else {
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
        if (stristr($client_info, 'arm64')) {
            return 'win_arm';
        } else if (strstr($client_info, 'x64')||strstr($client_info, 'WOW64')) {
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
            // major version 10
            if ($min >= 13) {
                return 'mac';
            } else if ($min >= 10) {
                return 'mac_10_10_plus';
            } else if ($min >= 9) {
                return 'mac_10_9_plus';
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
