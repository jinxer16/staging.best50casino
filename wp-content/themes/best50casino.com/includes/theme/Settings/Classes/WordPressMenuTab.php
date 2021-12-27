<?php
/**
 * Created by PhpStorm.
 * User: Panos
 * Date: 6/6/2019
 * Time: 11:32 πμ
 */

class WordPressMenuTab
{
    public $slug;
    public $title;
    public $menu;
    function __construct( $options, WordPressMenu $menu ){
        $this->slug = $options['slug'];
        $this->title = $options['title'];
        $this->menu = $menu;
        $this->menu->add_tab( $options );
    }
    /**
     * Add field to this tab
     * @param [type] $array [description]
     */
    public function add_field( $array ){
        $this->menu->add_field( $array, $this->slug );
    }
}