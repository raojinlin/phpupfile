<?php

$config = require(__DIR__ . '/config.php');

function createDbConnection() {
    global $config;
    $dbconf = $config['database'];
    return new PDO(
        "mysql:dbname=${dbconf['dbname']};host=${dbconf['host']};port=${dbconf['port']}",
        $dbconf['user'],
        $dbconf['password']
    );
}