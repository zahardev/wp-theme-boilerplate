<?php

use App\App as Starter;

require_once( __DIR__ . '/autoloader.php' );

// Todo: replace CHILD_ with your prefix, rename child-theme folder, edit style.css
define('CHILD_THEME_DIR_URI', get_stylesheet_directory_uri());
define('CHILD_THEME_DIR', __DIR__);

Starter::init();
