<?php

require_once("../inc/util.inc");
require_once("projects.inc");
require_once("get_platforms.inc");

$is_login_page = true;

page_head(tra("Choosing BOINC projects"));

echo sprintf("
<script src=\"wz_tooltip.js\"></script>
<p>
%s
<p>
%s:
<ul>
<li> %s
<li> %s
<li> %s
<li> %s
</ul>
<p>

%s
",
tra("BOINC is used by many projects.  You can participate in any number of these projects."),
tra('To decide whether to participate in a project, read its web site and consider'),
tra('Does the project clearly describe its goals?  Are these goals important and beneficial?'),
tra('Has the project published results in peer-reviewed journals or conferences?  See %1 a list of publications by BOINC projects %2.',
'<a href=pubs.php>',
'</a>'
),
tra('Do you trust the project to use proper security practices?'),
tra('Who owns the results of the computation?  Will they be freely available?  Will they belong to a company?'),
tra('The following projects are known to us at BOINC, and we believe their descriptions are accurate.')
);

function comp_name($p1, $p2) {
    return strcasecmp($p1->name, $p2->name);
}

function comp_area($p1, $p2) {
    if ($p1->area == $p2->area) {
        return strcasecmp($p1->name, $p2->name);
    }
    return $p1->area > $p2->area;
}

function ordered_display($areas, $sort) {
    // make a list of projects
    //
    $projects = null;
    foreach ($areas as $area) {
        $title = $area[0];
        $projs = $area[1];
        foreach ($projs as $p) {
            $p->category = $title;
            $projects[] = $p;
        }
    }
    usort($projects, $sort=="area"?'comp_area':'comp_name');
    start_table("table-striped");
    if ($sort=="area") {
        $name_title = sprintf(
            "<a title='%s' href=projects.php>%s</a>",
            tra('Sort by name'),
            tra('Name')
        );
        $cat_title = tra("Category");
    } else {
        $name_title = "Name";
        $cat_title = sprintf(
            "<a title='%s' href=projects.php?sort=area>%s</a>",
            tra('Sort by category'),
            tra('Category')
        );
    }
    row_heading_array(
        array(
            sprintf("%s <br><small>%s</small>",
                $name_title,
                tra('Mouse over for details; click to visit web site')
            ),
            $cat_title,
            tra("Area"),
            tra("Sponsor"),
            tra("Supported platforms").'<br><small>More details at
                <a href=https://wuprop.statseb.fr/results/ram.py>WUProp@Home</a></small>'
        ),
        null,
        'bg-default'
    );
    $n = 0;
    foreach ($projects as $p) {
        $img = "";
        if ($p->logo) {
            $img= "<img align=right vspace=4 hspace=4 src=images/$p->logo>";
        }
        $arg = sprintf(
            "$img <font size=.8em><b>%s:</b> $p->description <br> <b>%s:</b> $p->home<br><b>%s:</b> $p->area",
            tra("Goal"),
            tra("Sponsor"),
            tra("Area")
        );
        $arg = addslashes($arg);
        $x = "<a href=$p->web_url onmouseover=\"Tip('$arg', WIDTH, 600, FONTSIZE, '12px', BGCOLOR, '#eeddcc')\" onmouseout=\"UnTip()\">$p->name</a>";
        $home = $p->home;
        $category = $p->category;
        $area = $p->area;
        $master_url = $p->web_url;
        if (strlen($p->master_url)) {
            $master_url = $p->master_url;
        }
        $p = get_platform_icons($master_url);
        if (!$p) {
            $p = tra("Unknown");
        } else {
            $p .= sprintf(
                "<br><a href=projects.php onmouseover=\"Tip('%s:<br>%s', WIDTH, 240, FONTSIZE, '12px', BGCOLOR, '#eeddcc')\" onmouseout=\"UnTip()\"><small>%s</small></a>",
                tra('Supported platforms'),
                get_platforms_string($master_url, false),
                tra('Details')
            );
        }
        echo "<tr class=row$n>
            <td valign=top>$x</td>
            <td valign=top>$category</td>
            <td valign=top>$area</td>
            <td valign=top>$home</td>
            <td width=30% valign=top>$p</td>
            </tr>
        ";
        $n = 1-$n;
    }
    end_table();
}

$sort = @$_GET['sort'];
ordered_display($areas, $sort);
echo "
<p>
If you run a BOINC-based project
and would like it to be included on this list,
please <a href=https://github.com/BOINC/boinc/wiki/Contact-BOINC>contact us</a>,
and answer the four questions above.

";
page_tail();
?>
