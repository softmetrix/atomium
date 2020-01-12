<?php

$configPath = __DIR__.'/config.php';
if (file_exists($configPath)) {
    $config = require $configPath;
} else {
    echo $configPath.' does not exist';
    exit;
}

return [
    'steps_path' => $config['scripts_path'].'/steps',
    'jobs_path' => $config['scripts_path'].'/jobs',
    'components_path' => $config['scripts_path'].'/components',
    'base_url' => $config['base_url'],
    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => $config['mailer_host'],
            'username' => $config['mailer_user'],
            'password' => $config['mailer_pass'],
            'port' => $config['mailer_port'],
            'encryption' => $config['mailer_encryption'],
        ],
    ],
    'mailer_from' => $config['mailer_from'],
    'users' => [
        1 => [
            'id' => 1,
            'username' => $config['app_login_user'],
            'password' => $config['app_login_pass'],
            'accessToken' => '555access888',
            'authKey' => 'abcabc123',
        ],
    ],
];
