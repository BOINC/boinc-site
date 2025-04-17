<?php

// BOINC web site home page.
// to maintain translations: if you change anything here:
// - in dev/html, run ops/build_po.php
// - upload the resulting en.po to app.transifex.com/boinc/boinc/web/
//   as BOINC-Web.pot
// - later, download all translations as zip;
//   install in ~/boinc-site/translations

if (isset($_SERVER) && array_key_exists('SERVER_NAME', $_SERVER)) {
    $host = $_SERVER["SERVER_NAME"];
    if ($host == "bossa.berkeley.edu") {
        Header("Location: https://github.com/davidpanderson/bossa/wiki");
        exit();

    }
    if ($host == "bolt.berkeley.edu") {
        Header("Location: https://github.com/davidpanderson/bolt/wiki");
        exit();
    }
}

require_once("../inc/util.inc");
require_once("../inc/language_names.inc");
require_once("../inc/news.inc");
require_once("../inc/forum.inc");
require_once("../inc/rss.inc");
require_once("../inc/project_news.inc");

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

// get project news items, show newest 3 and link to the rest
// This uses https://vcnews.info,
// which runs on AWS and was created by Kevin Reed.
// This may not be there forever.
//
function show_project_news() {
    $items = get_rss_feed_cached("https://api.vcnews.info/rss", 3600);
    if (!$items) return;
    panel(
        tra("News from BOINC Projects"),
        function() use ($items) {
            show_rss_items($items, 3, 'rss_filter', 200);
            echo "<a href=project_news.php>... more</a>";
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
        <br><a href="pubs.php">'.tra("Science publications").'</a>
        <br><a href="https://github.com/BOINC/boinc/wiki/User-manual"><span class=nobr>'.tra("User manual").'</span></a> 
        <br><a " href="addons.php"><span class=nobr>'.tra("Add-ons").'</span></a> 
        <br><a btn-primary href=https://github.com/BOINC/boinc/wiki/Web-Resources><span class=nobr>'.tra("Web resources").'</span></a> 
        <p>
        </div><div class="col-sm-4">
        <font size=+2>
        '.tra("Communicate").'
        </font>
        <br><a href="forum_index.php">'.tra("Message boards").'</a>
        <br><a href="https://github.com/BOINC/boinc/wiki/BOINC-Help">'.tra("Help").'</a>
        <br><a href="https://github.com/BOINC/boinc/wiki/EmailLists">'.tra("Email lists").'</a>
        <br><a href="https://github.com/BOINC/boinc/wiki/Reporting-client-Bugs">'.tra("Report bugs").'</a>
        <br><a href=https://www.reddit.com/r/BOINC/ title="BOINC on Reddit"><img src=images/reddit.png height=28></a>
        <p>
        </div><div class="col-sm-4">
        <font size=+2>
        '.tra("Help").'
        </font>
        <br><a href="https://github.com/BOINC/boinc/wiki/TranslateIntro">'.tra("Translate").'</a>
        <br><a href="https://github.com/BOINC/boinc/wiki/AlphaInstructions">'.tra("Test").'</a>
        <br><a href="https://github.com/BOINC/boinc/wiki/BoincPr">'.tra("Publicize").'</a>
        </div>
        </div>
        </div>

    ';
    echo sprintf('
        <p>
        <a href=computing.php>%s</a>
        &middot;
        <a href=cert_dev.php>%s</a>
        &middot;
        <a href=poll_results.php>%s</a>
        ',
        tra('Computing power'),
        tra('Certificate'),
        tra('Poll')
    );
    echo sprintf('
        <hr>
        <font size=+2>%s:</font> <br>
            <ul>
            <li><a href=https://github.com/BOINC/boinc/wiki/Computing-with-boinc>%s</a> and <a href=https://github.com/BOINC/boinc/wiki/Maintain-your-boinc-project>%s</a> %s.
            <br>
            <li>
            <a href=https://boinc.berkeley.edu/central/>
            Run Autodock Vina jobs with BOINC Central and Raccoon2</a>
            </ul>
        <p>
        <font size=+2>%s:</font> <br>
        <ul>
        <li>
        <a href=https://github.com/BOINC/boinc/wiki/>
        Visit the BOINC github repo </a>
        </ul>
        ',
        tra("Scientists"),
        tra("Create"),
        tra("maintain"),
        tra("a BOINC project"),
        tra("Programmers")
    );
    echo '
        <p>
    ';
    echo sprintf('
        <hr>
        <a href=https://github.com/BOINC/boinc/wiki/Contact-BOINC>%s</a>
        &middot;
        <a href="https://github.com/BOINC/boinc/wiki/BoincPapers">%s</a>
        &middot;
        <a href=logo.php>%s</a>
        &middot;
        <a href=https://github.com/BOINC/boinc/wiki/BOINC-events>%s</a>
        &middot;
        <a href=https://continuum-hypothesis.com/boinc_history.php>History</a>
        ',
        tra('Contact'),
        tra('Papers'),
        tra("Graphics"),
        tra("Events")
    );

}

function intro() {
    echo "<ul><li>";
    echo tra("BOINC lets you help cutting-edge science research using your computer.  The BOINC app, running on your computer, downloads scientific computing jobs and runs them invisibly in the background.  It's easy and safe.");
    echo "</p><p>\n ";
    echo "<li>";
    echo tra("About 30 science projects use BOINC.");
    echo " ";
    echo tra('They investigate diseases, study climate change, discover pulsars, and do many other types of scientific research.');
    echo '
        </p><p>
    ';
    echo "<li>";
    echo tra("The BOINC and Science United projects are located at the University of California, Berkeley and are supported by the National Science Foundation.");
    echo "</ul><center>
        <a href=https://berkeley.edu><img hspace=8 width=120 src=images/ucbseal.png  alt=\"UCB logo\"></a>
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        <a href=https://nsf.gov><img hspace=8 width=120 src=images/NSF_4-Color_bitmap_Logo.png alt=\"NSF logo\"></a>
        </center>
    ";
}

function call_to_action() {
    $spacer = '<br style="margin-bottom: 10px" />';

    echo "<font size=+2>".tra("START COMPUTING!")."</font></p>";
    echo tra('To contribute to science areas (biomedicine, physics, astronomy, and so on) use %1.  Your computer will help current and future projects in the areas you choose.',
        '<a href=https://scienceunited.org style="color:orange">Science United</a>'
    );
    echo '
        </p><p>
        <center>
    ';
    echo sprintf('<a class="btn " style= "background-color:mediumseagreen; color:white; font-size:24px; text-decoration:none" href="%s">%s</a>',
        'https://scienceunited.org/su_join.php',
        tra("Join %1", "Science United")
    );
    echo "</center></p>";
    echo tra("Or %1download BOINC%2 and choose specific projects.",
        '',''
    );
    echo ' ';
    echo tra("This will let you participate in competitions and systems like Gridcoin.");
    echo '<p><center>';
    echo sprintf('<a class="btn " style= "background-color:dodgerblue; color:white; font-size:20px; text-decoration:none" href="%s">%s</a>',
        'download.php',
        tra("Download BOINC")
    );
    echo '</center>';
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
            intro();
        },
        "panel-primary",
        "bg-primary"
    );
    panel(
        null,
        function() {
            call_to_action();
        },
        "panel-primary",
        "bg-primary"
    );
    show_project_news();
}

function right() {
    panel(
        null,
        function() {
            show_links();
        }
    );
    show_news_items();
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

grid(null, 'left', 'right');

    //show_nsf();
    echo "<br>";
page_tail(true, true);
?>
