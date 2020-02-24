<?php

$db_passwd = trim(file_get_contents("db_passwd"));
$link = @mysqli_connect("localhost", "boincadm", $db_passwd, "support");
//mysqli_select_db("support");

function rating_insert($r) {
    global $link;
    $auth = mysqli_real_escape_string($link, $r->auth);
    $comment = mysqli_real_escape_string($link, $r->comment);
    $query = "insert into rating (volunteerid, rating, timestamp, auth, comment) values ($r->volunteerid, $r->rating, $r->timestamp, '$auth', '$comment')";
    return mysqli_query($link, $query);
}

function rating_lookup($r) {
    global $link;
    $auth = mysqli_real_escape_string($link, $r->auth);
    $query = "select * from rating where volunteerid=$r->volunteerid and auth='$auth'";
    $result = mysqli_query($link, $query);
    $rating = mysqli_fetch_object($result);
    mysqli_free_result($result);
    return $rating;
}

function rating_update($r) {
    global $link;
    $auth = mysqli_real_escape_string($link, $r->auth);
    $comment = mysqli_real_escape_string($link, $r->comment);
    $query = "update rating set rating=$r->rating, timestamp=$r->timestamp, comment='$comment' where volunteerid=$r->volunteerid and auth='$auth'";
    return mysqli_query($link, $query);
}

function ratings_get($volid) {
    global $link;
    $ratings = array();
    $volid = mysqli_real_escape_string($link, $volid);
    $query = "select * from rating where volunteerid=$volid order by timestamp desc";
    $result = mysqli_query($link, $query);
    while ($r = mysqli_fetch_object($result)) {
        $ratings[] = $r;
    }
    mysqli_free_result($result);
    return $ratings;
}

function rating_vol_auth($volid, $auth) {
    global $link;
    $auth = mysqli_real_escape_string($link, $auth);
    $volid = mysqli_real_escape_string($link, $volid);
    $result = mysqli_query($link, "select * from rating where volunteerid=$volid and auth='$auth'");
    $rating = mysqli_fetch_object($result);
    mysqli_free_result($result);
    return $rating;
}

function vol_insert($vol) {
    global $link;
    $password = mysqli_real_escape_string($link, $vol->password);
    $email_addr = mysqli_real_escape_string($link, $vol->email_addr);
    $country = mysqli_real_escape_string($link, $vol->country);
    $skypeid = mysqli_real_escape_string($link, $vol->skypeid);
    $lang1 = mysqli_real_escape_string($link, $vol->lang1);
    $lang2 = mysqli_real_escape_string($link, $vol->lang2);
    $specialties = mysqli_real_escape_string($link, $vol->specialties);
    $projects = mysqli_real_escape_string($link, $vol->projects);
    $availability = mysqli_real_escape_string($link, $vol->availability);

    $query = "insert into volunteer (id, create_time, name, password, email_addr, country, skypeid, lang1, lang2, specialties, projects, availability, voice_ok, text_ok, timezone) values (0, $vol->create_time, '$vol->name', '$vol->password', '$vol->email_addr', '$vol->country', '$vol->skypeid', '$vol->lang1', '$vol->lang2', '$vol->specialties', '$vol->projects', '$vol->availability', $vol->voice_ok, $vol->text_ok, $vol->timezone)";
    return mysqli_query($link, $query);
}

function vol_update($vol) {
    global $link;
    $password = mysqli_real_escape_string($link, $vol->password);
    $email_addr = mysqli_real_escape_string($link, $vol->email_addr);
    $country = mysqli_real_escape_string($link, $vol->country);
    $skypeid = mysqli_real_escape_string($link, $vol->skypeid);
    $lang1 = mysqli_real_escape_string($link, $vol->lang1);
    $lang2 = mysqli_real_escape_string($link, $vol->lang2);
    $specialties = mysqli_real_escape_string($link, $vol->specialties);
    $projects = mysqli_real_escape_string($link, $vol->projects);
    $availability = mysqli_real_escape_string($link, $vol->availability);

    $query = "update volunteer set name='$vol->name', password='$vol->password', email_addr='$vol->email_addr', country='$vol->country', skypeid='$vol->skypeid', lang1='$vol->lang1', lang2='$vol->lang2', specialties='$vol->specialties', projects='$vol->projects', availability='$availability', voice_ok=$vol->voice_ok, text_ok=$vol->text_ok, timezone=$vol->timezone, hide=$vol->hide where id=$vol->id";
    return mysqli_query($link, $query);
}

