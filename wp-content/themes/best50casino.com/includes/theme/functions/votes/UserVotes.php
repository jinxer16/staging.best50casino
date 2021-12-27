<?php


class userVotes
{
    public static $userIP;
    public static $postID;
    public static $layout;
    private static $initialized = false;
    /**
     * @param mixed $userIP
     */
    public static function setUserIP($userIP)
    {
        self::$userIP = $userIP;
    }
    /**
     * @return mixed
     */
    public static function getUserIP()
    {
        return self::$userIP;
    }
    /**
     * @return mixed
     */
    public static function getPostID()
    {
        return self::$postID;
    }
    /**
     * @param mixed $postID
     */
    public static function setPostID($postID)
    {
        self::$postID = $postID;
    }

    /**
     * @return mixed
     */
    public static function getLayout()
    {
        return self::$layout;
    }

    /**
     * @param mixed $layout
     */
    public static function setLayout($layout)
    {
        self::$layout = $layout;
    }
    public function __construct()
    {
        $this->setUp_DB();
        add_action( 'wp_ajax_nopriv_addVote', array ($this, 'addVote') );
        add_action( 'wp_ajax_addVote', array ($this, 'addVote') );
    }
    private static function setUpTemplate(){
        if(self::$layout=='game'){
            return self::setUpTemplate_game();
        }elseif(self::$layout==null){
            return self::setUpTemplate_post();
        }elseif(self::$layout=='simple'){
            return self::setUpTemplate_simple();
        }elseif(self::$layout=='casino'){
            return self::setUpTemplate_casino();
        }
    }
    private static function setUpTemplate_casino(){
        $class= 'hoverable';
        global $post;
        $casinoID ='';

        if (is_singular( 'kss_casino' )) {
            $casinoID = $post->ID;
        }else{
            $casinoID = get_post_meta($post->ID, 'bonus_custom_meta_bookie_offer', true);
        }
        $args = array(
            'post_type' => 'player_review',
            'posts_per_page' => 999,
            'post_status' => array('publish'),
            'numberposts' => 999,
            'no_found_rows' => true,
            'fields' =>'ids',
            'update_post_term_cache' => false,
            'orderby' => 'rand',
            'meta_query' => array(
                array(
                    'key' => 'review_casino',
                    'value' => $casinoID,
                )
            )
        );
        $getreview = get_posts($args);
        $totalVotes = count($getreview);
        $sumVotes=0;
        foreach ($getreview as $review){
            $votes = get_post_meta($review,'review_rating',true);
            $sumVotes +=  (float)$votes;
        }
        $rating = $totalVotes != 0? $sumVotes/$totalVotes : 0;
        $ret = '<style>
                    .pretty-star { background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg); }
                    .icon-star { width: 100%;height: 100%; position: absolute; background-size: cover; background-repeat: no-repeat; background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg);}
                    .star-voting .star-wrap { height: 30px;width: 30px;}
                    .star-wrap { position: relative; width: 30px;height: 30px;float: left;border-right: 2px solid transparent;background-size: cover;background-repeat: no-repeat;background-image: url('.get_template_directory_uri().'/assets/images/star_empty.svg);}
                    .star-temp .icon-star {background-image: none;}
                    .icon-star.mousevote, .icon-star.mousedone {background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg);width: 100% !important;}
                </style>';
        $ret .= '<div class="star-voting-wrap flex-column align-items-center d-sm-block">';
        $ret .= '<div class="d-flex">';

        $ret .= '<div class="star-voting voting-casino '.$class.' mr-5p" style="" data-post="'.self::$postID.'" data-votes="'.(round($rating,1)).'">';
        $ret .= self::drawStars();
        $ret .= '</div>';
        $ret .= '<div class="d-flex">';
        $ret .= '<p class="font-bold mb-5p mr-5p vote-stats small"><span class="vote-stats-2 font-regular">'.(round($rating,1)).'</span>/10</</p>';
        $ret .= '<p class="font-thin mb-5p vote-stats small">(<span class="vote-stats-1">'.$totalVotes.' Reviews</span>)</p>';
        $ret .= '</div>';
        $ret .= '</div>';
