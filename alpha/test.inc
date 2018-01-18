<?php

// 0: short name
// 1: long name
// 2: target #reports
// 3: category (win, mac, linux)

$platforms_win = array(
    array("winxp", "Windows XP", 1, "win"),
    array("winvista_x64", "Windows Vista", 1, "win"),
    array("win7_x64", "Windows 7", 5, "win"),
    array("win8_x64", "Windows 8/8.1", 5, "win"),
    array("win10_x64", "Windows 10", 5, "win"),
);

$platforms_mac = array(
    //array("mac104", "Mac OS X 10.4", 1, "mac"),
    //array("mac105", "Mac OS X 10.5", 1, "mac"),
    array("mac106", "Mac OS X 10.6", 1, "mac"),
    array("mac107", "Mac OS X 10.7", 1, "mac"),
    array("mac108", "Mac OS X 10.8", 1, "mac"),
    array("mac109", "Mac OS X 10.9", 1, "mac"),
    array("mac110", "Mac OS X 10.10", 1, "mac"),
    array("mac111", "Mac OS X 10.11", 1, "mac"),
    array("mac112", "Mac OS X 10.12", 5, "mac"),
    array("mac113", "Mac OS X 10.13", 5, "mac"),
);

$platforms_linux = array(
    //array("linuxgraphical", "Linux x86 graphical", 5, "linux"),
    array("linuxgraphical_x64", "Linux x64 graphical", 5, "linux"),
);

$platforms_android = array(
    array("android", "Android", 5, "android"),
);

$all_platforms = array_merge(
    $platforms_win, $platforms_mac, $platforms_linux, $platforms_android
);

$platforms_win_mac = array_merge($platforms_win, $platforms_mac);

$platforms_win_linux = array_merge($platforms_win, $platforms_linux);

$platforms_mac_linux = array_merge($platforms_mac, $platforms_linux);

$platforms_win_mac_linux = array_merge($platforms_win, $platforms_mac, $platforms_linux);

// 0: short name
// 1: long name
// 2: target #reports
// 3: category (or null)
// 4: description