function vol_update_rating($vol, $old_rating, $rating) {
    global $link;
    $diff = $rating->rating - $old_rating->rating;
    $query = "update volunteer set rating_sum=rating_sum+$diff where id=$vol->id";
    return mysqli_query($link, $query);
}

function vol_new_rating($vol, $rating) {
    global $link;
    $query = "update volunteer set nratings=nratings+1, rating_sum=rating_sum+$rating where id=$vol->id";
    return mysqli_query($link, $query);
}

function vol_update_status($vol) {
    global $link;
    $query = "update volunteer set last_check=$vol->last_check, last_online=$vol->last_online, status=$vol->status where id=$vol->id";
    return mysqli_query($link, $query);
}

function get_vols($lang) {
    global $link;
    $vols = array();
    $result = mysqli_query($link, "select * from volunteer where hide=0");
    while ($vol = mysqli_fetch_object($result)) {
        if ($lang) {
            if ($vol->lang1 == $lang || $vol->lang2 == $lang) {
                $vols[] = $vol;
            }
        } else {
            $vols[] = $vol;
        }
    }
    mysqli_free_result($result);
    return $vols;
}

function vol_lookup($id) {
    global $link;
    $result = mysqli_query($link, "select * from volunteer where id=$id");
    if (!$result) return null;
    $vol = mysqli_fetch_object($result);
    mysqli_free_result($result);
    return $vol;
}

function vol_lookup_email($email) {
    global $link;
    $email = mysqli_real_escape_string($link, $email);
    $result = mysqli_query($link, "select * from volunteer where email_addr='$email'");
    if (!$result) return null;
    $vol = mysqli_fetch_object($result);
    mysqli_free_result($result);
    return $vol;
}

function vol_lookup_name($name) {
    global $link;
    $name = mysqli_real_escape_string($link, $name);
    $result = mysqli_query($link, "select * from volunteer where name='$name'");
    if (!$result) return null;
    $vol = mysqli_fetch_object($result);
    mysqli_free_result($result);
    return $vol;
}

function get_languages() {
    global $link;
    $langs = array();
    $result = mysqli_query($link, "select lang1 from volunteer");
    echo mysqli_error();
    echo "foo";
    while ($lang = mysqli_fetch_object($result)) {
        $langs[] = $lang->lang1;
    }
    mysqli_free_result($result);
    $result = mysqli_query($link, "select lang2 from volunteer where lang2<>''");
    while ($lang = mysqli_fetch_object($result)) {
        $langs[] = $lang->lang2;
    }
    mysqli_free_result($result);
    $temp = array_unique($langs);
    $langs = array_values($temp);
    return $langs;
}

function get_languages2() {
    global $link;
    $langs = array();
    $result = mysqli_query($link, "select lang1 from volunteer where hide=0");
    while ($lang = mysqli_fetch_object($result)) {
        if (array_key_exists($lang->lang1, $langs)) {
            $langs[$lang->lang1]++;
        } else {
            $langs[$lang->lang1] = 1;
        }

    }
    mysqli_free_result($result);
    $result = mysqli_query($link, "select lang2 from volunteer where lang2<>'' and hide=0");
    while ($lang = mysqli_fetch_object($result)) {
        if (array_key_exists($lang->lang2, $langs)) {
            $langs[$lang->lang2]++;
        } else {
            $langs[$lang->lang2] = 1;
        }
    }
    mysqli_free_result($result);
    arsort($langs);
    return $langs;
}

?>
