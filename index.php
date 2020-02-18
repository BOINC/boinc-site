<?php

if (isset($_SERVER) && array_key_exists('SERVER_NAME', $_SERVER)) {
    $host = $_SERVER["SERVER_NAME"];
    if ($host == "bossa.berkeley.edu") {
        Header("Location: https://boinc.berkeley.edu/trac/wiki/BossaIntro");
        exit();

    }
    if ($host == "bolt.berkeley.edu") {
        Header("Location: https://boinc.berkeley.edu/trac/wiki/BoltIntro");
        exit();
    }
}

require_once("../inc/util.inc");
require_once("../inc/language_names.inc");
require_once("../inc/news.inc");
require_once("../inc/forum.inc");

function show_participant() {
    $i = rand(0, 99);
    $j = $i+1;
    panel(
        tra("Computing power"),
        function() use ($i) {
            echo "
                <center>
            ";
            show_totals();
            echo '
                <p> </p>
                <a class="btn btn-s btn-primary" href=chart_list.php>'.tra("Top 100 volunteers").'</a>
                <a class="btn btn-s btn-primary" href=https://boinc.berkeley.edu/trac/wiki/WebResources#Creditstatistics>'.tra("Statistics").'</a>
                <hr>
                <p>
            ';
            echo "</center>";
            include("piecharts/$i.html");
        }
     );
}

function show_totals() {
    $fn = "boinc_state.xml";
    if (!file_exists($fn) || filemtime($fn) < time()-86400) {
        $uid = time();
        $x = file_get_contents("https://www.boincstats.com/xml/boincState?uid=$uid");
        if ($x) {
            $f = fopen($fn, "w");
            fwrite($f, $x);
        } else return;
    }
    $x = file_get_contents($fn);
    $users = parse_element($x, "<participants_active>");
    $hosts = parse_element($x, "<hosts_active>");
    $dusers = parse_element($x, "<participants_day>");
    if ((int)$dusers > 0) $dusers = "+".$dusers;
    $dhosts = parse_element($x, "<hosts_day>");
    if ((int)$dhosts > 0) $dhosts = "+".$dhosts;
    $credit_day = parse_element($x, "<credit_day>");
    $users = number_format($users);
    $hosts = number_format($hosts);

    $petaflops = number_format($credit_day/200000000, 3);
    echo
        tra("24-hour average:")." $petaflops ".tra("PetaFLOPS.")."
        <br>
        ".tra("Active:")." $users ".tra("volunteers,")." $hosts ".tra("computers").".
        <br>
        ".tra("Daily change:")." $dusers ".tra("volunteers,")." $dhosts ".tra("computers").".
    ";
}

function show_news_items() {
    panel(
        tra("News"),
        function() {
            if (!file_exists("stop_web")) {
                show_news(0, 5);
            } else {
                echo "<p>".tra("Database not available; please try again later.");
            }
        }
    );
}

