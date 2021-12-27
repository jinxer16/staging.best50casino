<div class="section-ratings mb-10p shadow-box  mt-10p">

    <div class="d-flex flex-wrap w-100">
        <div class="w-100 d-flex flex-wrap p-15p">
            <div class="w-20">
            </div>
            <p class="w-100 d-block text-20">Payout Rates of Casino Games</p>
            <div class="w-40 pr-10p games-rat-title">
                <div class="mb-2p d-flex flex-wrap title-game">
                    <div class="w-80 text-13">
                        Slots
                    </div>
                    <div class="w-20">
                        <span class="free-casino"></span>
                    </div>
                </div>
                <div class="mb-2p d-flex flex-wrap title-game">
                    <div class="w-80 text-13">
                        Roulette
                    </div>
                    <div class="w-20">
                        <span class="roulette-casino"></span>
                    </div>
                </div>
                <div class="mb-2p d-flex flex-wrap title-game">
                    <div class="w-80 text-13">
                        Blackjack
                    </div>
                    <div class="w-20">
                        <span class="cards-casino"></span>
                    </div>
                </div>
                <div class="mb-2p d-flex flex-wrap title-game">
                    <div class="w-80 text-13">
                        Table Games
                    </div>
                    <div class="w-20">
                        <span class="crabs-casino"></span>
                    </div>
                </div>

                <div class="mb-2p d-flex flex-wrap title-game">
                    <div class="w-80 text-13">
                        Video Poker
                    </div>
                    <div class="w-20">
                        <span class="spades-casino"></span>
                    </div>
                </div>

                <div class="mb-2p d-flex flex-wrap title-game">
                    <div class="w-80 text-13">
                        Scratch Cards
                    </div>
                    <div class="w-20">
                        <span class="scratch-casino"></span>
                    </div>
                </div>

                <div class="mb-2p d-flex flex-wrap title-game">
                    <div class="w-80 text-13">
                        Arcade Games
                    </div>
                    <div class="w-20">
                        <span class="free-casino"></span>
                    </div>
                </div>
            </div>
            <div class="w-60 payout-rates" style="border-left: 1px solid #ab8f8f; border-bottom: 1px solid #ab8f8f;">
                    <?php
                    $value =get_post_meta($post->ID,"casino_custom_meta_slots_rtp",true) ;
                    ?>
                <div class="progress bg-gray mb-12p  text-13 w-100" style="box-shadow: 0 1px 2px #828586bf; height: 14px;">
                    <div class="progress-bar text-black p-7p font-weight-bold h-100 overf-h float-left text-center"  style="background: #ffcd00; width: <?=$value;?>%"  role="progressbar" aria-valuenow="<?php echo $value; ?>" aria-valuemin="0" aria-valuemax="100">
                        <span class="position-relative d-flex justify-content-center" style="bottom: 10px;"><?= round($value)?>%</span>
                    </div>
                </div>
                <?php
                    $value =get_post_meta($post->ID,"casino_custom_meta_roulette_rtp",true) ;
                    ?>
                <div class="progress bg-gray mb-12p text-13 w-100" style="box-shadow: 0 1px 2px #828586bf; height: 14px;">
                    <div class="progress-bar p-7p text-black font-weight-bold h-100 overf-h float-left text-center" style="background: #ffcd00; width: <?=$value;?>%"  role="progressbar" aria-valuenow="<?php echo $value; ?>" aria-valuemin="0" aria-valuemax="100">
                        <span class="position-relative d-flex justify-content-center" style="bottom: 10px;"><?= round($value)?>%</span>
                    </div>
                </div>
                <?php
                    $value =get_post_meta($post->ID,"casino_custom_meta_blackjack_rtp",true) ;
                    ?>
                <div class="progress bg-gray mb-12p text-13 w-100" style="box-shadow: 0 1px 2px #828586bf; height: 14px;">
                    <div class="progress-bar  p-7p text-black font-weight-bold h-100 overf-h float-left text-center"  style="background: #ffcd00; width: <?=$value;?>%"  role="progressbar" aria-valuenow="<?php echo $value; ?>" aria-valuemin="0" aria-valuemax="100">
                        <span class="position-relative d-flex justify-content-center" style="bottom: 10px;"><?= round($value)?>%</span>
                    </div>
                </div>
                <?php
                    $value =get_post_meta($post->ID,"casino_custom_meta_tableGames_rtp",true) ;
                    ?>
                <div class="progress bg-gray mb-12p text-13 w-100" style="box-shadow: 0 1px 2px #828586bf; height: 14px;">
                    <div class="progress-bar p-7p text-black font-weight-bold h-100 overf-h float-left text-center"  style="background: #ffcd00; width: <?=$value;?>%" role="progressbar" aria-valuenow="<?php echo $value; ?>" aria-valuemin="0" aria-valuemax="100">
                        <span class="position-relative d-flex justify-content-center" style="bottom: 10px;"><?= round($value)?>%</span>
                    </div>
                </div>
                <?php
                    $value =get_post_meta($post->ID,"casino_custom_meta_videoPoker_rtp",true) ;
                    ?>
                <div class="progress bg-gray mb-12p text-13 w-100" style="box-shadow: 0 1px 2px #828586bf; height: 14px;">
                    <div class="progress-bar p-7p text-black font-weight-bold h-100 overf-h float-left text-center"  style="background: #ffcd00; width: <?=$value;?>%" role="progressbar" aria-valuenow="<?php echo $value; ?>" aria-valuemin="0" aria-valuemax="100">
                        <span class="position-relative d-flex justify-content-center" style="bottom: 10px;"><?= round($value)?>%</span>
                    </div>
                </div>
                <?php
                    $value =get_post_meta($post->ID,"casino_custom_meta_scratchCards_rtp",true) ;
                    ?>
                <div class="progress bg-gray mb-12p text-13 w-100" style="box-shadow: 0 1px 2px #828586bf; height: 14px;">
                    <div class="progress-bar p-7p text-black font-weight-bold h-100 overf-h float-left text-center"  style="background: #ffcd00; width: <?=$value;?>%"  role="progressbar" aria-valuenow="<?php echo $value; ?>" aria-valuemin="0" aria-valuemax="100">
                        <span class="position-relative d-flex justify-content-center" style="bottom: 10px;"><?= round($value)?>%</span>
                    </div>
                </div>
                <?php
                    $value =get_post_meta($post->ID,"casino_custom_meta_arcadeGames_rtp",true) ;
                    ?>
                <div class="progress bg-gray mb-12p text-13 w-100" style="box-shadow: 0 1px 2px #828586bf; height: 14px;">
                    <div class="progress-bar p-7p text-black font-weight-bold h-100 overf-h float-left text-center"  style="background: #ffcd00; width: <?=$value;?>%"  role="progressbar" aria-valuenow="<?php echo $value; ?>" aria-valuemin="0" aria-valuemax="100">
                        <span class="position-relative d-flex justify-content-center" style="bottom: 10px;"><?= round($value)?>%</span>
                    </div>
                </div>
            </div>
            <div class="w-40 pr-10p"></div>
            <div class="w-60 d-flex flex-wrap">
                <span class=" text-muted text-left" style="width: 16.6%">0</span>
                <span class="text-muted text-center" style="width: 16.6%">20</span>
                <span class="text-muted text-center" style="width: 16.6%">40</span>
                <span class="text-muted text-center" style="width: 16.6%">60</span>
                <span class="text-muted text-center" style="width: 16.6%">80</span>
                <span class="text-muted text-right" style="width: 16.6%">100</span>
                <span class="float-right text-right w-100 text-muted">Return To Player (%)</span>
            </div>
        </div>
    </div>
</div>