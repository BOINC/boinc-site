<?php

echo "Deprecated: see <a href=https://boinc.berkeley.edu/trac/wiki/WebResources>https://boinc.berkeley.edu/trac/wiki/WebResources</a>";
exit;
require_once("docutil.php");

include("../inc/stats_sites.inc");

function language($lang, $sites) {
    echo "<h4>$lang</h4>\n<ul>\n";
    foreach ($sites as $s) {
        echo "<li>$s\n";
    }
    echo "</ul>\n";
    return;

    echo "<tr><td bgcolor=eeeeee valign=top width=250>$lang</td><td>\n";
    shuffle($sites);
    foreach ($sites as $s) {
        echo "$s<br>\n";
    }
    echo "</td></tr>\n";
}

function site($url, $name) {
    return "<a href=$url>$name</a>";
}

$info_sites = array(
    array(
        "http://www.pkcarlisle.com/smboinc.html",
        "Running BOINC over a Samba Server",
        "(in English)"
    ),
    array(
        "http://www.overclock.net/f/365/overclock-net-boinc-team",
        "Overclock.net",
        "(in English)"
    ),
    array(
        "http://projekty.czechnationalteam.cz/",
        "BOINC projects",
        "(in Czech)"
    ),
    array(
        "http://www.hyper.net/dc-howto.html",
        "How to participate in grid computing projects that benefit humanity",
        "(survey of volunteer computing, including non-BOINC projects)"
    ),
    array(
        "https://www.rechenkraft.net/wiki/",
        "Rechenkraft.net wiki",
        "(German, English, Portuguese)"
    ),
    array(
        "http://www.kd-web.info/#%21/boinc",
        "Flash-based BOINC tutorials", "(in Czech, English, and Slovak)"
    ),
    array(
        "https://boinc.mundayweb.com/wiki/index.php?title=BOINC_FAQs_Central",
        "The BOINC FAQ Service"
    ),
    array(
        "http://www.seti-argentina.com.ar/instrucciones-boinc-manager",
        "BOINC Argentina",
        "(in Spanish)",
    ),
    array(
        "http://www.angelfire.com/jkoulouris-boinc/",
        "The Big BOINC! Projects and Chronology Page",
        "(by John Koulouris)"
    ),
);

function show_social_media() {
    echo "
    <a name=misc></a>
    <h3>Social media</h3>
    ";
    $misc_sites = array(
        array("https://www.reddit.com/r/BOINC", "BOINC subreddit"),
        array("https://www.linkedin.com/groups/678497/profile", "BOINC group on LinkedIn"),
        array("https://www.facebook.com/pages/Berkeley-Open-Infrastructure-for-Network-Computing/111781192172429", "BOINC on Facebook"),
    );
    echo "<ul>";
    foreach ($misc_sites as $m) {
        $u = $m[0];
        $t1 = $m[1];
        $t2 = $m[2];
        echo "<li> <a href=$u>$t1</a> $t2
        ";
    }
    echo "
    </ul>
    ";
}

page_head("Web resources for BOINC participants");

echo "
<h3>Contents</h3>
<ul>
<li> <a href=#info>Help and Information</a>
<li> <a href=#misc>Social media</a>
<li> <a href=#stats>Credit statistics</a>
<li> <a href=#sigs>Signature images</a>
<li> <a href=#team_stats>Team statistics</a>
";
echo "
<li> <a href=#skins>Skins for the BOINC Manager</a>
<li> <a href=#sites>Other BOINC-related sites</a>
(Information, message boards, and teams)
<li> <a href=#video>BOINC-related videos</a>
</ul>
<a name=info></a>
<h3>Help and Information</h3>
Sites with information and documentation about BOINC.
";
shuffle($info_sites);
site_list($info_sites);

show_social_media();

echo "
<a name=stats></a>
<h3>Credit statistics</h3>
<p>
The following websites show statistics for one or more BOINC projects.
These sites use XML-format data exported by BOINC projects,
as described
<a href=trac/wiki/CreditStats>here</a>.
If you're interested in running your own site or
participating in the development efforts,
please contact the people listed below.
";
shuffle($stats_sites);
site_list($stats_sites);
echo "
<a name=sigs></a>
<h3>Signature images</h3>
<p>
The following sites offer dynamically-generated
images showing your statistics in BOINC projects,
and/or news from projects.
Use these in your email or message-board signature.
";
shuffle($sig_sites);
site_list($sig_sites);
echo "
<a name=team_stats></a>
<h3>Team statistics</h3>
";
shuffle($team_stats_sites);
site_list($team_stats_sites);
if (0) {
    echo "
        <a name=status></a>
        <h3>Project status sites</h3>
        Show if the servers of various projects are up or down.
        <ul>
    ";
    echo "
        <li> <a href=http://boincprojectstatus.ath.cx/>BOINC Project Status</a>
        </ul>
    ";
}
echo "
<a name=skins></a>
<h3>Skins for the BOINC Manager</h3>
<ul>
<li> <a href=http://www.crunching-family.at/download-center/>Crunching Family Skin Download</a>
<li> <a href=http://www.czechnationalteam.cz/view.php?cisloclanku=2007040003>Czech National Team skin</a> (in Czech)
<li> <a href=http://www.grid-france.fr/tutos/boinc-personnaliser-aux-couleurs-equipe>Skin for Equipe France (WCG)</a>
";
echo "
</ul>
<a name=sites></a>
<h3>Other BOINC-related web sites</h3>
";
list_start();
echo "
<tr><th>Language</th><th>Site</th></tr>
";

