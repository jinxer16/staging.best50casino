<?php
function ampizeImages($theContent=null){
//    $theContent = get_the_content(null, null, $post->ID);
    $dom = new DOMDocument();
    $dom->loadHTML(mb_convert_encoding($theContent, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED|LIBXML_HTML_NODEFDTD);
    $xp = new DOMXPath($dom);
    foreach ($xp->query("//img") as $img) {
        $src = urldecode($img->getAttribute('src'));
        $width  = $img->getAttribute('width');
        $height = $img->getAttribute('height');
        $class  = $img->getAttribute('class');
        if (!empty($src)) {
            $ampElement ='<amp-img></amp-img>';
            $imgAMP = $dom->createElement('amp-img');
            $imgAMP->setAttribute('layout', 'fixed');
            $imgAMP->setAttribute('width', $width);
            $imgAMP->setAttribute('height', $height);
            $imgAMP->setAttribute('class', $class);
            $imgAMP->setAttribute('src', $src);
            $img->parentNode->replaceChild($imgAMP, $img);
        }
    }
    return html_entity_decode($dom->saveHTML());
}