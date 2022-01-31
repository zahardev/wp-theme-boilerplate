<?php

use App\Post_Types\Articles;

$supports = [
    'title',
    'thumbnail',
    'excerpt',
    'editor',
];

$labels = [
    'name'           => 'Articles',
    'singular_name'  => 'Article',
    'menu_name'      => 'Articles',
    'name_admin_bar' => 'Articles',
    'add_new'        => 'Add Article',
    'add_new_item'   => 'Add article',
    'new_item'       => 'New article',
    'edit_item'      => 'Edit article',
    'view_item'      => 'View article',
    'all_items'      => 'All articles',
    'search_items'   => 'Search articles',
    'not_found'      => 'No articles found.',
];

return [
    'supports'     => $supports,
    'labels'       => $labels,
    'public'       => true,
    'query_var'    => true,
    'rewrite'      => [
        'slug'       => '/kennis-en-informatie/kennisbank',
        'with_front' => false,
    ],
    'has_archive'  => true,
    'hierarchical' => false,
    '_taxonomies'   => [
        [
            'name' => 'article_subjects',
            'type' => Articles::post_type(),
            'args' => [
                'hierarchical' => true,
                'label'        => 'Subjects',
                'query_var'    => true,
                'rewrite'      => [
                    'slug'       => 'onderwerpen',
                    'with_front' => false,
                ],
            ],
        ],
    ],
];
