<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'public2' => [
            'driver' => 'local',
            'root' => public_path().'/images',
            'url' => '/images',
            'visibility' => 'public',
        ],

        'skinsegup' => [
            'driver' => 'local',
            'root' => storage_path('app/public/skinseguploads'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'objectdetup' => [
            'driver' => 'local',
            'root' => storage_path('app/public/objdetuploads'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'faceandgenderup' => [
            'driver' => 'local',
            'root' => storage_path('app/public/faguploads'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
/*
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],*/
        'gdrive' => [
            'driver' => 'google',
            'clientId' => '699356406135-etras5sgh577d461uatthn6icti5b0p6.apps.googleusercontent.com',
            'clientSecret' => 'BTUmtPZwWLciiQFlRZ5dFuN2',
            'refreshToken' => '1//04FORvgfAnN-1CgYIARAAGAQSNwF-L9IrQG-4XgapNfxrZuyHqXqxsdP_635fPcGSix-pSC2_Ga0P6R_PWvXHf8nxa50zr-yxS78',
            'folderId' => '1tjknXACnuT3vRAvuA6IcTReSDtJq8WTG',
        ],
        'gdrive2' => [
            'driver' => 'google',
            'clientId' => '699356406135-etras5sgh577d461uatthn6icti5b0p6.apps.googleusercontent.com',
            'clientSecret' => 'BTUmtPZwWLciiQFlRZ5dFuN2',
            'refreshToken' => '1//04FORvgfAnN-1CgYIARAAGAQSNwF-L9IrQG-4XgapNfxrZuyHqXqxsdP_635fPcGSix-pSC2_Ga0P6R_PWvXHf8nxa50zr-yxS78',
            'folderId' => '10qmLEXJ6QdvGhvRiidmVP8W2Bw8AHIGm',
        ],
        'gdrive3' => [
            'driver' => 'google',
            'clientId' => '699356406135-etras5sgh577d461uatthn6icti5b0p6.apps.googleusercontent.com',
            'clientSecret' => 'BTUmtPZwWLciiQFlRZ5dFuN2',
            'refreshToken' => '1//04FORvgfAnN-1CgYIARAAGAQSNwF-L9IrQG-4XgapNfxrZuyHqXqxsdP_635fPcGSix-pSC2_Ga0P6R_PWvXHf8nxa50zr-yxS78',
            'folderId' => '1-HM5bjtx548oJk4Fo04qi0GEpLqXssRE',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
