<?php

// upload Linux installers
// filename is of the form repo-alpha-jammy.tar.gz
// action: in dl/linux/alpha/jammy/:
// - create jammy/ if needed
// - delete directory contents
// - move the file there
// - tar -xf file
// request must include auth cookie
//
// e.g.:
// curl -F 'upload_file=@/path/to/file' https://boinc.berkeley.edu/upload.php --cookie "auth=xxx"

require_once("../inc/util.inc");

function check_login($user) {
    $ids = parse_config(get_config(), '<upload_ids>');
    $ids = explode(' ', $ids);
    if (!in_array($user->id, $ids)) {
        error_page('not authorized');
    }
}

function form() {
    page_head('Upload installer file');
    form_start('upload.php', 'POST', 'ENCTYPE="multipart/form-data"');
    form_general('File to upload:', '<input name=upload_file type=file>');
    form_submit('Upload', 'name=submit value=on');
    form_end();
    page_tail();
}

function action() {
    $f = $_FILES['upload_file'];
    $orig_name = $f['name'];
    $tmp_name = $f['tmp_name'];
    if (!$orig_name) die('no file');
    if (!is_uploaded_file($tmp_name)) die('not uploaded file');

    $x = explode('.', $orig_name);
    if (count($x)!=3 || $x[1]!='tar' || $x[2]!= 'gz') {
        die('bad file type');
    }
    $y = explode('-', $x[0]);
    if (count($y)!=3 || $y[0]!='repo') die('bad file name');
    if ($y[1]!='alpha' && $y[1]!='stable') die('bad file name');

    $dir = sprintf('dl/linux/%s/%s', $y[1], $y[2]);

    if (preg_match('/\s/', $dir)) die('filename has space');

    @mkdir($dir);

    // don't screw this up or you'll delete everything

    $cmd = "rm $dir/*";
    echo "cleanup command: $cmd\n";
    system($cmd);

    $path = "$dir/$orig_name";
    if (!move_uploaded_file($tmp_name, $path)) die("can't move file");

    $cmd = "cd $dir; tar -xf $orig_name";
    echo "tar command: $cmd\n";
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

$user = get_logged_in_user();
check_login($user);
if (count($_FILES)>0) {
    action();
} else {
    form();
}

?>
