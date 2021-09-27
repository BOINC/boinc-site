<?php

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
    return "Tested on the current Ubuntu distribution; may work on others.
    <br>These versions may not be current.
    We recommend that instead you
    <a href=https://boinc.berkeley.edu/wiki/Installing_BOINC#Linux>
    install BOINC using a package manager, run it using Docker,
    or use a bootable ISO image</a>.
    ";
}

$w716 = array(
    "num"=>"7.16.3",
    "status"=>"Development version",
    "file"=>"boinc_7.16.3_windows_intelx86.exe",
    "vbox_file"=>"boinc_7.16.3_windows_intelx86_vbox.exe",
    "vbox_version"=>"5.2.8",
    "date"=>"29 September 2019",
    "type"=>"win_new",
);


$w714 = array(
    "num"=>"7.14.2",
    "status"=>"Recommended version",
    "file"=>"boinc_7.14.2_windows_intelx86.exe",
    "vbox_file"=>"boinc_7.14.2_windows_intelx86_vbox.exe",
    "vbox_version"=>"5.2.8",
    "date"=>"11 October 2018",
    "type"=>"win_new",
);

$w712 = array(
    "num"=>"7.12.1",
    "status"=>"Older version",
    "file"=>"boinc_7.12.1_windows_intelx86.exe",
    "vbox_file"=>"boinc_7.12.1_windows_intelx86_vbox.exe",
    "vbox_version"=>"5.2.8",
    "date"=>"12 July 2018",
    "type"=>"win_new",
);

$w710 = array(
    "num"=>"7.10.2",
    "status"=>"Older version",
    "file"=>"boinc_7.10.2_windows_intelx86.exe",
    "vbox_file"=>"boinc_7.10.2_windows_intelx86_vbox.exe",
    "vbox_version"=>"5.2.8",
    "date"=>"3 May 2018",
    "type"=>"win_new",
);

$w78 = array(
    "num"=>"7.8.3",
    "status"=>"Older version",
    "file"=>"boinc_7.8.3_windows_intelx86.exe",
    "vbox_file"=>"boinc_7.8.3_windows_intelx86_vbox.exe",
    "vbox_version"=>"5.1.26",
    "date"=>"3 Oct 2017",
    "type"=>"win_new",
);

$w77 = array(
    "num"=>"7.7.2",
    "status"=>"Older version",
    "file"=>"boinc_7.7.2_windows_intelx86.exe",
    "vbox_file"=>"boinc_7.7.2_windows_intelx86_vbox.exe",
    "vbox_version"=>"5.1.18",
    "date"=>"25 Mar 2017",
    "type"=>"win_new",
);

$w76 = array(
    "num"=>"7.6.33",
    "status"=>"Older version",
    "file"=>"boinc_7.6.33_windows_intelx86.exe",
    "vbox_file"=>"boinc_7.6.33_windows_intelx86_vbox.exe",
    "vbox_version"=>"5.0.18",
    "date"=>"5 Jun 2016",
    "type"=>"win_new",
);

