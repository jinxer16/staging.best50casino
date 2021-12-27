<form id="comments" class="comment-form" method="post" action-xhr="<?php echo 'https://www.best50casino.com/wp-content/themes/best50casino.com/templates/amp/amp-common/amp-login-reviews-hander.php'?>" target="_top" on="submit:comments.clear">
    <?php
    $idgiven='';
    if (is_singular('kss_casino' )) {
        $idgiven = $post->ID;
    }else{
        $idgiven = get_post_meta($post->ID, 'bonus_custom_meta_bookie_offer', true);
    }
    ?>
    <span class="text-left text-whitte pb-3p pt-3p">Your review for <?=get_the_title($idgiven)?>:</span>
    <input type="text" class="form-control w-100 pb-5p pt-5p rounded-5 mt-5p mb-7p" placeholder="Your name" name="nameReview" id="nameReview">
    <input type="email" class="form-control w-100 pb-5p pt-5p rounded-5 mb-7p " placeholder="Your Email" name="emailReview" id="emailReview">
    <textarea id="comment_text" name="comment_text" rows="5" class="w-100 rounded-5" placeholder="Your comment..."></textarea>
    <fieldset class="rating-review mt-7p p-0 text-left pointer">
        <input name="rating" type="radio" id="rating5" value="5">
        <label for="rating5" class="position-relative d-inline-block" title="5 stars">☆</label>

        <input name="rating" type="radio" id="rating4" value="4">
        <label for="rating4" class="position-relative d-inline-block" title="4 stars">☆</label>

        <input name="rating" type="radio" id="rating3" value="3">
        <label for="rating3" class="position-relative d-inline-block" title="3 stars">☆</label>

        <input name="rating" type="radio" id="rating2" value="2" checked="checked">
        <label for="rating2" class="position-relative d-inline-block" title="2 stars">☆</label>

        <input name="rating" type="radio" id="rating1" value="1">
        <label for="rating1" class="position-relative d-inline-block" title="1 stars">☆</label>
    </fieldset>
    <input name="casinoID" id="casinoID" type="hidden" value="<?=$idgiven?>">

  <input type="submit" class="bg-primary text-whitte rounded-5 w-33 p-7p" style="border: none;" name="submitcomment" value="Submit">
    <div submit-success>
        <template type="amp-mustache">
            <p>{{output_message}}{{rating}}</p>
        </template>
    </div>
    <div submit-error>
        <template type="amp-mustache">
            <p>There was an error</p>
        </template>
    </div>
</form>





