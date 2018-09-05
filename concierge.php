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

// concierge is a mechanism for downloading an installer
// pre-configured for a particular project or AM account
//
// This script gets (via POST)
//  - ID of a project or AM
//  - login token
//  - the name of an installer file
// It downloads the requested installer,
// with a filename that encodes the project ID and login token (Win)
// or adding this info to the download zip (Mac)
//

require_once("../inc/util.inc");

// default: just send the file
//
function other($filename) {
    $path = "dl/$filename";
    header("Content-length: ".filesize($path));
    header("Content-type: application/octet-stream");
    header(sprintf('Content-Disposition: attachment; filename=%s;', $filename));
    readfile($path);
}

// encode info in filename
//
function change_filename($filename, $project_id, $user_id, $token) {
    $path = "dl/$filename";
    if (strstr($filename, ".exe")) {
        $x = sprintf('__%d_%d_%s.exe', $project_id, $user_id, $token);
        $new_filename = str_replace('.exe', $x, $filename);
    } else {
        $new_filename = sprintf("%s__%d_%d_%s",
            $filename, $project_id, $user_id, $token
        );
    }
    header("Content-length: ".filesize($path));
    header("Content-type: application/octet-stream");
    header(sprintf('Content-Disposition: attachment; filename=%s;', $new_filename));
    readfile($path);
}

// Mac: change name of installer file within zip
//
function mac($zipname, $project_id, $user_id, $token) {
    // make a temp dir
    //
    $tempdir = tempnam("/tmp", "concierge_mac_");
    unlink($tempdir);
    if (!mkdir($tempdir)) {
        other($zipname);
    }

    // copy zip to temp dir
    //
    $zpath = "$tempdir/$zipname";
    copy("dl/$zipname", $zpath);

    // get name without the .zip
    //
    $fname = substr($zipname, 0, strlen($zipname)-4);

    // unzip, rename, zip
    //
    $cmd = sprintf('cd %s; unzip %s; mv "%s/BOINC Installer.app" "%s/BOINC Installer__%d_%d_%s.app"; rm %s; zip -r %s %s',
        $tempdir,
        $zipname,
        $fname,
        $fname, $project_id, $user_id, $token,
        $zipname,
        $zipname, $fname
    );
    exec($cmd);

    // download it
    //
    header("Content-length: ".filesize($zpath));
    header("Content-type: application/zip");
    header(sprintf('Content-Disposition: attachment; filename=%s;', $zipname));
        // need this, otherwise download file is "concierge.php"
    readfile($zpath);

    // clean up temp files
    //
    exec("/bin/rm -rf $tempdir");
}

$project_id = post_int("project_id");
$token = post_str("token");
$user_id = post_str("user_id");
$filename = post_str("filename");
if (strstr($filename, "..")) exit;
if (strstr($filename, "/")) exit;

if (strstr($filename, "win")) {
    change_filename($filename, $project_id, $user_id, $token);
} else if (strstr($filename, "macOSX")) {
    mac($filename, $project_id, $user_id, $token);
} else {
    other($filename);
}

?>
