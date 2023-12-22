<?php
function generateExcerpt($text, $maxLength = 80, $suffix = '...')
{
    $cleanText = strip_tags($text);
    $cleanText = trim($cleanText);

    if (strlen($cleanText) > $maxLength) {

        $excerpt = substr($cleanText, 0, $maxLength);

        $lastSpace = strrpos($excerpt, ' ');

        if ($lastSpace !== false) {
            $excerpt = substr($excerpt, 0, $lastSpace);
        }

        $excerpt .= $suffix;
    } else {
        $excerpt = $cleanText;
    }

    return $excerpt;
}
?>