<?php

require_once("../inc/db.inc");
require_once("../inc/util.inc");
require_once("server_util.inc");

page_head("Server test results summaries");

echo "
    <p>
    This table shows the number of test reports that have been
    submitted for each (test, version).
    <p>
";

start_table("table-striped");
echo "
    <tr>
    <td>Version<br><font size=-2>click for details</td>
	<td><p>Target #results /</p><p>% Complete</p></td>
";

$max_versions = 12;
for ($i=0; $i<count($versions)&&$i<$max_versions; $i++) {
	$v = $versions[$i];
    $vn = $v[0];
	$pp = number_format(100*(1-fraction_left($v)), 0);
    echo "
        <td><p><a href=server_details.php?version=$vn>$vn</a></p><p>$pp%</p></td>
    ";
}
echo "</tr>";

$nc = count($versions)+2;

echo "<tr><th colspan=$nc>TESTS</td></tr>\n";
foreach ($all_test_groups as $tg) {
	$p = $tg[0];
	$pl = $tg[1];
	$tr = $tg[2];
    echo "<tr><td>$pl</td><td>$tr</td>";
    for ($j=0; $j<count($versions)&&$j<$max_versions; $j++) {
        $v = $versions[$j];
        if (test_included($p, $v[1])) {
            $v = $v[0];
            $x1 = tcount($p, $v);
            echo "<td>$x1</td>\n";
        } else {
            echo "<td>---</td>\n";
        }
    }
    echo "</tr>\n";
}

end_table();

page_tail();
?>
