<?php

require_once("../inc/util.inc");
require_once("server_test.inc");

DEPRECATED

db_init();

// # of reports for the given test/version
//
function tcount($p, $v) {
    $r = _mysql_query("select count(*) from server_report where version='$v' and test_group = '$p' and status<>3");
    $s = _mysql_fetch_row($r);
    return $s[0];
}

function reports_for_version($v) {
    $rs = array();
    $q = "select * from server_report where version='$v' and status<>3";
    $r = _mysql_query($q);
    while ($rep = _mysql_fetch_object($r)) {
        $rs[] = $rep;
    }
    return $rs;
}
function current_version() {
    global $versions;
    return $versions[0];
}

function fraction_left() {
    return 0;
}

function show_test_cases() {
    global $all_test_groups;
    foreach ($all_test_groups as $t) {
        $title = $t[1];
        $desc = $t[2];

        echo "<h3>$title</h3>
            $desc
        ";
    }
}

function lookup_version($name) {
    global $versions;
    foreach ($versions as $v) {
        if ($v[0] == $name) return $v;
    }
    die("Version $name not found");
}

function test_included($name, $list) {
    foreach($list as $test) {
        if ($test[0] == $name) return true;
    }
    return false;
}

function show_status_select($t, $user, $v) {
    $tgname = $t[0];
    $query = "select * from server_report where userid=$user->id and version='$v' and test_group='$tgname'";
    $result = _mysql_query($query);
    $tr = _mysql_fetch_object($result);
    $ch0 = "";
    $ch1 = "";
    $ch2 = "";
    $ch3 = "";
    $comment = "";
    if ($tr) {
        if ($tr->status==0) $ch0 = "checked";
        if ($tr->status==1) $ch1 = "checked";
        if ($tr->status==2) $ch2 = "checked";
        if ($tr->status==3) $ch3 = "checked";
        $comment = $tr->comment;
    } else {
        $ch3 = "checked";
    }

    echo "
        <td><input type=radio name=".$tgname."_status value=3 $ch3></td>
        <td><input type=radio name=".$tgname."_status value=0 $ch0></td>
        <td><input type=radio name=".$tgname."_status value=1 $ch1></td>
        <td><input type=radio name=".$tgname."_status value=2 $ch2></td>
    ";
    echo "<td><textarea rows=4 cols=60 name=".$tgname."_comment>$comment</textarea></td>";
}

function show_test_groups($user, $v) {
    echo '<script type="text/javascript" src="tooltip.js"></script>
        <link rel="stylesheet" href="tooltip.css" type="text/css">
    ';
    $test_groups = test_groups_for_version($v);
    $i = 0;
    foreach ($test_groups as $t) {
        $desc = $t[2];
        $desc = str_replace("\n", " ", $desc);
        echo "<div id=\"t$i\" class=\"tip\">
            $desc
            </div>
        ";
        $i++;
    }

    start_table("table-striped");
    echo "
        <tr>
        <th>Test group<br><span class=note>Mouse over for description</span></th>
        <th>Not<br> tested</th>
        <th>No<br>bugs<br>found</th>
        <th>Minor<br>bugs<br>found</th>
        <th>Major<br>bugs<br>found</th>
        <th>Comments</th>
        </tr>
    ";
    $i = 0;
    foreach ($test_groups as $t) {
        $x = "<a
            onmouseover=\"popUp(event, 't$i')\"
            onmouseout=\"popUp(event, 't$i')\"
            >$t[1]</a>
        ";
        echo "<tr><td>$x</td>\n";
        show_status_select($t, $user, $v);
        echo "</tr>\n";
        $i++;
    }
    end_table();
}

function test_groups_for_version($v) {
    global $versions;
    foreach ($versions as $ver) {
        if ($ver[0] == $v) {
            return $ver[1];
        }
    }
    error_page("version $v not found");
}

?>
