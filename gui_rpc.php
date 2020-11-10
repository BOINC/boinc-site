<?php
require_once("../inc/util.inc");
page_head("Accessing BOINC on Linux");
text_start();
echo "
<p>
There are two ways to control BOINC on Linux:
<ul>
<li> <a href=https://boinc.berkeley.edu/wiki/The_BOINC_Manager><code>boincmgr</code></a>: a GUI; also known as the BOINC Manager
<li> <a href=https://boinc.berkeley.edu/wiki/Boinccmd_tool><code>boinccmd</code></a>: a command-line tool
</ul>
<p>
Each of these requires a key to communicate with the BOINC client.
The client creates this key and stores it in a file
<code>gui_rpc_auth.cfg</code> in the BOINC data directory.

<p>
To locate the key file, <code>boincmgr</code> and <code>boinccmd</code>
do the following:
<ol>
<li> <code>boincmgr</code> looks in a directory specified with the <code>-datadir</code> command-line option (<code>boinccmd</code> doesn't have this option).
<li> They look in the current directory.
<li>
They check for a configuration file <code>/etc/boinc-client/config.properties</code>
and look for a line of the form
<pre>
data_dir=PATH
</pre>
This tells them where the data directory is.
If you install BOINC using a package manager, this is set up automatically.
<li> They look in <code>/var/lib/boinc-client</code>.
</ol>

If none of these locates <code>gui_rpc_auth.cfg</code> you get an error message -
which is probably why you're here.
To fix this, either create a configuration file as above,
or run the program in the BOINC data directory,
or use the <code>-datadir</code> option in the Manager.

";
text_end();
page_tail();
?>
