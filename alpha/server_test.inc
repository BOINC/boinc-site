<?php

$all_platforms = array(
    array("linux", "Linux", 5, "linux"),
);

function make_test($short_name, $long_name, $desc) {
    return array($short_name, $long_name, 5, null, $desc);
}

// 0: short name
// 1: long name
// 2: description

$make_project = make_test(
    "make_project",
    "make_project",
    "See <a href=https://boinc.berkeley.edu/trac/wiki/MakeProject>MakeProject</a>"
);

$start = make_test(
    "start",
    "start, stop, and cron",
    "See <a href=https://boinc.berkeley.edu/trac/wiki/StartTool>StartTool</a>"
);

$xadd = make_test(
    "xadd",
    "xadd",
    "Verify that it works correctly.  Test with various combinations of application attributes: weight, beta, non-CPU-intensive, HR, etc."
);

$update_versions = make_test(
    "update_versions",
    "update_versions",
    "See <a href=https://boinc.berkeley.edu/trac/wiki/AppVersionNew>AppVersionNew</a>.  Create an application directory hierarchy: Use different combinations of file attributes, including multiplet URLs.  Use different application attributes.  Test the case where there is no version.xml.  In each case verify that the DB entry is made and files are copied correctly.  Check that api_version is set correctly."
);

$scheduler = make_test(
    "scheduler",
    "Scheduler",
    "Test app version selection, runtime estimation, and all the options in  <a href=https://boinc.berkeley.edu/trac/wiki/ProjectOptions#Scheduler>ProjectOptions</a>"
);

$api = make_test(
    'api',
    "Basic API",
    "Test the BOINC API basic features: parallel apps, critical sections, timer handler, etc.: <a href=https://boinc.berkeley.edu/trac/wiki/BasicApi>BasicApi</a>"
);

$trickle = make_test(
    "trickle",
    "Trickle-up and trickle-down message mechanisms",
    "See <a href=https://boinc.berkeley.edu/trac/wiki/TrickleApi>TrickleApi</a>"
);

$locality = make_test(
    "locality",
    "Limited locality scheduling",
    "See <a href=https://boinc.berkeley.edu/trac/wiki/LocalityScheduling>LocalityScheduling</a>"
);

$intermediate_upload = make_test(
    "intermediate_upload",
    "Intermediate upload mechanism",
    "See <a href=https://boinc.berkeley.edu/trac/wiki/IntermediateUpload>IntermediateUpload</a>"
);

$app_network = make_test(
    "app_network",
    "API for apps that do network communication",
    "See <a href=https://boinc.berkeley.edu/trac/wiki/NetworkApps>NetworkApps</a>"
);

$remote_files = make_test(
    "remote_files",
    "Remote file management",
    "Including the C++, Python, and PHP APIs. See <a href=https://boinc.berkeley.edu/trac/wiki/RemoteInputFiles>RemoteInputFiles</a> and <a href=https://boinc.berkeley.edu/trac/wiki/RemoteOutputFiles>RemoteOutputFiles</a>"
);

$remote_job = make_test(
    "remote_job",
    "Remote job submission",
    "Including the C++, Python and PHP bindings; see <a href=https://boinc.berkeley.edu/trac/wiki/RemoteJobs>RemoteJobs</a>"
);

$gzip = make_test(
    "gzip",
    "File compression",
    "Verify that files with the gzip attribute are sent in compressed form to 7.0+ clients, and uncompressed to earlier clients.  See <a href=https://boinc.berkeley.edu/trac/wiki/FileCompression>FileCompression</a>"
);

$app_attributes = make_test(
    "app_attributes",
    "Application attributes.",
    "Verify that: dont_throttle: the app is not throttled.  needs_network: the app is not scheduled if network disabled beta: app is sent to beta users is_wrapper: app is run at above-idle priority.  See <a href=https://boinc.berkeley.edu/trac/wiki/AppVersion>AppVersion</a>"
);

$web_config = make_test(
    'web_config',
    "Web config features",
    "test all the features of the web config file: <a href=https://boinc.berkeley.edu/trac/wiki/WebConfig>WebConfig</a>"
);

$per_app_credit = make_test(
    'per_app_credit',
    "Per-app credit",
    "test the per-app credit system described here: <a href=https://boinc.berkeley.edu/trac/wiki/PerAppCredit>PerAppCredit</a>"
);

$user_app_selection = make_test(
    'user_app_selection',
    "User app selection",
    "See <a href=https://boinc.berkeley.edu/trac/wiki/AppFiltering>AppFiltering</a>)"
);

$opaque_data = make_test(
    'opaque_data',
    "Opaque data features",
    "Test the mechanism for including opaque data in scheduler requests: <a href=https://boinc.berkeley.edu/trac/wiki/ClientOpaque>ClientOpaque</a>"
);

$multi_size = make_test(
    'multi_size',
    "Multi-size app features",
    "See <a href=https://boinc.berkeley.edu/trac/wiki/MultiSize>MultiSize</a>"
);

$wrapper = make_test(
    'wrapper',
    "Wrapper",
    "Test the wrapper and all its features (there are lots of them): <a href=https://boinc.berkeley.edu/trac/wiki/WrapperApp>WrapperApp</a>"
);

$plan_class = make_test(
    'plan_class',
    "Plan class mechanism",
    "Test the plan class mechanism (see <a href=https://boinc.berkeley.edu/trac/wiki/AppPlanSpec>AppPlanSpec</a>) and all its various features.  (make sure the right version sent to different host types, and that the FLOPS estimate is correct)"
);

$vbox_wrapper = make_test(
    "vbox_wrapper",
    "VBox wrapper",
    "Test the VBox wrapper and all its features; see <a href=https://boinc.berkeley.edu/trac/wiki/VboxApps>VboxApps</a>"
);

$all_test_groups = array(
    $make_project,
    $start,
    $scheduler,
    $trickle,
    $locality,
    $intermediate_upload,
    $app_network,
    $remote_files,
    $remote_job,
    $xadd,
    $update_versions,
    $gzip,
    $app_attributes,
    $web_config,
    $per_app_credit,
    $user_app_selection,
    $opaque_data,
    $multi_size,
    $wrapper,
    $api,
    $plan_class,
    $vbox_wrapper,
);

// newer versions first
$versions = array(
    array("1.1.0", $all_test_groups, $all_platforms),
);

?>
