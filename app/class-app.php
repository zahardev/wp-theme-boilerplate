<?php

namespace App;

use App\Post_Types\Articles;
use App\Post_Types\Debtor_Articles;
use App\Post_Types\Debtor_News;
use App\Post_Types\News;
use App\Post_Types\Partners;
use App\Post_Types\References;
use App\Post_Types\Vacancies;
use App\Widgets\Footer_Widget;

class App {
    public static function init() {
        Frontend::init();

        //Post Types
        Articles::init();
    }
}
