#!/usr/bin/php
<?php

// generate .po template for the BOINC web site.
//

$date = strftime('%Y-%m-%d %H:%M %Z');

$header = <<<HDR
# BOINC web translation
# Copyright (C) 2019 University of California
#
# This file is distributed under the same license as BOINC.
#
# FileID  : \$Id\$
#
msgid ""
msgstr ""
"Project-Id-Version: BOINC \$Id\$\\n"
"POT-Creation-Date: $date\\n"
"Last-Translator: Generated automatically from source files\\n"
"MIME-Version: 1.0\\n"
"Content-Type: text/plain; charset=utf-8\\n"
"Content-Transfer-Encoding: 8bit\\n"
"X-Poedit-SourceCharset: utf-8\\n"

msgid "LANG_NAME_NATIVE"
msgstr "English"

msgid "LANG_NAME_INTERNATIONAL"
msgstr "English"


HDR;

$files = "index.php download.php download_util.inc help.php help_funcs.inc help_lang.php projects.inc projects.php";

$pipe = popen("xgettext --omit-header --add-comments -o - --keyword=tra -L PHP $files", "r");

$out = fopen("BOINC-Web.pot", "w");

fwrite($out, $header);
stream_copy_to_stream($pipe, $out);

fclose($pipe);
fclose($out);

echo "Created BOINC-Web.pot.  If it's OK, move it to ../locale/templates and commit\n";
?>
