<?php
function fortune_wheel( $atts, $content = null )
{
    ob_start();

    echo fortuneWheel();

    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode('fortune-wheel','fortune_wheel');