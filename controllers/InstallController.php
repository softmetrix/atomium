<?php

namespace app\controllers;

class InstallController extends BaseController
{
    public function beforeAction($action)
    {
        $this->layout = 'install';

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        if ($this->isInstalled()) {
            return $this->redirect('/');
        }
        $basePath = \Yii::$app->basePath;
        $output = [];
        $retVal = null;
        exec("cd {$basePath}; ./install", $output, $retVal);
        $output = implode("\n", $output);

        return $this->render('index', [
            'output' => $output,
            'retVal' => $retVal,
        ]);
    }
}
