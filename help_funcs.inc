<?php

// info is at: http://www.skype.com/share/buttons/advanced.html
// and https://developer.skype.com/Docs/Web?action=AttachFile&do=get&target=2006-06-06skypewebdevnotes.pdf
// and http://cvs.drupal.org/viewcvs/drupal/contributions/modules/skypesupport/skypesupport.inc?rev=1.2

function skype_status($skypeid) {
    $url = "http://mystatus.skype.com/$skypeid.xml";
    $xml = @file_get_contents($url);
    $x = strstr($xml, "NUM\">");
    return (int)substr($x, 5, 1);
}

function button_image($status) {
    if ($status==1) return "offline.png";
    if ($status==2) return "online.png";
    if ($status==7) return "skypeme.png";
    if ($status==3) return "away.png";
    if ($status==4) return "notavailable.png";
    if ($status==5) return "donotdisturb.png";
    if ($status==6) return "offline.png";
    return "offline.png";
}

function status_string($status) {
    if ($status==1) return "Offline";
    if ($status==2) return "<font color=00aa00><b>Online</b></font>";
    if ($status==7) return "<font color=00aa00><b>Skype Me!</b></font>";
    if ($status==3) return "Away";
    if ($status==4) return "Not available";
    if ($status==5) return "Do not disturb";
    if ($status==6) return "Offline";
    return "Unknown";
}

function online($status) {
    if ($status == 2) return true;
    if ($status == 7) return true;
    return false;
}

//echo skype_status("rare44");
//<!--
//Skype 'My status' button
//http://www.skype.com/go/skypebuttons
//-->
//<script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>
//<a href="skype:rare44?call"><img src="http://mystatus.skype.com/balloon/rare44" style="border: none;" width="150" height="60" alt="My status" /></a>

// NOTE: nothing above works anymore; Skype turned off their mystatus API.
// Instead we now have the following

function skype_script() {
    echo '<script type="text/javascript" src="https://secure.skypeassets.com/i/scom/js/skype-uri.js"></script>
';
}

function skype_call_button($vol) {
    show_button("skype:$vol->skypeid?chat", "Skype with $vol->name", null, 'btn-lg btn-info');
    return;

    // the following doesn't seem to work anymore (10/2024)

    if ($vol->text_ok && $vol->voice_ok) {
        $x = "dropdown";
    } else if ($vol->voice_ok) {
        $x = "call";
    } else {
        $x = "chat";
    }
    echo "
        <div id=\"SkypeButton_Call_".$vol->skypeid."_1\">
          <script type=\"text/javascript\">
            Skype.ui({
              \"name\": \"$x\",
              \"element\": \"SkypeButton_Call_".$vol->skypeid."_1\",
              \"participants\": [\"".$vol->skypeid."\"],
              \"imageSize\": 24
            });
          </script>
        </div>
    ";
}

function input($name, $val) {
    return "<input name=$name size=40 value=\"$val\">";
}

function password($name, $val) {
    return "<input type=password name=$name value=\"$val\">";
}

function textarea($name, $val) {
    return "<textarea rows=4 cols=40 name=$name>$val</textarea>\n";
}

function checkbox($name, $val) {
    if ($val) {
        return "<input type=checkbox name=$name checked>";
    } else {
        return "<input type=checkbox name=$name>";
    }
}

function yesno($name, $val) {
    if ($val) {
        return "
            yes<input type=radio name=$name value=1 checked>
            no<input type=radio name=$name value=0>
        ";
    } else {
        return "
            yes<input type=radio name=$name value=1>
            no<input type=radio name=$name value=0 checked>
        ";
    }
}

function star_select($name, $val) {
    $x = "";
    for ($i=5; $i>=0; $i--) {
        $text = "";
        if ($i==0) $text="No";
        if ($i==5) $text="Yes";

        $checked = ($val==$i)?"checked":"";
        $x .= "
            <br><input name=$name value=$i type=radio $checked>
            <img src=images/help/stars-$i-0.gif> $text
        ";
    }
    return $x;
}

function help_warning() {
    echo "
        <ul>
        <span class=emphasize>
        <li>
        "
        . tra("BOINC helpers are unpaid volunteers.  Their advice is not endorsed by BOINC.")
        ." <li>"
        .tra(
            "%1 Never %2 give email address or password information to BOINC helpers.",
            "<span class=emphasize2>",
            "</span>"
        )
        ."</span>
        </ul>
    ";
}

?>
