<?php

if (0) {
    $x = $_SERVER['PHP_SELF'];
    $path = "/tmp/php_pids/".getmypid();
    $f = fopen($path, "w");
    fwrite($f, $x);
    fclose($f);
}

function search_form() {
    echo "
    <form method=get action=\"http://google.com/search\">
    <input type=hidden name=domains value=\"http://boinc.berkeley.edu\">
    <input type=hidden name=sitesearch value=\"http://boinc.berkeley.edu\">
    <span class=\"nobar\">
    <input class=small name=q size=20>
    <input class=small type=submit value=Search>
    </span>
    </form>
";
}

function last_mod($datefile) {
    return gmdate("g:i A \U\T\C, F d Y", filemtime($datefile));
}

function html_tag() {
    global $language_in_use;
     echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
     ";

    // if language is arabic, go right to left
    //
    if ($language_in_use == 'ar') {
        echo "<html dir=\"rtl\">";
    } else {
        echo "<html>";
    }
}

function page_head($title) {
    global $book;
    global $chap_num;
    if ($book) {
        echo "<br><h2>$chap_num. $title</h2>\n";
        return;
    }
    if (defined("CHARSET")) {
        header("Content-type: text/html; charset=".tr(CHARSET));
    }

    html_tag();
    echo "
        <head>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"white.css\">
        <link rel=\"shortcut icon\" href=\"logo/favicon.gif\">
        <title>$title</title>
        </head>
        <body bgcolor='ffffff'>
        <table width='100%'>
        <tr>
        <td><center><h1>$title</h1></center>
        <td align=right><a href=index.php><img src=\"logo/www_logo.gif\" alt=\"BOINC logo\"></a>
        <br>
";
        search_form();
echo "
        </td>
        </tr></table>
        <hr size=1>
    ";
}

function copyright() {
    $y = date("Y ");
    echo "
        Copyright &copy; $y University of California.
        Permission is granted to copy, distribute and/or modify this document
        under the terms of the GNU Free Documentation License,
        Version 1.2 or any later version published by the Free Software Foundation.
    ";
}

function page_tail($translatable=false, $is_main=false) {
    global $book;
    if ($book) {
        return;
    }
    $datefile = $_SERVER["SCRIPT_FILENAME"];
    $d = last_mod($datefile);
    echo "
        <hr size=1>
    ";
    if (!$is_main) {
        echo "
            <center>
            <a href=\"/\">Return to BOINC main page</a>
            </center><p>
        ";
    }
    echo "
        <span class=note>
        <font color=#888888>
    ";
    if ($translatable) {
        echo "
            This page is <a href=\"trac/wiki/TranslateIntro\">translatable</a>.<br>
        ";
    }
    echo "
        Last modified $d.<br>
    ";
    copyright();
    echo "
        </font>
        </span>
        </body>
        </html>
    ";
}

function html_text($x) {
    return "<pre>".htmlspecialchars($x)."</pre>
    ";
}

function start_table($extra="width=\"100%\"") {
    echo "<table class=bordered $extra>";
}

function end_table() {
    echo "</table>\n";
}

function list_start($attrs = 'width="100%"') {
    echo "<p><table $attrs border=0 cellpadding=6>\n";
}

function list_heading($x, $y, $z=null) {
    echo "
        <tr>
            <th valign=top><b>$x</b></th>
            <th valign=top>$y</th>
";
    if ($z) {
        echo "       <th valign=top>$z</th>\n";
    }
    echo " </tr>\n";
}

function list_heading_array($x) {
    echo "<tr>";
    foreach ($x as $h) {
        echo "<td class=heading valign=top><center><b>$h</b></center></td>";
    }
    echo "</tr>\n";
}

function list_item($x, $y, $z=null) {
    if (!$x) $x = "<br>";
    echo "
        <tr>
            <td class=fieldname valign=top><b>$x</b></td>
            <td valign=top>$y</td>
";
    if ($z) {
        echo "       <td valign=top>$z</a>\n";
    }
    echo " </tr>\n";
}

function list_item_array($x) {
    echo "<tr>";
    foreach ($x as $h) {
        echo "<td valign=top>$h</td>";
    }
    echo "</tr>\n";
}

function list_item_func($x, $y) {
    list_item(html_text($x), $y);
}

function list_bar($x, $note="") {
    if ($note) {
        $note = "<br><span class=note>$note</span>";
    }
    echo "
        <tr><td colspan=8 class=heading><center><b>$x</b>$note</center></td></tr>
    ";
}

function list_end() {
    echo "</table><p>\n";
}

function error_page($x) {
    page_head("Error");
    echo $x;
    page_tail();
    exit();
}

function block_start() {
    echo "
        <table width=100% cellpadding=4>
        <tr>
        <td class=fieldname width=100%><pre>";
}

function block_end() {
    echo "</pre></td></tr></table>
    ";
}

function get_str($name) {
    if (isset($_GET[$name])) {
        $x = $_GET[$name];
        $x = trim($x);
        return mysql_real_escape_string($x);
    }
    return null;
}

function show_link($url) {
    echo "<br><a href=$url>$url</a>";
}

function parse_element($xml, $tag) {
    $element = null;
    $closetag = "</" . substr($tag,1);
    $x = strstr($xml, $tag);
    if ($x) {
        if (strstr($tag, "/>")) return $tag;
        $y = substr($x, strlen($tag));
        $n = strpos($y, $closetag);
        if ($n) {
            $element = substr($y, 0, $n);
        }
    }
    return trim($element);
}
?>
