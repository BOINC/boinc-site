<?php

require_once("projects.inc");
require_once("get_platforms.inc");
page_head("Choosing BOINC projects");

echo "
<script src=\"wz_tooltip.js\"></script>
<p>
BOINC is used by many volunteer computing <b>projects</b>.
Some are based at universities and research labs,
others are run by private groups or individuals.
You can participate in any number of these projects.
<p>
In deciding whether to participate in a project,
read its web site and consider the following questions:

<ul>
<li> Does the project clearly describe its goals?
    Are these goals important and beneficial?
<li> Has the project published results in peer-reviewed
journals or conferences?  See <a href=/wiki/Publications_by_BOINC_projects>
A list of scientific publications of BOINC projects</a>.
<li> Do you trust the project to use proper security practices?
<li> Who owns the results of the computation?
  Will they be freely available?
  Will they belong to a company?
</ul>
<p>

The following projects are known to us at BOINC,
and we believe that their descriptions are accurate.
";
//See also <a href=wiki/Project_list>a complete list of projects</a>.
echo "

<p>
Projects have different requirements such as memory size;
a partial summary is <a href=http://boincfaq.mundayweb.com/index.php?view=67>here</a>.
<p>
If your computer is equipped with a Graphics Processing Unit
(GPU), you may be able to
<a href=\"http://boinc.berkeley.edu/wiki/GPU_computing\">use it to compute faster</a>.
";

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
    row_heading_array(array(
        (($sort=="area")?"<a title='Sort by name' href=projects.php>Name</a>":"Name")
            ."<br><small>Mouse over for details; click to visit web site</small>",
        ($sort!="area")?"<a title='Sort by category' href=projects.php?sort=area>Category</a>":"Category",
        "Area",
        "Sponsor",
        "Supported platforms"
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
        $arg = "$img <font size=.8em><b>Goal:</b> $p->description <br> <b>Sponsor:</b> $p->home<br><b>Area:</b> $p->area";
        $arg = addslashes($arg);
        $x = "<a href=$p->web_url onmouseover=\"Tip('$arg', WIDTH, 500, FONTSIZE, '12px', BGCOLOR, '#eeddcc')\" onmouseout=\"UnTip()\">$p->name</a>";
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
            $pd = get_platforms_string($master_url, false);
            $p .= "<br><a href=projects.php onmouseover=\"Tip('Supported platforms:<br>$pd', WIDTH, 240, FONTSIZE, '12px', BGCOLOR, '#eeddcc')\" onmouseout=\"UnTip()\"><small>Details</small></a>";
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
please <a href=trac/wiki/ProjectPeople>contact us</a>.

";
page_tail();
?>
