<?php

// call this first to generate javascript

function copy_to_clipboard_script() {
    echo "
        <script>
            function copy_to_clipboard(x, id) {
                navigator.clipboard.writeText(x);
                //alert('Copied to clipboard');
                x = document.getElementById(id);
                //x.style.visibility = 'hidden';
                x.src = 'images/check.png';
            }
        </script>
    ";
}

// return text for a graphic button to copy text

function copy_button($text, $tooltip, $id) {
    $text = str_replace("\n", '\n', $text);
    $text .= '\n';
    return sprintf(
        "<img id=%s width=20 src=images/clipboard.png onclick=\"copy_to_clipboard('%s', '%s')\" title=\"%s\">
        ",
        $id, $text, $id, $tooltip
    );
}

?>
