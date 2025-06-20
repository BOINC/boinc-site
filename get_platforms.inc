<?php

ini_set('display_errors', 'stdout');
error_reporting(E_ALL);

// when read list of supported platforms from a project,
// cache it for this long
//
define('CACHE_LIFETIME', 86400);

// The platforms for a given project are stored in a JSON file platforms/URL.
// It's a list of 'extended platform names': strings of the form
// <platform>
// or
// <platform>[<planclass>]

// convert extended platform name to human-readable string
//
function friendly_name($p) {
    $x = explode('[', $p);
    $pc = "";
    if (sizeof($x) > 1) {
        $p = $x[0];
        $pc = substr($x[1], 0, -1);
    }

    if (strstr($p, "fubar")) return null;
    if ($p == 'x86_64-unknown-linux-gnu') return null;
    $q = $p;
    switch ($p) {
    case 'i686-pc-linux-gnu': $q = 'Linux/x86'; break;
    case 'windows_intelx86': $q = 'Windows'; break;
    case 'x86_64-pc-linux-gnu': $q = 'Linux/x64'; break;
    case 'i686-apple-darwin': $q = 'Mac OS X'; break;
    case 'x86_64-apple-darwin': $q = 'Mac OS X 64-bit'; break;
    case 'powerpc-apple-darwin': $q = 'Mac OS X (PowerPC)'; break;
    case 'sparc-sun-solaris2.7': $q = 'SPARC Solaris 2.7'; break;
    case 'sparc-sun-solaris': $q = 'SPARC Solaris'; break;
    case 'powerpc64-unknown-linux-gnu': $q = 'Linux/PowerPC64'; break;
    case 'windows_x86_64': $q = 'Windows/x64'; break;
    case 'powerpc64-ps3-linux-gnu': $q = 'Playstation3/Linux'; break;
    case 'i386-portbld-freebsd': $q = 'FreeBSD/x86'; break;
    case 'windows_amd64': $q = 'Windows/Opteron'; break;
    case 'x86_64-pc-solaris': $q = 'Solaris/x64'; break;
    case 'windows_intelx86_64': $q = 'Windows/x64'; break;
    case 'arm-android-linux-gnu': $q = 'Android/ARM'; break;
    case 'arm-android': $q = 'Android/ARM'; break;
    case 'arm-unknown-linux-gnu': $q = 'Linux/ARM'; break;
    case 'aarch64-unknown-linux-gnu': $q = 'Linux on ARM64'; break;
    case 'x86_64-pc-freebsd': $q = 'FreeBSD/x86'; break;
    case 'arm-unknown-linux-gnueabihf': $q = 'Linux on ARM (e.g., Raspberry Pi)'; break;
    }
    if (strlen($pc)) {
        if (strstr($pc, 'cuda')) $q .= " (NVIDIA GPU)";
        else if (strstr($pc, 'nvidia')) $q .= " (NVIDIA GPU)";
        else if (strstr($pc, 'ati')) $q .= " (AMD/ATI GPU)";
        else if (strstr($pc, 'amd')) $q .= " (AMD/ATI GPU)";
        else if (strstr($pc, 'intel_gpu')) $q .= " (Intel GPU)";
        else if (strstr($pc, 'apple_gpu')) $q .= " (Apple GPU)";

        if (strstr($pc, 'mt')) $q .= " (multicore)";

        if (strstr($pc, 'vbox32')) $q .= " (VirtualBox 32-bit)";
        else if (strstr($pc, 'vbox64')) $q .= " (VirtualBox 64-bit)";
        else if (strstr($pc, 'docker')) $q .= " (Docker)";
    }
    return $q;
}

