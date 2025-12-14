<?php

// SPECIAL BOINC WEB SITE VERSION
// When you change this, copy to projects/dev/html/user/forum_index.php
// (and make it read-only to avoid overwrite)

require_once('../inc/util.inc');
require_once('../inc/forum.inc');

$user = get_logged_in_user(false);
BoincForumPrefs::lookup($user);

// Process request to mark all posts as read
//
if ((get_int("read", true) == 1)) {
    if ($user) {
        check_tokens($user->authenticator);
        $now = time();
        $user->prefs->update("mark_as_read_timestamp=$now");
        Header("Location: ".get_str("return", true));
    }
}

function show_forum_summary($forum, $i) {
    switch ($forum->parent_type) {
    case 0:
        $t = $forum->title;
        $d = $forum->description;
        break;
    case 1:
        $team = BoincTeam::lookup_id($forum->category);
        $t = $forum->title;
        if (!strlen($t)) $t = $team->name;
        $d = $forum->description;
        if (!strlen($d)) $d = tra("Discussion among members of %1", $team->name);
        break;
    }
    echo "
        <tr>
        <td>
            <a href=\"forum_forum.php?id=$forum->id\">$t</a>
            <br><small>$d</small>
        </td>
        <td>$forum->threads</td>
        <td>$forum->posts</td>
        <td>".time_diff_str($forum->timestamp, time())."</td>
    </tr>";
}

page_head("BOINC Message boards");

show_forum_header($user);

echo "
<p>
    <ul>
    <li> These messages boards are for discussion of BOINC,
    not projects (such as Einstein@home, World Community Grid, and so on).
    To discuss a project, please use its message boards.
    <li> To post messages, you must
    <a href=signup.php>create an account</a>.
    <li>
    These message boards are frequented by volunteers.
    It's likely (but not guaranteed) that they'll be able
    to respond to your questions or suggestions.
    <li>
    See <a href=https://github.com/BOINC/boinc/wiki/BOINC-Help>other ways of getting help</a>.
    </ul>
";


$categories = BoincCategory::enum("is_helpdesk=0 order by orderID");
$first = true;
foreach ($categories as $category) {
    if ($first) {
        $first = false;
        echo "<p>";
        show_forum_title($category, NULL, NULL);
        echo "<p>";
        show_mark_as_read_button($user);
        start_table('table-striped');
        row_heading_array(array(
            tra("Topic"),
            tra("Threads"),
            tra("Posts"),
            tra("Last post")
        ));
    }
    if (strlen($category->name)) {
        echo '
            <tr>
            <th class="info" colspan="4">'.$category->name.'</th>
            </tr>
        ';
    }
    $forums = BoincForum::enum("parent_type=0 and category=$category->id order by orderID");
    $i = 0;
    foreach ($forums as $forum) {
        show_forum_summary($forum, $i++);
    }
}
end_table();

if ($user) {
    $subs = BoincSubscription::enum("userid=$user->id");
    if (count($subs)) {
        echo "<p><h3>".tra("Subscribed threads")."</h3><p>";
        show_thread_and_context_header();
        $i = 0;
        foreach ($subs as $sub) {
            $thread = BoincThread::lookup_id($sub->threadid);
            if (!$thread) {
                BoincSubscription::delete($user->id, $sub->threadid);
                continue;
            }
            if ($thread->hidden) continue;
            show_thread_and_context($thread, $user, $i++);
        }
        end_table();
    }
}

page_tail();
BoincForumLogging::cleanup();

?>
