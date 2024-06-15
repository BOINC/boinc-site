<?php

// Versions of the BOINC client.
// This determines what gets shown on the download page,
// and when the client shows a "new version available" notice.
//
// When you add a version:
// - put it in the right place
// - status is either "Development version" or "Recommended version"
//      (or "Older version" if needed)
// - delete unused versions
// - if changing a recommended version:
//      - email boinc_projects, telling them to run html/ops/get_versions.php
//          if they use auto-attach
//          (see https://github.com/BOINC/boinc/wiki/SimpleAttach>
//      - run get_versions.php in Science United and BOINC Central
//      - post news item on BOINC and Science Unite

// List of platforms.
// Each has a list of versions, then a structure in which "versions"
// lists versions in reverse time order.
// i.e. the first non-dev version is the current one

// -------------- Windows 64-bit -------------------

$w80 = array(
    "num"=>"8.0.2",
    "status"=>"Recommended version",
    "file"=>"boinc_8.0.2_windows_x86_64.exe",
    "vbox_file"=>"boinc_8.0.2_windows_x86_64_vbox.exe",
    "vbox_version"=>"7.0.6",
    "date"=>"30 May 2024",
    "type"=>"win_new"
);

$w724_1 = array(
    "num"=>"7.24.1",
    "status"=>"Older version",
    "file"=>"boinc_7.24.1_windows_x86_64.exe",
    "vbox_file"=>"boinc_7.24.1_windows_x86_64_vbox.exe",
    "vbox_version"=>"7.0.6",
    "date"=>"12 Aug 2023",
    "type"=>"win_new"
);

$windowsx64 = array(
    "name"=>"Windows 64-bit",
    "description"=>"Vista/7/8/8.1/10/11",
    "dbname" => "windows_x86_64",
    "versions"=> array(
        $w80,
        $w724_1
    )
);

// -------------- Windows 32-bit -------------------

$w714 = array(
    "num"=>"7.14.2",
    "status"=>"Recommended version",
    "file"=>"boinc_7.14.2_windows_intelx86.exe",
    "vbox_file"=>"boinc_7.14.2_windows_intelx86_vbox.exe",
    "vbox_version"=>"5.2.8",
    "date"=>"11 October 2018",
    "type"=>"win_new",
);

$w66 = array(
    "num"=>"6.6.38",
    "status"=>"Older version (also works on Windows 98 and ME)",
    "file"=>"boinc_6.6.38_windows_intelx86.exe",
    "date"=>"28 Oct 2009",
    "type"=>"win_new",
);

$w5816 = array(
    "num"=>"5.8.16",
    "status"=>"Older version (also works on Windows 95 and NT 4.0)",
    "file"=>"boinc_5.8.16_windows_intelx86.exe",
    "date"=>"1 Mar 2007",
    "type"=>"win_new",
);

$windows = array(
    "name"=>"Windows 32-bit",
    "description"=>"XP/Vista/7/8/8.1/10",
    "dbname" => "windows_intelx86",
    "versions"=>array(
          $w714,
          $w66,
          $w5816,
    )
);

// --------------- Mac Intel 64 or ARM --------------------

$m80_2 = array(
    "num"=>"8.0.2",
    "status"=>"Recommended version (MacOS 10.13+)",
    "file"=>"boinc_8.0.2_macOSX_universal.zip",
    "date"=>"30 May 2024",
    "type"=>"mac_advanced",
    "min_os_version"=>"101300",
    "max_os_version"=>"999999",
);

$m80_2c = array(
    "num"=>"8.0.2",
    "status"=>"Recommended version (Unix command-line version) (MacOS 10.13+)",
    "file"=>"boinc_8.0.2_universal-apple-darwin.dmg",
    "date"=>"30 May 2024",
    "type"=>"bare_core",
    "min_os_version"=>"101300",
    "max_os_version"=>"999999",
);

// Do not remove 7.20.2, which is latest version that can run on MacOS 10.10
$m720_2 = array(
    "num"=>"7.20.2",
    "status"=>"Older version (MacOS 10.10 - MacOS 12.x)",
    "file"=>"boinc_7.20.2_macOSX_universal.zip",
    "date"=>"19 Jul 2022",
    "type"=>"mac_advanced",
    "min_os_version"=>"101000",
    "max_os_version"=>"129999",
);

