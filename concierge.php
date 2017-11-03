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
// with a filename that encodes the project ID and login token
//

$dir = getcwd();
chdir("../projects/dev/html/user");
require_once("../inc/util.inc");
chdir($dir);

$project_id = post_int("project_id");
$token = post_str("token");
$user_id = post_str("user_id");
$filename = post_str("filename");
if (strstr($filename, "..")) exit;
if (strstr($filename, "/")) exit;
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

?>
