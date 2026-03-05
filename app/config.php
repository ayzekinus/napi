<?php

# Application Configuration File.

$config = array(
    # Application Mode { value: debug or live }

    'mode' => 'live',
    # Application Folder { default: '' (home directory) }
    'folder' => '',
    # Application Admin Panel Folder { not required. }
    'admin' => '',
    # Application Licence Key { not required }
    'key' => '',
    # Database Configuration
    'database' => array(
        'db_name' => 'test',
        'db_user' => 'test',
        'db_pass' => '..test..',
        'db_host' => 'localhost',
        'db_type' => 'mysql', // mysql, pgsql, sqlite
        'charset' => 'utf8',
        'prefix' => ''
    ),
    'hash' => 'zTIuV5Ko.Hn-',
    # Auto Load Libraries, Models and Helpers.
    'autoload' => array(
        'helper' => array('global'),
        'library' => array(),
        'model' => array()
    ),
    # Default Timezone Settings
    'timezone' => 'Europe/Istanbul'
);
