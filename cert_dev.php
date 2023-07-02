<?php
require_once("../inc/util.inc");
require_once("../inc/cert.inc");

function get_other_projects_cpid($cpid) {
    $url = "http://boinc.netsoft-online.com/get_user.php?cpid=".$cpid;

    //echo "$url\n";
    // Check the cache for that URL
    //
    $cacheddata = get_cached_data(3600, $url);
    if ($cacheddata) {
        $remote = unserialize($cacheddata);
    } else {
        // Fetch the XML, use curl if fopen() is disallowed
        //
        if (ini_get('allow_url_fopen')) {
            $timeout = 3;
            $old_timeout = ini_set('default_socket_timeout', $timeout);
            $xml_object = null;
            $f = @file_get_contents($url);
            //echo $f;
            if ($f) {
                $xml_object = @simplexml_load_string($f);
            }
            ini_set('default_socket_timeout', $old_timeout);
            if (!$xml_object) {
                return null;
            }
        } else {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            $rawxml = @curl_exec($ch);
            $xml_object = null;
            if ($rawxml) {
                $xml_object = @simplexml_load_string($rawxml);
            }
            curl_close($ch);
            if (!$xml_object) {
                return null;
            }
        }

        // auto-cast the project list to an array of stdClass projects
        //
        $remote = @json_decode(json_encode((array)$xml_object))->project;
        if (!$remote) {
            return null;
        }
        if (count($remote) == 1) {
            $remote = array($remote);
        }

        // Cache the results
        set_cached_data(3600, serialize($remote), $url);
    }
    return $remote;
}

function show_form() {
    page_head("Certificate of Computation");
    echo "
        <p>
        <b>Science United users</b>:
        don't use this form.
        Instead, get your certificate
        <a href=https://scienceunited.org/su_cert.php>here</a>.
        <hr>
        You can get a certificate, suitable for framing,
        showing how much computing
        you've done across all BOINC projects.
        <p>
        You'll need your 'cross-project ID'.
        To find this:
        <ul>
        <li> Go to the web site of any BOINC project in which you participate.
            Log in.
        <li> Go to your 'home page' (on most projects,
            you can do this by clicking on your name in the upper right).
        <li> Under 'Computing', look for 'Cross-Project ID: xxx'.
            Copy and paste the xxx part into this form.
        </ul>
        <p>
        <form action=cert_dev.php>
        Cross-project ID: <input type=text name=cpid>
        <p><br>
        Name to show on certificate: <input name=name>
        <p>
        Show only projects where you have at least <input name=min_credit> credits.
        <p>
        <input type=submit>
        </form>
        <p>
        It should look something like this:
        <p>
        <img width=500 src=images/cert.png>
    ";
    page_tail();
}

function show_proj($p) {
    echo sprintf('<tr> <td>%s</td><td>%s</td><td>%s</td></tr>',
        $p->name,
        number_format($p->total_credit),
        date('j F Y', $p->create_time)
    );
}

function show_cert($cpid, $name, $min_credit) {
    $projects = get_other_projects_cpid($cpid);
    if (!$projects) {
        die("No projects; check cross-project ID");
    }
    $total_credit = 0;
    foreach ($projects as $p) {
        $total_credit += $p->total_credit;
    }

    $font = "\"Optima,Lucida Bright,Times New Roman\"";
    $border=8;

    $credit = credit_string($total_credit, false);

    echo "
        <table id=\"certificate\" width=1200 height=800 border=$border cellpadding=20>
        <tr><td>
        <center>
        <table width=1000 border=0>
        <tr><td style=\"background-position:center; background-repeat:no-repeat\" background=https://boinc.berkeley.edu/logo/boinc_fade_600.png>
        <center>
        <font style=\"font-size: 48\" face=$font>Certificate of Computation

        <font face=$font style=\"font-size:32\">
        <br><br>
        This certifies that
        <p>
        <font face=$font style=\"font-size:36\">
        $name

        <font face=$font style=\"font-size:18\">
        <p>
        has contributed $credit to the following projects:

        <center>
        <table width=80%>
        <tr><th align=left>Project</th><th align=left>Cobblestones</th><th align=left>Joined</th></tr>
    ";
    foreach ($projects as $p) {
        if ($p->total_credit<$min_credit) continue;
        show_proj($p);
    }
    echo "
        </table>
        </center>
    ";

    $today = gmdate('j F Y', time(0));

    echo "
        <p>
        <table width=1100><tr>
        <td width=20% align=left>
            <img width=\"150\" src=images/ucbseal.png>
        </td>
        <td align=center>
            <p>
            <img valign=center width=\"280\" src=images/dpa_signature.png>
            <br>
            <font face=$font style=\"font-size:18\">
            <p>David P. Anderson
            <br>Director, BOINC
            <br>https://boinc.berkeley.edu
            <br>
            $today
        </td>
        <td align=right width=20% valign=center>
            <img width=\"170\" src=images/NSF_4-Color_bitmap_Logo.png>
        </td>
        </tr>
        </table>
    ";
    echo "
    </td><tr></table>
    ";
    echo "
    </td><tr></table>
    ";
}

$cpid = get_str("cpid", true);

if ($cpid) {
    $min_credit = (double)get_str('min_credit');
    show_cert($cpid, strip_tags(get_str('name')), $min_credit);
    show_download_button();

    echo '<br>';
    $current_url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $cert_url = urlencode($current_url);
    // Share on Facebook
    $fb_url = 'https://www.facebook.com/sharer/sharer.php?u='.$cert_url;
    echo '<a href="'.$fb_url.' target="_blank">Share on Facebook</a>';
    echo '<br>';
    // Share on Twitter
    $twitter_text = urlencode("Check out my computation certificate from BOINC!");
    $tw_url = 'https://twitter.com/intent/tweet?url='.$cert_url.'&text='.$twitter_text;
    echo '<a href="'.$tw_url.'" target="_blank">Share on Twitter</a>';
} else {
    show_form();
}

?>
