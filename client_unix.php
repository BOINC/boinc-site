<?php
require_once("docutil.php");
page_head("The BOINC command-line client");
echo "
<h3>Components</h3>
<p>
The BOINC client software can be run in a command-line
(non-graphical) environment.
This involves two components:
<ul>
<li> The <b>core client</b> (boinc_client),
intended to be run as a background or daemon process.
<li> A <b>command tool</b> (boinc_cmd) that provides
an interactive command-line interface to the core client.
</ul>
<p>
Install the BOINC client software by using gunzip to decompress it.
Use 'chmod' to make the programs executable if needed.
Put the core client in a directory by itself.
Run it manually, from your login script,
or from system startup files.
<p>
A set of instructions for running BOINC on Unix systems is
<a href=http://noether.vassar.edu/~myers/help/boinc/unix.html>here</a>.
<p>
The core client has the following optional environment variables:
";
list_start();
list_item("HTTP_PROXY", "URL of HTTP proxy");
list_item("HTTP_USER_NAME", "User name for proxy authentication");
list_item("HTTP_USER_PASSWD", "Password for proxy authentication");
list_item("SOCKS4_SERVER", "URL of SOCKS 4 server");
list_item("SOCKS5_SERVER", "URL of SOCKS 5 server");
list_item("SOCKS5_USER", "User name for SOCKS authentication");
list_item("SOCKS5_PASSWD", "Password for SOCKS authentication");
list_end();
";
<h3>Command-line interface</h3>
<p>
The command-line interface program
has the following interface:
<pre>
boinc_cmd [--host hostname] command
</pre>
The commands are as follows:
";
list_start();
list_item("--get_state", "show client state");
list_item("--get_results", "show results");
list_item("--get_file_transfers", "show file transfers");
list_item("--get_project_status", "show status of all projects");
list_item("--get_disk_usage", "Show disk usage by project");
list_item("--result
     <br>{suspend | resume | abort | graphics_window | graphics_fullscreen}
     <br>url result_name",
     "Do operation on a result"
);
list_item("--project
     <br>{reset | detach | update | suspend | resume | nomorework | allowmorework}
     <br>url",
     "Do operation on a project"
);
list_item("--project_attach url auth","Attach to an account");
list_item("--file_transfer {retry | abort} url filename",
    "Do operation on a file transfer"
);
list_item("--get_run_mode","Get current run mode");
list_item("--set_run_mode {always | auto | never}","Set run mode");
list_item("--get_network_mode","Get current network mode");
list_item("--set_network_mode {always | auto | never}","Set network mode");
list_item("--get_proxy_settings", "Get proxy settings");
list_item("--set_proxy_settings", "Set proxy settings");
list_item("--get_messages seqno",
    "show messages with sequence numbers beyond the given seqno"
);
list_item("--get_host_info", "Show host info");
list_item("--acct_mgr_rpc url name password",
    "Instruct core client to contact account manager server."
);
list_item("--run_benchmarks", "Run CPU benchmarks");
list_item("--get_screensaver_mode", "");
list_item("--set_screensaver_mode on|off blank_time {desktop window_station}", "");
list_item("--quit", "");
list_end();
echo "
<p>
Core client command-line options [DEPRECATED]:
";
list_start();
list_item("-attach_project",
    "Attach this computer to a new project.
    You must have an account with that project.
    You will be asked for the project URL and the account key."
);
list_item("-show_projects",
    "Print a list of projects to which this computer is attached."
);

list_item("-detach_project URL",
    "Detach this computer from a project."
);

list_item("-reset_project URL",
    "Clear pending work for a project.
    Use this if there is a problem that is preventing
    your computer from working."
);

list_item("-update_prefs URL",
    "Contact a project's server to obtain new preferences.
    This will also report completed results
    and get new work if needed."
);

list_item("-return_results_immediately",
    "Contact scheduler as soon as any result done."
);
list_item("-run_cpu_benchmarks",
    "Run CPU benchmarks.
    Do this if you have modified your computer's hardware."
);
list_item("-check_all_logins",
    "If 'run if user active' preference is off,
    check for input activity on all current logins;
    default is to check only local mouse/keyboard"
);
list_item("-exit_when_idle",
    "Get, process and report work, then exit."
);
list_item("-allow_remote_gui_rpc",
    "Allow GUI RPCs from remote hosts"
);
list_item("-help",
    "Show client options."
);

list_item("-version",
    "Show client version."
);
list_end();
page_tail();
?>
