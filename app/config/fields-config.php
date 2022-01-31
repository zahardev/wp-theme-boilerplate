<?php

use App\Fields;
use App\Post_Types\Articles;
use App\Post_Types\Debtor_Articles;
use App\Post_Types\Debtor_News;
use App\Post_Types\News;
use App\Post_Types\References;
use App\Post_Types\Vacancies;
use Carbon_Fields\Field;

$days        = [ 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' ];
$day         = Field::make( 'select', 'day', __( 'Day' ) )->add_options( array_combine( $days, $days ) );
$open_time   = Field::make( 'time', 'open_at', __( 'Opening time' ) );
$close_time  = Field::make( 'time', 'close_at', __( 'Closing time' ) );

$time_format = "H:i";
foreach ( [ $open_time, $close_time ] as $time ) {
    $time->set_storage_format( $time_format )
         ->set_input_format( $time_format, $time_format )
         ->set_picker_options( [ 'time_24hr' => true, 'allowInput' => true ] );
}

$worktime_fields = [ $day, $open_time, $close_time ];

return [
    'theme_options' => [
        'type'   => 'theme_options',
        'name'   => 'Theme options',
        'tabs' => [
            'General' => [
                Field::make( 'checkbox', 'business_langs_enabled', 'Enable languages switcher for business' ),
                Field::make( 'separator', 'global_separator', 'General settings' ),
                Field::make( 'text', 'business_login_link', 'Business Login link' )->set_default_value( 'https://cibincasso.nl/auth/login' ),
                Field::make( 'text', 'business_contact_link', 'Business contact link' )->set_default_value( '/contact/contact-zakelijk/' ),
                Field::make( 'text', 'debtor_login_link', 'Debtor Login link' )->set_default_value( 'https://app.cibincasso.nl/debtor/login' ),
                Field::make( 'image', 'logo', 'Logo Image' )
                     ->set_default_value( CHILD_THEME_DIR_URI . '/assets/img/logo.png' ),
                Field::make( 'textarea', 'footer_logo_description', 'Footer Logo Description' ),
                Field::make( 'textarea', 'footer_copyright', 'Footer Copyright' )
                     ->set_default_value( 'Copyright Centraal Invorderings Bureau 2020' ),
                Field::make( 'text', 'number_of_clients', 'Number of clients' )->set_default_value( '2213' ),

                Field::make( 'separator', 'contact_form_separator', 'Contact Form' ),
                Field::make( 'text', 'contact_form_title', 'Title' )->set_default_value( 'Weten wat CIB voor uw organisatie kan betekenen?' ),
                Field::make( 'textarea', 'contact_form_description', 'Description' )->set_default_value( '<a href="#" class="link">Download onze brochure</a> of neem contact op met een van onze incasso-experts.' ),
                Field::make( 'text', 'contact_form_shortcode', 'Shortcode' )->set_default_value( '[contact-form-7 title="Contact Block"]' ),
                Field::make( 'separator', 'user_scripts_separator', 'User Scripts' ),
                Field::make( 'textarea', 'user_scripts', 'User Scripts' ),
            ],
            'News' => array_merge(
                [
                    Field::make( 'separator', 'news_separator', 'News' ),
                ],
                Fields::get_lang_dependent_fields([
                    [
                        'type'    => 'text',
                        'id'      => 'news_link_text',
                        'label'   => 'News overview link text',
                        'default' => 'Nieuwsoverzicht',
                    ],
                    [
                        'type'    => 'text',
                        'id'      => 'news_link_url',
                        'label'   => 'News overview link url',
                        'default' => '/over-cib/nieuws/',
                    ],
                    [
                        'type'    => 'text',
                        'id'      => 'debtor_news_link_url',
                        'label'   => 'Debtor news overview link url',
                        'default' => '/over-ons/nieuws/',
                    ],
                ])
            ),
            'Articles' => array_merge(
                [
                    Field::make( 'separator', 'article_separator', 'Articles' ),
                ],
                Fields::get_lang_dependent_fields( [
                    [
                        'type'    => 'text',
                        'id'      => 'article_link_text',
                        'label'   => 'Article overview link text',
                        'default' => 'Alle artikelen',
                    ],
                    [
                        'type'    => 'text',
                        'id'      => 'article_link_url',
                        'label'   => 'Article overview link url',
                        'default' => '/kennis-en-informatie/kennisbank/',
                    ],
                ] ),

                [
                    Field::make( 'separator', 'rel_articles_separator', 'Related Articles block' ),
                    Field::make( 'text', 'rel_articles_title', 'Title' )->set_default_value( 'Ook interessant…' ),
                    Field::make( 'rich_text', 'rel_articles_text', 'Text' )->set_default_value( 'Centraal Invorderings Bureau is uitgegroeid tot een innovatieve en dynamische speler binnen het credit management. Sinds onze oprichting verlenen wij inmiddels aan meer dan 2000 opdrachtgevers onze diensten.' ),
                    Field::make( 'text', 'rel_articles_btn_title', 'Button title' )->set_default_value( 'Lees verder' ),
                    Field::make( 'text', 'rel_articles_btn_url', 'Button url' ),
                    Field::make( 'checkbox', 'rel_articles_bg', 'Background' ),
                ]
            ),
            'Debtor Articles' => array_merge(
	            [
		            Field::make( 'separator', 'debtor_article_separator', 'Debtor Articles' ),
	            ],
	            Fields::get_lang_dependent_fields( [
		            [
			            'type'    => 'text',
			            'id'      => 'debtor_article_link_text',
			            'label'   => 'Article overview link text',
			            'default' => 'Alle artikelen',
		            ],
		            [
			            'type'    => 'text',
			            'id'      => 'debtor_article_base_url',
			            'label'   => 'Debtor article base URL',
			            'default' => '/hulp-en-advies/kennisbank',
		            ],
		            [
			            'type'    => 'text',
			            'id'      => 'debtor_article_link_url',
			            'label'   => 'Article overview link url',
			            'default' => '/hulp-en-advies/kennisbank',
		            ],
	            ] ),

	            [
		            Field::make( 'separator', 'rel_debtor_articles_separator', 'Related Debtor Articles block' ),
	            ],

	            Fields::get_lang_dependent_fields( [
		            [
			            'type'    => 'text',
			            'id'      => 'rel_debtor_articles_title',
			            'label'   => 'Title',
			            'default' => 'Ook interessant…',
		            ],
		            [
			            'type'    => 'rich_text',
			            'id'      => 'rel_debtor_articles_text',
			            'label'   => 'Text',
			            'default' => 'Centraal Invorderings Bureau is uitgegroeid tot een innovatieve en dynamische speler binnen het credit management. Sinds onze oprichting verlenen wij inmiddels aan meer dan 2000 opdrachtgevers onze diensten.',
		            ],
		            [
			            'type'    => 'text',
			            'id'      => 'rel_debtor_articles_btn_title',
			            'label'   => 'Button title',
			            'default' => 'Lees verder',
		            ],
		            [
			            'type'    => 'text',
			            'id'      => 'rel_debtor_articles_btn_url',
			            'label'   => 'Button url',
		            ],
	            ]),

	            [
		            Field::make( 'checkbox', 'rel_debtor_articles_bg', 'Background' ),
	            ]

            ),
            'References' => array_merge(
                [
                    Field::make( 'separator', 'reference_separator', 'Referencies' ),
                ],
                Fields::get_lang_dependent_fields( [
                    [
                        'type'    => 'text',
                        'id'      => 'reference_link_text',
                        'label'   => 'Reference overview link text',
                        'default' => 'Lees klantverhalen',
                    ],
                    [
                        'type'    => 'text',
                        'id'      => 'reference_link_url',
                        'label'   => 'Reference overview link url',
                        'default' => '/over-cib/referenties/',
                    ],
                ] )
            ),
            'Vacancies' => array_merge(
	            [
		            Field::make( 'separator', 'vacancies_separator', 'Vacancies' ),
	            ],
	            Fields::get_lang_dependent_fields( [
		            [
			            'type'    => 'text',
			            'id'      => 'vacancy_base_url',
			            'label'   => 'Vacancies base URL',
			            'default' => '/contact/werkenbij',
		            ],
		            [
			            'type'    => 'text',
			            'id'      => 'vacancy_closed_title',
			            'label'   => 'Closed vacancy popup title',
			            'default' => 'Deze vacature is verlopen!',
		            ],
		            [
			            'type'    => 'rich_text',
			            'id'      => 'vacancy_closed_text',
			            'label'   => 'Closed vacancy popup text',
			            'default' => 'Helaas is deze vacature verlopen. Bekijk hier de openstaande vacatures.',
		            ],
	            ] )
            ),
            'Socials' => [
                Field::make( 'separator', 'socials_separator', 'Socials' ),
                Field::make( 'text', 'facebook_url', 'Facebook url' ),
                Field::make( 'text', 'linkedin_url', 'Linkedin url' ),
                Field::make( 'text', 'whatsapp_url', 'WhatsApp url' ),
                Field::make( 'text', 'email', 'Email' ),
            ],
            'Logos' => [
                Field::make( 'complex', 'partner_logos', 'Logos' )
                     ->add_fields( [
                         Field::make( 'image', 'logo', 'Logo Image' )
                     ] )
            ],
            'Working Times' => [
                Field::make( 'separator', 'worktime_separator', 'Working Times' ),
                Field::make( 'text', 'worktime_opened_text', 'Opened Text' )->set_default_value( 'Op dit moment zijn wij <b>geopend</b>' ),
                Field::make( 'text', 'worktime_opened_text_fr', 'Opened Text (FR)' )->set_default_value( 'Nous sommes actuellement <b> ouverts </b>' ),
                Field::make( 'text', 'worktime_opened_text_en', 'Opened Text (EN)' )->set_default_value( 'We are currently <b> open </b>' ),
                Field::make( 'text', 'worktime_closed_text', 'Closed Text' )->set_default_value( 'Op dit moment zijn wij <b>gesloten</b>' ),
                Field::make( 'text', 'worktime_closed_text_fr', 'Closed Text (FR)' )->set_default_value( 'Nous sommes actuellement <b> fermés </b>' ),
                Field::make( 'text', 'worktime_closed_text_en', 'Closed Text (EN)' )->set_default_value( 'We are currently <b> closed </b>' ),
                Field::make( 'text', 'worktime_text', 'Working Hours Title' )->set_default_value( 'Wij zijn geopend op:' ),
                Field::make( 'text', 'worktime_text_fr', 'Working Hours Title (FR)' )->set_default_value( 'Nous sommes ouverts sur:' ),
                Field::make( 'text', 'worktime_text_en', 'Working Hours Title (EN)' )->set_default_value( 'We are open on:' ),
                Field::make( 'complex', 'worktime_debtors', 'Working Hours (debtors)' )
                     ->set_layout( 'tabbed-horizontal' )
                     ->add_fields( $worktime_fields ),
                Field::make( 'complex', 'worktime_business', 'Working Hours (business)' )
                     ->set_layout( 'tabbed-horizontal' )
                     ->add_fields( $worktime_fields ),
            ],
        ],
    ],
    'article'       => [
        'type'   => 'post_meta',
        'name'   => 'Settings',
        'where'  => [ 'post_type', '=', Articles::post_type() ],
        'fields' => [
            Field::make( 'text', 'subtitle', 'Subtitle' ),
            Field::make( 'text', 'label', 'Label' ),
            Field::make( 'image', 'preview_img', 'Preview' ),
        ],
    ],
    'vacancy'       => [
	    'type'   => 'post_meta',
	    'name'   => 'Settings',
	    'where'  => [ 'post_type', '=', Vacancies::post_type() ],
	    'fields' => [
		    Field::make( 'date', 'expiration_date', 'Expiration date' ),
	    ],
    ],
    'debtor_article'       => [
	    'type'   => 'post_meta',
	    'name'   => 'Settings',
	    'where'  => [ 'post_type', '=', Debtor_Articles::post_type() ],
	    'fields' => [
		    Field::make( 'text', 'subtitle', 'Subtitle' ),
		    Field::make( 'text', 'label', 'Label' ),
		    Field::make( 'image', 'preview_img', 'Preview' ),
	    ],
    ],
    'news'          => [
        'type'   => 'post_meta',
        'name'   => 'Settings',
        'where' => [ 'post_type', 'IN', [ News::post_type(), Debtor_News::post_type() ] ],
        'fields' => [
            Field::make( 'text', 'subtitle', 'Subtitle' ),
            Field::make( 'text', 'read_time', 'Read time' ),
            Field::make( 'text', 'contact_person', 'Contact Person' ),
            Field::make( 'image', 'preview', 'Preview' ),
            Field::make( 'text', 'label', 'Label' ),
        ],
    ],
    'page'          => [
        'type'   => 'post_meta',
        'name'   => 'Settings',
        'where' => [ 'post_type', '=', 'page' ],
        'fields' => [
            Field::make( 'checkbox', 'is_debtor', 'Debtor page' ),
            Field::make( 'checkbox', 'hide_from_search', 'Hide from search results' ),
        ],
    ],
    'reference' => [
        'type'   => 'post_meta',
        'name'   => 'Settings',
        'where'  => [ 'post_type', '=', References::post_type() ],
        'fields' => [
            Field::make( 'text', 'label', 'Label' ),
            Field::make( 'image', 'preview_image', 'Preview (if empty, featured image will be used)' ),
        ],
    ],
];
