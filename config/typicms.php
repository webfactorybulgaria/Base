<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cache system (use cache decorator in place of repository classes)
    |--------------------------------------------------------------------------
    */
    'cache' => true,

    /*
    |--------------------------------------------------------------------------
    | Save each front office page in public/html as flat html file.
    | Pages are generated only when debug is off and no user is connected.
    | The directory is cleaned on eloquent save, delete and composer install.
    |--------------------------------------------------------------------------
    */
    'html_cache' => env('CACHE_HTML', false),

    /*
    |--------------------------------------------------------------------------
    | You can choose not to have main locale in URLs
    |--------------------------------------------------------------------------
    |
    | If set to false, the fallback_locale defined in config/app.php
    | will not appear in URLs.
    |
    */
    'main_locale_in_url' => true,

    /*
    |--------------------------------------------------------------------------
    | You can choose to have all pages URLs starting at root level 
    | (default = false)
    |--------------------------------------------------------------------------
    |
    | If set to false, the URLs will be nested 
    | Note that the URLs are generated and stored in the database. If you 
    | change this setting make sure you update the database
    |
    */
    'single_level_urls' => false,

    /*
    |--------------------------------------------------------------------------
    | Max file upload size allowed
    |--------------------------------------------------------------------------
    */
    'max_file_upload_size' => 8000,

    /*
    |--------------------------------------------------------------------------
    | Welcome message url present in Dashboard
    |--------------------------------------------------------------------------
    */
    'welcome_message_url' => getEnv('WELCOME_MESSAGE_URL'),

    /*
    |--------------------------------------------------------------------------
    | Per module config
    |--------------------------------------------------------------------------
    |
    | Here you can override config for each module.
    |
    */
    'news' => [
        'per_page' => 50,
    ],

    /*
    |--------------------------------------------------------------------------
    | Folder to find template files for pages.
    | This folder is a subfolder of /resources/views/vendor/pages
    |--------------------------------------------------------------------------
    |
    */
    'template_dir' => 'public',

    /*
    |--------------------------------------------------------------------------
    | Number of content versions that can be reverted
    |--------------------------------------------------------------------------
    |
    */
    'version_count' => 10,

    /*
    |--------------------------------------------------------------------------
    | Public Path setting
    |--------------------------------------------------------------------------
    |
    | Here you can override the public path but it is advisable to do it in the .env
    |
    */
    'public_path' => env('PUBLIC_PATH'),
];
