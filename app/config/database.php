<?php
/**
 * Created by IntelliJ IDEA.
 * User: gabrielgagno
 * Date: 4/20/16
 * Time: 11:54 AM
 */

return array(
    'db' => \App\Libraries\CoreHelpersLibrary::env('DB_CONNECTION', 'mysql'),
    'settings' => array(
        'mysql' => array(
            'dbname' => \App\Libraries\CoreHelpersLibrary::env('DB_DATABASE', 'sample'),
            'username'   => \App\Libraries\CoreHelpersLibrary::env('DB_USERNAME', 'usr'),
            'password'  => \App\Libraries\CoreHelpersLibrary::env('DB_PASSWORD', 'pass'),
            'host'   => \App\Libraries\CoreHelpersLibrary::env('DB_HOST', 'localhost'),
            'port'   => '3306'
        )
    ),
    'drivers' => array(
        'mysql' => \App\Libraries\CoreHelpersLibrary::env('DB_DRIVER', 'pdo_mysql')
    )
);