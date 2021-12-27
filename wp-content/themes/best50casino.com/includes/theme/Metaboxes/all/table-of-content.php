<?php global $wpalchemy_media_access; ?>
<style type="text/css">
    td.sort_td:hover{cursor: move;}
</style>

<?php global $post;?>

<div class="my_meta_control metabox">
    <p><a href="#" class="docopy-anchors button">New Anchor</a></p>

    <table border="1" cellspacing="0" cellpadding="3" class="anchors_table" style="width: 100%; margin-top: 10px; margin-bottom: 20px;">
        <tr>
            <th>Order</th>
            <th>Anchor Title</th>
            <th>Shortcode (place this shortcode wherever the target of the anchor is!)</th>
            <th></th>
        </tr>
        <tbody>
        <?php $my_counter = 0;?>
        <?php while($metabox->have_fields_and_multi('anchors',array('length' => 1, 'limit' => 10))): ?>
            <?php $metabox->the_group_open('tr'); ?>
            <?php $metabox->the_field('order'); ?>
            <td class="sort_td">
                <div class="shown_order" style="text-align: center"><?php echo (1+$my_counter);?></div>
                <input type="text" class="faqs_sort_order" style="display: none;" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            </td>
            <td>
                <?php $metabox->the_field('anchor_title'); ?>
                <input type="text" class="main-text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/><br/>
                <?php $metabox->the_field('anchor_id'); ?>
                <input type="hidden" class="main-text" id="duplicate-anchor" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/><br/>
            </td>
            <?php $metabox->the_field('anchor_shortcode'); ?>
            <td> <input type="text" class="target-input" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" readonly/><br/></td>
            <td style="text-align: center;"><a href="#" class="dodelete button"><span class="dashicons dashicons-trash" style="pointer-events: none;"></span></a></td>
            <?php $my_counter++;?>
            <?php $metabox->the_group_close(); ?>
        <?php endwhile; ?>
        </tbody>
    </table>
    <hr/>
</div>

<script type="text/javascript">

    jQuery( ".faqs_table" ).find('tbody').sortable( {
        dropOnEmpty: false,
        cursor: "move",
        handle: ".sort_td",
        update: function( event, ui ) {
            $(this).children().each(function(index) {
                $(this).find('.shown_order').html(index + 1);
                $(this).find('input.faqs_sort_order').val(index + 1);
            });
        }
    });
    jQuery('.anchors_table').on("keyup", "input.main-text", function(){

        var greeklish = string_to_slug(jQuery(this).val()); // translate
        var slug = greeklish.replace(/^\s+|\s+$/g, ''); // trim
        var str = slug.toLowerCase();
        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '_') // collapse whitespace and replace by -
            .replace(/-+/g, '_'); // collapse dashes
        var hiddenTarget = jQuery(this).parent('td').find('#duplicate-anchor');
        var target = jQuery(this).parent('td').next('td').find('.target-input');
        target.val('[anchor id="'+str+'"]');
        hiddenTarget.val(str);
    });
    function string_to_slug(str) {

        str  = str.replace(/^\s+|\s+$/g, '') // TRIM WHITESPACE AT BOTH ENDS.
            .toLowerCase();            // CONVERT TO LOWERCASE

        from = [ "ου", "ΟΥ", "Ού", "ού", "αυ", "ΑΥ", "Αύ", "αύ", "ευ", "ΕΥ", "Εύ", "εύ", "α", "Α", "ά", "Ά", "β", "Β", "γ", "Γ", "δ", "Δ", "ε", "Ε", "έ", "Έ", "ζ", "Ζ", "η", "Η", "ή", "Ή", "θ", "Θ", "ι", "Ι", "ί", "Ί", "ϊ", "ΐ", "Ϊ", "κ", "Κ", "λ", "Λ", "μ", "Μ", "ν", "Ν", "ξ", "Ξ", "ο", "Ο", "ό", "Ό", "π", "Π", "ρ", "Ρ", "σ", "Σ", "ς", "τ", "Τ", "υ", "Υ", "ύ", "Ύ", "ϋ", "ΰ", "Ϋ", "φ", "Φ", "χ", "Χ", "ψ", "Ψ", "ω", "Ω", "ώ", "Ώ" ];
        to   = [ "ou", "ou", "ou", "ou", "au", "au", "au", "au", "eu", "eu", "eu", "eu", "a", "a", "a", "a", "b", "b", "g", "g", "d", "d", "e", "e", "e", "e", "z", "z", "i", "i", "i", "i", "th", "th", "i", "i", "i", "i", "i", "i", "i", "k", "k", "l", "l", "m", "m", "n", "n", "ks", "ks", "o", "o", "o", "o", "p", "p", "r", "r", "s", "s", "s", "t", "t", "y", "y", "y", "y", "y", "y", "y", "f", "f", "x", "x", "ps", "ps", "o", "o", "o", "o" ];

        for ( var i = 0; i < from.length; i++ ) {

            while( str.indexOf( from[i]) !== -1 ){

                str = str.replace( from[i], to[i] );    // CONVERT GREEK CHARACTERS TO LATIN LETTERS

            }

        }

        str = str.replace(/[^a-z0-9 -]/g, '') // REMOVE INVALID CHARS
            .replace(/\s+/g, '-')        // COLLAPSE WHITESPACE AND REPLACE BY DASH -
            .replace(/-+/g, '-');        // COLLAPSE DASHES

        return str;

    }
</script>