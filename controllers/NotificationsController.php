<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\PjeNotification;

class NotificationsController extends BaseController
{
    public function actionSeen($id)
    {
        PjeNotification::updateAll(['seen' => 1], 'id = ' . $id);
    }
}
