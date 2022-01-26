<?php

namespace Config;

define('STORE', 'Ambarukmo');

define('BANDWITH_SPEEDBOOSTER', '120000000/120000000');
// define('BANDWITH_SPEEDBOOSTER', '95000000/95000000');

define('IP_STORE_MULTIMEDIA', [
    'merapi' => '192.168.99.1',
    'netcity' =>  '192.168.99.3',
    'godean' =>  '192.168.99.4',
    'luxury' =>  '192.168.99.7'
]);

define('MIKROTIK_USERNAME', 'min');
define('MIKROTIK_PASSWORD', 'pass');
define('MIKROTIK_PORT', 3333);


define('IP_UNIFI', [
    'merapi' => '110.76.148.165',
    'netcity' =>  '192.168.3.2',
    'godean' =>  '110.76.149.178',
    'luxury' =>  '110.76.149.198'
]);

// set ip unutk mikrotik dan unifi
define('IP_DEFAULT', IP_STORE_MULTIMEDIA['merapi']);

define('UNIFI_USERNAME', 'min');
define('UNIFI_PASSWORD', 'pas');


define("DB_HOST", "127.0.0.1");
define("DB_USERNAME", "rizal");
define("DB_PASSWORD", "123");
define("DB_PORT", 3306);
define("DB_DATABASE", "speedbooster_app");
