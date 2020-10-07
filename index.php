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
    $i = rand(0, 99)+1;
    echo "
        <br>
        <font size=+1>Computing power:</font>
        &nbsp; <a href=computing.php>View</a>

    ";
    return;
    show_totals();
    echo '
        <p> </p>
        <p>
    ';
    include("piecharts/$i.html");
    echo '<p><a href=chart_list.php>'.tra("Top 100 volunteers").'</a>';
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
                show_news(0, 3);
            } else {
                echo "<p>".tra("We're down for maintenance; please try later.");
            }
        }
    );
}

function show_links() {
    echo '
        </p>
        <div class="container-fluid">
        <div class="row">
        <div class="col-sm-4">
        <font size=+2>
        '.tra("Learn").'
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
        '.tra("Help").'
        </font>
        <br><a href="trac/wiki/TranslateIntro">'.tra("Translate").'</a>
        <br><a href="trac/wiki/AlphaInstructions">'.tra("Test").'</a>
        <br><a href="trac/wiki/WikiMeta">'.tra("Document").'</a>
        <br><a href="https://boinc.berkeley.edu/wiki/Publicizing_BOINC">'.tra("Publicize").'</a>
        </div>
        </div>
        </div>

        <hr>
        <font size=+1>Scientists:</font> &nbsp; <a href=https://boinc.berkeley.edu/trac/wiki/BoincOverview>Compute with BOINC</a>
            &middot; <a href=https://boinc.berkeley.edu/trac/wiki/ProjectMain>Documentation</a>
        <p>
        <font size=+1>Developers:</font> &nbsp; <a href=develop.php>Help maintain and develop BOINC</a>
    ';
}

function top() {
    panel(
        "",
        function () {

            // style for join/download boxes
            //
            //$s = 'style="background-color:#036; a.link{color:white;}; color:white; border-style: solid; border-width:1.5px; border-radius: 6px; border-color:#c8c8c8"';
            $s = ' style="a.link{color:white;}; color:white; border-radius: 6px; border-color:#c8c8c8"';

            // half-line spacer
            //
            $spacer = '<br style="line-height: 10px" />';

            echo '
                <div class="container-fluid">
                <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 bg-primary"'.$s.'>
                '.$spacer.'
            ';
            echo tra("BOINC lets you help cutting-edge science research using your computer (Windows, Mac, Linux) or Android device.  BOINC downloads scientific computing jobs to your computer and runs them invisibly in the background.  It's easy and safe.");
            echo "</p><p>\n ";
            echo tra(
                "About 30 science projects use BOINC; examples include %3, %4, and %5.",
                '<a href="projects.php">', '</a>',
                '<a href="https://boinc.bakerlab.org/rosetta/">Rosetta@home</a>',
                '<a href="https://einsteinathome.org">Einstein@Home</a>',
                '<a href="https://worldcommunitygrid.org">IBM World Community Grid</a>'
            );
            echo " ";
            echo tra('These projects investigate diseases, study global warming, discover pulsars, and do many other types of scientific research.');
            echo '
                </p><p>
            ';
            echo tra('To contribute to science areas (biomedicine, physics, astronomy, and so on) use %1.  Your computer will do work for current and future projects in those areas.',
                '<a href=https://scienceunited.org style="color:orange">Science United</a>'
            );
            echo '
                </p><p>
                <center>
                <a class="btn btn-lg" style="background-color:#ffd730; color:black" href="https://scienceunited.org/su_join.php"><font size=+2>'.tra("Join Science United").'</font></a>
                </center>
                '.$spacer.'
                <p>Or
                <a href=download.php>download BOINC</a>
                and choose specific projects.
                </div>
                <div class="col-sm-2"></div>
                </div>
                </div>
            ';
        },
        "panel-borderless"
    );
}

function show_boinc() {
    echo '
        <hr>
        <p>
        The BOINC project is located at the
        University of California, Berkeley.
        <p>
        <a href="trac/wiki/ProjectPeople">'.tra('Contact').'</a>
        &middot;
        <a href="trac/wiki/BoincPapers">'.tra('Papers').'</a>
        &middot;
        <a logo.php">'.tra("Graphics").'</a>
    ';
}

function show_nsf() {
    echo "
        <img hspace=8 width=120 src=images/NSF_4-Color_bitmap_Logo.png alt=\"NSF logo\">
        BOINC is supported by the
        <a href=\"https://nsf.gov\">National Science Foundation</a>
        through awards SCI-0221529, SCI-0438443, SCI-0506411,
                PHY/0555655, and OCI-0721124.
    ";
}

header("Content-type: text/html; charset=utf-8");

$rh_col_width = 390;

function left() {
    panel(
        null,
        function() {
            show_links();
            show_participant();
            show_boinc();
        }
    );
}

function right() {
    echo '<div class="container-fluid">';
    show_news_items();
    echo '</div>';
}

page_head(tra("Compute for Science"), null, true, '',
'
    <link rel="shortcut icon" href="logo/favicon.gif">
    <link href="https://plus.google.com/117150698502685192946" rel="publisher" />
    <meta name=description content="BOINC is an open-source software platform for computing using volunteered resources">
    <meta name=keywords content="distributed scientific computing supercomputing grid SETI@home public computing volunteer computing ">
    <title>BOINC</title>
',
    true
);
echo "<p>";

grid('top', 'left', 'right');

    //show_nsf();
    echo "<br>";
page_tail(true, true);
?>
