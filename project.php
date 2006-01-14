<?php
require_once("docutil.php");
page_head("Projects and applications");
echo "
<h2>Projects and applications</h2>
A <b>project</b> is a group of one or
more distributed applications, run by a single organization, that use BOINC.
Projects are independent; each one has its own applications,
databases and servers, and is not affected by the status of other projects. 
<p>
Each is identified by a <a href=server_components.php>master URL</a>,
which refers to an XHTML document describing the project.
<p>
Creating projects is relatively easy.
An organization can create
projects to do Alpha and Beta testing of applications.
Testers can register for these projects, in addition to or instead of the
organization's public project.
<p>
The components of a project are shown below. Those in blue are the ones that
are provided as part of the BOINC package.  Those in off-white are the parts
that you must write yourself, in order to BOINC-enable your own application.
<br>
<img vspace=10 src=project.png> 
<p>
The server side of a project consists of two parts: 
<ul>
<li> A <b>project back end</b> that supplies applications and work
units, and that handles the computational results.
Input and output files are distributed by <b>data servers</b>,
which are HTTP servers able to handle CGI programs with POST commands.
These servers need not be owned or operated by the project.
A project might, for example,
recruit other organizations to donate network bandwidth by hosting data
servers; data could be moved on tape between the project back end and
the data servers. 
<li> A <b>BOINC server complex</b> that manages data distribution and
collection. 
</ul>
The BOINC server complex includes the following components: 
<ul>
<li> One or more <b>scheduling servers</b> that communicates with
participant hosts. 
<li> A relational database storing information about work, results,
and participants. 
<li> Utility programs and libraries that allow the project back end
to interact with the server complex. 
<li>
Web interfaces for participants and developers. 
</ul>
";
page_tail();
?>
