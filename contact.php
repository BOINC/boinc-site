<?php
// This file is part of BOINC.
// http://boinc.berkeley.edu
// Copyright (C) 2021 University of California
//
// BOINC is free software; you can redistribute it and/or modify it
// under the terms of the GNU Lesser General Public License
// as published by the Free Software Foundation,
// either version 3 of the License, or (at your option) any later version.
//
// BOINC is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// See the GNU Lesser General Public License for more details.
//
// You should have received a copy of the GNU Lesser General Public License
// along with BOINC.  If not, see <http://www.gnu.org/licenses/>.

require_once("../inc/util.inc");

function main() {
    page_head("Contact BOINC");
    echo "
        <p>
        For issues involving the BOINC software, please
        <a href=https://boinc.berkeley.edu/forum_index.php>visit the BOINC message boards</a> or
        <a href=https://github.com/BOINC/boinc/wiki/help-volunteer>get online help</a>.
        <p>
        For most other issues, please
        <a href=https://github.com/BOINC/boinc/wiki/EmailLists>post to the appropriate email list</a>.
        <p>
        For anything else, email the director of BOINC,
        <a href=http://boinc.berkeley.edu/anderson/>David P. Anderson</a>.
    ";
    page_tail();
}

main();

?>
