<?php

namespace App\Post_Types;


class Articles extends Abstract_CPT {

    protected static $post_type = 'article';

    protected static function get_config() {
        return include __DIR__ . '/../config/cpt/articles-config.php';
    }
}