//        if(self::UserVoted())$ret .= '<p class="font-thin mb-5p vote-stats small vote-stats-user"><span class="vote-stats-1">Your Vote: <b>'.self::getUserVote().'</b></span></p>';
        $ret .= '</div>';
        return $ret;
    }
    private static function setUpTemplate_post(){
        $class= !self::UserVoted()?'hoverable':'';
        $txt= !self::UserVoted()?'Did you like our content;':'Thank you for leaving a vote';
        $totalVotes = self::getNumberVotes();
        $sumVotes = self::getSumVotes();
        $rating = $totalVotes != 0? $sumVotes/$totalVotes : 0;
        $ret = '<style>
                    .pretty-star { background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg); }
                    .icon-star { width: 100%;height: 100%; position: absolute; background-size: cover; background-repeat: no-repeat; background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg);}
                    .star-voting .star-wrap { height: 16px;width: 16px;}
                    .star-wrap { position: relative; width: 21px;height: 21px;float: left;border-right: 2px solid transparent;background-size: cover;background-repeat: no-repeat;background-image: url('.get_template_directory_uri().'/assets/images/star_empty.svg);}
                    .star-temp .icon-star {background-image: none;}
                    .icon-star.mousevote, .icon-star.mousedone {background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg);width: 100% !important;}
                </style>';
        $ret .= '<div class="d-flex star-voting-wrap text-center flex-column align-items-center align-items-lg-start d-block">';
        $ret .= '<p class="font-thin mb-5p vote-text small text-left">'.$txt.'</p>';
        $ret .= '<div class="d-flex">';
        $ret .= '<p class="font-bold mb-5p mr-5p vote-stats small"><span class="vote-stats-2 font-regular">'.(round($rating,1)).'</span>/10</</p>';
        $ret .= '<div class="star-voting '.$class.' mr-5p" style="" data-post="'.self::$postID.'" data-votes="'.(round($rating,1)).'">';
        $ret .= self::drawStars();
        $ret .= '</div>';
        $ret .= '<p class="font-thin mb-5p vote-stats small">(<span class="vote-stats-1">'.$totalVotes.' Αξιολογήσεις</span>)</p>';
        $ret .= '</div>';
        $ret .= '</div>';
        return $ret;
    }
    private static function setUpTemplate_game(){
        $class= !self::UserVoted()?'hoverable':'';
        $totalVotes = self::getNumberVotes();
        $sumVotes = self::getSumVotes();
        $rating = $totalVotes != 0? $sumVotes/$totalVotes : 0;
        $txt= self::UserVoted()?'Αξιολόγηση '.$totalVotes.' Παιχτών':'Ψήφισε τώρα το '.get_the_title(self::$postID);
        $txt= $totalVotes==0? 'Γίνε ο πρώτος παίχτης που θα ψηφίσει το '.get_the_title(self::$postID):$txt;
        $ret = '<style>
                    .pretty-star { background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg); }
                    .icon-star { width: 100%;height: 100%; position: absolute; background-size: cover; background-repeat: no-repeat; background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg);}
                    .star-voting .star-wrap { height: 30px;width: 30px;}
                    .star-wrap { position: relative; width: 30px;height: 30px;float: left;border-right: 2px solid transparent;background-size: cover;background-repeat: no-repeat;background-image: url('.get_template_directory_uri().'/assets/images/star_empty.svg);}
                    .star-temp .icon-star {background-image: none;}
                    .icon-star.mousevote, .icon-star.mousedone {background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg);width: 100% !important;}
                </style>';
        $ret .= '<div class="star-voting-wrap flex-column align-items-start d-none d-sm-block">';
        $ret .= '<p class="font-thin mb-5p vote-text small">'.$txt.'</p>';
        $ret .= '<div class="d-flex">';
//        $ret .= '<p class="font-bold mb-5p mr-5p vote-stats small"><span class="vote-stats-2 font-regular">'.(round($rating,1)).'</span>/10</</p>';
        $ret .= '<div class="star-voting voting-game '.$class.' mr-5p" style="" data-post="'.self::$postID.'" data-votes="'.(round($rating,1)).'">';
        $ret .= self::drawStars();
        $ret .= '</div>';
