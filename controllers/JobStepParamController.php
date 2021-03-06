<?php

namespace app\controllers;

use app\models\PjeJobStep;
use Yii;
use app\models\PjeJobStepParam;
use app\models\PjeStepParamSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JobStepParamController implements the CRUD actions for PjeJobStepParam model.
 */
class JobStepParamController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PjeJobStepParam models.
     *
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new PjeStepParamSearch();
        $searchModel->job_step_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $jobStep = PjeJobStep::find()->where(['id' => $id])->one();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jobStepId' => $id,
            'jobStep' => $jobStep,
        ]);
    }

    /**
     * Displays a single PjeJobStepParam model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PjeJobStepParam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new PjeJobStepParam();
        $model->job_step_id = $id;
        $jobStep = PjeJobStep::find()->where(['id' => $id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/job-step-param/index/'.$id);
        } else {
            return $this->render('create', [
                'model' => $model,
                'jobStepId' => $id,
                'jobStep' => $jobStep,
            ]);
        }
    }

    /**
     * Updates an existing PjeJobStepParam model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $jobStep = PjeJobStep::find()->where(['id' => $model->job_step_id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/job-step-param/index/'.$model->job_step_id);
        } else {
            return $this->render('update', [
                'model' => $model,
                'jobStep' => $jobStep,
            ]);
        }
    }

    /**
     * Deletes an existing PjeJobStepParam model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $jobStepId = $model->job_step_id;
        $model->delete();

        return $this->redirect('/job-step-param/index/'.$jobStepId);
    }

    /**
     * Finds the PjeJobStepParam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return PjeJobStepParam the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PjeJobStepParam::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
