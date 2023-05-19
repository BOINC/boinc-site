<?php

// upload files to dl/

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
    $tmp_name = $f['tmp_name'];
    $orig_name = $f['name'];
    if (!$orig_name) error_page('no file');
    if (!is_uploaded_file($tmp_name)) error_page('not uploaded file');
    $path = "dl/$orig_name";
    if (file_exists($path)) error_page('file exists');
    if (!move_uploaded_file($tmp_name, $path)) error_page("can't move file");
    page_head("File uploaded");
    page_tail();
}

$user = get_logged_in_user();
check_login($user);
if (post_str('submit', true)) {
    action();
} else {
    form();
}

?>
