# Atomium
## Installation (Docker)
#### Basic docker-compose.yml setup

    version: "3.3"
    services:
        atomium:
            image: softmetrixgroup/atomium:latest
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

## Installation from ZIP package
#### Download latest stable version
ZIP package is provided in each release. Download ZIP package from last stable release.
#### Unpack ZIP archive into web root folder
Configure your web server and unpack ZIP archive into web root folder.
#### Configuration file
Copy /config/config_example.php to /config/config.php. Fill /config/config.php according to 
your system environment.
#### First time install
Open application in web browser first time. It will call installation script. Once installation is 
completed you can start using application.

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
#### Configuration file
Copy /config/config_example.php to /config/config.php. Fill /config/config.php according to 
your system environment.
#### Init composer plugin
Navigate to root folder of cloned repository and execute following command from terminal:

    composer global require "fxp/composer-asset-plugin:dev-master"
#### Composer update
Execute composer update from terminal:

    composer update
#### Execute migrations
    /path-to-cloned-repo/yii migrate

## CRON setup (optional)
This step is not necessary but it is recommended. Application might crash in the middle of the job for some reason (e.g. power outage, operatyng system crash). Application will close interrupted job on page open. However, it is reccomended to close job and notify user as soon as job is crashed. Add following item to crontab:

    * * * * * /path-to-cloned-repo/yii close-interrupted

If your operatyng sistem is not Linux or OSX, use default scheduling system on your OS. 

## Additional configuration (optional)
There is an option if you need additional configuration options which is not achievable using Atomium API.
Create extra_config.php file unther the config subdirectory. This is an example:

    <?php
    $extra = [];
    $extra['components'] = [];
    $extra['components']['db2'] = [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=targetmysql;dbname=target_db',
        'username' => 'target_user',
        'password' => 'target123',
        'charset' => 'utf8',
    ];
    return $extra;

It will create Yii::$app->db2 which can be used in jobs. 
For more details please read [Yii2 docs](https://www.yiiframework.com/doc/api/2.0) since Atomium is based on Yii2.

For Docker setup add VOLUME entry to docker-compose.yml file:

    volumes:
        ...
        - /path-to-conf/extra_config.php:/var/www/html/atomium/config/extra_config.php
        ...

## Usage
#### Creating step, job and component classes
Step, job and component classes can be created manually. However, it is easier to create them using command line utility. Navigate to root of application directory. To create step class execute following command:

    yii create -n=StepName -t=step

It will generate empty class:

    namespace app\components;
    use Yii;

    class StepNameStep extends Step {
        protected function execute() {
            $success = 1;
            $response = 'OK';
            return self::generateResponse($success, $response);
        }
    }

Command for creating jobs:

    yii create -n=JobName -t=job

Command for creating components:

    yii create -n=ComponentName -t=component
