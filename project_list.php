<?php

// The BOINC client uses this to get a current list of projects,
// which it does every 14 days.
// Don't break backwards compatibility!

$dir = getcwd();
chdir("/mydisks/a/users/boincadm/projects/dev/html/user");
require_once("../inc/translation.inc");
require_once("../inc/util.inc");
require_once("projects.inc");
require_once("get_platforms.inc");
chdir($dir);

$test = get_str("test", true);

header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="ISO-8859-1" ?>
<projects>
';

$proj_list = array();

foreach ($areas as $area) {
    $area_name = $area[0];
    $projects = $area[1];
    foreach ($projects as $p) {
        if (!$test && $p->id >= 100) continue;
        $np = null;
        if ($p->logo) {
            $np->image = $p->logo;
        }
        $np->url = $p->web_url;
        $np->web_url = $p->web_url;
        if (strlen($p->master_url)) {
            $np->url = $p->master_url;
        }
        if (strlen($p->summary)) {
            $np->summary = $p->summary;
        }
        $np->id = $p->id;
        $np->home = $p->home;
        $np->general_area = $area_name;
        $np->specific_area = $p->area;
        $np->description = $p->description;
        $np->name = $p->name;

        $proj_list[] = $np;
    }
}

foreach($proj_list as $p) {
    echo "    <project>
        <name>$p->name</name>
        <id>$p->id</id>
        <url>$p->url</url>
        <general_area>$p->general_area</general_area>
        <specific_area>$p->specific_area</specific_area>
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
    if (isset($p->image)) {
        echo "      <image>https://boinc.berkeley.edu/images/$p->image</image>
";
    }
    if (isset($p->summary)) {
        echo "      <summary>$p->summary</summary>
";
    }
    echo "    </project>
";
}

foreach ($account_managers as $am) {
    if (!$test && $am->id >= 100) continue;
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