$general = array("general", "General tests", 10, null,
    "<ul>
        <li> Examine all tabs of the BOINC Manager Advanced View;
             check that all data is present and correct.
        <li> Switch to the Simple View, check its data,
            and make sure slide-show images are shown
            for projects that provide them (WCG, Einstein, SETI).
        <li> Make sure graphics work (for apps that support graphics).
        <li> Make sure elapsed time and fraction done are increasing
            for running tasks.
        <li> Suspend and resume tasks, file transfers, and projects.
        <li> Test activity modes 'Suspend', 'Run based on preferences',
            and 'Run always'.
        <li> Check that the 'Help' menu items bring up a web browser
            and loads a Help page on the BOINC site.
        <li> Windows only: Check that pressing 'F1' brings up
            a web browser and loads a Help page on the BOINC site.
        <li> Let BOINC run long enough to complete a task.
            Check that output files are uploaded and the task is reported.
     </ul>
    "
);
$clean = array("clean", "Clean install and uninstall", 5, null,
    "<ul>
        <li> Rename the BOINC data directory to a temporary directory name.
        <li> Uninstall BOINC
             <ul>
             <li> Windows XP: go to <b>Start > Control Panel > Add/Remove Programs</b> and uninstall BOINC
             <li> Windows 7/8: go to <b>Start > Control Panel > Programs and Features</b> and uninstall BOINC
             <li> Mac: run the 'uninstall BOINC' utility included in the Extras folder with the installer.
             </ul>
        <li> Verify that the boinc_projects, boinc_users, and boinc_admins local groups have been deleted.
             <ul>
             <li> Windows: go to <b>Start > All Programs > Accessories > Command prompt</b> and type 'net localgroup' in the command prompt window. None of the above groups should be listed
             <li> Mac: execute /Applications/Utilities/Terminal.app, type 'dscl . list /users UniqueID' in the terminal window. None of the above groups should be listed
             </ul>
        <li> Verify that the boinc_master and boinc_project user accounts have been deleted.
             <ul>
             <li> Windows: go to <b>Start > All Programs > Accessories > Command Prompt</b> and type 'net users' in the command prompt window. None of the above users should be listed
             <li> Mac: execute /Applications/Utilities/Terminal.app, type 'dscl . list /groups PrimaryGroupID' in the terminal window. None of the above users should be listed
             </ul>
        <li> Install new BOINC.
        <li> Verify that client and manager run,
            and that the manager brings up the Attach Project wizard.
        <li> Attach to a project,
            and check that work is downloaded and started.
        <li> <b> There should be no long delays, errors,
            confusing messages, or anything else that might bother a naive,
            non-technical computer user.
            If there is, report it as a bug.</b>
        <li> Exit BOINC, delete the BOINC data directory,
            and rename the temporary directory back to BOINC.
    </ul>
    "
);
$transfer_restart = array("transfer_restart", "File transfer restart", 5, null,
    "<ul>
        <li> In the middle of a long file download, note the fraction done,
            then exit the BOINC client
            (e.g., using 'Advanced/Shut down connected client' in the Manager).
            Restart the client by exiting and launching the Manager.
            Verify that the download resumes from the same point.
        <li> Same, but instead of exiting the client,
            disconnect your network cable in the middle of the transfer.
        <li> Same, but upload instead of download.
        </ul>
    "
);
$preference = array("preference", "Preferences tests", 5, null,
    "<ul>
        <li> Test computing preferences using the Computing Preferences dialogs
            in both the Manager's advanced and simple views.
            <ul>
            <li> Test as many preferences as you can.
            <li> Check that each preference is enforced correctly.
            <li> Try entering illegal values
                (e.g. percentages greater than 100 or less than zero)
                and make sure the Manager rejects these.
            </ul>
        <li> Test computing preferences using the web-based
            (change computing preferences on a project web site,
           then Update the project in the BOINC manager).
            <ul>
            <li> Test the venue mechanism (e.g., create preferences for
                'Home', change your computer's location to 'Home',
                make sure it gets the right preferences).
            <li> Update a second project with same account email address,
                and make sure computing preferences are propagated
                to the second project.
            </ul>
        <li> Test project preferences on one or more projects
            (for example, change resource shares).
        <li> Test the exclusive application feature in the Computing
            Preferences dialog. 
     </ul>
    "
);
$v6_win_compat_private = array("v6_win_compat_private",
    "Windows compatibility/private install tests", 5,
    "win",
    "This install mode is selected by unchecking the
        'Protected application execution' checkbox and
        checking the 'All users can control BOINC' checkbox
        on the advanced configuration screen.
        <ul>
        <li> Launch BOINC Manager and verify that the client runs
        and you can control it.
        <li> Launch Task Manager (CTRL-SHIFT-ESC),
        switch to the 'Processes' tab and verify that boinc.exe,
        boincmgr.exe, and any science applications are running
        as the current user account.
        <li> Log on as a different user and launch BOINC Manager.
        A dialog should appear telling you to contact an administrator
        and have them add you to the 'boinc_users' group.
        </ul>
    "
);
$v6_win_secure_private = array("v6_win_secure_private",
    "Windows secure/private install tests", 5,
    "win",
    "This install mode is selected by checking the
        'Protected application execution' checkbox and unchecking the
        'All users can control BOINC' checkbox on the advanced
        configuration screen.
        <ul>
        <li> Launch BOINC Manager and verify that the client runs
        and you can control it.
        <li> Launch Task Manager (CTRL-SHIFT-ESC),
        switch to the 'Processes' tab and verify: 
          <ul>
          <li> boinc.exe is running as 'boinc_master'.
          <li> boincmgr.exe is running as the current user.
          <li> science applications are running as 'boinc_project'.
          </ul>
        <li> Log on as a different user and launch BOINC Manager.
        A dialog should appear telling you to contact an administrator
        and have them add you to the 'boinc_users' group.
        </ul>
    "
);
$v6_win_secure_public = array("v6_win_secure_public",
    "Windows secure/public install tests", 5,
    "win",
    "This install mode is selected by checking the
        'Protected application execution' checkbox and checking the
        'All users can control BOINC' checkbox on the advanced
        configuration screen.
        <ul>
        <li>  Launch BOINC Manager and verify that the client runs
        and you can control it.
        <li> Launch Task Manager (CTRL-SHIFT-ESC),
        switch to the 'Processes' tab and verify: 
          <ul>
          <li> boinc.exe is running as 'boinc_master'.
          <li> boincmgr.exe is running as the current user.
          <li> science applications are running as 'boinc_project'.
          </ul>
        <li> Log on as a different user and launch BOINC Manager.
        You should be able to attach to projects, suspend/resume work, etc.
        </ul>
    "
);
$v6_migration = array("v6_migration", "Windows data migration tests", 5,
    "win",
    "During installation, choose a new data directory.
        <p>
        After installation check to see that files were moved from
        your old data directory to the new one,
        and that both BOINC and BOINC Manager
        launch and can use the data files.
    "
);
$modem = array("modem", "Tests for modem-connected connections", 5, null,
    "<ul>
         <li> TO BE COMPLETED
    </ul>
    "
);
$firewall = array("firewall", "Tests for computers with personal firewalls", 5, null,
    "Do the General Tests on a computer that uses a personal firewall
        (ZoneAlarm, Symantec, Windows XP, etc.).
        In your test report Comments field,
        indicate the type of personal firewall.
    "
);
$proxyhttp = array("proxyhttp", "Tests for computers connected by HTTP proxy", 5, null,
    "<ul>
         <li> Do the General Tests on a computer connected via an HTTP proxy.
         <li> Use authentication if possible.
         <li> Advanced test: Configure BOINC so that attempting to connect
             to a different local computer is excluded from using the proxy.
             Enable <http_debug> logging flag.
             Verify that an attempt to attach to a fake project on the excluded
             computer skips using the proxy server.
     </ul>
    "
);
$proxysocks = array("proxysocks", "Tests for computers connected by SOCKS proxy", 2, null,
    "<ul>
         <li> Do the General Tests on a computer connected via a SOCKS proxy.
         <li> Use authentication if possible.
         <li> Advanced test: Configure BOINC so that attempting to connect
            to a different local computer is excluded from using the proxy.
            Enable <http_debug> logging flag.
            Verify that an attempt to attach to a fake project on the excluded
            computer skips using the proxy server.
     </ul>
    "
);
$laptop = array("laptop", "Tests for laptops", 5, null,
    "Test 'work while running on batteries' preference."
);

