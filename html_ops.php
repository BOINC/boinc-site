<?php
require_once("docutil.php");

page_head("Administrative web interface");

echo "
    BOINC's administrative web interface provides interfaces for
    <ul>
    <li> Browsing the database
    <li> <a href=profile_screen.php>Screening user profiles</a>
    <li> Viewing recent results
    <li> Browsing stripcharts
    <li> Browsing log files
    <li> Creating user accounts
    </ul>
";
page_tail();
?>