function top() {
    panel(
        "",
        function () {
            echo "<p>\n";
            echo tra("BOINC lets you help cutting-edge science research using your computer (Windows, Mac, Linux) or Android device.  BOINC downloads scientific computing jobs to your computer and runs them invisibly in the background.  It's easy and safe.");
            echo "</p><p>\n ";
            echo tra(
                "About 30 science projects use BOINC; examples include %3, %4, and %5.",
                '<a href="projects.php">', '</a>',
                '<a href="https://einsteinathome.org">Einstein@Home</a>',
                '<a href="https://worldcommunitygrid.org">IBM World Community Grid</a>',
                '<a href="https://setiathome.berkeley.edu">SETI@home</a>'
            );
            echo " ";
            echo tra('These projects investigate diseases, study global warming, discover pulsars, and do many other types of scientific research.');
            echo '
                </p><p>
            ';
            echo tra('You can participate in either of two ways:');

            // style for join/download boxes
            //
            $s = 'style="background-color:#036; a.link{color:white;}; color:white; border-style: solid; border-width:1.5px; border-radius: 6px; border-color:#c8c8c8"';

            // half-line spacer
            //
            $spacer = '<br style="line-height: 10px" />';

            echo '
                </p><p>
                <div class="container-fluid">
                <div class="row">
                <div class="col-sm-6"'.$s.'>
                <center>
                '.$spacer.'
            ';
            echo sprintf('<font size=+2>%s</font><p><p>',
                tra('Choose science areas')
            );
            echo tra('To contribute to science areas (biomedicine, physics, astronomy, and so on) use %1.  Your computer will do work for current and future projects in those areas.',
                '<a href=https://scienceunited.org style="color:orange">Science United</a>'
            );
            echo '
                </p><p>
                <a class="btn btn-lg" style="background-color:#ffd730; color:black" href="https://scienceunited.org/su_join.php"><font size=+2>'.tra("Join Science United").'</font></a>
                </center>
                '.$spacer.'
                </div>
                <div class="col-sm-1" ><p></p><center><font size=+1>or</font></center></div>
                <div class="col-sm-5"'.$s.'>
                <center>
                '.$spacer.'
            ';
            echo sprintf('<font size=+2>%s</font><p><p>',
                tra('Choose projects')
            );
            echo tra('To contribute to specific projects, download BOINC and follow the directions.');
            echo '
                </p><p>
                <a class="btn btn-lg" style="background-color:ffd730; color:black" href="download.php">'.tra("Download BOINC").'</a>
                </center>
                '.$spacer.'
                </div>
                </div>
                </div>
            ';
            echo $spacer;
            echo '
                </p>
                <div class="container-fluid">
                <div class="row">
                <div class="col-sm-4">
                <font size=+2>
                '.tra("Learn more").'
                </font>
                <br><a href="projects.php">'.tra("Science projects").'</a>
                <br><a href="https://boinc.berkeley.edu/wiki/User_manual"><span class=nobr>'.tra("User manual").'</span></a> 
                <br><a " href="addons.php"><span class=nobr>'.tra("Add-ons").'</span></a> 
                <br><a btn-primary href=https://boinc.berkeley.edu/trac/wiki/WebResources><span class=nobr>'.tra("Web resources").'</span></a> 
                <p>
                </div><div class="col-sm-4">
                <font size=+2>
                '.tra("Communicate").'
                </font>
                <br><a href="forum_index.php">'.tra("Message boards").'</a>
                <br><a href="https://boinc.berkeley.edu/wiki/BOINC_Help">'.tra("Help").'</a>
                <br><a href="trac/wiki/EmailLists">'.tra("Email lists").'</a>
                <br><a href="trac/wiki/ReportBugs">'.tra("Report bugs").'</a>
                <p>
                </div><div class="col-sm-4">
                <font size=+2>
                '.tra("Other ways to help").'
                </font>
                <br><a href="trac/wiki/TranslateIntro">'.tra("Translate").'</a>
                <br><a href="trac/wiki/AlphaInstructions">'.tra("Test").'</a>
                <br><a href="trac/wiki/WikiMeta">'.tra("Document").'</a>
                <br><a href="https://boinc.berkeley.edu/wiki/Publicizing_BOINC">'.tra("Publicize").'</a>
                </div>
                </div>
                </div>
            ';
        },
        "panel-borderless"
    );
}

