<?php
require_once("../inc/util.inc");

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

function main() {
    page_head("BOINC computing power");
    echo "<h3>Totals</h3>";
    show_totals();
    echo '
        <p> </p>
        <a href=chart_list.php>'.tra("Top 100 volunteers").'</a>
        &middot;
        <a href=https://github.com/BOINC/boinc/wiki/WebResources#credit-statistics>'.tra("Statistics").'</a>
        <p>
        <h3>Featured volunteer</h3>
    ';
    $i = rand(0, 100);
    include("piecharts/$i.html");
    page_tail();
}

main();

?>
