<?php

namespace App;

class Frontend {

    private function __construct() {
    }

    public static function init() {
        if ( is_admin() ) {
            self::init_admin_styles();
        } else {
            self::init_styles();
            self::init_scripts();

            add_filter( 'wpseo_canonical', [ self::class, 'canonical' ] );
        }
    }

    public static function init_admin_styles() {
        add_action( 'admin_init', function () {
            $style_path = '/assets/css/admin.css';
            $deps       = [];
            wp_enqueue_style( 'admin-style', CHILD_THEME_DIR_URI . $style_path, $deps, filemtime( CHILD_THEME_DIR . $style_path ) );
        } );
    }

    public static function init_styles() {
        add_action( 'init', function () {
            wp_dequeue_style( 'style' );
            wp_enqueue_style( 'select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', [] );

            $style_path = '/assets/css/all.min.css';
            $deps       = [];
            wp_enqueue_style( 'style', CHILD_THEME_DIR_URI . $style_path, $deps, filemtime( CHILD_THEME_DIR . $style_path ) );
        } );
    }

    public static function init_scripts() {
        add_action( 'wp_enqueue_scripts', function () {
            $script_path = '/assets/js/all.min.js';
            $deps        = [];

            $handle = 'theme-script';
            wp_enqueue_script( $handle, CHILD_THEME_DIR_URI . $script_path, $deps, filemtime( CHILD_THEME_DIR . '/src/js' ), true );

            $data = [];
            wp_localize_script( $handle, 'ThemeData', $data );
        } );
    }
}
