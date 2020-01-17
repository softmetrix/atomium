<?php

$config = [];
// DSN of database. Example: mysql:host=localhost;dbname=db_name
$config['db_dsn'] = getenv('DB_DSN');
// Database user name
$config['db_user'] = getenv('DB_USER');
// Database user password
$config['db_pass'] = getenv('DB_PASS');
/* Path where job, step and component files are stored.
Example: /var/www/scripts */
$config['scripts_path'] = getenv('SCRIPTS_PATH');
// Application base URL. Example: http://www.yourdomain.com
$config['base_url'] = getenv('APP_URL');
// Mail server host
$config['mailer_host'] = getenv('MAIL_HOST');
// Mailer server user name
$config['mailer_user'] = getenv('MAIL_USER');
// Mailer server user password
$config['mailer_pass'] = getenv('MAIL_PASS');
// Mailer server port
$config['mailer_port'] = getenv('MAIL_PORT');
// Mailer srever encryption
$config['mailer_encryption'] = getenv('MAIL_ENCRYPT');
// Mailer from
$config['mailer_from'] = getenv('MAIL_FROM');
// Mailer srever encryption
$config['mailer_auth_mode'] = 'login';
// Application account user name
$config['app_login_user'] = getenv('UM_USER');
// Application account user password
$config['app_login_pass'] = getenv('UM_PASS');

return $config;