// Do not remove 7.20.2, which is latest version that can run on MacOS 10.10
$m720_2c = array(
    "num"=>"7.20.2",
    "status"=>"Older version (Unix command-line version) (MacOS 10.10 - MacOS 12.x)",
    "file"=>"boinc_7.20.2_universal-apple-darwin.dmg",
    "date"=>"19 Jul 2022",
    "type"=>"bare_core",
    "min_os_version"=>"101000",
    "max_os_version"=>"129999",
);

// Do not remove 7.16.21, which is latest version that can run on MacOS 10.9
$m716_21 = array(
    "num"=>"7.16.21",
    "status"=>"Older version (MacOS 10.9 - MacOS 12.x)",
    "file"=>"boinc_7.16.21_macOSX_universal.zip",
    "date"=>"23 Mar 2022",
    "type"=>"mac_advanced",
    "min_os_version"=>"100900",
    "max_os_version"=>"129999",
);

// Do not remove 7.16.21, which is latest version that can run on MacOS 10.9
$m716_21c = array(
    "num"=>"7.16.21",
    "status"=>"Older version (Unix command-line version) (MacOS 10.9 - MacOS 12.x)",
    "file"=>"boinc_7.16.21_universal-apple-darwin.dmg",
    "date"=>"23 Mar 2022",
    "type"=>"bare_core",
    "min_os_version"=>"100900",
    "max_os_version"=>"129999",
);

// Mac Universal builds contain code for both Intel 64 and 
// Apple Silicon (ARM64) Macs, but the two architectures 
// report different primary platforms so we need to include
// these builds in both the $mac and $mac_arm arrays for
// the client's New Version Check code to handle them properly.
// See GitHub Issue #4551 for more details.

$mac = array(
    "name"=>"Apple Mac (64-bit Intel and Apple Silicon)",
    "description"=>null,
    "dbname" => "x86_64-apple-darwin",
    "versions"=>array(
        $m80_2,
        $m80_2c,
        $m720_2,  // Keep 7.20.2, which is latest version that can run on MacOS 10.10 - 10.12
        $m720_2c,
        $m716_21, // Keep 7.16.21, which is latest version that can run on MacOS 10.9
        $m716_21c,
    )
);

// mac_arm is not currently used (but see comment above)
$mac_arm = array(
    "name"=>"Apple Mac (64-bit Intel and Apple Silicon)",
    "description"=>null,
    "dbname" => "arm64-apple-darwin",
    "versions"=>array(
        $m80_2,
        $m80_2c,
        $m720_2,   // Keep 7.20.2, which is latest version that can run on MacOS 10.10 - 10.12
        $m720_2c,
        $m716_21,  // Keep 7.16.21, which is latest version that can run on MacOS 10.9
        $m716_21c,
    )
);

// The following are for download.php (not download_all.php)
// for old OS versions
$mac_10_10_plus = [
    "name"=>"Apple Mac (64-bit Intel and Apple Silicon)",
    "versions"=> [$m720_2]
];

$mac_10_9_plus = [
    "name"=>"Apple Mac (64-bit Intel and Apple Silicon)",
    "versions"=> [$m716_21]
];

// --------------- Mac Intel 64 --------------------

$m716_11 = array(
    "num"=>"7.16.11",
    "status"=>"Recommended version",
    "file"=>"boinc_7.16.11_macOSX_x86_64.zip",
    "date"=>"30 Aug 2020",
    "type"=>"mac_advanced",
    "min_os_version"=>"100700",
    "max_os_version"=>"100899",
);

$m716_11c = array(
    "num"=>"7.16.11",
    "status"=>"Recommended version (Unix command-line version)",
    "file"=>"boinc_7.16.11_x86_64-apple-darwin.zip",
    "date"=>"30 Aug 2020",
    "type"=>"bare_core",
    "min_os_version"=>"100700",
    "max_os_version"=>"100899",
); 
   
$m716_6 = array(
    "num"=>"7.16.6",
    "status"=>"Older version",
    "file"=>"boinc_7.16.6_macOSX_x86_64.zip",
    "date"=>"3 April 2020",
    "type"=>"mac_advanced",
    "min_os_version"=>"100700",
    "max_os_version"=>"100899",
);

$m716_6c = array(
    "num"=>"7.16.6",
    "status"=>"Older version (Unix command-line version)",
    "file"=>"boinc_7.16.6_x86_64-apple-darwin.zip",
    "date"=>"3 April 2020",
    "type"=>"bare_core",
    "min_os_version"=>"100700",
    "max_os_version"=>"100899",
); 
   
