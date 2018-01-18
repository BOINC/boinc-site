<?php

require_once("../inc/db.inc");
require_once("../inc/util.inc");

$server = 0;
if (get_int("server", true)) {
    $server = 1;
}

require_once("test_util.inc");

page_head("Test results summaries");

echo "
    <p>
    This table shows the number of test reports that have been
    submitted for each combination of (platform, version)
    and (test, version).
    <p>
";

start_table("table-striped");
$x = array();
$x[] = "Version<br><font size=-2>click for details";
$x[] = "Target #results <br>% Complete";

$max_versions = 6;
for ($i=0; $i<count($versions)&&$i<$max_versions; $i++) {
	$v = $versions[$i];
    $vn = $v[0];
	$pp = number_format(100*(1-fraction_left($v)), 0);
    $x[] = "<a href=test_details.php?version=$vn&server=$server>$vn</a><br>$pp%";
}
row_heading_array($x);

$nc = count($versions)+2;
row_heading("Platforms");
foreach ($all_platforms as $plat) {
    $x = array();
    $p = $plat[0];
    $pl = $plat[1];
    $tr = $plat[2];
    $x[] = $pl;
    $x[] = $tr;
    for ($j=0; $j<count($versions)&&$j<$max_versions; $j++) {
        $v = $versions[$j];
        if (platform_included($p, $v[2])) {
            $v = $v[0];
            $x1 = pcount($p, $v);
            $x[] = $x1;
        } else {
            $x[] = "---";
        }
    }
    row_array($x);
}
row_heading("Tests");
foreach ($all_test_groups as $tg) {
    $x = array();
	$p = $tg[0];
	$pl = $tg[1];
	$tr = $tg[2];
    $x[] = $pl;
    $x[] = $tr;
    for ($j=0; $j<count($versions)&&$j<$max_versions; $j++) {
        $v = $versions[$j];
        if (test_included($p, $v[1])) {
            $v = $v[0];
            $x1 = tcount($p, $v);
            $x[] = $x1;
        } else {
            $x[] = "---";
        }
    }
    row_array($x);
}

end_table();

page_tail();
?>
