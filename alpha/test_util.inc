<?php

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

require_once("../inc/util.inc");
require_once("test.inc");

db_init();

// # of reports for the given platform/version
//
function pcount($p, $v) {
    $r = _mysql_query("select count(*) from test_report where version='$v' and platform = '$p' and status<>3");
    $s = _mysql_fetch_row($r);
    return $s[0];
}

// # of reports for the given test/version
//
function tcount($p, $v) {
    $r = _mysql_query("select count(*) from test_report where version='$v' and test_group = '$p' and status<>3");
    $s = _mysql_fetch_row($r);
    return $s[0];
}

function tests_needed_text(&$html, &$message) {
    $version = current_version();
    $vn = $version[0];
    $pp = number_format(100*(1-fraction_left($version)), 0);

    $html = "<html><head><title>Testing status report ($vn)</title></head><body>
        <p>
        This report shows the tests for which more reports are needed.
        <p>
        Please visit http://boinc.berkeley.edu/alpha/test_matrix.php
        to see descriptions of the various tests,
        and submit reports as soon as possible.
        <p>
        Thanks for your time and effort in making BOINC
        a great platform for volunteer computing.
        <p>
        The BOINC Development Team
        <p>
        Percentage Complete: $pp
        <p>
    ";

    $message = "
Testing status report ($vn)

This report shows which test areas need more test coverage.

Please visit http://boinc.berkeley.edu/alpha/test_matrix.php
to see descriptions of the various tests,
and submit reports as soon as possible.
Thanks for your time and effort in making BOINC
a great platform for volunteer computing.

The BOINC Development Team

Percentage Complete: $pp
";

    //
    // Platforms
    //

    $html = $html."
            Platforms for which we need more reports:
            <p>
            <table><tr><td>Platform</td><td>Additional reports needed</td></tr>
            ";

    $message = $message."
Platforms for which we need more reports:
";

    foreach($version[2] as $pp) {
        $p = $pp[0];
        $pl = $pp[1];
        $tr = $pp[2];
        $x1 = pcount($p, $vn);
        $x2 = $tr - $x1;
        if ($tr > $x1) {
            $html = $html."<tr><td>$pl</td><td>$x2</td></tr>";
            $message = $message."$pl\t$x2\n";
        }
    }

    $html = $html."</table></body></html><p><p>";


    //
    // Test Cases
    //

    $html = $html."
            Tests for which we need more reports:
            <p>
            <table><tr><td>Test</td><td>Additional reports needed</td></tr>
            ";

    $message = $message."
Tests for which we need more reports:
";

    foreach($version[1] as $tg) {
        $p = $tg[0];
        $pl = $tg[1];
        $tr = $tg[2];
        $x1 = tcount($p, $vn);
        $x2 = $tr - $x1;
        if ($tr > $x1) {
            $html = $html."<tr><td>$pl</td><td>$x2</td></tr>";
            $message = $message."$pl\t$x2\n";
        }
    }

    $html = $html."</table></body></html>";

}

function current_version() {
    global $versions;
    return $versions[0];
}

function current_test_groups() {
    global $versions;
    $v = $versions[0];
    return $v[1];
}

function test_groups_for_version($v) {
    global $versions;
    foreach ($versions as $ver) {
        if ($ver[0] == $v) {
            return $ver[1];
        }
    }
    error_page("version not found");
}

function reports_for_version($v) {
    $rs = array();
    $q = "select * from test_report where version='$v' and status<>3";
    $r = _mysql_query($q);
    while ($rep = _mysql_fetch_object($r)) {
        $rs[] = $rep;
    }
    return $rs;
}

function results_required_platforms($ps) {
    $n = 0;
    foreach($ps as $p) {
        $n += $p[2];
    }
    return $n;
}

function results_required_tests($test_groups) {
    $n = 0;
    foreach($test_groups as $y) {
        $n += $y[2];
    }
    return $n;
}

function results_required($platforms, $test_groups) {
    return results_required_platforms($platforms) + results_required_tests($test_groups);
}

