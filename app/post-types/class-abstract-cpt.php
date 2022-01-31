<?php

namespace App\Post_Types;


abstract class Abstract_CPT {

    protected static $post_type;

    public static function init() {
        self::register_post_type();
        self::register_taxonomies();
    }

    protected static function register_post_type() {
        register_post_type( static::$post_type, static::get_config() );
    }

    protected static function register_taxonomies() {
        $config = static::get_config();
        if ( isset( $config['_taxonomies'] ) ) {
            foreach ( $config['_taxonomies'] as $tax ) {
                register_taxonomy( $tax['name'], $tax['type'], $tax['args'] );
            }
        }
    }

    public static function post_type() {
        return static::$post_type;
    }

    abstract protected static function get_config();

}