// return an array of bools for the supported platforms,
// GPU types, and virtualization types
//
function get_platform_icon_flags($platforms) {
    $x = new StdClass;
    $x->windows = false;
    $x->mac = false;
    $x->linux = false;
    $x->android = false;
    $x->freebsd = false;
    $x->rasp_pi = false;
    $x->nvidia_gpu = false;
    $x->amd_gpu = false;
    $x->intel_gpu = false;
    $x->apple_gpu = false;
    $x->vbox = false;
    $x->docker = false;
    foreach ($platforms as $plat) {
        $p = $plat;
        $y = explode('[', $plat);
        $pc = "";
        if (sizeof($y) > 1) {
            $p = $y[0];
            $pc = substr($y[1], 0, -1);
        }
        if (strstr($p, "windows")) $x->windows = true;
        else if (strstr($p, "darwin")) $x->mac = true;
        else if (strstr($p, "android")) $x->android = true;
        else if (strstr($p, "freebsd")) $x->freebsd = true;
        else if (strstr($p, "arm-unknown-linux-gnueabihf")) $x->rasp_pi = true;
        else if (strstr($p, "armv5")) $x->rasp_pi = true;
        else if (strstr($p, "aarch64")) $x->rasp_pi = true;
        else if (strstr($p, "armv6")) $x->rasp_pi = true;
        else if (strstr($p, "linux")) $x->linux = true;
            // must follow android, rasp_pi options

        if (strstr($pc, "ati")) $x->amd_gpu = true;
        else if (strstr($pc, "amd")) $x->amd_gpu = true;
        else if (strstr($pc, "cuda")) $x->nvidia_gpu = true;
        else if (strstr($pc, "nvidia")) $x->nvidia_gpu = true;
        else if (strstr($pc, "intel_gpu")) $x->intel_gpu = true;
        else if (strstr($pc, "apple_gpu")) $x->apple_gpu = true;

        if (strstr($pc, "vbox")) $x->vbox = true;
        else if (strstr($pc, "docker")) $x->docker = true;
    }
    return $x;
}

function icon_image($fname, $title, $background=false) {
    return sprintf(
        '<img hspace=%d %s vspace=%d height=%d src=images/%s title="%s">%s',
        5,          // horiz pad
        $background?'style="background-color:white;"':'',
        4,          // vert pad
        40,         // height
        $fname,
        $title,
        "\n"
    );
}

function platform_icons($f) {
    $x = "";
    $ht = 40;
    $hs = 5;
    $vs = 4;
    if ($f->windows) {
        $x .= icon_image('windows_logo.png', 'Supports Microsoft Windows');
    }
    if ($f->mac) {
        $x .= icon_image('macos_logo.png', 'Supports Mac OS');
    }
    if ($f->linux) {
        $x .= icon_image('linux_logo.png', 'Supports Linux on Intel');
    }
    if ($f->android) {
        $x .= icon_image('android_logo.png', 'Supports Android');
    }
    if ($f->freebsd) {
        $x .= icon_image('freebsd_logo.png', 'Supports FreeBSD');
    }
    if ($f->rasp_pi) {
        $x .= icon_image('linux_arm.png', 'Supports Linux on ARM');
        $x .= icon_image('raspberrypi_logo.png', 'Supports Raspberry Pi');
    }
    if ($f->nvidia_gpu) {
        $x .= icon_image('nvidia_logo.png', 'Supports NVIDIA GPUs', true);
    }
    if ($f->amd_gpu) {
        $x .= icon_image('AMD_logo.png', 'Supports AMD GPUs', true);
    }
    if ($f->intel_gpu) {
        $x .= icon_image('intel_logo.png', 'Supports Intel GPUs');
    }
    if ($f->apple_gpu) {
        $x .= icon_image('metal_logo.png', 'Supports Apple GPUs');
    }
    if ($f->vbox) {
        $x .= icon_image('virtualbox_logo.png', 'Supports VirtualBox');
    }
    if ($f->docker) {
        $x .= icon_image('docker_logo.png', 'Supports Docker');
    }
    return $x;
}

function canonical_plan_class($pc) {
	if (strstr($pc, "atiOpenCL")) return "opencl_ati";
	if (strstr($pc, "nvidiaOpenCL")) return "opencl_nvidia";
	if (strstr($pc, "intelOpenCL")) return "opencl_intel_gpu";
    return $pc;
}

// some specific cases where we know the project doesn't have jobs
//
function valid($url, $plat) {
    if (strstr($url, "gpugrid.net")) {
        if (strstr($plat, "android")) return false;
        if (strstr($plat, "vbox")) return false;
    } else if (strstr($url, "csgrid")) {
        if (strstr($plat, "android")) return false;
    }
    return true;
}

