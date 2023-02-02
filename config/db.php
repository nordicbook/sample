<?php

use yii\db\Connection;

$params = require __DIR__ . '/params.php';

return [
    'class' => Connection::class,
    'dsn' => $params['db']['dsn'],
    'username' => $params['db']['username'],
    'password' => $params['db']['password'],
    'charset' => 'utf8',
    'enableLogging' => false

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
