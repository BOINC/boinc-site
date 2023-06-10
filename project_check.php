#! /usr/bin/env php

<?php

// This file is part of BOINC.
// http://boinc.berkeley.edu
// Copyright (C) 2019 University of California
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


// go through project list, see if still alive and master URL is correct

require_once("projects.inc");

function main() {
    $projects = get_project_list();
    foreach ($projects as $project) {
        echo "$project->name $project->web_url\n";
        $x = simplexml_load_file("$project->web_url/get_project_config.php");
        $m = (string)$x->master_url;
        if ($project->master_url != $m) {
            echo "mismatch: we have $project->master_url; actual is $m\n";
        }
    }
}

main();
?>