$mac_10_7 = array(
    "name"=>"Apple Mac (64-bit Intel)",
    "description"=>"MacOS 10.7 - 10.15",
    "dbname" => "x86_64-apple-darwin",
    "versions"=>array(
          $m716_11,
          $m716_11c,
          $m716_6,
          $m716_6c,
    )
);

// --------------- Mac Intel 32/64 --------------------

$m72 = array(
    "num"=>"7.2.42",
    "status"=>"Recommended version",
    "file"=>"boinc_7.2.42_macOSX_i686.zip",
    "date"=>"28 Feb 2014",
    "type"=>"mac_advanced",
    "min_os_version"=>"100400",
    "max_os_version"=>"100699",
);

$m72c = array(
    "num"=>"7.2.42",
    "status"=>"Recommended version (Unix command-line version)",
    "file"=>"boinc_7.2.42_i686-apple-darwin.zip",
    "date"=>"28 Feb 2014",
    "type"=>"bare_core",
    "min_os_version"=>"100400",
    "max_os_version"=>"100699",
);

$mupdater = array(
    "num"=>"any",
    "status"=>"Certificate updater for old versions of BOINC before 7.9.1 only",
    "file"=>"update_boinc_certificate.zip",
    "date"=>"28 April 2018",
    "type"=>"cert_updater",
);

$mac32 = array(
    "name"=>"Apple Mac (32-bit or 64-bit Intel)",
    "description"=>"MacOS 10.4.0+",
    "dbname" => "x86_64-apple-darwin",
    "versions"=>array(
          $m72,
          $m72c,
          $mupdater,
    )
);

// --------------- Mac PowerPC --------------------

$m612_ppc = array(
    "num"=>"6.12.35",
    "status"=>"Recommended version",
    "file"=>"boinc_6.12.35_macOSX_universal.zip",
    "date"=>"11 Aug 2011",
    "type"=>"mac_advanced",
    "min_os_version"=>"100400",
    "max_os_version"=>"100699",
);

$m612c_ppc = array(
    "num"=>"6.12.35",
    "status"=>"Recommended version (Unix command-line version)",
    "file"=>"boinc_6.12.35_universal-apple-darwin.zip",
    "date"=>"11 Aug 2011",
    "type"=>"bare_core",
    "min_os_version"=>"100400",
    "max_os_version"=>"100699",
);

$m66 = array(
    "num"=>"6.6.36",
    "status"=>"Older version (standard GUI) (works on OS 10.3.9 - OS 10.5.8)",
    "file"=>"boinc_6.6.36_macOSX_universal.zip",
    "date"=>"10 June 2009",
    "type"=>"mac_advanced",
    "min_os_version"=>"100309",
    "max_os_version"=>"100599",
);

$m66c = array(
    "num"=>"6.6.36",
    "status"=>"Older version (Unix command-line version) (works on OS 10.3.9 - OS 10.5.8)",
    "file"=>"boinc_6.6.36_universal-apple-darwin.zip",
    "date"=>"10 June 2009",
    "type"=>"bare_core",
    "min_os_version"=>"100309",
    "max_os_version"=>"100599",
);

$macppc = array(
    "name"=>"Apple Mac (Power PC or 32-bit Intel)",
    "description"=>"MacOS 10.4.0+",
    "dbname" => "powerpc-apple-darwin",
    "versions"=>array(
        $m612_ppc,
        $m612c_ppc,
        $m66,
        $m66c,
    )
);

// --------------- Linux 64-bit --------------------

$l716ubuntux64dev = array(
    "num"=>"7.16.6",
    "status"=>"Development version",
    "file"=>"boinc_ubuntu_7.16.6_x86_64-pc-linux-gnu.sh",
    "date"=>"5 April 2020",
    "type"=>"sea",
);

$l74ubuntux64 = array(
    "num"=>"7.4.22",
    "status"=>"Older version",
    "file"=>"boinc_7.4.22_x86_64-pc-linux-gnu.sh",
    "date"=>"17 Sept 2014",
    "type"=>"sea",
);

$linux_80 = array(
    "num"=>"8.0.2",
    "status"=>"Recommended version",
    'file'=>'',
    "date"=>"30 May 2024",
    "type"=>'linux_pkg'
);

$linuxx64 = array(
    "name"=>"Linux x64",
    //"description"=> linux_info(),
    "description"=> 'Packages are available for several distros',
    "dbname" => "x86_64-pc-linux-gnu",
    "versions"=>array(
        $linux_80,
        //$l716ubuntux64dev,
        //$l74ubuntux64,
    )
);

// --------------- Linux 32-bit --------------------

