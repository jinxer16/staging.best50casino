<style>
        .body{font-family: 'Open Sans', sans-serif; font-size: 0.8rem; background: #15242c; color: #fff;}
        .bjcontainer{width: 100vw !important; height: auto; max-width:unset; padding-top: 30px;}
        .mb2px{margin-bottom:2px;}
        .pt10{padding-top:10px;}
        .font-red{color: #ff0042;}
        .tshadow{text-shadow: 2px 2px rgba(0,0,0,0.6);}
        .mycard{cursor:pointer;float: left; width: 38px; margin-left: 2px;}
        .mycard svg{width: 38px; height:55px;}
        .selected-dealer-cards svg,.selected-player-cards svg, .mselected-dealer-cards svg, .mselected-player-cards svg{width: 60px; height:82px;}
        .reset-cont a{color:white; padding-left: 1em; padding-right: 1em; background:repeating-linear-gradient(45deg, #ea9d00, #ea9d00 10px, #f3aa00 10px, #f3aa00 20px);border-color:#d39e00; }
        .reset-cont a:hover{text-decoration: none; color:white; background:repeating-linear-gradient(45deg, #f3aa00, #f3aa00 10px, #ea9d00 10px, #ea9d00 20px);}
        .selected-dealer-cards{position: absolute;text-align-center;top: 150px;left: 50%;transform:translatex(-50%);}
        .selected-dealer-card, .hidden-dealer-card{display: block; margin:0 auto; width: 60px; height:82px;}
        .selected-player-cards-cont{position: absolute;bottom: 90px;left: 50%;transform:translatex(-50%);}
        .selected-player-cards{position: relative; display: block; padding-left: 40px;}
        .selected-player-cards svg{display: block; float: left; margin-left: -40px;}
        .player-total{position: absolute; display: none; bottom: -20px; right: -27px; width: 55px; height: 55px; text-align: center; border-radius: 50%; background: white; color: green; font-weight: bold; font-size: 10px; line-height:48px; border: 3px solid #000;}
        .result-outer-container{display: none; margin: 20px auto 0; text-align:center;}
        .result-container{width: 100px; height: 100px; margin: 0 auto;  text-align: center; border-radius: 50%; background: white; color: #000; font-weight: bold; font-size: 20px; line-height:80px; border: 8px solid #000;}
        .result-container.hit-result{color: #005a33; border-color: #005a33;}
        .result-container.split-result{color: #02509f; border-color: #02509f;}
        .result-container.stand-result{color: #c80228; border-color: #c80228;}
        .result-container.double-result{color: #e0a800; border-color: #e0a800;}
        .betlogo{display: inline-block; height: 30px;}
        @media (max-width:626.98px){
            .mbgtop{background: #096b42 url('wp-content/themes/best50casino.com/templates/bj-calculator/cards/table_top.png') top center no-repeat;}
            .mbgbottom{background: transparent url('wp-content/themes/best50casino.com/templates/bj-calculator/cards/table-bottom.png') bottom center no-repeat; padding-bottom: 150px;}
        }
        @media (min-width:627px){
            .body{ background: #15242c url('wp-content/themes/best50casino.com/templates/bj-calculator/cards/table3.jpg') 50% 40px no-repeat; }
        }
        @media (min-width:768px){
            .bjcontainer{width: 600px !important; height: 480px !important;}
            .reset-cont{position: absolute; bottom: 190px; left: 110px;}
            .result-outer-container{position: absolute; bottom: 140px; right: 80px; }
            .mycard:hover{padding-top:20px;}
            .player-total{bottom: -24px;}
            .mycards{padding-left:50px;}
            .mycard svg{width: 60px; height:82px;}
            .mycard{margin-left: -45px; width: 60px; transition: all 10ms;}
            .mycard:hover{padding-top:20px;}
        }
    </style>
<div class="body pb-35p">
<?php $cards = array(2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,'J'=>10,'Q'=>10,'K'=>10,'A'=>11)?>
<div class="text-center pt10">
    <div class="d-flex mx-auto justify-content-center align-items-end">
        <div class="pr-1">BlackJack calculator by</div>
        <div><a href="https://www.best50casino.com/" target="_new" class="d-inline-block"><img src="wp-content/themes/best50casino.com/assets/images/best50casino-logo.svg" class="betlogo" alt="Best50Casino.com ᐈ List of the best online casinos in 2020"></a></div>
    </div>
</div>
<div class="mbgtop">
    <div class="mbgbottom">
        <div class="bjcontainer container position-relative">
            <div class="row no-gutters pt-3 d-flex">
                <div class="col-12 col-md-6 text-center text-md-left">
                    <div class="dealer-cards d-inline-block">
                        <div class="text-center mb2px tshadow"><strong>Select dealer's card:</strong></div>
                        <div class="mycards">
                            <?php foreach($cards as $c=>$cv){?>
                                <div class="mycard dealer-card" data-card-value="<?php echo $cv;?>">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="113.76px" height="150px" viewBox="0 0 113.76 150" enable-background="new 0 0 113.76 150" xml:space="preserve">
												<path d="M113.14,12.63v123.75c0,7.24-4.46,13.12-9.95,13.12H9.34c-5.5,0-9.96-5.88-9.96-13.12V12.63c0-7.25,4.46-13.13,9.96-13.13h93.85c3.33,0,6.28,2.17,8.091,5.5h0.22v0.43C112.54,7.5,113.14,9.97,113.14,12.63z M111.14,136.38V12.63c0-2.26-0.49-4.44-1.43-6.31l-0.03-0.07l-0.16-0.3c-1.51-2.78-3.88-4.45-6.33-4.45H9.34c-4.39,0-7.96,4.99-7.96,11.13v123.75c0,6.13,3.57,11.12,7.96,11.12h93.85C107.57,147.5,111.14,142.51,111.14,136.38z"/>
                                        <path fill="#F5F5F5" d="M111.14,12.63v123.75c0,6.13-3.569,11.12-7.95,11.12H9.34c-4.39,0-7.96-4.99-7.96-11.12V12.63C1.38,6.49,4.95,1.5,9.34,1.5h93.85c2.45,0,4.82,1.67,6.33,4.45l0.16,0.3l0.03,0.07C110.649,8.19,111.14,10.37,111.14,12.63z"/>
                                        <path class="d-block d-md-none" d="M78.229,77.104c-0.412-12.861-20.801-27.754-20.801-27.754c0,0.002-21.129,15.428-20.742,27.754c0.331,10.541,11.1,14.295,17.936,8.188L48.632,99.65h17.653l-6-14.369C67.218,91.236,78.571,87.791,78.229,77.104z"/>
                                        <path class="d-none d-md-block" d="M86.363,78.123C85.791,60.226,57.417,39.5,57.417,39.5c0,0.003-29.405,21.47-28.867,38.623c0.461,14.67,15.448,19.894,24.961,11.396L45.175,109.5h24.567l-8.351-19.996C71.04,97.791,86.84,92.996,86.363,78.123z"/>
                                        <path class="d-none"  d="M19.005,32.571c-0.114-3.565-5.767-7.694-5.767-7.694s-5.858,4.277-5.75,7.694c0.092,2.922,3.077,3.963,4.973,2.271L10.8,38.823h4.894l-1.664-3.984C15.953,36.49,19.101,35.535,19.005,32.571z"/>
                                        <path class="d-none" d="M93.047,115.938c0.114,3.565,5.767,7.694,5.767,7.694c0-0.001,5.857-4.276,5.75-7.694c-0.092-2.922-3.076-3.963-4.973-2.271l1.661-3.981h-4.894l1.662,3.984C96.101,112.02,92.952,112.975,93.047,115.938z"/>
                                        <text class="d-none d-md-block" transform="matrix(1 0 0 1 10 35)" style="font-family: 'Open Sans', sans-serif; font-weight: 700; font-size: 2rem;"><?php echo $c;?></text>
                                        <text class="d-none d-md-block" transform="matrix(-1 0 0 -1 103 115)" style="font-family: 'Open Sans', sans-serif; font-weight: 700; font-size: 2rem;"><?php echo $c;?></text>
                                        <text class="d-block d-md-none" transform="matrix(1 0 0 1 10 45)" style="font-family: 'Open Sans', sans-serif; font-weight: 700; font-size: 3rem;"><?php echo $c;?></text>
                                        <text class="d-block d-md-none" transform="matrix(-1 0 0 -1 103 105)" style="font-family: 'Open Sans', sans-serif; font-weight: 700; font-size: 3rem;"><?php echo $c;?></text>
											</svg>
                                </div>
                            <?php } ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 text-center text-md-right mt-2 mt-md-0">
                    <div class="player-cards d-inline-block">
                        <div class="text-center mb2px tshadow"><strong>Select player's cards:</strong></div>
                        <div class="mycards float-right pr-2">
                            <?php foreach($cards as $c=>$cv){?>
                                <div class="mycard player-card" data-card-value="<?php echo $cv;?>">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="113.76px" height="150px" viewBox="0 0 113.76 150" enable-background="new 0 0 113.76 150" xml:space="preserve">
												<path d="M113.14,12.63v123.75c0,7.24-4.46,13.12-9.95,13.12H9.34c-5.5,0-9.96-5.88-9.96-13.12V12.63c0-7.25,4.46-13.13,9.96-13.13h93.85c3.33,0,6.28,2.17,8.091,5.5h0.22v0.43C112.54,7.5,113.14,9.97,113.14,12.63z M111.14,136.38V12.63c0-2.26-0.49-4.44-1.43-6.31l-0.03-0.07l-0.16-0.3c-1.51-2.78-3.88-4.45-6.33-4.45H9.34c-4.39,0-7.96,4.99-7.96,11.13v123.75c0,6.13,3.57,11.12,7.96,11.12h93.85C107.57,147.5,111.14,142.51,111.14,136.38z"/>
                                        <path fill="#F5F5F5" d="M111.14,12.63v123.75c0,6.13-3.569,11.12-7.95,11.12H9.34c-4.39,0-7.96-4.99-7.96-11.12V12.63C1.38,6.49,4.95,1.5,9.34,1.5h93.85c2.45,0,4.82,1.67,6.33,4.45l0.16,0.3l0.03,0.07C110.649,8.19,111.14,10.37,111.14,12.63z"/>
                                        <path class="d-block d-md-none" d="M78.229,77.104c-0.412-12.861-20.801-27.754-20.801-27.754c0,0.002-21.129,15.428-20.742,27.754c0.331,10.541,11.1,14.295,17.936,8.188L48.632,99.65h17.653l-6-14.369C67.218,91.236,78.571,87.791,78.229,77.104z"/>
                                        <path class="d-none d-md-block" d="M86.363,78.123C85.791,60.226,57.417,39.5,57.417,39.5c0,0.003-29.405,21.47-28.867,38.623c0.461,14.67,15.448,19.894,24.961,11.396L45.175,109.5h24.567l-8.351-19.996C71.04,97.791,86.84,92.996,86.363,78.123z"/>
                                        <path class="d-none"  d="M19.005,32.571c-0.114-3.565-5.767-7.694-5.767-7.694s-5.858,4.277-5.75,7.694c0.092,2.922,3.077,3.963,4.973,2.271L10.8,38.823h4.894l-1.664-3.984C15.953,36.49,19.101,35.535,19.005,32.571z"/>
                                        <path class="d-none" d="M93.047,115.938c0.114,3.565,5.767,7.694,5.767,7.694c0-0.001,5.857-4.276,5.75-7.694c-0.092-2.922-3.076-3.963-4.973-2.271l1.661-3.981h-4.894l1.662,3.984C96.101,112.02,92.952,112.975,93.047,115.938z"/>
                                        <text class="d-none d-md-block" transform="matrix(1 0 0 1 10 35)" style="font-family: 'Open Sans', sans-serif; font-weight: 700; font-size: 2rem;"><?php echo $c;?></text>
                                        <text class="d-none d-md-block" transform="matrix(-1 0 0 -1 103 115)" style="font-family: 'Open Sans', sans-serif; font-weight: 700; font-size: 2rem;"><?php echo $c;?></text>
                                        <text class="d-block d-md-none" transform="matrix(1 0 0 1 10 45)" style="font-family: 'Open Sans', sans-serif; font-weight: 700; font-size: 3rem;"><?php echo $c;?></text>
                                        <text class="d-block d-md-none" transform="matrix(-1 0 0 -1 103 105)" style="font-family: 'Open Sans', sans-serif; font-weight: 700; font-size: 3rem;"><?php echo $c;?></text>
											</svg>
                                </div>
                            <?php } ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="d-block d-md-none">
                <div class="text-center mt-4 reset-cont">
                    <a href="#" class="reset-game btn badge-pill tshadow"><strong>Reset</strong></a>
                </div>
                <div class="d-flex flex-cards-container mt-4">
                    <div class="col p-0 text-center">
                        <p class="text-center mb-1 tshadow"><strong>Dealer's card</strong></p>
                        <div class="mselected-dealer-cards">
                            <div class="selected-dealer-card">
                                <?php echo card_bg();?>
                            </div>
                        </div>
                    </div>
                    <div class="col p-0 text-center">
                        <p class="text-center mb-1 tshadow"><strong>Player's cards</strong></p>
                        <div class="mselected-player-cards-cont d-inline-block text-center mt-1 position-relative">
                            <div class="selected-player-cards d-inline-block mx-auto">
                                <?php echo card_bg('first_card');?>
                                <?php echo card_bg('second_card');?>
                            </div>
                            <div class="player-total"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="reset-cont d-none d-md-block">
                <a href="#" class="reset-game btn badge-pill tshadow"><strong>Reset</strong></a>
            </div>
            <div class="selected-dealer-cards d-none d-md-block">
                <p class="text-center mb-1 tshadow"><strong>Dealer's card</strong></p>
                <div class="selected-dealer-card">
                    <?php echo card_bg();?>
                </div>
            </div>
            <div class="selected-player-cards-cont d-none d-md-block">
                <p class="text-center mb-1 tshadow"><strong>Player's cards</strong></p>
                <div class="selected-player-cards">
                    <?php echo card_bg('first_card');?>
                    <?php echo card_bg('second_card');?>
                </div>
                <div class="player-total"></div>
            </div>
            <div class="result-outer-container">
                <p class="text-center mb-1 tshadow"><strong>Your best move</strong></p>
                <div class="result-container"></div>
            </div>
        </div>
    </div>
</div>
<div class="original-selected-dealer-card d-none">
    <?php echo card_bg();?>
</div>
<div class="original-selected-player-cards d-none">
    <?php echo card_bg('first_card');?>
    <?php echo card_bg('second_card');?>
</div>
<script src="/wp-content/themes/best50casino.com/templates/bj-calculator/black_jack.js"></script>
</div>
