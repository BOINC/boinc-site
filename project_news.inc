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

// filter project news items;
// don't show test projects or items with too many links

function rss_filter($item) {
    if (strstr($item->link, "boinc.berkeley.edu")) return true;
    if (strstr($item->link, "boinc.network")) return true;
    $n = substr_count($item->description, "href");
    return $n > 5;
}
?>