$screensaver = array("screensaver", "Screensaver tests", 5, null,
    "<ul>
     <li> Test normal case (enter/leave screensaver mode).
     <li> Open graphics windows from Manager before enter/leave
        screensaver; make sure they reappear.
     <li> Check that graphics change on CPU reschedule
        (set scheduling period to 1 min).
     <li> Test 'blank screen after X minutes'.
     <li> Test power-saver modes, e.g. 'turn off monitor after N minutes'.
     <li> Test password-after-resume options.
     <li> Test screensaver properties 'Preview' function.
     <li> (Windows only?) Test  multi-user install -
        switch to different user and run screensaver.
     </ul>
    "
);
$attach_wizard = array("attach_wizard", "BOINC Manager 'Attach to Project' tests", 5, null,
    "<ul>
        <li> Test normal case, invalid URL,
            valid but non-BOINC URL, projects that are down.
        <li> Test bad password, bad username.
     </ul>
    "
);
$gui_rpc_auth = array("gui_rpc_auth", "GUI RPC authentication", 5, null,
    "Try to connect to core client with bad password,
        from host not on list, etc.
    "
);
$acct_mgr = array("acct_mgr", "Account manager functions", 5, null,
    " <ul>
        <li> Attach to and detach from an account manager
            such as GridRepublic or BAM!.
        <li> Verify that the core client periodically synchronizes with
            the account manager.
        <li> Verify that the core client won't let you detach
            from a project that you attached via the account manager.
        <li> Create a new account on GridRepublic,
            click download link, abort download,
            then install new custom client.
            It should attach automatically.
        </ul>
        <p>
        NOTE: If you find bugs in the account manager itself,
        report them directly to the account manager admins,
        not to BOINC Alpha.
    "
);
$trickle = array("trickle", "Trickle messages and intermediate file upload", 5, null,
    "Let CPDN run long enough so that it does a trickle-up request
        and an intermediate file upload. Make sure that these succeed.
    "
);

