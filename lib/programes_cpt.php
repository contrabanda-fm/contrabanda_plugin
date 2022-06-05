<?php
    add_action( 'init', 'cbfm_create_prog_post_type' );
    function cbfm_create_prog_post_type() {
        register_post_type( 'programa',
            array(
                'labels' => array(
                    'name' => __( 'Programes' ),
                    'singular_name' => __( 'Programa' )
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'programa'),
                'menu_position'      => 15,
                'menu_icon'          => 'dashicons-playlist-audio',
            )
        );
        register_taxonomy('tipus', 'programa', array( 'hierarchical' => true, 'label' => 'Tipus', 'query_var' => true, 'rewrite' => true ) );
        wp_insert_term( 
            'Contrabanda', 
            'tipus', 
            array(
                'description' => 'Un programa de contrabanda amb podcast a contrabanda.org',
                'slug'        => 'contrabanda',
            )
        );
        wp_insert_term( 
            'Web pròpia', 
            'tipus', 
            array(
                'description' => 'Un programa de contrabanda amb podcast fora de contrabanda.org',
                'slug'        => 'propia',
            )
        );
        wp_insert_term( 
            'Altres ràdios', 
            'tipus', 
            array(
                'description' => 'Un podcast que no és de contrabanda',
                'slug'        => 'podcast',
            )
        );
    }
    add_action('init', 'cbfm_add_prog_thumbs');    
    function cbfm_add_prog_thumbs() {
        add_post_type_support( 'programa', 'thumbnail' );
    }
?>