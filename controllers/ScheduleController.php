<?php

namespace app\controllers;

use app\models\PjeJob;
use Yii;
use app\models\PjeSchedule;
use app\models\PjeScheduleSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ScheduleController implements the CRUD actions for PjeSchedule model.
 */
class ScheduleController extends BaseController
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
     * Lists all PjeSchedule models.
     *
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new PjeScheduleSearch();
        $searchModel->job_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jobId' => $id,
            'job' => PjeJob::find()->where(['id' => $id])->one(),
        ]);
    }

    /**
     * Displays a single PjeSchedule model.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PjeSchedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new PjeSchedule();
        $model->job_id = $id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $this->regenerateScheduleFile();

                return $this->redirect('/schedule/index/'.$id);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PjeSchedule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->regenerateScheduleFile();

            return $this->redirect('/schedule/index/'.$model->job_id);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PjeSchedule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $jobId = $model->job_id;
        $model->delete();
        $this->regenerateScheduleFile();

        return $this->redirect('/schedule/index/'.$jobId);
    }

    /**
     * Finds the PjeSchedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return PjeSchedule the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PjeSchedule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function regenerateScheduleFile()
    {
        $fileContent = '<?php'."\n";
        $filePath = Yii::$app->basePath.'/config/schedule.php';
        $schedule = PjeSchedule::find()->all();
        $fileContent .= '$schedule->command(\'close-interrupted\')->cron(\'* * * * *\');'."\n";
        foreach ($schedule as $s) {
            $command = $s->job->generateCommand();
            $fileContent .= '$schedule->exec(\''.$command.'\')->cron(\''.$s->cron_config.'\');'."\n";
        }
        $fileContent .= '?>'."\n";
        @unlink($filePath);
        touch($filePath);
        file_put_contents($filePath, $fileContent);
    }
}
