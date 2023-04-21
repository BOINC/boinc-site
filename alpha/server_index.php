<?php

$server = true;

require_once("../inc/db.inc");
require_once("../inc/util.inc");
require_once("../inc/news.inc");
require_once("../inc/cache.inc");
require_once("../inc/uotd.inc");
require_once("../inc/sanitize_html.inc");
require_once("../inc/translation.inc");
require_once("../project/project.inc");
require_once("../project/project_news.inc");

$server = true;
require_once("test_util.inc");

$stopped = web_stopped();
$rssname = PROJECT . " RSS 2.0" ;
$rsslink = URL_BASE . "rss_main.php";

page_head("BOINC Server Test");
if (!$stopped) {
    get_logged_in_user(false);
    show_login_info();
}
echo "
    <p>
    BOINC Server Test allows projects
    to test new versions of BOINC server software,
    thereby increasing the reliability of releases.
";
start_table("");
$cv = current_version();
$fl = fraction_left($cv);
$pd = number_format(100*(1-$fl), 0);
row2("Version being tested", $cv[0]);
row2("Testing is", "$pd% complete");
end_table();
echo "
    <h3> <a href=https://github.com/BOINC/boinc/wiki/ServerTestInstructions>Instructions</a></h3>
    <dd> How to be a server tester</dd>
    <h3> <a href=test_matrix.php?server=1>Test cases</a></h3>
    <dd> The set of test procedures</dd>
    <h3><a href=test_form.php?server=1>Report test results</a></h3>
    <dd> Submit test results for a particular platform and version</dd>
    <h3> <a href=test_summary.php?server=1>View results</a></h3>
    <dd> See test results for recent versions</dd>
    <h3> <a href=top_testers.php?server=1>Top testers</a></h3>
    <dd> See who's reported test results in the last 30 days</dd>
    <hr>
    <a href=create_account_form.php>Create account</a> |
    <a href=home.php>Your account</a>
    <p>
    <a href=https://boinc.berkeley.edu/><img align=middle border=0 src=img/pb_boinc.gif alt=\"BOINC Logo\"></a>
";
page_tail();

?>
