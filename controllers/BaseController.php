<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        $this->installation($action);
        $this->authentication($action);

        return parent::beforeAction($action);
    }

    private function authentication($action)
    {
        $loginAction = '/auth/login';
        $installAction = '/install/index';
        $currentAction = '/'.$action->controller->id.'/'.$action->id;
        if ($currentAction != $loginAction
            && $currentAction != $installAction) {
            if (!Yii::$app->user->identity) {
                $this->redirect($loginAction);
                Yii::$app->end();
            }
        }
    }

    private function installation($action)
    {
        if (!$this->isInstalled()) {
            $installAction = '/install/index';
            $currentAction = '/'.$action->controller->id.'/'.$action->id;
            if ($currentAction != $installAction) {
                $this->redirect($installAction);
                Yii::$app->end();
            }
        }
    }

    protected function isInstalled()
    {
        return Yii::$app->db->getTableSchema('pje_execution_step', true) !== null;
    }
}