function show_science() {
    panel(
        tra("High-Throughput Computing with BOINC"),
        function() {
            echo "
                <p>
                BOINC is a platform for high-throughput computing
                on a large scale (thousands or millions of computers).
                It can be used for volunteer computing
                (using consumer devices)
                or grid computing (using organizational resources).
                It supports virtualized, parallel, and GPU-based applications.
                <p>
                BOINC is distributed under the LGPL open source license.
                It can be used for commercial purposes,
                and applications need not be open source.
            ";
            echo '
                <center>
                <a class="btn btn-s btn-primary" href="trac/wiki/BoincOverview">'.tra("Computing with BOINC").'</a>
                <a class="btn btn-s btn-primary" href="trac/wiki/ProjectMain">'.tra("Technical Documentation").'</a>
                </center>
            ';
        }
    );
}
function show_software() {
    panel(
        tra("Software"),
        function() {
            echo 
                tra("BOINC includes client, server, and web components, and APIs for connecting other components.").'
                '.tra("It is distributed under the LGPLv3 open-source license.").'
                <p></p>
                <center>
                <a class="btn btn-s btn-primary" href="trac/wiki/SourceCodeGit">'.tra("Source code").'</a>
                <a class="btn btn-s btn-primary" href="trac/wiki/SoftwareBuilding">'.tra("Building BOINC").'</a>
                <a class="btn btn-s btn-primary" href="trac/wiki/SoftwareAddon">APIs</a>
                <a class="btn btn-s btn-primary" href="trac/wiki/SoftwareDevelopment">'.tra("Design documents").'</a>
                <a class="btn btn-s btn-primary" href="trac/wiki/CodingStyle">'.tra("Coding style").'</a>
                </center>
                <p></p>
                '.tra("BOINC software development is community-based.  Everyone is welcome to participate.").'
                <p></p>
                <center>
                <a class="btn btn-s btn-primary" href="https://github.com/BOINC/boinc">Github</a>
                <a class="btn btn-s btn-primary" href="trac/wiki/BoincGovernanceWorkingGroups">'.tra("Organization").'</a>
                <a class="btn btn-s btn-primary" href="trac/wiki/AdminTasks">'.tra("Tasks").'</a>
                <a class="btn btn-s btn-primary" href="trac/wiki/BoincEvents">'.tra("Events").'</a>
                </center>
                <p></p>
            ';
        }
    );
}
                // <a class="btn btn-s btn-primary" href="trac/wiki/DevProcess">'.tra("Development process").'</a>
                // <a class="btn btn-s btn-primary" href="trac/wiki/DevProjects">'.tra("Development tasks").'</a>

function show_boinc() {
    panel(
        'The BOINC Project',
        function() {
            echo '
                The BOINC project is located at the University of California, Berkeley.  It has existed since 2002, with funding primarily from the National Science Foundation.
                <p></p>
                <center>
                <a class="btn btn-s btn-primary" href="trac/wiki/ProjectPeople">'.tra('Contact').'</a>
                <a class="btn btn-s btn-primary" href="trac/wiki/BoincPapers">'.tra('Papers').'</a>
                <a class="btn btn-s btn-primary" href="logo.php">'.tra("Graphics").'</a>
                </center>
            ';
        }
    );
}

function show_nsf() {
    echo "
        <img hspace=8 src=images/nsf.gif alt=\"NSF logo\">
        BOINC is supported by the
        <a href=\"https://nsf.gov\">National Science Foundation</a>
        through awards SCI-0221529, SCI-0438443, SCI-0506411,
                PHY/0555655, and OCI-0721124.
    ";
}

header("Content-type: text/html; charset=utf-8");

$rh_col_width = 390;

echo '
    <head>
    <link rel="shortcut icon" href="logo/favicon.gif">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link href="https://plus.google.com/117150698502685192946" rel="publisher" />
    <title>BOINC</title>
    <meta name=description content="BOINC is an open-source software platform for computing using volunteered resources">
    <meta name=keywords content="distributed scientific computing supercomputing grid SETI@home public computing volunteer computing ">
    </head>
    <body>
    <div class="container-fluid">
';

function left() {
    echo '<div class="container-fluid">';
    show_science();
    show_software();
    show_boinc();
    show_participant();
    echo '</div>';
}

function right() {
    echo '<div class="container-fluid">';
    show_news_items();
    echo '</div>';
}

echo "<p>&nbsp;</p>\n";
page_head(tra("Compute for Science"), null, true);

grid('top', 'left', 'right');

    show_nsf();
    echo "<br>";
page_tail(true, true);
?>