language("Belgium (Dutch/French/English)", array(
  site("http://www.boinc.be", "www.boinc.be"),
));
language("Catalan", array(
    site("http://www.boinc.cat", "BOINC.cat"),
));
language("Chinese", array(
    site("http://boinc.equn.com/", "boinc.equn.com")
));
language("Czech", array(
    site("http://www.czechnationalteam.cz/", "Czech National Team"),
    site("http://www.boincteamcz.net/", "BOINC Team CZ"),
    site("http://www.boinc.cz/", "www.boinc.cz")
));
language("Danish", array(
    site("http://boincdenmark.dk", "BOINC@Denmark"),
    site("http://www.setihome.dk", "www.setihome.dk")
));
language("Dutch", array(
    site("http://www.dutchpowercows.org/", "Dutch Power Cows
        </a>(also <a href=http://gathering.tweakers.net/forum/list_topics/5>forums</a>)"),
    site("http://www.seti.nl/content.php?c=boincmain", "SETI@Netherlands"),
    site("http://www.boinc.be", "www.boinc.be"),
));
language("English", array(
    site("http://www.overclock.net/f/365/overclock-net-boinc-team", "Overclock.net"),
    site("http://z15.invisionfree.com/The_Boinc_Bar/index.php?act=idx", "The BOINC Bar"),
    site("http://www.s15.invisionfree.com/Crunchers_Inc/index.php?act=idx", "Crunchers Inc."),
    site("http://www.calmchaosonline.com/", "Calm Chaos"),
    site("http://www.teamphoenixrising.net/", "Team Phoenix Rising"),
    site("http://www.unitedmacs.com/", "United Macs"),
    site("http://www.ukboincteam.org.uk/", "UK BOINC Team"),
    site("http://www.bc-team.org/", "BOINC Confederation"),
    site("http://www.free-dc.org/", "Free-DC"),
    site("http://forums.anandtech.com/categories.aspx?catid=39&entercat=y", "TeAm Anandtech"),
    site("http://www.boinc-australia.net", "BOINC@Australia"),
    site("http://www.boincuk.com/", "BOINC UK and Team Lookers"),
    site("http://www.tswb.org", "Team Starfire World BOINC"),
));
language("Finnish", array(
    site( "http://www.universe-examiners.org/", "Universe Examiners"),
));
language("French", array(
    site("http://boinc.starwars-holonet.com/", "Star Wars [FR]"),
    site("http://www.boinc-af.org", "L'Alliance Francophone"),
    site("https://www.crunchersansfrontieres.org/", "CRUNCHERS SANS FRONTIERES"),
));
language("German", array(
    site("http://www.crunchers-freiburg.de/", "crunchers@freiburg"),
    site("http://www.unitedmacs.com/", "United Macs"),
    site("http://www.rechenkraft.net/", "Rechenkraft"),
    site("http://www.seti-leipzig.de/", "SETI-Leipzig"),
    site("http://www.dc-gemeinschaft.com/", "DC - Gemeinschaft"),
    site("http://boinccast.podhost.de/", "BOINCcast (Podcast)"),
    site("http://www.boinc-team.de/", "BOINC@Heidelberg"),
    site("http://www.boinc.at/", "www.boinc.at"),
    site("http://www.boinc-halle-saale.de", "BOINC@Halle/Saale"),
    site("http://www.bc-team.org/", "BOINC Confederation"),
    site("http://www.seti-germany.de", "SETI.Germany"),
    site("http://www.sar-hessen.org", "Team Science and Research Hessen"),
    site("http://www.boinc.de/", "www.boinc.de"),
));
language("Italian", array(
    site("http://www.calcolodistribuito.it/", "Calcolo Distribuito"),
    site("http://www.boincitaly.org/", "BOINC.Italy"),
    site("http://gaming.ngi.it/forum/forumdisplay.php?f=73", "NGI forum"),
    site("http://it.groups.yahoo.com/group/BOINC-ITALIA/", "BOINC-ITALIA")
));
language("Japanese", array(
    site("https://www.boinc.tokyo/", "BOINC@TOKYO"),
));
language("Korean", array(
    site("http://cafe.naver.com/setikah", "SETIKAH@KOREA"),
));
language("Polish", array(
    site("http://www.boincatpoland.org", "BOINC@Poland"),
    site("http://boinc.pl", "BOINC Polish National Team"),
    site("http://www.tomaszpawel.republika.pl/", "TomaszPawelTeam"),
));
language("Portuguese", array(
    site("http://www.setibr.org/", "SETIBR"),
));
language("Russian", array(
    site("http://vkontakte.ru/club11963359", "BOINC group on vkontakte.ru"),
    site("http://www.boinc.ru", "BOINC.ru"),
    site("http://distributed.ru", "distributed.ru")
));
language("Slovak", array(
    site("http://www.boinc.sk/", "www.boinc.sk")
));
language("Spanish", array(
    site("http://www.titanesdc.com/", "Foros TitanesDC"),
    site("http://www.seti.cl/", "BOINC SETI Chile"),
    site("http://www.easyboinc.org/", "Computaci�n Distribuida"),
    site("http://foro.noticias3d.com/vbulletin/showthread.php?t=192297", "Noticias3D"),
    site("http://www.boinc-ecuador.com/", "BOINC - Ecuador"),
    site("http://www.hispaseti.org/", "HispaSeti"),
));
//));
language("Ukrainian", array(
    site("http://distributed.org.ua/", "Ukraine - Distributed Computing"),
));

echo "
</table>
<p>
If you'd like to add a web site to this list, please
<a href=mailto:davea@ssl.berkeley.edu>contact us</a>.

<a name=video>
<h2>BOINC-related videos</h2>

<ul>
<li> <a href=https://www.youtube.com/watch?v=8iSRLIK-x6A>David Anderson talks about BOINC</a> (2006)
<li> <a href=https://www.youtube.com/watch?v=GzATbET3g54>David Baker talks about Rosetta@home</a>
</ul>
";
page_tail();
?>
