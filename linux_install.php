<?php

// get instructions for installing Linux packages

require_once('../inc/util.inc');
require_once('../inc/clipboard.inc');

$versions = ['stable'=>'8.2.8', 'alpha'=>'8.2.8', 'nightly'=>'8.3.0'];

define('OS_DEBIAN', 0);
define('OS_UBUNTU', 1);
define('OS_FEDORA', 2);
define('OS_OPENSUSE', 3);
define('OS_MINT', 4);
define('OS_MINT_DEBIAN', 5);

function get_oss($os_num) {
    $n = 1;
    $oss = [];
    switch($os_num) {
    case OS_DEBIAN:
        $oss[$n++] = os('Debian', '10', 'buster', 'June 2024', '2.28');
        $oss[$n++] = os('Debian', '11', 'bullseye', 'June 2026', '2.31');
        $oss[$n++] = os('Debian', '12', 'bookworm', 'June 2028', '2.36');
        $oss[$n++] = os('Debian', '13', 'trixie', 'June 2030', '2.41');
        break;
    case OS_UBUNTU:
        $oss[$n++] = os('Ubuntu', '20.04', 'focal', 'April 2025', '2.31');
        $oss[$n++] = os('Ubuntu', '22.04', 'jammy', 'April 2027', '2.35');
        $oss[$n++] = os('Ubuntu', '24.04', 'noble', 'April 2034', '2.39');
        break;
    case OS_FEDORA:
        $oss[$n++] = os('Fedora', '37', 'fc37', 'November 2023', '2.36');
        $oss[$n++] = os('Fedora', '38', 'fc38', 'May 2024', '2.37');
        $oss[$n++] = os('Fedora', '39', 'fc39', 'November 2024', '2.38');
        $oss[$n++] = os('Fedora', '40', 'fc40', 'May 2025', '2.39');
        $oss[$n++] = os('Fedora', '41', 'fc41', 'November 2025', '2.40');
        $oss[$n++] = os('Fedora', '42', 'fc42', 'May 2026', '2.41');
        break;
    case OS_OPENSUSE:
        $oss[$n++] = os('openSUSE', '15.4', 'suse15_4', 'December 2023', '2.31');
        $oss[$n++] = os('openSUSE', '15.5', 'suse15_5', 'December 2024', '2.37');
        $oss[$n++] = os('openSUSE', '15.6', 'suse15_6', 'December 2025', '2.37');
        $oss[$n++] = os('openSUSE', '16.0', 'suse16_0', 'December 2026', '2.40');
        break;

    // the following must match ubuntu/debian version order
    case OS_MINT:
        $oss[$n++] = os('Mint', '20', 'mint20', 'April 2025', '2.31');
        $oss[$n++] = os('Mint', '21', 'mint21', 'April 2027', '2.35');
        $oss[$n++] = os('Mint', '22', 'mint22', 'April 2029', '2.39');
        break;
    case OS_MINT_DEBIAN:
        $oss[$n++] = os('Mint Debian edition', '4', 'mintde4', 'August 2022', '2.28');
        $oss[$n++] = os('Mint Debian edition', '5', 'mintde5', 'July 2024', '2.31');
        $oss[$n++] = os('Mint Debian edition', '6', 'mintde6', 'January 2025', '2.36');
        $oss[$n++] = os('Mint Debian edition', '7', 'mintde7', 'TBA', '2.41');
        break;
    }
    return $oss;
}

function os($type, $ver, $code, $support, $glibc) {
    $x = new StdClass();
    $x->type = $type;
    $x->ver = $ver;
    $x->code = $code;
    $x->support = $support;
    $x->glibc = $glibc;
    return $x;
}

function os_options() {
    return [
        [0, 'Debian'],
        [1, 'Ubuntu'],
        [2, 'Fedora'],
        [3, 'openSUSE'],
        [4, 'Mint'],
        [5, 'Mint Debian edition']
    ];
}

function version_options($os_num) {
    $oss = get_oss($os_num);
    $x = [];
    foreach ($oss as $i => $os) {
        $x[] = [$i, $os->ver];
    }
    return $x;
}

function build_options() {
    global $versions;
    $x = [];
    $x[] = ['stable', sprintf('Stable (version %s)', $versions['stable'])];
    $x[] = ['alpha', sprintf('Alpha (version %s)', $versions['alpha'])];
    $x[] = ['nightly', sprintf('Nightly (BOINC version %s)', $versions['nightly'])];
    return $x;
}

