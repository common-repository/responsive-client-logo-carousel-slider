<?php

class SLCRegisterPosttype{

    function __construct(){
        add_action( 'init', [$this, 'slc_create_post_type'] );

        add_filter('post_updated_messages', [$this, 'slc_updated_messages']);
        
        add_action('admin_head-post.php', [$this, 'slc_hide_publishing_actions']);
        add_action('admin_head-post-new.php', [$this, 'slc_hide_publishing_actions']);	

        
        // ONLY OUR CUSTOM TYPE POSTS
        add_filter('manage_scrollingcarousel_posts_columns', [$this, 'slc_column_handler'], 10);
        add_action('manage_scrollingcarousel_posts_custom_column', [$this, 'slc_column_content_handler'], 10, 2);

        add_action('admin_init', [$this, 'admin_init']);
        
        add_action('edit_form_after_title',[$this, 'slc_shortcode_area']);
    }

    /* Register Custom Post Types********************************************/
    function slc_create_post_type() {
        register_post_type( 'scrollingcarousel',
            array(
                'labels' => array(
                    'name' => __( 'Client Logo Carousel'),
                    'singular_name' => __( 'Client Logo Carousel' ),
                    'add_new' => __( 'Add New' ),
                    'add_new_item' => __( 'Add new item' ),
                    'edit_item' => __( 'Edit' ),
                    'new_item' => __( 'New' ),
                    'view_item' => __( 'View' ),
                    'search_items'       => __( 'Search'),
                    'not_found' => __( 'Sorry, we couldn\'t find any item you are looking for.' )
                ),
                'public' => false,
                'show_ui' => true, 									
                'publicly_queryable' => true,
                'exclude_from_search' => true,
                'menu_position' => 14,
                'menu_icon' =>SLC_PLUGIN_DIR .'/img/icon.png',
                'has_archive' => false,
                'hierarchical' => false,
                'capability_type' => 'page',
                'rewrite' => array( 'slug' => 'scrollingcarousel' ),
                'supports' => array( 'title','thumbonail' )
            )
        );
    }	

    //Remove post update massage and link 
    function slc_updated_messages( $messages ) {
        $messages['scrollingcarousel'][1] = __('Updated');
        return $messages;
    }

    
    /*-------------------------------------------------------------------------------*/
    /* HIDE everything in PUBLISH metabox except Move to Trash & PUBLISH button
    /*-------------------------------------------------------------------------------*/
    function slc_hide_publishing_actions(){
        $my_post_type = 'scrollingcarousel';
        global $post;
        if($post->post_type == $my_post_type){
            echo '
                <style type="text/css">
                    #misc-publishing-actions,
                    #minor-publishing-actions{
                        display:none;
                    }
                </style>
            ';
        }
    }
     
    // CREATE TWO FUNCTIONS TO HANDLE THE COLUMN
    function slc_column_handler($defaults) {
        $defaults['directors_name'] = 'ShortCode';
        return $defaults;
    }

    function slc_column_content_handler($column_name, $post_ID) {
        if ($column_name == 'directors_name') {
            // show content of 'directors_name' column
            echo '<input onClick="this.select();" value="[carousel id='. esc_attr($post_ID) . ']" >';
        }
    }	

    function admin_init(){ 
        $import_ver = get_option('slc_import_ver', 0);
        if($import_ver < SLC_IMPORT_VER){
            eov_import_meta();
            update_option('slc_import_ver', SLC_IMPORT_VER);
        }
    }

    function slc_shortcode_area(){
        global $post;   
        if($post->post_type=='scrollingcarousel'){
            ?>  
            <div>
                <label style="cursor: pointer;font-size: 13px; font-style: italic;" for="slc_shortcode">Copy this shortcode and paste it into your post, page, or text widget content:</label>
                <span style="display: block; margin: 5px 0; background:#1e8cbe; ">
                    <input type="text" id="slc_shortcode" style="font-size: 12px; border: none; box-shadow: none;padding: 4px 8px; width:100%; background:transparent; color:white;"  onfocus="this.select();" readonly="readonly"  value="[carousel id=<?php echo esc_html($post->ID); ?>]" /> 
                    
                </span>
            </div>
            <?php   
        }
    }
}

new SLCRegisterPosttype();