$w74 = array(
    "num"=>"7.4.42",
    "status"=>"Older version",
    "file"=>"boinc_7.4.42_windows_intelx86.exe",
    "vbox_file"=>"boinc_7.4.42_windows_intelx86_vbox.exe",
    "vbox_version"=>"4.3.12",
    "date"=>"10 Mar 2015",
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

$w716_11 = array(
    "num"=>"7.16.11",
    "status"=>"Recommended version",
    "file"=>"boinc_7.16.11_windows_x86_64.exe",
    "vbox_file"=>"boinc_7.16.11_windows_x86_64_vbox.exe",
    "vbox_version"=>"6.1.12",
    "date"=>"2 Sept 2020",
    "type"=>"win_new",
);

$w716x64 = array(
    "num"=>"7.16.7",
    "status"=>"Older version",
    "file"=>"boinc_7.16.7_windows_x86_64.exe",
    "vbox_file"=>"boinc_7.16.7_windows_x86_64_vbox.exe",
    "vbox_version"=>"6.0.14",
    "date"=>"28 May 2020",
    "type"=>"win_new",
);

$w716_5x64 = array(
    "num"=>"7.16.5",
    "status"=>"Older version",
    "file"=>"boinc_7.16.5_windows_x86_64.exe",
    "vbox_file"=>"boinc_7.16.5_windows_x86_64_vbox.exe",
    "vbox_version"=>"6.0.14",
    "date"=>"10 March 2020",
    "type"=>"win_new",
);

$w714x64 = array(
    "num"=>"7.14.2",
    "status"=>"Older version",
    "file"=>"boinc_7.14.2_windows_x86_64.exe",
    "vbox_file"=>"boinc_7.14.2_windows_x86_64_vbox.exe",
    "vbox_version"=>"5.2.8",
    "date"=>"11 October 2018",
    "type"=>"win_new",
);

$w712x64 = array(
    "num"=>"7.12.1",
    "status"=>"Older version",
    "file"=>"boinc_7.12.1_windows_x86_64.exe",
    "vbox_file"=>"boinc_7.12.1_windows_x86_64_vbox.exe",
    "vbox_version"=>"5.2.8",
    "date"=>"12 July 2018",
    "type"=>"win_new",
);

$w710x64 = array(
    "num"=>"7.10.2",
    "status"=>"Older version",
    "file"=>"boinc_7.10.2_windows_x86_64.exe",
    "vbox_file"=>"boinc_7.10.2_windows_x86_64_vbox.exe",
    "vbox_version"=>"5.2.8",
    "date"=>"3 May 2018",
    "type"=>"win_new",
);

$w78x64 = array(
    "num"=>"7.8.3",
    "status"=>"Older version",
    "file"=>"boinc_7.8.3_windows_x86_64.exe",
    "vbox_file"=>"boinc_7.8.3_windows_x86_64_vbox.exe",
    "vbox_version"=>"5.1.26",
    "date"=>"3 Oct 2017",
    "type"=>"win_new",
);

$w77x64 = array(
    "num"=>"7.7.2",
    "status"=>"Development version",
    "file"=>"boinc_7.7.2_windows_x86_64.exe",
    "vbox_file"=>"boinc_7.7.2_windows_x86_64_vbox.exe",
    "vbox_version"=>"5.1.18",
    "date"=>"25 Mar 2017",
    "type"=>"win_new",
);

$w76x64 = array(
    "num"=>"7.6.33",
    "status"=>"Older version",
    "file"=>"boinc_7.6.33_windows_x86_64.exe",
    "vbox_file"=>"boinc_7.6.33_windows_x86_64_vbox.exe",
    "vbox_version"=>"5.0.18",
    "date"=>"5 Jun 2016",
    "type"=>"win_new",
);

$w74x64 = array(
    "num"=>"7.4.42",
    "status"=>"Older version",
    "file"=>"boinc_7.4.42_windows_x86_64.exe",
    "vbox_file"=>"boinc_7.4.42_windows_x86_64_vbox.exe",
    "vbox_version"=>"4.3.12",
    "date"=>"10 Mar 2015",
    "type"=>"win_new",
);

$w72x64 = array(
    "num"=>"7.2.42",
    "status"=>"Older version",
    "file"=>"boinc_7.2.42_windows_x86_64.exe",
    "vbox_file"=>"boinc_7.2.42_windows_x86_64_vbox.exe",
    "vbox_version"=>"4.2.16",
    "date"=>"28 Feb 2014",
    "type"=>"win_new",
);

///// MAC STARTS HERE

$m716_19 = array(
    "num"=>"7.16.19",
    "status"=>"Recommended version",
    "file"=>"boinc_7.16.19_macOSX_universal.zip",
    "date"=>"16 Sep 2021",
    "type"=>"mac_advanced",
);

$m716_19c = array(
    "num"=>"7.16.19",
    "status"=>"Recommended version (Unix command-line version)",
    "file"=>"boinc_7.16.19_universal-apple-darwin.dmg",
    "date"=>"16 Sep 2021",
    "type"=>"bare_core",
);

$m716_14 = array(
    "num"=>"7.16.14",
    "status"=>"Older version",
    "file"=>"boinc_7.16.14_macOSX_universal.zip",
    "date"=>"30 Nov 2020",
    "type"=>"mac_advanced",
);

$m716_14c = array(
    "num"=>"7.16.14",
    "status"=>"Older version (Unix command-line version)",
    "file"=>"boinc_7.16.14_universal-apple-darwin.dmg",
    "date"=>"30 Nov 2020",
    "type"=>"bare_core",
);

$m716_6 = array(
    "num"=>"7.16.6",
    "status"=>"Older version",
    "file"=>"boinc_7.16.6_macOSX_x86_64.zip",
    "date"=>"3 April 2020",
    "type"=>"mac_advanced",
);

$m716_6c = array(
    "num"=>"7.16.6",
    "status"=>"Older version (Unix command-line version)",
    "file"=>"boinc_7.16.6_x86_64-apple-darwin.zip",
    "date"=>"3 April 2020",
    "type"=>"bare_core",
   ); 
   
$m716_11 = array(
    "num"=>"7.16.11",
    "status"=>"Recommended version",
    "file"=>"boinc_7.16.11_macOSX_x86_64.zip",
    "date"=>"30 Aug 2020",
    "type"=>"mac_advanced",
);

$m716_11c = array(
    "num"=>"7.16.11",
    "status"=>"Recommended version (Unix command-line version)",
    "file"=>"boinc_7.16.11_x86_64-apple-darwin.zip",
    "date"=>"30 Aug 2020",
    "type"=>"bare_core",
   ); 
   
$m72 = array(
    "num"=>"7.2.42",
    "status"=>"Recommended version",
    "file"=>"boinc_7.2.42_macOSX_i686.zip",
    "date"=>"28 Feb 2014",
    "type"=>"mac_advanced",
);

$m612_ppc = array(
    "num"=>"6.12.35",
    "status"=>"Recommended version",
    "file"=>"boinc_6.12.35_macOSX_universal.zip",
    "date"=>"11 Aug 2011",
    "type"=>"mac_advanced",
);

$m66 = array(
    "num"=>"6.6.36",
    "status"=>"Older version (standard GUI) (works on OS 10.3.9 - OS 10.5.8)",
    "file"=>"boinc_6.6.36_macOSX_universal.zip",
    "date"=>"10 June 2009",
    "type"=>"mac_advanced",
);

$mupdater = array(
    "num"=>"any",
    "status"=>"Certificate updater for old versions of BOINC (works on OS 10.3.9 - OS 10.5.8)",
    "file"=>"update_boinc_certificate.zip",
    "date"=>"28 April 2018",
    "type"=>"cert_updater",
);

$m72c = array(
    "num"=>"7.2.42",
    "status"=>"Recommended version (Unix command-line version)",
    "file"=>"boinc_7.2.42_i686-apple-darwin.zip",
    "date"=>"28 Feb 2014",
    "type"=>"bare_core",
);

$m612c_ppc = array(
    "num"=>"6.12.35",
    "status"=>"Recommended version (Unix command-line version)",
    "file"=>"boinc_6.12.35_universal-apple-darwin.zip",
    "date"=>"11 Aug 2011",
    "type"=>"bare_core",
);

$m66c = array(
    "num"=>"6.6.36",
    "status"=>"Older version (Unix command-line version) (works on OS 10.3.9 - OS 10.5.8)",
    "file"=>"boinc_6.6.36_universal-apple-darwin.zip",
    "date"=>"10 June 2009",
    "type"=>"bare_core",
);

$l612 = array(
    "num"=>"6.12.22",
    "status"=>"Recommended version",
    "file"=>"boinc_compat_6.12.22_i686-pc-linux-gnu.sh",
    "date"=>"6 Apr 2011",
    "type"=>"sea",
);

$l74ubuntudev = array(
    "num"=>"7.4.22",
    "status"=>"Recommended version",
    "file"=>"boinc_7.4.22_i686-pc-linux-gnu.sh",
    "date"=>"17 Sept 2014",
    "type"=>"sea",
);

$l72ubuntu = array(
    "num"=>"7.2.42",
    "status"=>"Recommended version",
    "file"=>"boinc_7.2.42_i686-pc-linux-gnu.sh",
    "date"=>"28 Feb 2014",
    "type"=>"sea",
);

$l70ubuntu = array(
    "num"=>"7.0.65",
    "status"=>"Older version",
    "file"=>"boinc_7.0.65_i686-pc-linux-gnu.sh",
    "date"=>"17 Apr 2013",
    "type"=>"sea",
);

$l716ubuntux64dev = array(
    "num"=>"7.16.6",
    "status"=>"Development version",
    "file"=>"boinc_ubuntu_7.16.6_x86_64-pc-linux-gnu.sh",
    "date"=>"5 April 2020",
    "type"=>"sea",
);

$l74ubuntux64dev = array(
    "num"=>"7.4.22",
    "status"=>"Recommended version",
    "file"=>"boinc_7.4.22_x86_64-pc-linux-gnu.sh",
    "date"=>"17 Sept 2014",
    "type"=>"sea",
);

$l72ubuntux64 = array(
    "num"=>"7.2.42",
    "status"=>"Recommended version",
    "file"=>"boinc_7.2.42_x86_64-pc-linux-gnu.sh",
    "date"=>"28 Feb 2014",
    "type"=>"sea",
);

$l70ubuntux64 = array(
    "num"=>"7.0.65",
    "status"=>"Older version",
    "file"=>"boinc_7.0.65_x86_64-pc-linux-gnu.sh",
    "date"=>"17 Apr 2013",
    "type"=>"sea",
);

$a718 = array(
    "num"=>"7.18.1",
    "status"=>"Recommended Version",
    "file"=>"boinc_7.18.1.apk",
    "date"=>"5 August 2021",
    "type"=>"apk",
);

$a716 = array(
    "num"=>"7.16.16",
    "status"=>"Older Version",
    "file"=>"boinc_7.16.16.apk",
    "date"=>"12 Feb 2021",
    "type"=>"apk",
);

$a74dev = array(
    "num"=>"7.4.31",
    "status"=>"Development Version",
    "file"=>"boinc_7.4.31.apk",
    "date"=>"26 Nov 2014",
    "type"=>"apk",
);

$a74 = array(
    "num"=>"7.4.53",
    "status"=>"Older Version",
    "file"=>"boinc_7.4.53.apk",
    "date"=>"3 Jul 2016",
    "type"=>"apk",
);

$a74dev = array(
    "num"=>"7.4.43",
    "status"=>"Development Version",
    "file"=>"boinc_7.4.43.apk",
    "date"=>"15 Apr 2016",
    "type"=>"apk",
);

// platform descriptors.  For each one, "versions"
// lists versions in reverse time order.
// i.e. the first non-dev version is the current one

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

$windowsx64 = array(
    "name"=>"Windows 64-bit",
    "description"=>"Vista/7/8/8.1/10",
    "dbname" => "windows_x86_64",
    "versions"=> array(
          $w716_11,
          $w716x64,
    )
);

$mac = array(
    "name"=>"Apple Mac (64-bit Intel and Apple Silicon)",
    "description"=>"MacOS 10.9+",
    "dbname" => "x86_64-apple-darwin",
    "versions"=>array(
          $m716_19,
          $m716_19c,
          $m716_14,
          $m716_14c,
    )
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

$mac32 = array(
    "name"=>"Apple Mac (32-bit or 64-bit Intel)",
    "description"=>"MacOS 10.4.0+",
    "dbname" => "x86_64-apple-darwin",
    "versions"=>array(
          $m72,
          $m72c,
    )
);

$macppc = array(
    "name"=>"Apple Mac (Power PC or 32-bit Intel)",
    "description"=>"MacOS 10.4.0+",
    "dbname" => "powerpc-apple-darwin",
    "versions"=>array(
        $m612_ppc,
        $m612c_ppc,
        $mupdater,
    )
);

$linux = array(
    "name"=>"Linux x86",
    "description"=> linux_info(),
    "dbname" => "i686-pc-linux-gnu",
    "versions"=>array(
          $l74ubuntudev,
          //$l72ubuntu,
    )
);

$linuxx64 = array(
    "name"=>"Linux x64",
    "description"=> linux_info(),
    "dbname" => "x86_64-pc-linux-gnu",
    "versions"=>array(
          $l716ubuntux64dev,
          $l74ubuntux64dev,
          //$l72ubuntux64,
    )
);

$linuxcompat = array(
    "name"=>"Older Linux x86 and x64",
    "description"=>"For older Linux versions, both x86 and x64; command-line interface only",
    "dbname" => "i686-pc-linux-gnu",
    "versions"=>array(
        $l612,
    )
);

$android = array(
    "name"=>"Android",
    "description"=>"Android version 4.1 and later for ARM, AArch64, MIPS, MIPS64, x86, and x86_64
    <br> Amazon Fire tablets: install from the Amazon Appstore.
    <br> Available on <a href=https://f-droid.org/en/packages/edu.berkeley.boinc/>F-Droid</a>, a repository of open-source apps.
    <br> Or download and install the APK below.  If you have problems, see instructions <a href=https://www.lifewire.com/install-apk-on-android-4177185>here</a>",
    "dbname" => "arm-android-linux-gnu",
    "versions"=>array(
        $a718,
        $a716
    )
);

$platforms = array(
    "winx64"=>$windowsx64,
    "win"=>$windows,
    "mac"=>$mac,
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
    foreach ($p['versions'] as $i=>$v) {
        if (!$dev && is_dev($v)) continue;
        return $v;
    }
    foreach ($p['versions'] as $i=>$v) {
        return $v;
    }
}


$url_base = "https://boinc.berkeley.edu/dl/";

?>