//        $ret .= '<p class="font-thin mb-5p vote-stats small">(<span class="vote-stats-1">'.$totalVotes.' Αξιολογήσεις</span>)</p>';
        $ret .= '</div>';
        $ret .= '</div>';
        return $ret;
    }
    private static function setUpTemplate_simple(){
        $class= !self::UserVoted()?'hoverable':'';
        $totalVotes = self::getNumberVotes();
        $sumVotes = self::getSumVotes();
        $txt= !self::UserVoted()?'Vote  '.get_the_title(self::$postID):'Thank you for leaving a vote';
        $rating = $totalVotes != 0? $sumVotes/$totalVotes : 0;
        $ret = '<style>
                    .pretty-star { background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg); }
                    .icon-star { width: 100%;height: 100%; position: absolute; background-size: cover; background-repeat: no-repeat; background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg);}
                    .star-voting.star-game .star-wrap { height: 16px;width: 16px;}
                    .star-wrap { position: relative; width: 21px;height: 21px;float: left;border-right: 2px solid transparent;background-size: cover;background-repeat: no-repeat;background-image: url('.get_template_directory_uri().'/assets/images/star_empty.svg);}
                    .star-temp .icon-star {background-image: none;}
                    .icon-star.mousevote, .icon-star.mousedone {background-image: url('.get_template_directory_uri().'/assets/images/star_full.svg);width: 100% !important;}
                </style>';
        $ret .= '<div class="star-voting-wrap flex-column align-items-start">';
        $ret .= '<p class="font-thin mb-5p vote-text small text-center">'.$txt.'</p>';
        $ret.='<div id="ajaxLoader" style="display:none;">';
        $ret.='<img src="https://www.foxcasino.gr/wp-content/themes/foxcasino/assets/images/ajax-loader.gif"/>';
        $ret.='</div>';
        $ret .= '<span class="font-thin mb-5p vote-loader small text-center"></span>';
        $ret .= '<div class="d-flex justify-content-center">';
        $ret .= '<div class="star-voting star-game voting-game '.$class.' mr-5p" style="" data-post="'.self::$postID.'" data-votes="'.(round($rating,1)).'">';
        $ret .= self::drawStars();
        $ret .= '</div>';
        $ret .= '</div>';
        $ret .= '</div>';
        return $ret;
    }
    public static function getSumVotes($postID=null){ // Επιστρέφει το σύνολο της Βαθμολογίας για κάθε multiset
        global $wpdb;
        $ret = 0;
        $postID = $postID== null? self::$postID : $postID;
        $sql = "SELECT vote FROM wp_z_user_ratings WHERE `post_ID` LIKE $postID";
        $results = $wpdb->get_results($sql);
        foreach ($results as $result){
            $vote = (float)$result->vote;
            $ret +=  $vote;
        }
        return $ret;
    }
    public static function getNumberVotes($postID=null){ // Επιστρέφει το σύνολο των ψήφων για κάθε multiset
        global $wpdb;
        $postID = $postID== null? self::$postID : $postID;
        $sql = "SELECT COUNT(*) FROM wp_z_user_ratings WHERE `post_ID` LIKE $postID";
        $results = $wpdb->get_var($sql);
        return $results;
    }
    public static function getSutisfiedVotes($postID=null){ // Επιστρέφει το σύνολο των ψήφων για κάθε multiset
        global $wpdb;
        $postID = $postID== null? self::$postID : $postID;
        $sql = "SELECT COUNT(*) FROM wp_z_user_ratings WHERE `post_ID` LIKE $postID AND vote >= 8";
        $results = $wpdb->get_var($sql);
        return $results;
    }
    public static function drawStars(){
        $html = "";
        $totalVotes = self::getNumberVotes();
        $sumVotes = self::getSumVotes();
        $rating = $totalVotes != 0? $sumVotes/($totalVotes*2) : 0;
        $ratingWhole = floor($rating);
        $ratingDecimal = $rating - $ratingWhole;
        $j = 5;
        $helper = 1;
        for($i=0;$i<$ratingWhole;$i++){
            $j -=1 ;
            $html .= '<div class="star-wrap star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:100%"></div></div>';
            $helper ++;
        }
        if($ratingDecimal != 0){
            $j -=1 ;
            $test = $ratingDecimal*100;
            $html .= '<div class="star-wrap star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:'.$test.'%"></div></div>';
            $helper ++;
        }
        for($i=0;$i<$j;$i++){
            $html .= '<div class="star-wrap star-'.$helper.'" id="star-'.$helper.'"><div class="icon-star pretty-star" style="width:0%"></div></div>';
            $helper ++;
        }
        return $html;
    }
    public static function drawStarsDefault($rating=null,$size=20,$amp=NULL){

        if ($amp != 'amp') {
            $html = '<style>
                    .pretty-star { background-image: url(' . get_template_directory_uri() . '/assets/images/star_full.svg); }
                    .icon-star { width: 100%;height: 100%; position: absolute; background-size: cover; background-repeat: no-repeat; background-image: url(' . get_template_directory_uri() . '/assets/images/star_full.svg);}
                    .star-voting.star-game .star-wrap { height: 16px;width: 16px;}
                    .star-wrap { position: relative; width: 21px;height: 21px;float: left;border-right: 2px solid transparent;background-size: cover;background-repeat: no-repeat;background-image: url(' . get_template_directory_uri() . '/assets/images/star_empty.svg);}
                    .star-temp .icon-star {background-image: none;}
                    .icon-star.mousevote, .icon-star.mousedone {background-image: url(' . get_template_directory_uri() . '/assets/images/star_full.svg);width: 100% !important;}
                </style>';
        }else{
            $html='';
        }

        $ratingWhole = floor($rating);
        $ratingDecimal = $rating - $ratingWhole;
        $j = 5;
        $helper = 1;
        for($i=0;$i<$ratingWhole;$i++){
            $j -=1 ;
            $html .= '<div class="star-wrap star-'.$helper.'" id="star-'.$helper.'" style="width:'.$size.'px;height:'.$size.'px;"><div class="icon-star pretty-star" style="width:100%"></div></div>';
            $helper ++;
        }
        if($ratingDecimal != 0){
            $j -=1 ;
            $test = $ratingDecimal*100;
            $html .= '<div class="star-wrap star-'.$helper.'" id="star-'.$helper.'" style="width:'.$size.'px;height:'.$size.'px;"><div class="icon-star pretty-star" style="width:'.$test.'%"></div></div>';
            $helper ++;
        }
        for($i=0;$i<$j;$i++){
            $html .= '<div class="star-wrap star-'.$helper.'" id="star-'.$helper.'" style="width:'.$size.'px;height:'.$size.'px;"><div class="icon-star pretty-star" style="width:0%"></div></div>';
            $helper ++;
        }
        return $html;
    }
    private function setUp_DB(){
        global $wpdb;
        $table_name = $wpdb->prefix.'z_user_ratings';
        if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            //table not in database. Create new table
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
          id bigint(20) NOT NULL AUTO_INCREMENT,
          post_ID bigint(20) NOT NULL,
          vote decimal(11,1) NOT NULL,
          date datetime NOT NULL,
          ip varchar(45) NOT NULL,
          PRIMARY KEY(id),
          UNIQUE KEY id (id)
     ) $charset_collate;";
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );
            return true;
        }
        else{
            return false;
        }
    }
    public static function addVote(){
        // Check for nonce security
//    $nonce = $_POST['nonce'];
//    if(!wp_verify_nonce( $_POST[ 'put_name' ], 'ajaxVotes' ))
//        die ( 'Busted!');
        self::initialize($_POST['post_id']);
        $data=[];
        global $wpdb;
        $ip = self::$userIP;
        $post_id = self::$postID;
        $value = $_POST['value'];
        $date = current_time( 'mysql', 0);
        $table = $wpdb->prefix.'z_user_ratings';
        $data = array('post_ID' => $post_id, 'vote' => $value, 'date' => $date, 'ip' => $ip);
        $wpdb->insert($table,$data);
        $totalVotes = self::getNumberVotes();
        $sumVotes = self::getSumVotes();
        $rating = $totalVotes != 0? $sumVotes/$totalVotes : 0;
        $data['totalvotes'] = $totalVotes;
        $data['sumVotes'] = round($rating,1);
        echo json_encode($data);
        die ();
    }
    public static function UserVoted($echo = false){
        global $wpdb;
        $ip = self::$userIP;
        $postID = self::$postID;

        $sql = "SELECT COUNT(*) FROM wp_z_user_ratings WHERE `ip` LIKE '$ip' AND `post_ID` LIKE $postID";
        $results = $wpdb->get_var($sql);

        if ($results > 0){
            $ret = true;
        }else{
            $ret = false;
        }
        if ($echo){
            return $ret;
        }else{
            return $ret;
        }
    }
    public static function getUserVote($echo = false){
        global $wpdb;
        $ip = self::$userIP;
        $postID = self::$postID;
        $sql = "SELECT vote FROM wp_z_user_ratings WHERE `post_ID` LIKE $postID AND `ip` LIKE \"$ip\"";
        $results = $wpdb->get_results($sql);
        return $results[0]->vote;
    }
    private static function initialize($postID,$layout=null)
    {
//        if (self::$initialized)
//            return;
        self::setPostID($postID);
        self::setUserIP($_SERVER['REMOTE_ADDR']);
        self::setLayout($layout);
        self::$initialized = true;
    }
    public static function vote($postID,$layout=null)
    {
        self::initialize($postID,$layout);
        echo self::setUpTemplate();
    }
}