$l74ubuntu = array(
    "num"=>"7.4.22",
    "status"=>"Recommended version",
    "file"=>"boinc_7.4.22_i686-pc-linux-gnu.sh",
    "date"=>"17 Sept 2014",
    "type"=>"sea",
);

$linux = array(
    "name"=>"Linux x86",
    "description"=> linux_info(),
    "dbname" => "i686-pc-linux-gnu",
    "versions"=>array(
          $l74ubuntu,
    )
);

// --------------- Older Linux --------------------

$l612 = array(
    "num"=>"6.12.22",
    "status"=>"Recommended version",
    "file"=>"boinc_compat_6.12.22_i686-pc-linux-gnu.sh",
    "date"=>"6 Apr 2011",
    "type"=>"sea",
);

$linuxcompat = array(
    "name"=>"Older Linux x86 and x64",
    "description"=>"For older Linux versions, both x86 and x64; command-line interface only",
    "dbname" => "i686-pc-linux-gnu",
    "versions"=>array(
        $l612,
    )
);

// --------------- Android --------------------

$a80 = array(
    "num"=>"8.0.2",
    "status"=>"Recommended version",
    "file"=>"boinc_8.0.2.apk",
    "date"=>"30 May 2024",
    "type"=>"apk",
);

$a724_1 = array(
    "num"=>"7.24.1",
    "status"=>"Older Version",
    "file"=>"boinc_7.24.1.apk",
    "date"=>"12 Aug 2023",
    "type"=>"apk",
);

$a716 = array(
    "num"=>"7.16.16",
    "status"=>"Older Version",
    "file"=>"boinc_7.16.16.apk",
    "date"=>"12 Feb 2021",
    "type"=>"apk",
);

$android = array(
    "name"=>"Android",
    "description"=>"Android version 4.1 and later for ARM, AArch64, x86, and x86_64
    <br> Amazon Fire tablets: install from the Amazon Appstore.
    <br> Available on <a href=https://f-droid.org/en/packages/edu.berkeley.boinc/>F-Droid</a>, a repository of open-source apps.
    <br> Or download and install the APK below.  If you have problems, see instructions <a href=https://www.lifewire.com/install-apk-on-android-4177185>here</a>",
    "dbname" => "arm-android-linux-gnu",
    "versions"=>array(
        $a80,
        $a724_1,
        $a716
    )
);

// -------------- END OF PLATFORMS -------------------

$platforms = array(
    "winx64"=>$windowsx64,
    "win"=>$windows,
    "mac"=>$mac,
    "mac_arm"=>$mac_arm,
    "mac_10_10_plus"=>$mac_10_10_plus,
    "mac_10_9_plus"=>$mac_10_9_plus,
    "mac_10_7"=>$mac_10_7,
    "mac32"=>$mac32,
    "macppc"=>$macppc,
    "linuxx64"=>$linuxx64,
    "linux"=>$linux,
    "linuxcompat"=>$linuxcompat,
    "android"=>$android,
);

function is_dev($v) {
    return (strstr($v["status"], "Development") != null);
}

function latest_version($p) {
    $dev = false;
    // skip development versions
    //
    foreach ($p['versions'] as $i=>$v) {
        if (!$dev && is_dev($v)) continue;
        return $v;
    }
    // if there are only dev versions, return first one
    //
    foreach ($p['versions'] as $i=>$v) {
        return $v;
    }
}

function type_text($type) {
    global $xml;
    if ($xml) {
        switch($type) {
        case "win_old":
            return "Single-mode Windows installer";
        case "win_new":
            return "Windows installer";
        case "bare_core":
            return "Command-line client (no GUI)";
        case "sea":
            return "Self-extracting archive";
        case "mac_advanced":
            return "Standard GUI";
        case "apk":
            return "Android Installer";
        case "linux_pkg":
            return 'Linux package';
        }
    } else {
        switch($type) {
        case "win_old":
            return "<a href=client_windows.php>Single-mode Windows installer</a>";
        case "win_new":
            return "<a href=win_install.php>Windows installer</a>";
        case "bare_core":
            return "<a href=bare_core.php>Command-line client (no GUI)</a>";
        case "sea":
            return "<a href=sea.php>Self-extracting archive</a>";
        case "mac_advanced":
            return "<a href=mac_advanced.php>Standard GUI</a>";
        case "apk":
            return "TBD";
        }
    }
}

function linux_info() {
    return "Tested on Ubuntu; may work on others.
    ";
}

// do not delete!
$url_base = "https://boinc.berkeley.edu/dl/";

?>