// get platforms from get_project_config.php (preferred method)
//
// format is either
//
// <project_config>
// <platforms>
//  <platform>windows_intelx86</platform>
//  ...
//
// or
//
// <project_config>
// <platforms>
//   <platform>
//    <platform_name>windows_intelx86</platform_name>
//    <user_friendly_name>Windows</user_friendly_name>
//    [<plan_class>xxx</plan_class>]
//   </platform>
//   ...
//
function get_platforms($url) {
    if (strstr($url, "radioactive")) return null;
    $url .= 'get_project_config.php';
    $x = @file_get_contents($url);
    if (!$x) {
        //echo "no file $url";
        return null;
    }
    libxml_use_internal_errors(true);
    $x = trim($x);
    $s = simplexml_load_string($x);
    if (!$s) {
        //echo "XML parse error";
        return null;
    }
    if (!array_key_exists('platforms', $s)) {
        return null;
    }
    $p = $s->platforms;
    //print_r($p);
    //echo "---\n";
    //foreach ($p->children() as $x) {
    //    echo $x;
    //}
    if (!array_key_exists('platform', $p)) {
        return null;
    }
    if (sizeof($p->platform) == 0) {
        return null;
    }
    $list = array();
    if (array_key_exists(0, $p->platform[0])) {
        foreach ($p->children() as $r) {
            $list[] = (string)$r;
        }
    } else {
        foreach ($p->platform as $r) {
            $plat = (string)$r->platform_name;
            if (array_key_exists('plan_class', $r)) {
                $pc = canonical_plan_class((string)$r->plan_class);
                if ($pc) {
                    $plat .= "[".$pc."]";
                }
            }
            if (valid($url, $plat)) {
                $list[] = $plat;
            }
        }
    }
    return array_values(array_unique($list));
}

// get platforms from app.php?xml=1
// Deprecated, but needed for old projects like mindmodeling
//
function get_platforms2($url) {
    $url .= 'apps.php?xml=1';
    $x = @file_get_contents($url);
    if (!$x) {
        //echo "no file $url\n";
        return null;
    }
    libxml_use_internal_errors(true);
    $s = simplexml_load_string($x);
    $list = array();
    foreach($s->application as $a) {
        foreach ($a->version as $v) {
            if (!array_key_exists('platform_short', $v)) continue;
            $p = $v->platform_short[0];
            $pc = "";
            if (array_key_exists('plan_class', $v)) {
                $pc = (string)$v->plan_class;
                $pc = canonical_plan_class($pc);
            }
            if (strlen($pc)) {
                $p = $p.'['.$pc.']';
            }
            $list[] = (string)$p;
        }
    }
    return array_values(array_unique($list));
}

// convert an array of platform names into a comma-separated
// list of human-readable names
//
function make_friendly_string($l, $comma) {
    if (!count($l)) return "Unknown";
    $fn = array();
    foreach($l as $p) {
        $p = friendly_name($p);
        if (!$p) continue;
        $fn[] = $p;
    }
    $fn = array_unique($fn);
    natcasesort($fn);
    $x = "";
    $first = true;
    foreach($fn as $p) {
        if ($first) {
            $x .= "$p";
            $first = false;
        } else {
            if ($comma) {
                $x .= ", $p";
            } else {
                $x .= "<br>$p";
            }
        }
    }
    return $x;
}

// return platforms as an array of platform names
//
function get_platforms_cached($url) {
    $u = urlencode($url);
    $fname = "/home/boincadm/boinc-site/platforms/$u";
    $t = @filemtime($fname);
	if (strstr($url, "gpugrid") || ($t && $t > time() - CACHE_LIFETIME)) {
        return json_decode(file_get_contents($fname));
    }
    $l = get_platforms($url);
    echo "got $url";
    if (!$l) {
        $l = get_platforms2($url);
    }
    if ($l) {
        file_put_contents($fname, json_encode($l));
    } else {
        if (file_exists($fname)) {
            touch($fname);
        } else {
            $l[] = "Unknown";
            file_put_contents($fname, json_encode($l));
        }
    }
    return $l;
}

// return platforms as a human-readable string
//
function get_platforms_string($url, $comma=true) {
    $l = get_platforms_cached($url);
    return make_friendly_string($l, $comma);
}

function get_platform_icons($url) {
    $platforms = get_platforms_cached($url);
    $flags = get_platform_icon_flags($platforms);
    return platform_icons($flags);
}

//$u = "http://www.worldcommunitygrid.org/";
//$u = "http://asteroidsathome.net/boinc/";
//$u = "http://setiathome.berkeley.edu/";
//$u = "http://aqua.dwavesys.com/";
//$u = "http://lhcathome2.cern.ch/test4theory";
//$u = "http://www.rnaworld.de/rnaworld/";
//$u = "http://boinc.gorlaeus.net/";
//$u = "https://www.ramanujamachine.com/";
//$x = get_platforms_cached($u);
//print_r($x);
//$x = get_platforms2($u);
//print_r($x);
//echo json_encode($x);
//echo get_platforms_string($u);


// Mediawiki extension to show a project's platforms.
// Doesn't seem to work anymore.
//
function wfPlatforms() {
    global $wgParser;
    $wgParser->setHook( "platforms", "get_platforms_string" );
}

$wgExtensionFunctions[] = "wfPlatforms";

?>
