<?php

// This file is part of BOINC.
// http://boinc.berkeley.edu
// Copyright (C) 2018 University of California
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

// Show project list as XML.
//
// The BOINC client uses this to get a current list of projects,
// which it does every 14 days.
// Don't break backwards compatibility!

$dir = getcwd();
chdir("/mydisks/a/users/boincadm/projects/dev/html/user");
require_once("../inc/translation.inc");
require_once("../inc/util.inc");
chdir($dir);

require_once("projects.inc");
require_once("get_platforms.inc");

$test = get_str("test", true);
    // show test projects? (ID >= 1000)

header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="ISO-8859-1" ?>
<projects>
';

$proj_list = array();

foreach ($areas as $area) {
    $area_name = $area[0];
    $projects = $area[1];
    foreach ($projects as $p) {
        if (!$test && $p->id >= 1000) continue;
            // test projects have temp IDs >= 1000
        $p->general_area = $area_name;
        $proj_list[] = $p;
    }
}

foreach($proj_list as $p) {
    echo "    <project>
        <name>$p->name</name>
        <id>$p->id</id>
        <url>$p->master_url</url>
        <web_url>$p->web_url</web_url>
        <general_area>$p->general_area</general_area>
        <specific_area>$p->area</specific_area>
        <description><![CDATA[$p->description]]></description>
        <home>$p->home</home>
";
    $platforms = get_platforms_cached($p->web_url);
    if ($platforms) {
        echo "    <platforms>\n";
        foreach ($platforms as $platform) {
            if ($platform == 'Unknown') continue;
            echo "        <name>$platform</name>\n";
        }
        echo "    </platforms>\n";
    }
    if (!empty($p->logo)) {
        echo "      <image>https://boinc.berkeley.edu/images/$p->logo</image>
";
    }
    if (!empty($p->summary)) {
        echo "      <summary>$p->summary</summary>
";
    }
    echo "        <keywords>".implode(" ", $p->keywords)."</keywords>\n";
    echo "    </project>
";
}

foreach ($account_managers as $am) {
    if (!$test && $am->id >= 1000) continue;
    echo "   <account_manager>
        <name>$am->name</name>
        <id>$am->id</id>
        <url>$am->url</url>
        <description>$am->description</description>
        <image>https://boinc.berkeley.edu/images/$am->logo</image>
    </account_manager>
";
}

echo "</projects>
";

?>
