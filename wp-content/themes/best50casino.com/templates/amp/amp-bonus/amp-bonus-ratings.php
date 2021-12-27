<div class="w-100 d-flex mt-10p flex-wrap" style="background: rgb(5,9,11);
background: linear-gradient(180deg, rgba(5,9,11,1) 0%, rgba(29,41,47,1) 31%, rgba(38,75,93,1) 100%);">
    <div class="w-100 border-bottom">
        <h1 class="font-weight-bold text-whitte w-90 p-7p mb-0 text-18 d-block mx-auto text-uppercase" style="letter-spacing: 1px;"><?= get_post_meta($post->ID, "bonus_custom_meta_h1", true); ?></h1>
    </div>
    <div class="w-100 mt-10p d-flex flex-column align-items-center">
        <div class="d-flex flex-wrap text-whitte p-5p bonus-ratings">
            <div class="w-20 d-flex justify-content-center">
                <span class="bg-bonus-icons cherry"></span>
            </div>
            <div class="w-80 align-self-center">
                <?php
                $value =get_post_meta($post->ID,'bonus_custom_meta_bonus_match',true) ;
                ?>
                <div class="font-weight-bold text-whitte text-12">
                    <span class=""> Bonus match & Percentage</span>
                    <span class="float-right text-right"> <?=$value?>/10</span>
                </div>
                <div class="progress bg-whitte mb-5p text-13 w-100 rounded-15" style="box-shadow: 0 1px 2px #828586bf; height: 7px;">
                    <div class="progress-bar rounded-15 text-black font-weight-bold h-100 overf-h float-left text-center" style="width: <?=$value*10;?>%"  role="progressbar" aria-valuenow="<?php echo $value *10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="w-20 d-flex justify-content-center">
                <span class="bg-bonus-icons  diamond"></span>
            </div>
            <div class="w-80">
                <?php
                $value =get_post_meta($post->ID,'bonus_custom_meta_free_spins',true) ;
                ?>
                <div class="font-weight-bold text-whitte text-12">
                    <span class=""> Free Spins & Bonus Codes</span>
                    <span class="float-right text-right"><?=$value?>/10</span>
                </div>
                <div class="progress bg-whitte mb-5p w-100 mb-10p rounded-15" style="box-shadow: 0 1px 2px #828586bf; height: 7px;">
                    <div class="progress-bar rounded-15 text-black font-weight-bold h-100 overf-h float-left text-center" style="width: <?=$value*10;?>%"  role="progressbar" aria-valuenow="<?php echo $value *10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="w-20 d-flex justify-content-center">
                <span class="bg-bonus-icons crown"></span>
            </div>
            <div class="w-80">
                <?php
                $value =get_post_meta($post->ID,'bonus_custom_meta_loaylty',true) ;
                ?>
                <div class="font-weight-bold text-whitte text-12">
                    <span class=""> Reload & Loyalty promotions</span>
                    <span class="float-right text-right"><?=$value?>/10</span>
                </div>
                <div class="progress bg-whitte mb-5p w-100 mb-10p rounded-15" style="box-shadow: 0 1px 2px #828586bf; height: 7px;">

                    <div class="progress-bar rounded-15 text-black font-weight-bold h-100 overf-h float-left text-center" style="width: <?=$value*10;?>%"  role="progressbar" aria-valuenow="<?php echo $value *10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="w-20 d-flex justify-content-center">
                <span class="bg-bonus-icons bell"></span>
            </div>
            <div class="w-80">
                <?php
                $value =get_post_meta($post->ID,'bonus_custom_meta_fair_terms',true) ;
                ?>
                <div class="font-weight-bold text-whitte text-12">
                    <span class=""> Fair Terms & Conditions</span>
                    <span class="float-right text-right"><?=$value?>/10</span>
                </div>
                <div class="progress bg-whitte mb-5p w-100 mb-10p rounded-15" style="box-shadow: 0 1px 2px #828586bf; height: 7px;">
                    <div class="progress-bar rounded-15 text-black font-weight-bold h-100 overf-h float-left text-center" style="width: <?=$value*10;?>%" role="progressbar" aria-valuenow="<?php echo $value *10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="w-20 d-flex justify-content-center">
                <span class="bg-bonus-icons chip"></span>
            </div>
            <div class="w-80">
                <?php
                $value =get_post_meta($post->ID,'bonus_custom_meta_wagering',true) ;
                ?>
                <div class="font-weight-bold text-whitte text-12">
                    <span class="">Reasonable Wagering Requirements</span>
                    <span class="float-right text-right"><?=$value?>/10</span>
                </div>
                <div class="progress bg-whitte mb-5p w-100 mb-10p rounded-15" style="box-shadow: 0 1px 2px #828586bf; height: 7px;">
                    <div class="progress-bar rounded-15 text-black font-weight-bold h-100 overf-h float-left text-center" style="width: <?=$value*10;?>%"  role="progressbar" aria-valuenow="<?php echo $value *10; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <?php
        if(!empty(get_post_meta($post->ID,'bonus_custom_meta_redcards-complaints',true))){
            ?>
            <span class="w-80 pt-7p pb-7p d-flex justify-content-center mx-auto" style="color: #b8c2ca; line-height: 17px;">
          <i class="fa fa-exclamation text-danger pr-5p" style="font-size: 21px;"></i> <?= get_post_meta($post->ID,'bonus_custom_meta_redcards-complaints',true);?>
        </span>
            <?php
        }
        ?>

    </div>
    <div class="w-100 mb-10p p-5 align-self-center circle-progress">
<?php
        $sum = get_post_meta($post->ID,'bonus_custom_meta_rat_ovrl',true) *10;
        if ($sum <= 50){
            $percentageleft = 0;
            $percentageright = ($sum / 100 * 360);
        }else{
            $percentageright = 180;
            $percentageleft = (($sum -50) / 100 * 360);
        }
        ?>

        <div class="progress position-relative d-block mx-auto" data-total='<?= $sum *10;?>' style="width: 120px; height: 120px;">
                                    <span class="progress-left left-0 position-absolute overflow-hidden h-100 w-50 top-0">
                                        <span class="progress-bar w-100 h-100 border-secondary position-absolute top-0" style="transform: rotate(<?=$percentageleft;?>deg);"></span>
                                        </span>
            <span class="progress-right right-0 position-absolute overflow-hidden h-100 w-50 top-0">
                                         <span class="progress-bar w-100 h-100 border-secondary position-absolute top-0" style="transform: rotate(<?=$percentageright;?>deg);"></span>
                                      </span>
            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center position-absolute left-0 top-0 justify-content-center">
                <div class="d-flex flex-column text-dark valyeper position-relative  h-100  rounded-circle" style="left: 1%;width: 96%;background-color: #e8e9eb;">
                    <span class="text-center font-weight-thick mb-0" style="font-size: 25px; margin-top: 25px;"><?= $sum /10;?></span>
                    <span class="text-center font-weight-thick mb-0 text-15" >Overall</span>
                </div>
            </div>
        </div>
    </div>

</div>