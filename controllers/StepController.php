<?php

namespace app\controllers;

use Yii;
use app\models\PjeStep;
use app\models\PjeStepSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Inflector;

/**
 * StepController implements the CRUD actions for PjeStep model.
 */
class StepController extends BaseController
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

    public function beforeAction($action)
    {
        $this->scan();

        return parent::beforeAction($action);
    }

    /**
     * Lists all PjeStep models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PjeStepSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PjeStep model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $stepsPath = Yii::$app->params['steps_path'];
        $filePath = $stepsPath.DIRECTORY_SEPARATOR.$model->step_class.'.php';
        $code = '';
        if (file_exists($filePath)) {
            $code = file_get_contents($filePath);
        }

        return $this->render('view', [
            'model' => $model,
            'code' => $code,
        ]);
    }

    /**
     * Creates a new PjeStep model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PjeStep();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PjeStep model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PjeStep model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        \app\models\PjeJobStep::deleteAll(['step_id' => $id]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the PjeStep model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return PjeStep the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PjeStep::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function scan()
    {
        $stepsPath = Yii::$app->params['steps_path'];
        $files = glob($stepsPath.DIRECTORY_SEPARATOR.'*Step.php');
        $this->addNewSteps($files);
        $this->markUnexistingStepsAsInactive($files);
    }

    private function addNewSteps($files)
    {
        foreach ($files as $file) {
            $class = pathinfo($file, PATHINFO_FILENAME);
            if (!PjeStep::find()->where(['step_class' => $class])->count()) {
                $pjeStep = new PjeStep();
                $pjeStep->title = Inflector::camel2words($class);
                $pjeStep->step_class = $class;
                $pjeStep->is_active = PjeStep::ACTIVE;
                $pjeStep->save();
            }
        }
    }

    private function markUnexistingStepsAsInactive($files)
    {
        $classes = array_map(function ($file) {
            return pathinfo($file, PATHINFO_FILENAME);
        }, $files);
        $steps = PjeStep::find()->all();
        foreach ($steps as $step) {
            $step->is_active = in_array($step->step_class, $classes) ? PjeStep::ACTIVE : PjeStep::INACTIVE;
            $step->save();
        }
    }
}
