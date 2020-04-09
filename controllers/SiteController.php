<?php

namespace app\controllers;

use app\models\PjeExecution;
use Yii;
use app\models\PjeJob;
use yii\data\ActiveDataProvider;
use app\helpers\FormatHelper;
use app\models\PjeSchedule;
use Cron\CronExpression;
use yii\data\ArrayDataProvider;

class SiteController extends BaseController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $job = Yii::$app->request->get('job-filter');
        $date = date('Y-m-d', strtotime('-2 months'));

        return $this->render('index', [
            'lastExecutionsProvider' => $this->getLastExecutionsProvider($job),
            'failedExecutionsProvider' => $this->getFailedExecutionsProvider($job),
            'nextExecutionsProvider' => $this->getNextExecutionsProvider($job),
            'completedCount' => PjeExecution::getCompletedCount($date, $job),
            'failedCount' => PjeExecution::getFailedCount($date, $job),
            'avgDuration' => FormatHelper::secondsToHMS(PjeExecution::getAvgDuration($date, $job)),
            'maxDuration' => FormatHelper::secondsToHMS(PjeExecution::getMaxDuration($date, $job)),
            'jobs' => PjeJob::find()->orderBy('title')->all(),
            'selectedJob' => $job,
        ]);
    }

    private function getLastExecutionsProvider($job)
    {
        $executionQuery = PjeExecution::find()
                                ->where(['not', ['success' => null]])
                                ->orderBy('end_time desc')
                                ->limit(10);
        if ($job) {
            $executionQuery->andWhere(['job_id' => $job]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $executionQuery,
        ]);
        $dataProvider->pagination = false;

        return $dataProvider;
    }

    private function getFailedExecutionsProvider($job)
    {
        $date = date('Y-m-d', strtotime('-7 days'));
        $executionQuery = PjeExecution::find()
                                ->where(['success' => 0])
                                ->andWhere(['not', ['success' => null]])
                                ->andWhere(['>=', 'start_time', $date])
                                ->orderBy('end_time desc')
                                ->limit(10);
        if ($job) {
            $executionQuery->andWhere(['job_id' => $job]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $executionQuery,
        ]);
        $dataProvider->pagination = false;

        return $dataProvider;
    }

    private function getNextExecutionsProvider($job)
    {
        $data = [];
        $query = PjeSchedule::find();
        if ($job) {
            $query->andWhere(['job_id' => $job]);
        }
        $schedule = $query->all();
        foreach ($schedule as $s) {
            $exp = CronExpression::factory($s->cron_config);
            $nextRunDate = $exp->getNextRunDate();
            $nextExecution = '';
            if ($nextRunDate) {
                $nextExecution = $nextRunDate->format('Y-m-d H:i:s');
            }
            $data[] = [
                'job' => $s->job->title,
                'next_execution' => $nextExecution,
            ];
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $dataProvider;
    }
}
