<?php

require_once("docutil.php");
page_head("Notes on server security");
echo "
<p>
BOINC scheduling servers, data servers, and web servers
must be accessible via HTTP (port 80)
and therefore are potential targets for network attacks.
The possibility exists that BOINC software could
have vulnerabilities to such attacks.

<h3>Scheduling server</h3>
<p>
All network input to the scheduling server is read by calls of the form
<code>fgets(buf, 256, stdin);</code>
where buf is a 256-byte buffer.
There is no possibility of a buffer overrun from these calls.
In some cases data is copied out of the buffer to a second buffer;
this is done using functions
(<code>parse_str()</code>, <code>parse_attr()</code> and <code>strncpy()</code>)
that take a buffer-length argument,
so again there can be no buffer overruns.
<p>
The scheduling server doesn't run any secondary programs.
<p>
The scheduling server creates disk files in which it stores
request and reply messages.
These files have names of the form
PATH/sched_req_PID
where PATH is a compiled-in directory name (e.g. /tmp)
and PID is the server process ID.
There is no possibility of the server creating
executable files, or files in other directories.

<h3>File upload handler</h3>
<p>
The file upload handler parses its input
in the same way as the scheduling servers,
except for file data.
This data is read using fread() in fixed-sized increments.
So there are no buffer overruns.
<p>
The file upload handler reads and writes
files with names of the form BOINC_UPLOAD_DIR/filename,
where BOINC_UPLOAD_DIR is a compiled constant
for the directory where data files are stored.
'filename' is checked for '..' and such requests are ignored.
Hence files outside the directory cannot be read or written.
<p>
The only place where files are created (in copy_socket_to_file())
is a call 'fopen(path, \"wb\");'.
Hence no executable files or links are created.


";
page_tail();
?>
