<?php
/**
 * Created by PhpStorm.
 * User: Panos
 * Date: 31/5/2019
 * Time: 1:06 μμ
 */

class PostTypesSetup
{
    //variables
    private $supports ;
    private $singular_name ;
    private $plural_name ;
    private $slug;
    private $content_type_name ;
    private $isVisible;
    private $capability_type;
    private $taxonomies;
    private $restBase;

    /**
     * @param mixed $supports
     */
    public function setSupports($supports)
    {
        $this->supports = $supports;
    }

    /**
     * @return mixed
     */
    public function getSupports()
    {
        return $this->supports;
    }

    /**
     * @param mixed $singular_name
     */
    public function setSingularName($singular_name)
    {
        $this->singular_name = $singular_name;
    }

    /**
     * @return mixed
     */
    public function getSingularName()
    {
        return $this->singular_name;
    }

    /**
     * @param mixed $plural_name
     */
    public function setPluralName($plural_name)
    {
        $this->plural_name = $plural_name;
    }

    /**
     * @return mixed
     */
    public function getPluralName()
    {
        return $this->plural_name;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $content_type_name
     */
    public function setContentTypeName($content_type_name)
    {
        $this->content_type_name = $content_type_name;
    }

    /**
     * @return mixed
     */
    public function getContentTypeName()
    {
        return $this->content_type_name;
    }

    /**
     * @param mixed $isVisible
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;
    }

    /**
     * @return mixed
     */
    public function getisVisible()
    {
        return $this->isVisible;
    }

    /**
     * @return mixed
     */
    public function getCapabilityType()
    {
        return $this->capability_type;
    }

    /**
     * @param mixed $capability_type
     */
    public function setCapabilityType($capability_type)
    {
        $this->capability_type = $capability_type;
    }

    /**
     * @return mixed
     */
    public function getTaxonomies()
    {
        return $this->taxonomies;
    }

    /**
     * @param mixed $taxonomies
     */
    public function setTaxonomies($taxonomies)
    {
        $this->taxonomies = $taxonomies;
    }
    public function __construct(){

    }

    /**
     * @return mixed
     */
    public function getRestBase()
    {
        return $this->restBase;
    }

    /**
     * @param mixed $restBase
     */
    public function setRestBase($restBase)
    {
        $this->restBase = $restBase;
    }

    private function setArgs($args){ //Args = Singular, Plyral, Slug, Visibility, supports
            $this->setSingularName($args[0]);
            $this->setPluralName($args[1]);
            $this->setContentTypeName($args[2]);
            $this->setSlug($args[3]);
            $this->setIsVisible($args[4]);
            $this->setSupports($args[5]);
            if(isset($args[6])) {
                $this->setCapabilityType($args[6]);
            }
            if(isset($args[7])){
                $this->setTaxonomies($args[7]);
            }
            if(isset($args[8])){
                $this->setRestBase($args[8]);
            }
    }

    public function insertPostType($args){
        $this->setArgs($args);
        add_action('init', array($this,'add_postType')); //add content type
    }

    public function insertTaxonomy($args){
        $this->setArgs($args);
        add_action('init', array($this,'add_taxonomy')); //add content type
    }

    public function add_postType(){
        if($this->capability_type != 'post' || $this->capability_type != 'page'){
            $caps = [
                'edit_post'          => 'edit_'.$this->capability_type[0],
                'read_post'          => 'read_'.$this->capability_type[0],
                'delete_post'        => 'delete_'.$this->capability_type[0],
                'delete_posts'        => 'delete_'.$this->capability_type[1],
                'edit_posts'         => 'edit_'.$this->capability_type[1],
                'edit_others_posts'  => 'edit_others_'.$this->capability_type[1],
                'publish_posts'      => 'publish_'.$this->capability_type[1],
                'read_private_posts' => 'read_private_'.$this->capability_type[1],
                'create_posts'       => 'edit_'.$this->capability_type[1],
                "delete_private_posts" => "delete_private_".$this->capability_type[1],
                "delete_published_posts" => "delete_published_".$this->capability_type[1],
                "delete_others_posts" => "delete_others_".$this->capability_type[1],
                "edit_private_posts" => "edit_private_".$this->capability_type[1],
                "edit_published_posts" => "edit_published_".$this->capability_type[1],
            ];
        }

        $labels = array(
            'name'               => ucwords($this->getSingularName()),
            'singular_name'      => ucwords($this->singular_name),
            'menu_name'          => ucwords($this->plural_name),
            'name_admin_bar'     => ucwords($this->singular_name),
            'add_new'            => 'New ' . ucwords($this->singular_name),
            'add_new_item'       => 'Add New ' . ucwords($this->singular_name),
            'new_item'           => 'New ' . ucwords($this->singular_name),
            'edit_item'          => 'Edit ' . ucwords($this->singular_name),
            'view_item'          => 'View ' . ucwords($this->plural_name),
            'all_items'          => 'All ' . ucwords($this->plural_name),
            'search_items'       => 'Search ' . ucwords($this->plural_name),
            'parent_item_colon'  => 'Parent ' . ucwords($this->plural_name) . ':',
            'not_found'          => 'No ' . ucwords($this->plural_name) . ' found.',
            'not_found_in_trash' => 'No ' . ucwords($this->plural_name) . ' found in Trash.',
        );
        $args = array(
            'labels'            => $labels,
            'public'            => $this->isVisible,
            'publicly_queryable'=> $this->isVisible, //TODO να είναι ξεχωριστό από το public
            'show_ui'           => true,
            'show_in_nav'       => true,
//            'show_in_rest' => $this->isVisible,
//            'rest_base' => $this->restBase,
//            'rest_controller_class' => 'WP_REST_Posts_Controller',//TODO
            'query_var'         => true,
            'rewrite'           => array('slug' => $this->slug, 'with_front' => false),
            'has_archive'       => false,
            'hierarchical'      => false,
            'menu_position'     => 5,
            'supports'          => $this->supports,
            'show_in_admin_bar' => true,
            'menu_icon'         => 'dashicons-buddicons-replies',
            'taxonomies' => $this->taxonomies,
//            'exclude_from_search' => false,TODO
            'capabilities' => $caps,
//            'create_posts' => false, // Removes support for the "Add New" function (use 'do_not_allow' instead of false for multisite set ups)
//             ),
            'capability_type' => $this->capability_type,
        );

        //register your content type
        register_post_type($this->content_type_name, $args);
        $role = get_role( 'administrator' );
        foreach ($caps as $defCap => $specCap){
            $role->add_cap( $specCap );
        }
    }

    public function add_taxonomy(){
        $labels = array(
            'name' => ucwords($this->getSingularName()),
            'singular_name' => ucwords($this->singular_name),
            'search_items' =>  'Search ' . ucwords($this->plural_name),
            'all_items' => 'All ' . ucwords($this->plural_name),
            'parent_item' => __( 'Parent Category' ),
            'parent_item_colon' => __( 'Parent Category:' ),
            'edit_item' => 'Edit ' . ucwords($this->singular_name),
            'update_item' => 'Update ' . ucwords($this->singular_name),
            'add_new_item' => 'Add ' . ucwords($this->singular_name),
            'new_item_name' => __( 'Title of New ' . ucwords($this->singular_name) ),
            'menu_name' => ucwords($this->singular_name),
        );
        register_taxonomy($this->content_type_name ,$this->supports, array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'public' => $this->getRestBase(),
            'rewrite' => array( 'slug' => $this->slug ),
        ));
//        register_taxonomy_for_object_type($this->slug, $this->supports);
    }
}