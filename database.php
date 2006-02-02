<?php
require_once("docutil.php");
page_head("The BOINC database");
echo "

<p>
BOINC stores information in a MySQL database.
The main tables are:
";
list_start();
list_item("platform",
"Compilation targets of the core client and/or applications.");
list_item("app",
"Applications.
The core client is treated as an application; its name is 'core_client'.");
list_item("app_version",
"Versions of applications.
Each record includes a URL for
downloading the executable, and the MD5 checksum of the executable. ");
list_item("user",
"Describes users, including their email address, name, web
password, and authenticator. ");
list_item("host",
"Describes hosts. ");
list_item("workunit",
"Describes workunits.
The input file descriptions are stored in an XML document in a blob field.
Includes counts of the number of
results linked to this workunit, and the numbers that have been sent,
that have succeeded, and that have failed. ");
list_item("result",
"Describes results.
Includes a 'state' (whether the result has been dispatched).
Stores a number of items relevant only after the
result has been returned: CPU time, exit status, and validation status. ");
list_end();
echo "
<p>
The database is created by the
<a href=make_project.php>make_project</a> script.
Normally you don't have to directly examine or manipulate the database.
If you need to, you can use the MySQL command-line interpreter
or BOINC's <a href=html_ops.php>administrative web interface</a>.
";
page_tail();
?>
