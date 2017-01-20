<?php

//define("MYSQLI", false);
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

$dir = getcwd();
chdir("/mydisks/a/users/boincadm/projects/dev/html/user");
require_once("../inc/util.inc");
require_once("../inc/language_names.inc");
require_once("../inc/news.inc");
require_once("../inc/forum.inc");
chdir($dir);

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
                <a class="btn btn-xs btn-primary" href=chart_list.php>'.tra("Top 100 volunteers").'</a>
                <a class="btn btn-xs btn-primary" href="links.php#stats">'.tra("Statistics").'</a>
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
        $x = file_get_contents("https://boincstats.com/en/xml/boincState?uid=$uid");
        if ($x) {
            $f = fopen($fn, "w");
            fwrite($f, $x);
        } else return;
    }
    $x = file_get_contents($fn);
    $users = parse_element($x, "<participants_active>");
    $hosts = parse_element($x, "<hosts_active>");
    $credit_day = parse_element($x, "<credit_day>");
    $users = number_format($users);
    $hosts = number_format($hosts);

    $petaflops = number_format($credit_day/200000000, 3);
    echo
        tra("24-hour average:")." $petaflops ".tra("PetaFLOPS.")."
        <br>
        ".tra("Active:")." $users ".tra("volunteers,")." $hosts ".tra("computers.
")."
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

function show_participate() {
    panel(
        // "Volunteer" is used as a verb
            tra("Volunteer"),
        function () {
            echo tra("Use the idle time on your computer (Windows, Mac, Linux, or Android) to cure diseases, study global warming, discover pulsars, and do many other types of scientific research.  It's safe, secure, and easy:");
            echo '<p>
                <center>
                <a class="btn btn-lg btn-success" href="download.php">'.tra("Download").'</a>
                </center>
                <p></p>
                '.tra("For Android devices, get the BOINC app from the Google Play Store; for Kindle, get it from the Amazon App Store.").'
                <p></p>
            ';
            echo tra(
                "You can choose to support %1projects%2 such as %3, %4, and %5, among many others.",
                '<a href="projects.php">', '</a>',
                '<a href="https://einsteinathome.org">Einstein@Home</a>',
                '<a href="https://worldcommunitygrid.org">IBM World Community Grid</a>',
                '<a href="https://setiathome.berkeley.edu">SETI@home</a>'
            );
            echo " ";
            echo tra("If you run several projects, try an %1account manager%2 such as %3GridRepublic%4 or %5BAM!%6. ",
                "<a href=\"wiki/Account_managers\">", "</a>",
                "<a href=\"https://www.gridrepublic.org\">", "</a>",
                "<a href=\"https://bam.boincstats.com/\">", "</a>"
            );
            echo '
                <p></p>
                '.tra("Learn more:").'
                <p></p>
                <center>
                <a class="btn btn-xs btn-primary" href="dev/">'.tra("Message boards").'</a>
                <a class="btn btn-xs btn-primary" href="projects.php">'.tra("Projects").'</a>
                <a class="btn btn-xs btn-primary" href="http://boinc.berkeley.edu/wiki/User_manual"><span class=nobr>'.tra("Manual").'</span></a> 
                <a class="btn btn-xs btn-primary" href="http://boinc.berkeley.edu/wiki/BOINC_Help">'.tra("Help").'</a>
                <a class="btn btn-xs btn-primary" href="addons.php"><span class=nobr>'.tra("Add-ons").'</span></a> 
                <a class="btn btn-xs btn-primary" href="links.php"><span class=nobr>'.tra("Links").'</span></a> 
                </center>
            ';
            echo '
                <p></p>
                '.tra("Other ways to help:").'
                <p></p>
                <center>
                <a class="btn btn-xs btn-primary" href="trac/wiki/ContributePage">'.tra("Overview").'</a>
                <a class="btn btn-xs btn-primary" href="trac/wiki/TranslateIntro">'.tra("Translate").'</a>
                <a class="btn btn-xs btn-primary" href="trac/wiki/AlphaInstructions">'.tra("Test").'</a>
                <a class="btn btn-xs btn-primary" href="trac/wiki/WikiMeta">'.tra("Document").'</a>
                <a class="btn btn-xs btn-primary" href="http://boinc.berkeley.edu/wiki/Publicizing_BOINC">'.tra("Publicize").'</a>
                <a class="btn btn-xs btn-primary" href=https://github.com/BOINC/boinc/issues>'.tra("Report bugs").'</a>
                </center>
                <p>
            ';
        }
    );
}

