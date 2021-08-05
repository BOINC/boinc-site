<?php

$server = false;

require_once("../inc/db.inc");
require_once("../inc/util.inc");
require_once("../inc/news.inc");
require_once("../inc/cache.inc");
require_once("../inc/uotd.inc");
require_once("../inc/sanitize_html.inc");
require_once("../inc/translation.inc");
require_once("../project/project.inc");
require_once("../project/project_news.inc");
require_once("test_util.inc");

$stopped = web_stopped();
$rssname = PROJECT . " RSS 2.0" ;
$rsslink = URL_BASE . "rss_main.php";

function platform_list($v) {
    $x = "";
    foreach ($v[2] as $p) {
        $x .= $p[1];
        $x .= ", ";
    }
    return substr($x, 0, -2);
}

page_head(PROJECT);
if (!$stopped) {
    get_logged_in_user(false);
    show_login_info();
}
echo "
    <p>
    BOINC Alpha Test allows volunteers
    to test new versions of BOINC client software
    on a wide range of computers,
    thereby increasing the reliability of software released to the public.
";
start_table("table-striped");
$cv = current_version();
$fl = fraction_left($cv);
$pd = number_format(100*(1-$fl), 0);
row2("Version being tested", $cv[0]);
row2("Platforms", platform_list($cv));
row2("Testing is", "$pd% complete");
end_table();
echo "
    <h3> <a href=https://boinc.berkeley.edu/trac/wiki/AlphaInstructions>Instructions</a></h3>
    <dd> How to be an alpha tester</dd>
    <h3> <a href=test_matrix.php>Test cases</a></h3>
    <dd> The set of test procedures</dd>
    <h3><a href=test_form.php>Report test results</a></h3>
    <dd> Submit test results for a particular platform and version</dd>
    <h3> <a href=test_summary.php>View results</a></h3>
    <dd> See test results for recent versions</dd>
    <h3> <a href=top_testers.php>Top testers</a></h3>
    <dd> See who's reported test results in the last 30 days</dd>
    <hr>
    <h3> <a href=https://boinc.berkeley.edu/trac/wiki/ReportBugs>Report bugs</a></h3>
    <dd> Help resolve bugs in the test or release version </dd>
    <h3> <a href=https://boinc.berkeley.edu/dev/sim_web.php>The BOINC Client Emulator</a></h3>
    <dd> A tool for studying and reporting scheduling issues </dd>
    <p>
    <hr>
    <a href=create_account_form.php>Create account</a> |
    <a href=home.php>Your account</a>
    <p>
    <a href=https://boinc.berkeley.edu/><img align=middle border=0 src=img/pb_boinc.gif alt=\"BOINC Logo\"></a>
";
page_tail();

?>