$coproc = array("coproc", "GPU tests", 5, null,
    "(This test applies only if your computer has an AMD/ATI or NVIDIA GPU.)
    Check if your GPU supports GPU Computing:
    <ul>
    <li><a href=http://www.nvidia.com/object/cuda_learn_products.html>NVIDIA</a>
    <li><a href=http://developer.amd.com/sdks/AMDAPPSDK/pages/DriverCompatibility.aspx#conformance>AMD/ATI</a>
    </ul>
    If it does, perform the following:
    <ul>
    <li> Download and install the latest drivers. ( 
    <a href=http://www.nvidia.com/Download/index.aspx>NVIDIA</a> or 
    <a href=http://support.amd.com/us/gpudownload/Pages/index.aspx>AMD/ATI</a> ) 
    <li> Verify that BOINC detects your GPU by checking the event log output. If not, add the &lt;coproc_debug/&gt;
    log flag to your cc_config.xml file. Report the failure(email or test form) along with the coproc_debug output.
    <li> Attach to a
    <a href=http://boinc.berkeley.edu/wiki/GPU_computing>project</a> that has one
    or more GPU application(s)
    <li> Verify that GPU jobs are downloaded and executed. 
    <li> Verify that BOINC keeps your GPU (or GPUs, if you have more than one)
    busy all the time.
    <li> Verify that GPU-related preferences work.
    </ul>
    Notes:
    <ul>
    <li> GPUs won't work on Vista/Win7 if you chose the
        'protected application execution' install option.
        If this applies to you, either skip this test
        or reinstall BOINC without this option.
    </ul>
    "
);

$cuda = array("cuda", "NVIDIA GPU tests", 5, null,
    "(This test applies only if your computer has an NVIDIA GPU.)
    <ul>
    <li> Check <a href=http://www.nvidia.com/object/cuda_learn_products.html>here</a>
    to see if your GPU is CUDA-capable.
    <li> If it is, download and install the latest
    <a href=http://www.nvidia.com/object/cuda_get.html>CUDA driver</a>
    (you don't need the toolkit or SDK).
    <li> Attach to a
    <a href=http://boinc.berkeley.edu/wiki/GPU_computing>project that has an NVIDIA GPU application</a>
    <li> Verify that CUDA jobs are downloaded and executed.
        BOINC should keep your GPU (or GPUs, if you have more than one)
        busy all the time.
    <li> Verify that GPU-related preferences work.
    </ul>
    Notes:
    <ul>
    <li> CUDA won't work on Vista if you chose the
        'protected application execution' install option.
        If this applies to you, either skip this test
        or reinstall BOINC without this option.
    </ul>
    "
);

$ati = array("ati", "ATI GPU tests", 5, null,
    "(This test applies only if your computer has an ATI GPU.)
    <ul>
    <li> Check <a href=http://developer.amd.com/gpu/ATIStreamSDK/pages/ATIStreamSystemRequirements.aspx#cards>here</a>
    to see if your GPU is Stream-capable.
    <li> If it is, download and install the latest
    <a href=http://support.amd.com/us/gpudownload/Pages/index.aspx>CAL driver</a>.
    <li> Attach to
    <a href=http://boinc.berkeley.edu/wiki/GPU_computing>a project that has a CAL application</a>
    <li> Verify that CAL jobs are downloaded and executed.
        BOINC should keep your GPU (or GPUs, if you have more than one)
        busy all the time.
    <li> Verify that GPU-related preferences work.
    </ul>
    Notes:
    <ul>
    <li> CAL/Brook+ won't work on Vista if you chose the
    'protected application execution' install option.
    If this applies to you, either skip this test
    or reinstall BOINC without this option.
    </ul>
    "
);

$exclusive_app = array("exclusive_app", "Exclusive apps", 5, null,
    "<ul>
        <li>Add an 'exclusive application' to <b>cc_config.xml</b>.
        For example:
        <pre>
&lt;cc_config>
   &lt;options>
      &lt;exclusive_app>notepad.exe&lt;/exclusive_app>
   &lt;/options>
   ...
&lt;/cc_config>
        </pre>
        Verify that when you launch that application
        (<b>Notepad</b> in this case), BOINC suspends tasks.
     </ul>
    "
);

$boincmanager = array("boincmanager", "BOINC Manager tests", 5, null,
    "<ul>
        <li> Check that translation is working:
            in Advanced/Display and network options/General,
            select a non-English language,
            restart the Manager, and check that text is shown in that language.
        <li> In the Projects tab, select a project and click Properties;
            check that a dialog appears showing correct project info.
        <li> Same thing, for Task Properties.
     </ul>
    "
);

$boincmanagerexit = array("boincmanagerexit", "BOINC Manager Exit tests", 5, null,
    "<ul>
        <li> Verify that the shutdown option shuts down the core client.
        <li> Verify that the remember this choice feature works for future exits.
        <li> Re-enable display the exit dialog by going to the advanced view
             and selecting Advanced/Options from the menu.
     </ul>
    "
);

$boincmanagerterms = array("boincmanagerterms", "BOINC Manager Terms of Use tests", 5, null,
    "<ul>
        <li> Verify that the terms of use wizard page appears for the alpha project.
     </ul>
    "
);

$boincmanagernotices = array("boincmanagernotices", "BOINC Manager Notices", 5, null,
    "<ul>
        <li>\"Notices\" are advisory or informational items delivered to users
            in the Notices tab (Advanced view) or Notices window (Simple view).
            Some notices come from attached projects:
            <ul>
            <li> A project publishes a News item and designates it as a Notice.
            <li> A friend request or private message is sent to you.
            <li> A post is made in a thread to which you subscribe.
            </ul>
            The client polls projects (usually once per hour) for these notices;
            you can force the client to poll a project by Updating it.
            Other notices come from the client itself:
            <ul>
            <li> BOINC needs to communicate and there is no network connection.
            <li> BOINC reads one of your configuration files
                (cc_config.xml, app_info.xml, app_config.xml)
                and finds an error in it.
            </ul>
        <li> For as many of the above notice types as possible,
            verify that you receive a notice when appropriate.
        <li> Briefly attach to BOINC Alpha (http://boinc.berkeley.edu/alpha/),
            which has News items containing images and video.
            Verify that these are displayed correctly.
        <li> When a new notice arrives, the Manager tries to alert you:
             <ul>
             <li>Windows: a balloon pops up in the notification area.
             <li>Mac: a notification appears in the notification area.
             </ul>
             Arrange for a notice to arrive (from any of the above sources)
            and verify that you're alerted.
            Note: by default, at most one alert is delivered every 6 hours.
            You can adjust this intertval using <b>Options > General > Notice reminder interval</b> in the Manager.
            For testing purposes, set this to \"always\".
        <li> If you get a notice about a temporary error condition
            (no network connection, configuration file error)
            and you fix the error,
            the notice should disappear within 10 seconds.
            Verify this.
     </ul>
    "
);

$boincandroid = array("boincandroid", "BOINC Android GUI", 5, null,
    "<ul>
        <li> Choose-project wizard (access via the main menu or + icon in Projects screen).
            This lets you select a set of projects,
            then enter an email address and password.
            For each project:
            <ul>
            <li> If no account with that email exists, create one an attach to it.
            <li> If an account exists and the password matches, attach to it
            <li> If an account exists and the password doesn't match, show an error message
            <li> If the project is down, retry later,
                and show the outcome in the Projects screen.
            </ul>
            Test as many of these cases as possible.
        <li> Add project using URL (access via the Choose-project wizard).
            This lets you enter a project URL, then an email address / password.
            Test as many of these cases as possible:
            <ul> If you enter a URL that is not that of a BOINC project,
                you should get an error.
            <li> If you click \"Forgot password?\"
                you should go a web page asking for an email address,
                and then you should get an email address letting you
                reset your password.
            <li> If you click \"Register\" with the email address of
                an existing account, you should get an error.
            <li> If you click \"Sign in\" with an email address
                not that of an existing account, or the wrong password,
                you should get an error.
            </ul>
        <li> Projects screen:
            <ul>
            <li> check project commands (update, suspend/resume, etc.)
             by tapping on a project and selecting menu item;
            <li> check that status text is updated accordingly.
            <li> check that information on project details screen
                is displayed correctly.
            </ul>
        <li> Tasks screen:
            <ul>
            <li>check task commands (suspend/resume, abort)
             by tapping on a task and selecting menu item.
             </ul>
        <li> Preferences screen:
            <ul>
            <li> verify that Autostart works
             (i.e. that BOINC starts up when the device is rebooted).
            <li> verify that Notifications works
             (the BOINC icon in the upper left hand of the screen
             should update when the client is running or suspended).
            <li> enable \"Advanced preferences and controls\",
            and verify that you see more
            preferences (e.g. CPU limits) in the preferences screen
            and more project commands
            (No New Tasks and Reset) in the Projects screen.
            </ul>
        <li> Verify that orientation changes (screen rotations)
            result in expected behavior on all menus and screens.
        <li> Verify that share/invite functions work as expected.
        <li> Verify that computing is suspended if battery charge
            is below 90%.
            This is shown in the Status tab,
            and the event log should have messages showing the charge level.
        <li> Verify that computing is suspended if battery temperature
            exceeds 45 degrees Celsius
            (this may happen on some devices).
            This is shown in the Status tab,
            and the event log should have messages showing the temperature.
        <li> Verify that the client properly detects when you are 
             connected to USB or AC power (this is shown in the event log).
        <li> Verify that the client properly detects when you are
             connected to a WiFi network (this is shown in the event log).
     </ul>
    "
);

// the following tests are needed only when specific areas change
//
$as_needed_tests = array(
    $transfer_restart,                 // Only needed on libcurl version changes
    $proxyhttp,                        // Only needed on libcurl version changes
    $proxysocks,                       // Only needed on libcurl version changes
    $firewall,
    $v6_win_compat_private,
    $v6_win_secure_private,
    $v6_win_secure_public,
    $modem,
    $laptop,
    $screensaver,
    $gui_rpc_auth,
    $trickle,
    $cuda,
    $ati,
    $exclusive_app,
    $boincmanager,
    $boincmanagerterms,
    $boincmanagerexit,
    $boincmanagernotices,
    $attach_wizard,
    $acct_mgr,
    $preference,
    $boincandroid,
);

// the following needed for every client release
//
$general_tests = array(
    $general,
    $clean,
);

$all_test_groups = array_merge($general_tests, $as_needed_tests);

$test_smoke = array(
    $general,
);

$test_android = array(
    $boincandroid,
);

// deprecated
$all_test_groups_minus_android = array(
    $general,
    $clean,
    $preference,
);

$screensaver_tests = array(
    $general,
    $clean,
    $screensaver
);

// newer versions first
// MAKE SURE YOU USE THE APPROPRIATE SET OF TESTS
//
$versions = array(
    array("7.8.6", $screensaver_tests, $platforms_mac),
    array("7.8.3", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.8.2", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.8.1", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.8.0", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.7.2", $all_test_groups_minus_android, $platforms_win),
    array("7.6.33", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.6.31", $all_test_groups_minus_android, $platforms_mac),
    array("7.6.29", $all_test_groups_minus_android, $platforms_win),
    array("7.6.22", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.6.21", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.6.18", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.6.8", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.6.6", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.6.2", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.5.0", $test_smoke, $platforms_win_mac),
    array("7.4.42", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.4.36", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.4.35", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.4.32", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.4.31", $test_android, $platforms_android),
    array("7.4.30", $test_android, $platforms_android),
    array("7.4.27", $test_smoke, $platforms_win),
    array("7.4.26", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.4.23", $all_test_groups_minus_android, $platforms_mac),
    array("7.4.22", $all_test_groups_minus_android, $platforms_win),
    array("7.4.21", $all_test_groups_minus_android, $platforms_win_mac_linux),
    array("7.4.19", $all_test_groups_minus_android, $platforms_mac),
    array("7.4.14", $test_android, $platforms_android),
    array("7.4.12", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.4.8", $all_test_groups_minus_android, $platforms_win_mac),
    array("7.3.19", $all_test_groups_minus_android, $platforms_win_mac_linux),
    array("7.3.17", $test_android, $platforms_android),
    array("7.3.12", $test_android, $platforms_android),
    array("7.3.11", $all_test_groups_minus_android, $platforms_win_mac_linux),
    array("7.3.9", $test_android, $platforms_android),
    array("7.3.7", $test_android, $platforms_android),
    array("7.3.6", $test_android, $platforms_android),
    array("7.3.5", $test_android, $platforms_android),
    array("7.2.39", $all_test_groups_minus_android, $platforms_win_mac_linux),
    array("7.2.38", $all_test_groups_minus_android, $platforms_win_mac_linux),
    array("7.2.37", $all_test_groups, $all_platforms),
    array("7.2.36", $all_test_groups, $all_platforms),
    array("7.2.35", $test_android, $platforms_android),
    array("7.2.34", $all_test_groups_minus_android, $platforms_win_mac_linux),
    array("7.2.26", $all_test_groups_minus_android, $platforms_win_mac_linux),
    array("7.2.18", $all_test_groups_minus_android, $platforms_win_mac_linux),
    array("7.2.5", $all_test_groups_minus_android, $platforms_win_mac_linux),
    array("7.1.17", $test_smoke, $platforms_win_mac_linux),
    array("7.1.16", $test_android, $platforms_android),
    array("7.1.15", $test_smoke, $platforms_win_mac_linux),
    array("7.1.14", $test_android, $platforms_android),
    array("7.1.11", $test_android, $platforms_android),
    array("7.1.10", $test_smoke, $all_platforms),
    array("7.1.3", $test_smoke, $all_platforms),
    array("7.1.1", $test_smoke, $all_platforms),
    array("7.0.60", $all_test_groups, $all_platforms),
    array("7.0.59", $all_test_groups, $all_platforms),
    array("7.0.58", $all_test_groups, $all_platforms),
    array("7.0.56", $all_test_groups, $all_platforms),
    array("7.0.55", $test_smoke, $all_platforms),
    array("7.0.54", $test_smoke, $all_platforms),
    array("7.0.52", $test_smoke, $all_platforms),
    array("7.0.44", $test_smoke, $all_platforms),
    array("7.0.42", $test_smoke, $all_platforms),
    array("7.0.36", $test_smoke, $all_platforms),
    array("7.0.31", $test_smoke, $all_platforms),
    array("7.0.30", $test_smoke, $all_platforms),
    array("7.0.29", $test_smoke, $platforms_mac),
    array("7.0.28", $test_smoke, $all_platforms),
    array("7.0.23", $all_test_groups, $all_platforms),
    array("7.0.22", $all_test_groups, $all_platforms),
    array("7.0.20", $all_test_groups, $all_platforms),
    array("7.0.18", $all_test_groups, $all_platforms),
    array("7.0.8", $all_test_groups, $all_platforms),
    array("7.0.3", $all_test_groups, $all_platforms),
    array("7.0.2", $all_test_groups, $all_platforms),
);

?>