function fraction_left($v) {
    $ps = $v[2];
    $gs = $v[1];
    $total_tests = results_required($ps, $gs);

    $rs = reports_for_version($v[0]);
    foreach ($rs as $r) {
        for ($i=0; $i<count($ps); $i++) {
            if ($r->platform == $ps[$i][0]) {
                if ($ps[$i][2]>0) {
                    $ps[$i][2]--;
                }
                break;
            }
        }
        for ($i=0; $i<count($gs); $i++) {
            if ($r->test_group == $gs[$i][0]) {
                if ($gs[$i][2]>0) {
                    $gs[$i][2]--;
                }
                break;
            }
        }
    }
    $tests_left = results_required($ps, $gs);
    return $tests_left/$total_tests;
}

function lookup_platform($short_name) {
    global $all_platforms;
    foreach ($all_platforms as $p) {
        if ($short_name == $p[0]) return $p;
    }
    return null;
}

function test_group_name($short_name) {
    global $all_test_groups;
    foreach ($all_test_groups as $p) {
        if ($short_name == $p[0]) return $p[1];
    }
    return $short_name;
}

function show_status_select($t, $user, $v, $p) {
    $tgname = $t[0];
    $pname = $p[0];
    $query = "select * from test_report where userid=$user->id and version='$v' and platform='$pname' and test_group='$tgname'";
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

function show_test_groups($user, $v, $p) {
    echo '<script type="text/javascript" src="tooltip.js"></script>
        <link rel="stylesheet" href="tooltip.css" type="text/css">
    ';
    $p = lookup_platform($p);
    $test_groups = test_groups_for_version($v);
    $i = 0;
    foreach ($test_groups as $t) {
        if ($t[3] && $t[3] != $p[3]) continue;
        $desc = $t[4];
        $desc = str_replace("\n", " ", $desc);
        echo "<div id=\"t$i\" class=\"tip\">
            $desc
            </div>
        ";
        $i++;
    }

    echo "<table cellpadding=4 border=1>
        <tr>
        <th>Test group<br><span class=note>Mouse over for description</span></th>
        <th>Not<br> tested</th>
        <th>No<br>bugs<br>found</th>
        <th>Minor<br>bugs<br>found</th>
        <th>Major<br>bugs<br>found</th>
        <th>Comments (include BOINC Trac ticket number if applicable)</th>
        </tr>
    ";
    $i = 0;
    foreach ($test_groups as $t) {
        if ($t[3] && $t[3] != $p[3]) continue;
        $x = "<a
            onmouseover=\"popUp(event, 't$i')\"
            onmouseout=\"popUp(event, 't$i')\"
            >$t[1]</a>
        ";
        echo "<tr><td>$x</td>\n";
        show_status_select($t, $user, $v, $p);
        echo "</tr>\n";
        $i++;
    }
    echo "</table>\n";
}

function show_test_cases($user, $v, $p, $cur_release) {
    global $all_test_groups;
    $tg = $cur_release?current_test_groups():$all_test_groups;
    foreach ($tg as $t) {
        $title = $t[1];
        $desc = $t[4];
        
        echo "<h3>$title</h3>
            $desc
        ";
    }
}

function show_version_select() {
    global $versions;
    echo "<select name=version>\n";
    foreach ($versions as $v) {
        $p = $v[0];
        echo "<option value=$p>$p\n";
    }
    echo "</select>\n";
}

// return true if one of the platforms is Android
//
function show_platform_select($version) {
    $found_android = false;
    $v = lookup_version($version);
    $platforms = $v[2];
    foreach ($platforms as $p) {
        echo "<br><input type=radio name=platform value=$p[0]> $p[1]\n";
        if ($p[0] == "android") {
            $found_android = true;
        }
    }
    return $found_android;
}

function show_platform_summary() {
    global $versions;
    global $platforms;
    foreach ($platforms as $p) {
        echo $p[1]."-";
        for ($n=0; $n<count($versions); $n++) {
            $v = $versions[$n];
            $v = $v[0];
            echo "<a href=\"test_details.php?platform=".$p[0].
                 "&version=".$v."\">".$v."</a> ";
            }
        echo "<br>\n";
    }
}

function show_platform_details($platform) {
     echo $platform->platform, $platform->version, $platform->status;
}

function test_included($name, $list) {
    foreach($list as $test) {
        if ($test[0] == $name) return true;
    }
    return false;
}

function platform_included($name, $list) {
    foreach($list as $p) {
        if ($p[0] == $name) return true;
    }
    return false;
}

function lookup_version($name) {
    global $versions;
    foreach ($versions as $v) {
        if ($v[0] == $name) return $v;
    }
    die("Version $name not found");
}

?>
