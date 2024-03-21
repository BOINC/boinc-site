<?php

// get instructions for installing Linux packages

require_once('../inc/util.inc');

$versions = ['stable'=>null, 'alpha'=>'8.0.0', 'nightly'=>'8.1.0'];

function get_oss() {
    $n = 1;
    $oss = [];
    $oss[$n++] = os('Debian', '10', 'buster', 'June 2024', '2.28');
    $oss[$n++] = os('Debian', '11', 'bullseye', 'June 2026', '2.31');
    $oss[$n++] = os('Debian', '12', 'bookworm', 'June 2028', '2.36');
    $oss[$n++] = os('Ubuntu', '20.04', 'focal', 'April 2025', '2.31');
    $oss[$n++] = os('Ubuntu', '22.04', 'jammy', 'April 2027', '2.35');
    $oss[$n++] = os('Fedora', '37', 'fc37', 'November 2023', '2.36');
    $oss[$n++] = os('Fedora', '38', 'fc38', 'May 2024', '2.37');
    $oss[$n++] = os('Fedora', '39', 'fc39', 'November 2024', '2.38');
    $oss[$n++] = os('openSUSE', '15.4', 'suse15_4', 'December 2023', '2.31');
    $oss[$n++] = os('openSUSE', '15.5', 'suse15_5', 'December 2024', '2.37');
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
    $oss = get_oss();
    $x = [];
    foreach ($oss as $num=>$os) {
        $x[] = [$num, sprintf('%s %s', $os->type, $os->ver)];
    }
    return $x;
}

function build_options() {
    global $versions;
    $x = [];
    $x[] = ['alpha', sprintf('Alpha (version %s)', $versions['alpha'])];
    $x[] = ['nightly', sprintf('Nightly (BOINC version %s)', $versions['nightly'])];
    return $x;
}

function action() {
    $oss = get_oss();
    $os_num = get_int('os_num');
    $build = get_str('build');
    $os = $oss[$os_num];
    echo sprintf('To install the %s version of BOINC on %s %s:',
        $build, $os->type, $os->ver
    );
    echo '<p>';
    switch ($os->type) {
    case 'Debian':
    case 'Ubuntu':
        echo '<pre>';
        echo sprintf(
'sudo apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 40254C9B29853EA6
sudo apt-add-repository deb https://boinc.berkeley.edu/dl/linux/%s/%s %s main
sudo apt install boinc-client boinc-manager',
            $build, $os->code, $os->code
        );
        echo '</pre>';
        break;
    case 'Fedora':
        echo '<pre>';
        echo sprintf(
'sudo dnf install dnf-plugins-core
sudo dnf config-manager --add-repo https://boinc.berkeley.edu/dl/linux/%s/%s
sudo dnf config-manager --set-enabled boinc-%s-%s
sudo yum install boinc-client boinc-manager',
            $build, $os->code, $build, $os->code
        );
        echo '</pre>';
        break;
    case 'openSUSE':
        echo '<pre>';
        echo sprintf(
'sudo zypper ar -f https://boinc.berkeley.edu/dl/linux/%s/%s official-boinc-repo
sudo zypper install boinc-client boinc-manager',
            $build, $os->code
        );
        echo '</pre>';
        break;
    }
    echo "<p>On headless systems, omit 'boinc-manager'.
        On such systems, the BOINC client can be
        controlled either using <a href=https://boinc.berkeley.edu/wiki/Boinccmd_tool>boinccmd</a>,
        or using a <a href=https://boinc.berkeley.edu/wiki/Controlling_BOINC_remotely>remote GUI</a>.
    ";
}

function main() {
    $os_num = get_int('os_num', true);
    $build = get_str('os_build', true);
    page_head('Linux installation instructions');
    form_start('linux_install.php');
    form_select('Operating system', 'os_num', os_options(), $os_num);
    form_select('BOINC build', 'build', build_options(), $build);
    form_submit('OK');
    form_end();

    if ($os_num) {
        action();
    }
    page_tail();
}

main();

?>
