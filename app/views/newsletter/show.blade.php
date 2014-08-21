<?php

function cleanParagraph($text, $tagname){
    return strip_tags ( $text , '<strong><b><i><a><img><ul><li><ol><br>' );
}

function stylePragraph($text, $tag, $style){
    return '<'.$tag.' style="'.$style.'">'.$text.'</'.$tag.'>';
}

$text = '<p class="align-justify" style="text-align:justify;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:normal;color:#303030;margin:0 0 12px 0;padding:0;">Text <a href="#">link</a> <img src="vre" /> <strong>to</strong> find</p>';

$clean = cleanParagraph($text,'p');

echo '<pre>';
print_r($clean);
echo '</pre>';

echo stylePragraph($clean, 'p', 'text-align:left;font-family:Arial, sans-serif;font-size:18px;color:#ddd;');