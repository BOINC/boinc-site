<?php

// users are directed here if read_gui_rpc_passwd() can't locate
// or can't read the passwd file: see lib/gui_rpc_client.cpp

require_once("../inc/util.inc");
page_head("Accessing BOINC on Linux");
text_start();
echo "
<p>
There are two ways to control BOINC on Linux:
<ul>
<li> <a href=https://github.com/BOINC/boinc/wiki/BOINC_Manager><code>boincmgr</code></a>: a GUI; also known as the BOINC Manager
<li> <a href=https://github.com/BOINC/boinc/wiki/boinccmd-tool><code>boinccmd</code></a>: a command-line tool
</ul>
<p>
Each of these requires a 'key' to communicate with the BOINC client.
The client creates this key and stores it in a file
<code>gui_rpc_auth.cfg</code> in the BOINC data directory.

<h3>'Not found' errors</h3>
<p>
To locate the key file, <code>boincmgr</code> and <code>boinccmd</code>
do the following:
<ol>
<li> <code>boincmgr</code> looks in a directory specified with the <code>--datadir</code> command-line option (<code>boinccmd</code> doesn't have this option).
<li> They look in the current directory.
<li>
They check for a configuration file <code>/etc/boinc-client/config.properties</code>
and look for a line of the form
<pre>
data_dir=PATH
</pre>
This tells them where the data directory is.
If you install BOINC using a package manager, this is set up automatically.
<li> They look in <code>/var/lib/boinc</code>.
</ol>

If none of these locates <code>gui_rpc_auth.cfg</code>
you get a 'not found' error message.
To fix this, either reinstall BOINC, or create a configuration file as above,
or run the program in the BOINC data directory,
or use the <code>--datadir</code> option in the Manager.

<h3>'Can't be read' errors</h3>
<p>
If you get an error message like
<code>gui_rpc_auth.cfg exists but can't be read</code>,
the problem is file permissions.
You can generally fix this by adding yourself to the 'boinc' group:
<pre>
sudo usermod -a -G boinc \$USER
exec su \$USER
</pre>
";
text_end();
page_tail();
?>
