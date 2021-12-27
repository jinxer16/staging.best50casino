<?php
include locate_template( array( '/templates/amp/amp-header.php' ) );?>
    <amp-geo layout="nodisplay">
        <!--        <script type="application/json">-->
        <!--            {-->
        <!--                "ISOCountryGroups": {-->
        <!--                    "valid": --><?//=$countriesEnabledArray2?><!--,-->
        <!--                    "withBonus": --><?//=$countriesWithBonus?><!--,-->
        <!--                    "restricted": --><?//=$restricted?><!--,-->
        <!--                    "glb": ["unknown", "preset-eea"]-->
        <!--                }-->
        <!--            }-->
        <!--        </script>-->
    </amp-geo>
<?php
$theContent = get_the_content(null,null,$post->ID);
$pattern = get_shortcode_regex();
preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches );
$atts = shortcode_parse_atts( $matches[0][0] );
$shortcodeLayout = $atts['layout'];
$shortcodeType = $matches[2][0];
echo '<pre>';
print_r($shortcodeLayout);
print_r($shortcodeType);
echo '</pre>';
$nbrOfShortcodes = count($matches[0]);
$breakContent = explode($matches[0][0],$theContent);
$breakContent2 = explode($matches[0][1],$breakContent[1]);
//echo '<pre>';
echo $breakContent[0];
include locate_template( array( '/templates/amp/amp-shortcodes/amp-'.$shortcodeType.'-'.$shortcodeLayout.'.php' ) );

echo $breakContent2[0];
//tobe Shortcode
echo $breakContent2[1];
//echo '</pre>';
?>


<?php
include locate_template( array( '/templates/amp/amp-footer.php' ) );
