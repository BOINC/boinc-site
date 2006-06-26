<?php
require_once("docutil.php");
page_head("The BOINC application programming interface (API)");
echo "
<p>
The BOINC API is a set of C++ functions.
Most of the functions have a C interface,
so that they can be used from programs written in C and other languages.
Unless otherwise specified,
the functions return an integer error code; zero indicates success.
<p>
BOINC applications may generate graphics,
allowing them to provide a screensaver.
This API is described <a href=graphics.php>here</a>.
<p>
BOINC applications may consist of several programs that are
executed in sequence;
these are called <b>compound applications</b>.
This API is described <a href=compound_app.php>here</a>.


<h3>Initialization and termination</h3>

<p>
Applications should
<a href=diagnostics.php>initialize diagnostics</a>
before any other BOINC calls.
<p>
Initialization for graphical and compound applications
are described elsewhere (see links above).
Other applications must call
<pre>
    int boinc_init();
</pre>
before calling other BOINC functions or doing I/O.
<p>
When the application has completed it must call
<pre>
    int boinc_finish(int status);
</pre>
<code>status</code> is nonzero if an error was encountered.
This call does not return.

<h3>Is your application running under the control of the BOINC client?</h3>
<p>
BOINC applications can be run in \"standalone\" mode for testing, or under
the control of the BOINC client.  You might want your application to behave differently
in the two cases.  For example you might want to output debugging information if
the application is running standalone.  To determine if the application is
running in standalone mode or under the control of the BOINC client, call
<pre>
    int boinc_is_standalone(void);
</pre>
This returns non-zero (True) if the application is running standalone, and zero (False) if the application
is running under the control of the BOINC client.



<h3>Resolving file names</h3>
Applications that use named input or output files must call
<pre>
    int boinc_resolve_filename(char *logical_name, char *physical_name, int len);
</pre>
or
", html_text("
    int boinc_resolve_filename_s(char *logical_name, std::string& physical_name);
