<?php
require_once('../inc/util.inc');

function youtube_video($key, $caption=null, $width=400, $height=300) {
    echo sprintf(
        '<p><iframe width="%d" height="%d" src="https://www.youtube.com/embed/%s" frameborder="0" allowfullscreen></iframe>',
        $width, $height, $key
    );
    if ($caption) {
        echo "<p><b>$caption</b>\n";
    }
    echo "<br><p>";
}

page_head('Promo materials from Science Commons Initiative');
echo '
Thanks to <a href=https://thesciencecommons.org>The Science Commons Initiative</a>
for creating these materials.
We encourage you to use them to make flyers and posters about BOINC.
<h2>Poster 1</h2>
<ul>
<li> <a href="sci/BOINC BOLD 1 A4 for David.pdf">A4</a>
<li> <a href="sci/BOINC BOLD 1 US Letter for David.pdf">US Letter</a>
</ul>

<h2>Poster 1</h2>
<ul>
<li> <a href="sci/BOINC BOLD 2 A4 for David.pdf">A4</a>
<li> <a href="sci/BOINC BOLD 2 US Letter for David.pdf">US Letter</a>
<li> <a href="sci/BOINC BOLD 1 card for David.pdf">Card</a>
</ul>

<h2>Poster 3</h2>
<ul>
<li> <a href="sci/BOINC General for David.pdf">Card</a>
</ul>

<h2>Installation videos</h2>
';
youtube_video('AK95EvQ9tXA');
youtube_video('yRIdsorbtWo');
page_tail();
?>
