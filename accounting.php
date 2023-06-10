<?php
require_once("../inc/util.inc");
page_head("Accounting systems in BOINC");

text_start();
echo <<<EOT
<p>
When a computer runs BOINC it contributes various things:
<p>
<ul>
<li> Computing
<li> Data storage
<li> Network communication
</ul>
<p>
To measure how much a computer has contributed,
we could measure each of these and add them together somehow.
But since BOINC has been used mostly for scientific computing,
we currently measure only computing.
<p>
There are different ways to measure computing.
For example, we could measure CPU time.
But one CPU might be 10X faster than another,
so that's not a good measure.
<p>
Scientific computing mostly involves floating-point calculations,
so BOINC uses floating-point operations (FLOPs) as the basic unit.
The BOINC runs a "benchmark" program that measures
the peak FLOPs per second that each processor can do.
GPU vendors supply APIs that return the peak FLOPS of GPUs.
<p>
The basic unit of credit in BOINC is the "Cobblestone".
It is defined as 1/200 of a day on a 1 GFLOPS machine.

<h2>Cheating</h2>
<p>
BOINC is based on a client/server model.
The client runs jobs, uploads the output files,
and sends a message to the server saying how fast
its CPUs and GPUs are, and what the job runtimes were.

<p>
The server can't trust messages from clients.
Hackers can modify the BOINC client,
or run programs that spoof the client.

<p>
There are various ways that hackers can try to get
undeserved credit:
<ul>
<li> Claim that their CPUs and GPUs are faster than they really are.
<li> Claim that jobs took longer than they really did.
<li> Not do jobs at all, but upload false output files
    and claim that they did the job.
</ul>

<p>
It's difficult or impossible to make an accounting system
that's cheat-proof.
But we can make them "cheat-resistant":
that is, make it difficult to cheat, and limit the
rate at which false credit can be gained.
<p>
The importance of cheat-resistance depends on what
the accounting data is used for.
<ul>
<li>
In Science United it's used only to show individual users
their rate of progress,
so there's no need for cheat-resistance.
<li>
In standard BOINC, it's used as a basis for competition among
users and groups,
so cheat-resistance is important but not critical.
<li>
If accounting data is linked to money,
then cheat-resistance is critical.
</ul>

<h2>The BOINC credit system</h2>

The standard accounting system, used by most BOINC projects,
grants credit for completed jobs.
For each job, the "claimed credit" is the product
of the job runtime and the peak FLOPS of the devices it uses.
Each of these quantities is reported by the client, and hence can't be trusted.
The calculation of credit does "sanity checking" for each quantity:
there's a maximum possible CPU FLOPS and a maximum # of CPUs per host;
runtime can't exceed the time interval since the job was sent.
This provides a small amount of cheat resistance.

<p>
There are two additional mechanisms,
which provide more cheat-resistance.

<p>
<b>Validation</b>: credit is granted only for jobs that have been "validated".
Typically this means that a second copy of the job was run
on a different computer, and the results agree.
There may be a delay of days or weeks in the completion of this second job,
in which case there's a delay in the granting of credit.
Also, this means that credit is not granted for failed jobs:
e.g. a job might run for a week and then crash;
the user wouldn't get any credit for it.

<p>
<b>Normalization</b>: the server keeps track of the statistics
(mean and variance) of the credit claimed by hosts.
It uses this to "normalize" granted credit so that,
over the long term, all hosts get the same average credit for jobs.

<p>
BOINC project servers store total and recent-average credit per user and host;
they don't store history.
Project servers export credit information daily as XML files.
Hosts and users are identified by "cross-project IDs",
making it possible to find the totals across all projects
for a given host or user.
This is used by credit statistics websites
such as BOINCstats and BOINC Combined Statistics.
These sites store historical data.

<p>
Some BOINC projects have their own ways of granting credit;
e.g., to grant a fixed amount of credit per job.
These may be less cheat-resistant than the standard BOINC mechanism,
and they may grant more credit
(some projects deliberately grant inflated credit to attract volunteers).

<p>
When the client communicates with a project server ("scheduler RPC")
the server returns the total and recent average credit
for both user and host.
The client displays this but doesn't maintain history.

<h2>The Science United accounting system</h2>

For Science United, the goals are:
<ol>
<li>
Show users their contribution on a daily basis, and their history.
<li>
The accounting data for a user or host is shown only to the user;
there are no leader boards or other forms of competition.
</ol>
The BOINC credit system can't be used because its potentially
long delays conflict with 1).

<p>
In addition, Science United doesn't create separate user accounts
on BOINC projects; it uses a single account per project.
Figuring out how much credit each SU user got is possible, but
would require looking at host-level information.
<p>
So we created a different accounting system.
<ul>
<li>
The BOINC client (starting with 7.14) maintains
the "estimated credit" for each project it's attached to.
This accumulates continuously as jobs run.
It's computed as job runtime times peak FLOPS of the devices the job uses.
<li>
On each account manager RPC, the client reports the estimated
credit for each project.
<li>
SU maintains an accounting record for each (host, project) pair.
When it gets an RPC, it computes the difference in estimated credit
since the last RPC for each project.
<li>
SU maintains a daily accounting history for each user and project.
When it gets an RPC, it adds the accounting deltas to
the current accounting record for the user and project.
</ul>

<p>
Credit is grant based on runtime, rather than jobs.
If jobs fail, users still get credit.

<p>
SU does sanity checking of estimated credit, similar to BOINC.
That's the only form of cheat resistance.
This means that a hacker can make it look like they have
and extremely powerful computer, running all the time,
when in fact they do no computation at all.
As far as SU is concerned, that's OK.

<p>
The account manager RPC doesn't return account information
(e.g. user totals); this would be easy to add,
and to display in the client.

<h2>Possible additions</h2>

<p>
It may be desirable to create an account system that
accumulates continuously (like the SU system)
but has the cheat-resistance of the BOINC system.
<p>
One way to do this would be to link SU credit to jobs.
Account manager RPCs would include lists of jobs,
and the SU database would record these.
SU would then periodically query projects to see if the
jobs were granted credit.
This would be vastly complicated and impractical.
<p>
Another way would be for SU to periodically query
projects to get credit totals for users and/or hosts,
and adjust the SU accounting accordingly.
This is feasible but would have the property that
SU users would sometimes see their credit totals decrease.


EOT;
text_end();
page_tail();
?>