"), "
to convert logical file names to physical names.
For example, instead of
<pre>
    f = fopen(\"my_file\", \"r\");
</pre>
</p>
the application might use
", html_text("
    string resolved_name;
    retval = boinc_resolve_filename(\"my_file\", resolved_name);
    if (retval) fail(\"can't resolve filename\");
    f = fopen(resolved_name.c_str(), \"r\");
"), "
<code>boinc_resolve_filename()</code> doesn't need to be used for temporary files.

<h3>I/O wrappers</h3>
<p>
Applications should replace fopen() calls with
<pre>
boinc_fopen(char* path, char* mode);
</pre>
This deals with platform-specific problems.
On Windows, where security and indexing programs can briefly lock files,
boinc_fopen() does several retries at 1-second intervals.
On Unix, where signals can cause fopen() to fail with EINTR,
boinc_fopen checks for this and does a few retries;
it also sets the 'close-on-exec' flag.

<h3>Checkpointing</h3>

Computations that use a significant amount of time
per work unit may want to periodically write the current
state of the computation to disk.
This is known as <b>checkpointing</b>.
The state file must include everything required
to start the computation again at the same place it was checkpointed.
On startup, the application
reads the state file to determine where to begin computation.
If the BOINC client quits or exits,
the computation can be restarted from the most recent checkpoint.
<p>
Frequency of checkpointing is a user preference
(e.g. laptop users might want to checkpoint infrequently).
An application must call
<pre>
    int boinc_time_to_checkpoint();
</pre>
whenever it reaches a point where it is able to checkpoint.
If this returns nonzero (True) then
the application should checkpoint immediately
(i.e., write the state file and flush all output files),
then call
<pre>
    void boinc_checkpoint_completed();
</pre>
<code>boinc_time_to_checkpoint()</code> is fast,
so it can be called frequently (hundreds or thousands of times a second).

<h3>Critical sections</h3>
<pre>
void boinc_begin_critical_section();
void boinc_end_critical_section();
</pre>
Call these around code segments during which you
don't want to be suspended or killed by the core client.
NOTE: this is done automatically while checkpointing.

<h3>Atomic file update</h3>
<p>
To facilitate atomic checkpoint, an application can write to output and
state files using the <code>MFILE</code> class.
<pre>
class MFILE {
public:
    int open(char* path, char* mode);
    int _putchar(char);
    int puts(char*);
    int printf(char* format, ...);
    size_t write(const void* buf, size_t size, size_t nitems);
    int close();
    int flush();
};
</pre>
MFILE buffers data in memory
and writes to disk only on <code>flush()</code> or <code>close()</code>.
This lets you write output files and state files more or less atomically.

<a name=credit>
<h3>Credit reporting</h3>
<p>
By default, the claimed credit of a result is based on
the product of its total CPU time and the
benchmark values obtained by the core client.
This can produce results that are too low if
the application uses processor-specific optimizations
not present in the core client,
is compiled with different compiler settings,
or uses a GPU or other non-CPU computing resource.
To handle such cases, the following functions can be used.
<pre>
void boinc_ops_per_cpu_second(double floating_point_ops, double integer_ops);
</pre>
This reports the results of an application-specific benchmark,
expressed as number of floating-point and integer operations per CPU second.
<pre>
void boinc_ops_cumulative(double floating_point_ops, double integer_ops);
</pre>
This reports the total number of floating-point and integer operations
since the start of the result.
It must be called just before boinc_finish(),
and optionally at intermediate points.

<h3>Communicating with the core client</h3>
<p>
The core client GUI displays the percent done of workunits in progress.
To keep this display current, an application should periodically call
<pre>
   boinc_fraction_done(double fraction_done);
</pre>
The <code>fraction_done</code> argument is an estimate of the
workunit fraction complete (0 to 1).
This function is fast and can be called frequently.
The sequence of arguments in successive calls should be non-decreasing.
An application should never 'reset' and start over
if an error occurs; it should exit with an error code.
<pre>
   double boinc_get_fraction_done();
</pre>
returns the last value set, or -1 if none has been set
(this would typically be called from graphics code).

<p>
The following functions get information from the core client;
this information may be useful for graphics.
",
html_text("
    int boinc_get_init_data(APP_INIT_DATA&);

    struct APP_INIT_DATA {
        int core_version;
        char app_name[256];
        char project_preferences[65536];
        char user_name[256];
        char team_name[256];
        char project_dir[256];
        char boinc_dir[256];
        char wu_name[256];
        char authenticator[256];
        int slot;
        double user_total_credit;
        double user_expavg_credit;
        double team_total_credit;
        double team_expavg_credit;
        HOST_INFO host_info;
    };
"), "
to get the following information:
";
list_start();
list_item("core version", "The version number of the core client");
list_item("app_name", "The application name (from the server's DB)");
list_item("project_preferences", "An XML string containing
the user's project-specific preferences.");
list_item("user_name", " the user's 'screen name' on this project.");
list_item("team_name", " the user's team name, if any.");
list_item("project_dir", "absolute path of project directory");
list_item("boinc_dir", "absolute path of BOINC root directory");
list_item("wu_name", "name of workunit being processed");
list_item("authenticator", "user's authenticator for this project");
list_item("slot", "The number of the app's 'slot' (0, 1, ...)");
list_item("user_total_credit", " user's total work for this project.");
list_item("user_expavg_credit", " user's recent average work per day.");
list_item("team_total_credit", " team's total work for this project.");
list_item("team_expavg_credit", " team's recent average work per day.");
list_item("host_info", "A structure describing the host hardware and OS");
list_end();
echo "
<p>
An application may call
", html_text("
    int boinc_wu_cpu_time(double &cpu_time);
"), "to get its total CPU time
(from the beginning of the work unit, not just since the last restart).
This excludes CPU time used to render graphics.

<h3>Requesting network connection</h3>
<p>
If it appears that there is no physical network connection
(e.g. gethostbyname() fails for a valid name) then
<ul>
<li> Call <code>boinc_need_network()</code>.
This will alert the user that a network connection is needed.
<li> Periodically call <code>boinc_network_poll()</code>
until it returns zero.
<li> Do whatever communication is needed.
<li> When done, call <code>boinc_network_done()</code>.
This enables that hangup of a modem connection, if needed.
</ul>
",html_text("
void boinc_need_network();
int boinc_network_poll();
void boinc_network_done();
"), "

Note: this should be enclosed in
<code>boinc_not_using_cpu() ... boinc_using_cpu()</code>.
";
page_tail();
?>
