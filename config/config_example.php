<?php

$config = [];

// DSN of database. Example: mysql:host=localhost;dbname=db_name
$config['db_dsn'] = '';
// Database user name
$config['db_user'] = '';
// Database user password
$config['db_pass'] = '';
/* Path where job, step and component files are stored.
Example: /var/www/scripts */
$config['scripts_path'] = '';
// Application base URL. Example: http://www.yourdomain.com
$config['base_url'] = '';
// Mail server host
$config['mailer_host'] = '127.0.0.1';
// Mailer server user name
$config['mailer_user'] = '';
// Mailer server user password
$config['mailer_pass'] = '';
// Mailer server port
$config['mailer_port'] = '587';
// Mailer srever encryption
$config['mailer_encryption'] = 'tls';
// Mailer srever encryption
$config['mailer_auth_mode'] = 'login';
// Mailer from
$config['mailer_from'] = '';
// Application account user name
$config['app_login_user'] = 'admin';
// Application account user password
$config['app_login_pass'] = '22engine11!';

return $config;
