<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control metabox d-flex flex-wrap">
    <div class="col-2">
        <label>Reviewer's Name</label>
        <p>
            <input type="text" name="<?php $metabox->the_name('review_name'); ?>" value="<?php $metabox->the_value('review_name'); ?>"/>
        </p>
    </div>
    <div class="col-2">
        <label>Gender</label>
        <?php $mb->the_field('review_gender'); ?>
        <p>
            <select name="<?php $mb->the_name(); ?>">
                <option value="M" <?php $mb->the_select_state("M"); ?>>Male</option>
                <option value="F" <?php $mb->the_select_state("F"); ?>>Female</option>
            </select>
        </p>
    </div>

    <div class="col-2">
        <label>Review Rating</label>
        <p>
            <input type="text" name="<?php $metabox->the_name('review_rating'); ?>" value="<?php $metabox->the_value('review_rating'); ?>"/>
        </p>
    </div>

    <div class="col-3">
        <label>e-mail</label>
        <p>
            <input class="w-100" type="text" name="<?php $metabox->the_name('review_email'); ?>" value="<?php $metabox->the_value('review_email'); ?>"/>
        </p>
    </div>
    <div class="col-2">
        <label>IP</label>
        <p>
            <input type="text" name="<?php $metabox->the_name('review_ip'); ?>" value="<?php $metabox->the_value('review_ip'); ?>"/>
        </p>
    </div>
    <div class="col-1">
        <label>Hidden</label>

        <p>
            <?php $mb->the_field('review_hidden'); ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php $mb->the_checkbox_state('1'); ?>/>
        </p>
    </div>
    <div class="col-2">
        <label>Casino</label>
        <?php $mb->the_field('review_casino'); ?>
        <p>
            <select name="<?php $mb->the_name(); ?>">
                <?php
                global $post;
                $original_post = $post;
                $args = array(
                    "echo" => 0,
                    "sort_order" => "ASC",
                    "sort_column" => "post_title",
                    "post_type" => "kss_casino",
                    "posts_per_page" => -1,
                );
                $my_query = new WP_Query($args);
                echo '<option value="">Select</option>';
                if( $my_query->have_posts() ) {
                    while ($my_query->have_posts()) : $my_query->the_post();
                        $pid = get_the_ID();?>
                        <option value="<?=$pid;?>" <?php $mb->the_select_state($pid); ?>><?php the_title(); ?></option>
                    <?php
                    endwhile;
                }
                $post = $original_post;
                wp_reset_query();  // Restore global post data stomped by the_post().
                ?>
            </select>
        </p>
    </div>
    <div class="col-12">
    <label>Best50casino Answer</label>
    <p class="w-100">
        <?php $mb->the_field('Best50_answer'); ?>
        <textarea class="w-100" name="<?php $metabox->the_name('Best50_answer'); ?>" ><?php $metabox->the_value('Best50_answer'); ?></textarea>
    </p>
    </div>
    <div class="col-12">
        <label>Review From:</label>
        <div class="d-flex flex-wrap">
            <?php
            $countries = WordPressSettings::getCountriesWithIDandName();
            asort($countries);
            $mb->the_field('validat', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);//WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI
            foreach ($countries as $country_id=>$country_name ){ ?>
                <div class="w-15 d-flex flex-wrap align-items-center">
                <input type="checkbox" name="<?php $mb->the_name(); ?>" value="<?=$country_id;?>" <?php $mb->the_checkbox_state($country_id); ?>/><?=ucwords($country_name);?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
