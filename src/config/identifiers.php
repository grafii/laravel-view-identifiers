<?php

return [
    /*
    |--------------------------------------------------------------------------
    | View Identifiers
    |--------------------------------------------------------------------------
    |
    | These are the settings for ViewIdentifier.
    |
    */

    /*
    | These options control the converters for incoming strings.
    |
    | Supported Styles: "kebab", "snake", "camel", "studly"
    |
     */
    'id' => [
        'style' => 'kebab',
    ],
    'class' => [
        'style' => 'kebab',
    ],

    /*
    | This option enables auto discovery to set the classes and id automatically.
    */
    'auto_discovery' => true,

    /*
    | This option sets controllers namespace for auto discovery.
    */
    'controllers' => 'App\Http\Controllers',
];
