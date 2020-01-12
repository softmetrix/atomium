<?php

$configPath = __DIR__.'/config.php';
if (file_exists($configPath)) {
    $config = require $configPath;
} else {
    echo $configPath.' does not exist';
    exit;
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => $config['db_dsn'],
    'username' => $config['db_user'],
    'password' => $config['db_pass'],
    'charset' => 'utf8',
];
