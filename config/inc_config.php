<?php

$GLOBALS['config']['db'] = array(
    'host'  => '127.0.0.1',
    'port'  => 3306,
    'user'  => 'root',
    'pass'  => 'root',
    'name'  => 'spider',
);

$GLOBALS['config']['redis'] = array(
    'host'      => '127.0.0.1',
    'port'      => 6379,
    'pass'      => '',
    'prefix'    => 'spider',
    'timeout'   => 30,
);

include "inc_mimetype.php";
