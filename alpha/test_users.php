<?php

require_once("../inc/db.inc");
require_once("../inc/util.inc");
require_once("test.inc");

db_init();
page_head("Alpha testers");
echo "
    <p>
    This table shows the alpha testers,
    the platforms they have,
    and the versions for which they have reported results.
    <p>
";

function os_list($user) {
    $r = _mysql_query("select distinct os_name from host where userid=$user->id");
    while ($row = _mysql_fetch_row($r)) {
        $y = trim($row[0]);
        if ($x) $x .= "<br><nobr>$y</nobr>";
        else $x = "<nobr>$y</nobr>";
    }
    if (!$x) $x='---';
    return $x;
}

function processor_list($user) {
    $r = _mysql_query("select distinct p_model from host where userid=$user->id");
    while ($row = _mysql_fetch_row($r)) {
        $y = trim($row[0]);
        if ($x) $x .= "<br><nobr>$y</nobr>";
        else $x = "<br><nobr>$y</nobr>";
    }
    if (!$x) $x='---';
    return $x;
}

function gpu_list($user) {
    $r = _mysql_query("select distinct serialnum from host where userid=$user->id");
    while ($row = _mysql_fetch_row($r)) {
        $y = trim($row[0]);
        if ($x) $x .= "<br><nobr>$y</nobr>";
        else $x = "<br><nobr>$y</nobr>";
    }
    if (!$x) $x='---';
    return $x;
}

$r = _mysql_query("select * from test_report where status<>3");
while ($tr = _mysql_fetch_object($r)) {
    $uarr[$tr->userid][$tr->version]++;
    $upresent[$tr->userid] = true;
}

echo "<table cellpadding=4 border=1><tr>
    <th>User</th>
    <th>Operating systems</th>
    <th>Processor list</th>
    <th>GPU list</th>
";
foreach ($versions as $v) {
    echo "<th>$v[0]</th>\n";
}
echo "</tr>\n";
$r = _mysql_query("select * from user");
while ($user = _mysql_fetch_object($r)) {
    if (!$upresent[$user->id]) continue;
    echo "<tr><td>$user->name</td>
        <td>".os_list($user)."</td>
        <td>".processor_list($user)."</td>
        <td>".gpu_list($user)."</td>
    ";
    foreach ($versions as $v) {
        $n = $uarr[$user->id][$v[0]];
        if (!$n) $n='---';
        echo "<td>$n</td>\n";
    }
    echo "</tr>";
}
echo "</table>\n";
page_tail();

?>