function action($os_num, $version_num) {
    global $versions;
    $mint_os = null;
    switch ($os_num) {
        case OS_MINT:
            $oss = get_oss($os_num);
            $mint_os = $oss[$version_num];
            $os_num = OS_UBUNTU;
            break;
        case OS_MINT_DEBIAN:
            $oss = get_oss($os_num);
            $mint_os = $oss[$version_num];
            $os_num = OS_DEBIAN;
            break;
    }
    $oss = get_oss($os_num);
    $os = $oss[$version_num];
    $build = get_str('build');
    page_head(
        sprintf('Install the %s version of BOINC on %s %s',
            $build,
            $mint_os?$mint_os->type:$os->type,
            $mint_os?$mint_os->ver:$os->ver
        )
    );
    copy_to_clipboard_script();
    echo "<p>
        In a terminal window, enter:
        <p>
    ";
    switch ($os->type) {
    case 'Debian':
    case 'Ubuntu':
        $x = sprintf(
'sudo apt update
sudo apt install gnupg2 curl
sudo mkdir -p /etc/apt/keyrings
sudo curl -fsSL https://boinc.berkeley.edu/dl/linux/%s/%s/boinc.gpg | sudo gpg --dearmor -o /etc/apt/keyrings/boinc.gpg
sudo echo deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/boinc.gpg] https://boinc.berkeley.edu/dl/linux/%s/%s %s main | sudo tee /etc/apt/sources.list.d/boinc.list > /dev/null
sudo apt update
sudo apt install boinc-client boinc-manager',
            $build, $os->code,
            $build, $os->code,
            $os->code
        );
        break;
    case 'Fedora':
        switch ($os->ver) {
        case '37':
        case '38':
        case '39':
        case '40':
            $x = sprintf(
'sudo dnf install dnf-plugins-core
sudo dnf config-manager --add-repo https://boinc.berkeley.edu/dl/linux/%s/%s
sudo dnf config-manager --set-enabled boinc.berkeley.edu_dl_linux_%s_%s
sudo rpm --import https://boinc.berkeley.edu/dl/linux/%s/%s/boinc.gpg
sudo yum install boinc-client boinc-manager',
                $build, $os->code,
                $build, $os->code,
                $build, $os->code
            );
            break;
        case '41':
        case '42':
            $x = sprintf(
'sudo dnf install dnf-plugins-core
sudo dnf config-manager addrepo --from-repofile=https://boinc.berkeley.edu/dl/linux/%s/%s/boinc-%s-%s.repo
sudo dnf config-manager setopt boinc-%s-%s.enabled=1
sudo rpm --import https://boinc.berkeley.edu/dl/linux/%s/%s/boinc.gpg
sudo yum install boinc-client-%s boinc-manager-%s',
                $build, $os->code,
                $build, $os->code,
                $build, $os->code,
                $build, $os->code,
                $versions[$build],
                $versions[$build]
            );
            break;
    }
        break;
    case 'openSUSE':
        $x = sprintf(
'sudo rpm --import https://boinc.berkeley.edu/dl/linux/%s/%s/boinc.gpg
sudo zypper ar -f https://boinc.berkeley.edu/dl/linux/%s/%s official-boinc-repo
sudo zypper install boinc-client boinc-manager',
            $build, $os->code,
            $build, $os->code
        );
        break;
    }
    echo "<pre>$x</pre>\n";
    echo copy_button($x, 'Copy instructions to clipboard', 'id1');

    text_start(800);
    echo "<p>On headless systems, omit 'boinc-manager'.
        On such systems, the BOINC client can be
        controlled either using <a href=https://boinc.berkeley.edu/wiki/Boinccmd_tool>boinccmd</a>,
        or using a <a href=https://boinc.berkeley.edu/wiki/Controlling_BOINC_remotely>remote GUI</a>.
        <p>
        Details on the installer are <a href=https://github.com/BOINC/boinc/wiki/Linux-installer>here</a>.
    ";

    // GPU instructions
    echo '<h3>GPU computing</h3>';
    echo '<p>
        If the system has a GPU, it may be usable by
        BOINC projects that have GPU-enabled apps.
        On some systems you may need to install GPU drivers that support this.
        <p>
        Check the BOINC client\'s output on startup.
        It should detect your GPU (NVIDIA, AMD, or Intel) using OpenCL,
        and NVIDIA GPUs should also be detected using CUDA.
        If not, check whether updated drivers are available
        for your GPU type and Linux distro.
        In general, vendor-supplied drivers may be
        preferable to open-source drivers.
    ';

    // Docker instructions

    switch ($os->type) {
    case 'Debian':
    case 'Ubuntu':
    case 'Fedora':
        echo '<h3>Install Podman</h3>
            Some BOINC projects use Docker to package their applications.
            We recommend that you install Podman,
            an open-source version of Docker.
            To do so:
            <p>
        ';
        break;
    }
    $x = null;
    switch ($os->type) {
    case 'Debian':
    case 'Ubuntu':
        $x = 'sudo apt install podman
sudo usermod --add-subuids 100000-165535 --add-subgids 100000-165535 boinc';
        break;
    case 'Fedora':
        $x = 'sudo yum install podman
sudo usermod --add-subuids 100000-165535 --add-subgids 100000-165535 boinc';
        break;
    }
    if ($x) {
        echo "<pre>$x</pre>\n";
        echo copy_button($x, 'Copy instructions to clipboard', 'id2');
    }

    // attach instructions

    echo '<h3>Configuration</h3>
        <p>
        You must tell BOINC which science projects to compute for.
        The recommended way is to use Science United,
        where you choose science areas rather than individual projects.
        <ul>
        <li> <a href=https://scienceunited.org>Create an account</a>
            on Science United.
        <li> <a href=https://scienceunited.org/su_help.php>Attach this computer</a> to the Science United account.
        </ul>
        <p>
        You can configure BOINC to limit its
        computing, memory usage, and disk usage.
        Do this using the BOINC Manager (Options / Computing Preferences)
        or the Computing Preferences form on the Science United website.
    ';

    // uninstall instructions
    echo '<h3>Uninstall</h3>
        <p>
        To remove BOINC:
        <p>
    ';
    $x = null;
    switch ($os->type) {
    case 'Debian':
    case 'Ubuntu':
        $x = 'sudo apt remove boinc-client boinc-manager';
        break;
    case 'Fedora':
        $x = 'sudo yum remove boinc-client boinc-manager';
        break;
    case 'openSUSE':
        $x = 'sudo zypper remove boinc-client boinc-manager';
        break;
    }
    if ($x) {
        echo "<pre>$x</pre>\n";
        echo copy_button($x, 'Copy instructions to clipboard', 'id3');
    }
    text_end();
    page_tail();
}

