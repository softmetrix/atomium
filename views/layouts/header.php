<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini"><img src="/images/atomium_logo_i_2.png" style="height: 35px;" /></span>
                 <span class="logo-lg"><img src="/images/atomium_logo_2.png" style="height: 45px;" /></span>', Yii::$app->homeUrl, ['class' => 'logo', 'style' => 'background-color: #fff;']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <?php
                $notifications = app\models\PjeNotification::find()->where([
                    'seen' => 0
                ])->orWhere(['seen' => null])->all();
                ?>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning"><?= count($notifications) ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have <?= count($notifications) ?> notifications</li>
                        <li>
                            <ul class="menu">
                                <?php
                                foreach ($notifications as $n) {
                                    $notificationClass = 'text-aqua';
                                    if ($n->notification_type == 4) {
                                        $notificationClass = 'text-red';
                                    } ?>
                                    <li>
                                        <a class="notification-link" 
                                           href="/stats/index/<?= $n->execution_id ?>"
                                           data-id="<?= $n->id ?>">
                                            <i class="fa fa-users <?= $notificationClass ?>"></i> <?= $n->message ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu" id="in-progress-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-refresh"></i>
                        <span class="label label-danger job-count"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <ul class="menu">
                               
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<?php
$js = <<<EOT
    $(function(){
        $('.notification-link').click(function(event){
            event.preventDefault();
            var href = $(this).attr('href');
            var id = $(this).data('id')
            $.get( "/notifications/seen/" + id, function( data ) {
                window.location.href = href;
            });
            return false;
        });
    });
EOT;
$this->registerJs($js);
?>