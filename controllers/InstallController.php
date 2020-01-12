<?php

namespace app\controllers;

class InstallController extends BaseController
{
    public function actionIndex()
    {
        $this->layout = false;
        if ($this->isInstalled()) {
            return $this->redirect('/');
        }
        $basePath = \Yii::$app->basePath;
        chmod($basePath.'/install', 'a+x');
        $retVal = null;
        echo '<pre>';
        passthru("cd {$basePath}; ./install", $retVal);
        echo '</pre>';
        if ($retVal === 0) {
            echo 'INSTALLED<br />';
            echo '<a href="/">Go to application</a>';
        } else {
            echo 'Something went wrong';
        }
    }
}
