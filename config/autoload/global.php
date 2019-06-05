<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
use Zend\Db\Adapter;

return [
    'db' => [
        'driver' => 'Pdo_Mysql',
        'database' => 'proyecto_zf3',
        'hostname' => 'localhost',
        'driver_options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ],
    ],
    'db_mysql_2' => [
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=otra_db_mysql;host=localhost',
    ],
    'db_sqlite_3' => [
        'driver' => 'Pdo_Sqlite',
        'database' => sprintf('%s/data/sqlite.db', realpath(getcwd())),
    ],
];
