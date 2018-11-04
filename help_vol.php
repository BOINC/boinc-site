<?php

require_once("../inc/util.inc");
require_once("help_funcs.php");
require_once("help_db.php");

$volid = get_int('volid');

$vol = vol_lookup($volid);
if (!$vol || $vol->hide) {
    error_page("No such volunteer");
}

function show_info($vol) {
    $x = "Country: $vol->country\n";
    if ($vol->availability) {
        $x .= "<br>Usual hours: $vol->availability";
    }
    if ($vol->specialties) {
        $x .= "<br>Specialties: $vol->specialties";
    }
    if ($vol->projects) {
        $x .= "<br>Projects: $vol->projects";
    }
    if ($vol->lang2) {
        $x .= "<br>Primary language: $vol->lang1";
        $x .= "<br>Secondary language: $vol->lang2";
    }
    $x .= "<p>";
    return $x;
}

function live_contact($vol) {
    $skypeid = $vol->skypeid;
    echo "
    <script>
        if (navigator.userAgent.indexOf('MSIE') != -1) {
            document.write(
                \"<br>If requested, please enable ActiveX controls for this site.<br>\"
            );
        }
    </script>
    <p>
    <script type=\"text/javascript\" src=\"http://download.skype.com/share/skypebuttons/js/skypeCheck.js\"></script>
    ";
    if ($vol->voice_ok) {
        echo "<a href=skype:$skypeid?call onclick=\"return skypeCheck();\"><img align=top border=0 src=images/help/phone_icon_green.gif> Call (voice)</a>
        ";
    }
    if ($vol->text_ok) {
        echo "<p><a href=skype:$skypeid?chat onclick=\"return skypeCheck();\"><img align=top border=0 src=images/help/skype_chat_icon.png> Chat (text)</a>
        ";
    }

    echo " <p>";
    help_warning();
    echo " <hr> ";
}

function show_rating($vol, $rating) {
    echo "
        If $vol->name has helped you, please give us your feedback:
        <form action=help_vol.php>
        <input type=hidden name=volid value=\"$vol->id\">
    ";
    start_table();
    row2(
        "Rating<br><span class=note>Would you recommend $vol->name to people seeking help with BOINC?</span>",
        star_select("rating", $rating->rating)
    );
    row2("Comments", textarea("comment", $rating->comment));
    row2("", "<input type=submit name=rate value=OK>");
    end_table();
    echo "
    </form>
    ";
}

function email_contact($vol) {
    echo "
        <form action=help_vol.php>
        <input type=hidden name=volid value=\"$vol->id\">
    ";
    start_table();
    row2(
        "Your email address",
        input("email_addr", "")
    );
    row2("Subject<br><small>Include 'BOINC' in the subject so $vol->name will know it's not spam</small>", input("subject", ""));
    row2("Message<br><small>Please include a detailed description of the problem you're experiencing.  Include the contents of BOINC's event log if relevant.</small>",
        textarea("message", "")
    );
    row2("", "<input type=submit name=send_email value=OK>");
    end_table();
    echo "</form>
    ";
}

$send_email = get_str('send_email', true);
$rate = get_str('rate', true);
//session_set_cookie_params(86400*365);
//@session_start();
//$uid = @session_id();
$uid = false;

if ($send_email) {
    $volid = $_GET['volid'];
    $subject = stripslashes($_GET['subject']);
    $vol = vol_lookup($volid);
    if (!$vol || $vol->hide) {
        error_page("No such volunteer $volid");
    }
    $msg = stripslashes($_GET['message']);
    if (!$msg) {
        error_page("You must supply a message");
    }
    $body = "The following message was sent by a BOINC Help user.\n";
    $email_addr = $_GET['email_addr'];
    if (!is_valid_email_addr($email_addr)) {
        error_page("You must specify a valid email address");
    }
    $reply = "\r\nreply-to: $email_addr";
    $body .= "\n\n";
    $body .= $msg;
    if (!$subject) $subject = "BOINC Help request";
    mail($vol->email_addr, $subject, $body, "From: BOINC".$reply);
    page_head("Message sent");
    echo "Your message has been sent to $vol->name";
    page_tail();
} else if ($rate) {
    $volid = $_GET['volid'];
    $vol = vol_lookup($volid);
    if (!$vol) {
        error_page("No such volunteer $volid");
    }
    $x = get_int('rating', true);
    if ($x===null) {
        error_page("You must supply a rating (0-5 stars)");
    }
    $rating = (int) $x;
    if ($rating < 0 || $rating > 5) {
        error_page("bad rating");
    }
    $comment = stripslashes($_GET['comment']);
    $r = null;
    $r->volunteerid = $volid;
    $r->rating = $rating;
    $r->timestamp = time();
    $r->comment = $comment;
    $r->auth = $uid;
    if ($uid) {
        $oldr = rating_lookup($r);
        if ($oldr) {
            $retval = rating_update($r);
            if ($retval) vol_update_rating($vol, $oldr, $r);
        } else {
            $retval = rating_insert($r);
            if ($retval) vol_new_rating($vol, $rating);
        }
    } else {
        $retval = rating_insert($r);
        if ($retval) vol_new_rating($vol, $rating);
    }
    if (!$retval) {
        echo mysql_error();
        error_page("database error");
    }
    page_head("Feedback recorded");
    echo "Your feedback has been recorded.  Thanks.
        <p>
        <a href=help.php>Return to BOINC Help</a>.
    ";
    page_tail();
} else {
    page_head("Help Volunteer: $vol->name");
    skype_script();
    echo show_info($vol);
if (false) {
    $status = skype_status($vol->skypeid);
    if ($status != $vol->status) {
        $vol->status = $status;
        $vol->last_check = time();
        if (online($vol->status)) {
            $vol->last_online = time();
        }
        vol_update_status($vol);
    }
    $image = button_image($status);
    echo "
        <script type=\"text/javascript\" src=\"http://download.skype.com/share/skypebuttons/js/skypeCheck.js\"></script>
        <img src=images/help/$image><p>
    ";
    echo "<table class=box cellpadding=8 width=100%><tr><td width=40%>";
    if (online($status)) {
        live_contact($vol);
    }
}
    if ($vol->voice_ok || $vol->text_ok) {
        echo "<h2>Contact $vol->name by Skype</h2>\n";
        skype_call_button($vol);
    }
    echo "<p> <h2>Contact $vol->name by email</h2>\n";
    email_contact($vol);
    echo "</td></tr></table><p>\n";
    echo "<table class=box cellpadding=8 width=100%><tr><td>";
    $rating = null;
    if ($uid) {
        $rating = rating_vol_auth($vol->id, $uid);
    }
    if (!$rating) {
        $rating = new StdClass;
        $rating->rating = -1;
        $rating->comment = "";
    }
    show_rating($vol, $rating);
    echo "</td></tr></table>\n";

    page_tail();
}
?>
