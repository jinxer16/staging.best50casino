<?php
/**
 * Created by PhpStorm.
 * User: Panos
 * Date: 6/6/2019
 * Time: 11:31 πμ
 */

class WordPressSubMenu extends WordPressMenu
{
    function __construct( $options, WordPressMenu $parent ){
        parent::__construct( $options );
        $this->parent_id = $parent->settings_id;
    }
}