function show_science() {
    panel(
        tra("High-throughput computing with BOINC"),
        function() {
            echo 
                tra("%1Scientists%2: use BOINC to create a %3volunteer computing project%4, giving you the power of thousands of CPUs and GPUs.",
                    "<b>", "</b>", "<a href=volunteer.php>", "</a>"
                )
                .'<p></p>'.
                tra("%1Universities%2: use BOINC to create a %3Virtual Campus Supercomputing Center%4.",
                    "<b>", "</b>",
                    "<a href=\"trac/wiki/VirtualCampusSupercomputerCenter\">", "</a>"
                )
                .'<p></p>'.
                tra("%1Companies%2: use BOINC for %3desktop Grid computing%4.",
                    "<b>", "</b>", "<a href=dg.php>", "</a>"
                )
                .'<p></p>
                <center>
                <a class="btn btn-xs btn-primary" href="trac/wiki/ProjectMain">'.tra("Documentation").'</a>
                <a class="btn btn-xs btn-primary" href=trac/wiki/BoincDocker>'.tra("BOINC and Docker").'</a>
                </center>
            ';
        }
    );
}
function show_software() {
    panel(
        tra("Software development"),
        function() {
            echo 
                tra("BOINC is a software platform for volunteer computing. It includes client, server, and web components, and APIs for connecting other components.").'
                <p></p>
                <center>
                <a class="btn btn-xs btn-primary" href="trac/wiki/SourceCodeGit">'.tra("Source code").'</a>
                <a class="btn btn-xs btn-primary" href="trac/wiki/SoftwareBuilding">'.tra("Building BOINC").'</a>
                <a class="btn btn-xs btn-primary" href="trac/wiki/SoftwareAddon">APIs</a>
                <a class="btn btn-xs btn-primary" href="trac/wiki/SoftwareDevelopment">'.tra("Design documents").'</a>
                </center>
                <p></p>
                '.tra("We're always looking for programmers to help us maintain and develop BOINC.").'
                <p></p>
                <center>
                <a class="btn btn-xs btn-primary" href="trac/wiki/DevProcess">'.tra("Development process").'</a>
                <a class="btn btn-xs btn-primary" href="trac/wiki/DevProjects">'.tra("Development tasks").'</a>
                </center>
                <p></p>
                '.tra("BOINC is distributed under the LGPL open-source license.").'
            ';
        }
    );
}

function show_boinc() {
    panel(
        tra("The BOINC project"),
        function() {
            echo 
                tra("BOINC is a community-based project.  Everyone is welcome to participate.").'
                <p></p>
                <center>
                <a class="btn btn-xs btn-primary" href="trac/wiki/ProjectPeople">Contact</a>
                <a class="btn btn-xs btn-primary" href="trac/wiki/EmailLists">'.tra("Email lists").'</a>
                <a class="btn btn-xs btn-primary" href="trac/wiki/BoincEvents">'.tra("Events").'</a>
                <a class="btn btn-xs btn-primary" href="logo.php">'.tra("Graphics").'</a>
                <a class="btn btn-xs btn-primary" href="trac/wiki/ProjectGovernance">'.tra("Governance").'</a>
                </center>
            ';
        }
    );
}

function show_nsf() {
    echo "
        <tr><td>
        <img align=left hspace=8 src=nsf.gif alt=\"NSF logo\">
        BOINC is supported by the
        <a href=\"http://nsf.gov\">National Science Foundation</a>
        through awards SCI-0221529, SCI-0438443, SCI-0506411,
                PHY/0555655, and OCI-0721124.
        <span class=note>
        Any opinions, findings, and conclusions or recommendations expressed in
        this material are those of the author(s)
        and do not necessarily reflect the views of the National Science Foundation.
        </span>
        </td></tr>
    ";
}

header("Content-type: text/html; charset=utf-8");

//html_tag();
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
    show_participate();
    show_science();
    show_software();
    show_boinc();
    show_participant();
    //show_nsf();
    echo '</div>';
}

function right() {
    echo '<div class="container-fluid">';
    show_news_items();
    echo '</div>';
}

page_head("BOINC", null, true);

grid(null, 'left', 'right');

page_tail(true, true);
?>
