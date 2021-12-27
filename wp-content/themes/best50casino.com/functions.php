<?php
require_once 'includes/theme/Classes/ThemeSetup.php';

$theme = new ThemeSetup;

$files = glob( get_template_directory() . '/includes/widgets/*.php' );

foreach ( $files as $file ) {
    include $file;
}

function theme_add_editor_styles() {
    wp_enqueue_style( 'editorCSS', get_template_directory_uri().'/includes/theme/editor-buttons/editor.css' );
}
add_action( 'admin_init', 'theme_add_editor_styles' );

/**** NEEDED FOR FRONT ****/
require_once TEMPLATEPATH . '/includes/widgets/super-tabs.php'; //
/**** WIDGETS ****/
// TODO: move to Theme Setup


// get flags

function create_list($post_type){
    $list_args= array(
        'post_type'=>$post_type,
        'post_status'=>'publish',
        'posts_per_page'=>-1
    );
    $list_query = get_posts($list_args);

    foreach($list_query as $list_post){ ?>
        <li><a href="<?php echo get_the_permalink($list_post->ID); ?>"><?php echo get_the_title($list_post->ID); ?></a></li>
        <?php
    }
}