function form($os_num) {
    page_head('Installing BOINC on Linux');
    text_start(900);
    echo "
        <p>
        There are several ways to install BOINC on Linux:
    ";
    start_table('table-striped');
    table_header('Installer type', 'Sandboxing', 'Run at boot?', 'Can run without Manager open?');
    table_row('Standard package', 'account-based', 'yes', 'yes');
    table_row('Flatpack', 'container-based', 'no', 'no');
    table_row('Snap', 'container-based', 'TBD', 'TBD');
    table_row('GNU Guix', 'None', 'TBD', 'TBD');
    end_table();
    echo "
        <p>
        If you're already using a package manager like Flatpak,
        you can use it to install BOINC.
        If not, we recommend using the
        standard package manager of your Linux distro
        (apt, yum, or zypper).
    ";
    echo "<h2>Standard package</h2>
        <p>
        Get installation instructions:
    ";
    form_start('linux_install.php');
    form_input_hidden('action', 'submit');
    form_select('Operating system', 'os_num', os_options(), $os_num);
    echo "
        <script>
            document.getElementById('os_num').onchange = function() {
                window.location.href = window.location.pathname + '?os_num=' + this.value;
            };
        </script>
    ";
    form_select('OS version', 'version_num', version_options($os_num));
    form_select(
        'BOINC build<br><font size=-1>
            Stable: recommended version
            <br>Alpha: version under test
            <br>Nightly: very latest version</font>',
        'build', build_options()
    );
    form_submit('Get instructions');
    form_end();

    echo "<h2>Flatpack</h2>
        <p>
        <a href=https://flathub.org/apps/edu.berkeley.BOINC>Download BOINC from flathub</a>.
    ";

    echo "<h2>Snap</h2>
        <p>
        <a href=https://snapcraft.io/boinc>Download BOINC from Snapcraft</a>.
    ";
    echo "<h2>GNU Guix</h2>
        <p>
        <a href=https://hpc.guix.info/package/boinc-client>Download BOINC from Guix</a>.
    ";

    text_end();
    page_tail();
}

$os_num = get_int('os_num', true);
$action = get_str('action', true);
if ($action) {
    $version_num = get_int('version_num', true);
    action($os_num, $version_num);
} else {
    if (!$os_num) $os_num = 0;
    form($os_num);
}

?>
