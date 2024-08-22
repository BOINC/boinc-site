<?php

// upload Linux installers or symstore dir
// filename is of the form
//      repo-alpha-jammy.tar.gz
// or
//      symstore.tar.gz
//
// installer action: in dl/linux/alpha/jammy/:
// - create jammy/ if needed
// - delete directory contents
// - move the file there
// - tar -xf file
// symstore action:
//  - remove symstore.bak
//  - rename symstore to symstore.bak
//  - save file (in html/user)
//  - tar -xf file
//
// You can access this via a web interface:
// https://boinc.berkeley.edu/upload.php
// or using curl; request must include auth cookie
// e.g.:
// curl -F 'upload_file=/path/to/file' https://boinc.berkeley.edu/upload.php --cookie "auth=xxx"

require_once("../inc/util.inc");

function check_login($user) {
    $ids = parse_config(get_config(), '<upload_ids>');
    $ids = explode(' ', $ids);
    if (!in_array($user->id, $ids)) {
        return false;
    }
    return true;
}

function form() {
    page_head('Upload file');
    form_start('upload.php', 'POST', 'ENCTYPE="multipart/form-data"');
    form_general('File to upload:', '<input name=upload_file type=file>');
    form_submit('Upload', 'name=submit value=on');
    form_end();
    show_button("upload.php?action=zip", "Create symstore.tar.gz");
    page_tail();
}

function action() {
    $f = $_FILES['upload_file'];
    $orig_name = $f['name'];
    $tmp_name = $f['tmp_name'];
    if (!$orig_name) {
        http_response_code(400);
        die('no file');
    }
    if (!is_uploaded_file($tmp_name)) {
        http_response_code(400);
        die('not uploaded file');
    }

    $x = explode('.', $orig_name);
    if (count($x)!=3 || $x[1]!='tar' || $x[2]!= 'gz') {
        http_response_code(400);
        die('bad file type');
    }
    $y = explode('-', $x[0]);
    if (count($y)==3 && $y[0]=='repo') {
        upload_installer($y, $orig_name, $tmp_name);
    } else if ($orig_name == 'symstore.tar.gz') {
        upload_symstore($tmp_name);
    } else {
        http_response_code(400);
        die('bad file name');
    }
}

function upload_symstore($tmp_name) {
    $dir = '/home/boincadm/boinc-site';
    system("rm -r $dir/symstore.bak");
    system("mv $dir/symstore $dir/symstore.bak", $retval);
    if ($retval) {
        die("mv failed\n");
    }
    if (!move_uploaded_file($tmp_name, "$dir/symstore.tar.gz")) {
        die("can't move file");
    }
    $cmd = "cd $dir; tar -xf symstore.tar.gz";
    //echo "tar command: $cmd\n";
    system($cmd);
    echo "new symstore uploaded\n";
}

function upload_installer($y, $orig_name, $tmp_name) {
    if (!in_array($y[1], ['alpha', 'stable', 'nightly'])) {
        http_response_code(400);
        die('bad file name');
    }

    $dir = sprintf('dl/linux/%s/%s', $y[1], $y[2]);

    if (preg_match('/\s/', $dir)) {
        http_response_code(400);
        die('filename has space');
    }

    // don't screw this up or you'll delete everything

    $cmd = "rm -r $dir";
    //echo "cleanup command: $cmd\n";
    system($cmd);

    mkdir($dir);

    $path = "$dir/$orig_name";
    if (!move_uploaded_file($tmp_name, $path)) die("can't move file");

    $cmd = "cd $dir; tar -xf $orig_name";
    //echo "tar command: $cmd\n";
    system($cmd);

    echo "Installer uploaded to $dir.\n";
}

if (0) {
    echo "POST: "; print_r($_POST);
    echo "<br>";
    echo "COOKIE: "; print_r($_COOKIE);
    echo "<br>";
    echo "FILES: "; print_r($_FILES);
    echo "<br>";
}

$user = get_logged_in_user(false);
if (!$user || !check_login($user)) {
    http_response_code(401);
    die('Not authorized');
}
$action = get_str('action', true);
if ($action == 'zip') {
    $cmd = 'cd /home/boincadm/boinc-site; tar -czvf symstore.tar.gz symstore';
    system($cmd, $retval);
    if ($retval) {
        die("tar failed: $retval\n");
    }
    echo "Created symstore.tar.gz\n";
} else {
    if (count($_FILES)>0) {
        action();
    } else {
        form();
    }
}
?>
