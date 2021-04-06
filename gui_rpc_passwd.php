<?php

// if the client finds an empty GUI RPC passwd file,
// it issues a message warning the user that local RPC is unprotected,
// and directing them to this page
// (client/gui_rpc_server.cpp)

require_once("../inc/util.inc");
page_head("Controlling access to BOINC on Linux systems");
text_start();
echo "
<p>
If you install BOINC using the package manager (yum or apt),
all users on your system will be able to control BOINC;
in particular, they'll be able to attach to any project.
<p>
If you're the only user of your computer, that's OK.
If there are other users, and you don't want them to control BOINC,
do the following:
<pre>
sudo rm /var/lib/boinc/gui_rpc_auth.cfg
sudo usermod -a -G boinc \$USER
exec su \$USER
sudo systemctl restart boinc-client
</pre>
This will add you to the 'boinc' group,
and will create a new access control file readable only
by members of that group.
If you want to let other users control BOINC,
add them to the group also.
";
text_end();
page_tail();
?>
