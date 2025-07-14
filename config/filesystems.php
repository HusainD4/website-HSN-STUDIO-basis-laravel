<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Disk default yang akan digunakan oleh Laravel untuk menyimpan file.
    | Biasanya menggunakan 'local' untuk penyimpanan lokal, atau 'public'
    | jika ingin mudah diakses via web (setelah storage:link).
    |
    */

    'default' => env('FILESYSTEM_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Definisikan disk penyimpanan. Bisa menggunakan driver local, s3, ftp, dll.
    | Disk 'public' disiapkan untuk menyimpan file yang bisa diakses publik.
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Jalur symbolic link yang akan dibuat ketika kamu menjalankan:
    | php artisan storage:link
    | Link ini menghubungkan folder public/storage ke storage/app/public
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
