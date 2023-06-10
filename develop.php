<?php
require_once("../inc/util.inc");
page_head("Help maintain and develop BOINC");
text_start();
echo "
<h3>Overview</h2>
<p>
BOINC is open-source;
it's distributed under the LGPL open source license.
The BOINC source code is stored in
<a href=https://github.com/BOINC/boinc>a GitHub repository</a>.
If you're not familiar with Git,
<a href=https://boinc.berkeley.edu/trac/wiki/SourceCodeGit>read this</a>.
<p>
Here are <a href=https://boinc.berkeley.edu/trac/wiki/SoftwareBuilding>instructions for building BOINC</a> on various platforms.
<p>
BOINC is maintained and developed partly
by the UC Berkeley BOINC project,
and partly by volunteers.
If you're interested in participating, visit the GitHub repo.
Most communication takes place there.
Also subscribe to the <a href=https://boinc.berkeley.edu/trac/wiki/EmailLists>boinc_dev</a> email list.
<p>
Keeping BOINC working also involves a number of
<a href=https://boinc.berkeley.edu/trac/wiki/AdminTasks>maintenance tasks</a>
such as release management, managing the translation system, and so on.

<h3>APIs</h2>
<p>
BOINC is an 'open system' with lots of interacting pieces:
client, GUI, server, account managers, statistics websites,
remote job submission systems, etc.
These components communicate through
<a href=https://boinc.berkeley.edu/trac/wiki/SoftwareAddon>a set of RPC interfaces</a>.

<h3>Events</h2>
<p>
In the past we've had <a href=https://boinc.berkeley.edu/trac/wiki/BoincEvents>a yearly series of 'workshops'</a>
where everyone involved in BOINC
(developers, projects, volunteers) meets and talks.

<h3>Miscellaneous</h2>
<p>
<ul>
<li> <a href=https://boinc.berkeley.edu/trac/wiki/CodingStyle>Coding style</a>
<li> <a href=https://boinc.berkeley.edu/trac/wiki/SoftwareDevelopment>Design documents</a>
</ul>
";
text_end();
page_tail();
?>
