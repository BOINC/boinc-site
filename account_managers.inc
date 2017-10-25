<?php

function acct_mgr($name, $url, $description, $logo) {
    $x = new StdClass;
    $x->name = $name;
    $x->url = $url;
    $x->description = $description;
    $x->logo = $logo;
    return $x;
}

$account_managers = array(
    acct_mgr(
        "BAM!",
        "https://bam.boincstats.com/",
        tra("BAM! lets you create and manage BOINC project accounts, set preferences, join or create teams, connect your computers to projects, and much more."),
        "BAM.png"
    ),
    acct_mgr(
        "Gridrepublic",
        "http://www.gridrepublic.org/",
        tra("Gridrepublic lets you connect your computer to multiple projects, set preferences, and view your credit history."),
        "logo_gridrepublic_vc.gif"
    ),
);

?>
