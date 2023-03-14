<?php

require_once("../inc/util.inc");
require_once("../inc/bootstrap.inc");

// see https://en.wikipedia.org/wiki/RIS_(file_format)

function parse_ris($lines) {
    $pubs = [];
    $pub = null;
    // entries end with a blank line.
    // However some abstracts are multi-line and have blank lines
    //
    $in_abstract = false;
    foreach ($lines as $line) {
        $line = trim($line);
        if ($in_abstract) {
            if (substr($line, 2, 3) != '  -') {
                continue;
            }
            $in_abstract = false;
        }
        if ($line == '') {
            if ($pub) {
                $pubs[] = $pub;
                $pub = null;
            }
            continue;
        }
        if (!$pub) {
            $pub = new StdClass;
            $pub->authors = [];
            $pub->year = 0;
        }
        if (substr($line, 2, 3) != '  -') {
            //echo "unexpected line ($line\n";
            continue;
        }
        $code = substr($line, 0, 2);
        $rest = substr($line, 6);
        switch ($code) {
        case 'TI';
            $pub->title = $rest;
            break;
        case 'AB':
            $in_abstract = true;
            break;
        case 'AU':
            $pub->authors[] = $rest;
            break;
        case 'T2':
            $pub->source = $rest;
            break;
        case 'DA':
            $pub->date = $rest;
            break;
        case 'PY':
            $pub->year = $rest;
            break;
        case 'DO':
            $pub->doi = $rest;
            break;
        case 'UR':
            $pub->url = $rest;
            break;
        }
    }
    return $pubs;
}

// change "last, first" to "first last"
//
function name_swap($name) {
    $x = explode(',', $name);
    if (count($x)==1) return $name;
    return trim($x[1]." ".$x[0]);
}

// convert list of authors to something readable
//
function auth_str($authors) {
    $x = $authors[0];
    $n = count($authors);
    for ($i=1; $i<$n; $i++) {
        if ($i==3 and $n>8) {
            $x .= ' <i>et al</i>';
            break;
        }
        if ($i == $n-1) {
            $x .= ' and ';
            $x .= name_swap($authors[$i]);
        } else {
            $x .= ', ';
            $x .= name_swap($authors[$i]);
        }
    }
    if (substr($x, -1) != '.') $x .= '.';
    return $x;
}

function show_pub($pub) {
    if ($pub->authors) {
        echo auth_str($pub->authors);
    }
    if (!empty($pub->url)) {
        echo " <a href=$pub->url>$pub->title</a>. ";
    } else {
        echo ' <b>"', $pub->title, '"</b>. ';
    }
    if (!empty($pub->source)) {
        echo $pub->source, ' ';
    }
    if (!empty($pub->year)) {
        echo " ($pub->year). ";
    }
    if (!empty($pub->doi)) {
        echo " DOI: $pub->doi. ";
    }
}

function read_pubs() {
    $p = [];
    foreach (scandir('pubs') as $f) {
        if (substr($f, -4) != '.ris') continue;
        $proj = substr($f, 0, -4);
        $pubs = parse_ris(file("pubs/$f"));
        $p[$proj] = $pubs;
    }
    return $p;
}

function show_years($p) {
    $y = [];
    foreach ($p as $proj=>$pubs) {
        foreach ($pubs as $pub) {
            $pub->proj = $proj;
            if (empty($pub->year)) {
                if (array_key_exists('---', $y)) {
                    $y['---'][] = $pub;
                } else {
                    $y['---'] = [$pub];
                }
            } else {
                if (array_key_exists($pub->year, $y)) {
                    $y[$pub->year][] = $pub;
                } else {
                    $y[$pub->year] = [$pub];
                }
            }
        }
    }
    krsort($y);
    foreach ($y as $year=>$pubs) {
        echo "<h3>$year</h3>";
        echo "<ol>";
        foreach ($pubs as $pub) {
            echo "<li>";
            show_pub($pub);
            echo " ($pub->proj)";
        }
        echo "</ol>";
    }
}

function year_cmp($x, $y) {
    return $x->year < $y->year;
}

function show_proj($p) {
    echo "\n<table><tr><td valign=top>\n";
    text_start();
    foreach ($p as $proj=>$pubs) {
        echo "<a name=$proj></a>";
        echo "<h3>$proj</h3>\n";
        echo "<ol>";
        usort($pubs, 'year_cmp');
        foreach ($pubs as $pub) {
            echo "\n<li>";
            show_pub($pub);
        }
        echo "</ol>";
    }
    text_end();
    echo "\n</td><td width=10%></td><td valign=top>\n";
    foreach ($p as $proj=>$pubs) {
        echo "<li><a href=#$proj>$proj</a>\n";
    }
    echo "\n</td></tr></table>\n";

}

function main($years) {
    $p = read_pubs();
    page_head("Publications by BOINC Projects");
    echo "
        <p>
        Our intent is to list papers containing
        scientific results arising, directly or indirectly,
        from BOINC-based computing.
        Please report any issues
        <a href=https://github.com/BOINC/boinc-site>here</a>.
        Thanks to Alex Piskun for maintaining this list.
        <hr>
        <p>
    ";
    echo "<font size=+2>Group by ";
    if ($years) {
    text_start();
        echo"<a href=pubs.php>project</a> &middot; year</font><p>";
        show_years($p);
    text_end();
    } else {
        echo "project &middot; <a href=pubs.php?years=1>year</a></font><p>";
        show_proj($p);
    }
    page_tail();
}

$years = get_str('years', true);
main($years);

?>
