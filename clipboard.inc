<?php

// call this first to generate javascript

function copy_to_clipboard_script() {
    echo "
        <script>
            function copy_to_clipboard(x) {
                navigator.clipboard.writeText(x);
                alert('Copied to clipboard');
            }
        </script>
    ";
}

// return text for a graphic button to copy text

function copy_button($text, $tooltip) {
    $text = str_replace("\n", '\n', $text);
    $text .= '\n';
    return sprintf(
        "<img width=20 src=images/clipboard.png onclick=\"copy_to_clipboard('%s')\" title=\"%s\">",
        $text, $tooltip
    );
}

?>
