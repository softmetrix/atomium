# Atomium
## Installation (Docker)
#### Basic docker-compose.yml setup

    version: "3.3"
    services:
        atomium:
            image: softmetrixgroup/atomium:0.1.0
            ports:
                - "22111:80"
            volumes:
                - /path-to-scripts:/var/www/html/scripts
            environment:
                DB_DSN: 'mysql:host=localmysql;dbname=atomium_db'
                DB_USER: 'atomium_user'
                DB_PASS: 'atomium123'
                MAIL_HOST: 'smtp.yourserver.com'
                MAIL_USER: 'yourmail@yourserver.com'
                MAIL_PASS: 'password'
                MAIL_PORT: '587'
                MAIL_ENCRYPT: 'tls'
                MAIL_FROM: 'yourmail@yourserver.com'
                UM_USER: 'admin'
                UM_PASS: '22engine11!'
                APP_URL: 'http://localhost:22111'
## Installation from repository
#### Clone repository
    git clone https://github.com/softmetrix/atomium.git
#### Web server configurtion
Configure web server for new application. This is an example for Apache Web server

    <VirtualHost *:80>
      ServerName application.domain
      DocumentRoot "/path-to-cloned-repo/web"
      <Directory "/path-to-cloned-repo/web">
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Order allow,deny
        Allow from all
        Require all granted
      </Directory>
    </VirtualHost>
#### Create empty database (or use existing)
Create empty database, if you want to use fresh database. You can also use existing database for this application.
#### Create db.php file
Create empty db.php file inside /path-to-cloned-repo/config directory. Insert following content inside newly created file:

    <?php
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=DB_HOST;dbname=DB_NAME',
        'username' => 'DB_USER',
        'password' => 'DB_PASS',
        'charset' => 'utf8',
    ];
Replace DB_HOST, DB_USER, DB_NAME, DB_PASSWORD parameters according to your environment.
#### Create params.php file
Create empty params.php file inside /path-to-cloned-repo/config directory. Insert following content inside newly created file:

    <?php
    return [
        'steps_path' => '/your-project/steps',
        'jobs_path' => '/your-project/jobs',
        'base_url' => 'http://application.domain',
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yourserver.com',
                'username' => 'yourmail@yourserver.com',
                'password' => 'password',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],  
        'mailer_from' => 'yourmail@yourserver.com',
        'users' => [
            1 => [
                'id' => 1,
                'username' => 'admin',
                'password' => '22engine11!',
                'accessToken' => '555access888',
                'authKey' => 'abcabc123'
            ],
            2 => [
                'id' => 2,
                'username' => 'supervisor',
                'password' => '145auto#',
                'accessToken' => '777access111',
                'authKey' => 'abcabcXYZ'
            ]
        ]
    ];
Change jobs_path and steps_path parameters to point to directory inside your target application. Change mailer and authentication parameters according to your environment.
#### Init composer plugin
Navigate to root folder of cloned repository and execute following command from terminal:

    composer global require "fxp/composer-asset-plugin:dev-master"
#### Composer update
Execute composer update from terminal:

    composer update
#### Execute migrations
    /path-to-cloned-repo/yii migrate
#### CRON setup
Add following item to crontab:

    * * * * * /path-to-cloned-repo/yii close-interrupted
