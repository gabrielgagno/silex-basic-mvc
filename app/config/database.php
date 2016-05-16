<?php
/**
 * database.php
 * This is a configuration file for database connections by this Middleware. Returns
 * an array of desired settings. May also read from environment files.
 * @author Gabriel John P. Gagno <ggagno@stratpoint.com>
 * @version 1.0
 * @copyright 2016 Stratpoint Technologies, Inc.
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