<?php

require_once("pubs.inc");

function show_pub($p) {
    echo sprintf("<li> %s. %s.\n",
        $p->desc, $p->date
    );
    if ($p->url) {
        echo "<a href=$p->url>Download</a>\n";
    }
}

function show() {
    global $pubs;
    echo "<ol>";
    foreach ($pubs as $p) {
        show_pub($p);
    }
    echo "</ol>";
}

function show_area($area) {
    global $pubs;
    echo "<ol>";
    foreach ($pubs as $p) {
        if ($p->area == $area) {
            show_pub($p);
        }
    }
    echo "</ol>";
}

function show_areas() {
    echo "<h3>BOINC and volunteer computing</h3>\n";
    show_area(BOINC);
    echo "<h3>Science</h3>\n";
    show_area(SCI);
    echo "<h3>Digital audio/video</h3>\n";
    show_area(CM);
    echo "<h3>Computer music</h3>\n";
    show_area(MUSIC);
    echo "<h3>DASH</h3>\n";
    show_area(DASH);
    echo "<h3>Miscellaneous</h3>\n";
    show_area(MISC);
}

function show_type($type) {
    global $pubs;
    echo "<ol>";
    foreach ($pubs as $p) {
        if ($p->type == $type) {
            show_pub($p);
        }
    }
    echo "</ol>";
}

function show_types() {
    echo "<h3>Journal papers</h3>\n";
    show_type(JOURNAL);
    echo "<h3>Conference papers</h3>\n";
    show_type(CONF);
    echo "<h3>Technical reports</h3>\n";
    show_type(TR);
    echo "<h3>Book chapters</h3>\n";
    show_type(BOOK);
    echo "<h3>Magazine articles</h3>\n";
    show_type(MAG);
    echo "<h3>Patents</h3>\n";
    show_type(PATENT);
}
echo("<div style=\"max-width: 640px;\">\n");

show_types();
echo "</div>";
?>
