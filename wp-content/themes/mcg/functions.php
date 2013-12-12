<?php
	
	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Load jQuery
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"), false);
	   wp_enqueue_script('jquery');
       wp_register_script('jquery_custom', get_bloginfo('template_directory').'/js/jquery-ui-1.10.3.custom.min.js');
       wp_enqueue_script('jquery_custom');
       wp_register_script('jquery_mouse_wheel', get_bloginfo('template_directory').'/js/jquery.mousewheel.min.js');
       wp_enqueue_script('jquery_mouse_wheel');
       wp_register_script('jquery_kinetic', get_bloginfo('template_directory').'/js/jquery.kinetic.min.js');
       wp_enqueue_script('jquery_kinetic');
       wp_register_script('jquery_smoothdivscroll',get_bloginfo('template_directory').'/js/jquery.smoothdivscroll-1.3-min.js');
       wp_enqueue_script('jquery_smoothdivscroll');
       wp_register_script('product_scroll', get_bloginfo('template_directory').'/js/product-scroll.js');
       wp_enqueue_script('product_scroll');
       wp_register_script('function', get_bloginfo('template_directory').'/js/function.js');
       wp_enqueue_script('function');
	}
	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
	// Declare sidebar widget zone
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }

    //[thien.nguyen] add menu support
    if(function_exists('register_nav_menus')) {
        register_nav_menus (
            array(
                'main_nav' =>'Main Navigation Menu',
                'shortcut_nav' =>'Shortcut Menu',
                'home_product_cat' =>'Home Product Categories'
            ));
    }

    //[thien.nguyen] Change thumbnail image size
    if(function_exists('add_theme_support')) {
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(220,220,true);
    }

    //[thien.nguyen] Change excerpt more
    function new_excerpt_more($more) {
        global $post;
        return "";// remove [...]
    }

    add_filter('excerpt_more','new_excerpt_more');

/*
    *Woocommerce
*/
    
    // //[thien.nguyen][woocommerce] unhook the WooCommerce wrapper
    // remove_action('woocommerce_before_main_content',
    //     'woocommerce_output_content_wrapper',10);
    // remove_action('woocommerce_after_main_content',
    //     'woocommerce_output_contetn_wrapper_end',10);

    // add_action('woocommerce_before_main_content',
    //     'my_theme_wrapper_start',10);
    // add_action('woocommerce_after_main_content',
    //     'my_theme_wrapper_end',10);

    // function my_theme_wrapper_start() {
    //     echo '<section id="main">';
    // }

    // function my_theme_wrapper_end() {
    //     echo '</section>';
    // }

    //[thien.nguyen][woocommerce] Declare WooCommerce support
    add_theme_support('woocommerce');

    //[thien.nguyen][woocommerce] display category image on category 
    add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );

    function woocommerce_category_image() {
        if ( is_product_category() ){
            global $wp_query;
            $cat = $wp_query->get_queried_object();
            $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
            $image = wp_get_attachment_url( $thumbnail_id );
            if ( $image ) {
                echo '<img src="' . $image . '" alt="" />';
            }
        }
    }

?>