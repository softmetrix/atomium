<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pje_job".
 *
 * @property int          $id
 * @property string       $title
 * @property string       $description
 * @property string       $job_class
 * @property int          $parallel
 * @property int          $lock
 * @property int          $rollback_job_id
 * @property PjeJobStep[] $pjeJobSteps
 */
class PjeJob extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pje_job';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description', 'job_class'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['parallel', 'rollback_job_id', 'lock'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPjeJobSteps()
    {
        return $this->hasMany(PjeJobStep::className(), ['job_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRollbackJob()
    {
        return $this->hasOne(PjeJob::className(), ['id' => 'rollback_job_id']);
    }

    public function isRunning()
    {
        $executionId = false;
        $lastExecution = PjeExecution::find()
            ->where(['job_id' => $this->id])
            ->andWhere(['is', 'end_time', new \yii\db\Expression('null')])
            ->orderBy('id desc')
            ->one();
        if ($lastExecution) {
            $executionId = $lastExecution->id;
        }

        return $executionId;
    }

    public function preventExecutionLock()
    {
        $executionId = false;
        if ($this->lock) {
            $executionId = $this->isRunning();
        }

        return $executionId;
    }

    public static function jobClasses()
    {
        $stepsPath = Yii::$app->params['jobs_path'];
        $files = glob($stepsPath.DIRECTORY_SEPARATOR.'*Job.php');
        $jobClasses = [];
        $jobClasses[''] = '-- none --';
        foreach ($files as $file) {
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $jobClasses[$fileName] = $fileName;
        }

        return $jobClasses;
    }

    public static function rollbackJobs($jobId = false)
    {
        $rollbackJobs = [];
        $rollbackJobs[''] = '-- none --';
        $jobsQuery = PjeJob::find();
        if ($jobId) {
            $jobsQuery = $jobsQuery->where(['<>', 'id', $jobId]);
        }
        $jobs = $jobsQuery->all();
        $rollbackJobs += ArrayHelper::map($jobs, 'id', 'title');

        return $rollbackJobs;
    }

    public function generateCommand()
    {
        $command = Yii::$app->basePath;
        $command .= DIRECTORY_SEPARATOR;
        $command .= 'yii execute-job '.$this->id;

        return $command;
    }
}
