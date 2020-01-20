<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
<head>
    <meta charset="<?= Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags(); ?>
    <title><?= Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
    <style type="text/css">
        .window {
            border-radius: 3px;
            background: #222;
            color: #fff;
            overflow: auto;
            position: relative;
            margin: 0 auto;
            width: 70%;
            height: 400px;
        }
        .window:before {
            content: ' ';
            display: block;
            height: 48px;
            background: #C6C6C6;
        }
        .window:after {
            content: '. . .';
            position: absolute;
            left: 12px;
            right: 0;
            top: -3px;
            font-family: "Times New Roman", Times, serif;
            font-size: 96px;
            color: #fff;
            line-height: 0;
            letter-spacing: -12px;
        }
        .terminal {
            margin: 20px;
            font-family: monospace;
            font-size: 16px;
            color: #22da26;
        }
        .terminal .command {
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
        }
        .terminal .command:before {
            content: '$ ';
            color: #22da26;
        }
        .terminal .log {
            white-space: nowrap;
            overflow: hidden;
        }
    </style>
</head>
<body class='text-center'>
<?php $this->beginBody(); ?>
<?= $content; ?>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
