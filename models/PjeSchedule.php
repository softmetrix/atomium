<?php

namespace app\models;

use Cron\CronExpression;

/**
 * This is the model class for table "pje_schedule".
 *
 * @property int    $id
 * @property int    $job_id
 * @property string $cron_config
 * @property PjeJob $job
 */
class PjeSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pje_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'cron_config'], 'required'],
            [['job_id'], 'integer'],
            [['cron_config'], 'string', 'max' => 255],
            [['cron_config'], 'cronValidator'],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => PjeJob::className(), 'targetAttribute' => ['job_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_id' => 'Job ID',
            'cron_config' => 'Cron Config',
        ];
    }

    /**
     * Gets query for [[Job]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(PjeJob::className(), ['id' => 'job_id']);
    }

    public function cronValidator($attribute_name, $params)
    {
        if (!CronExpression::isValidExpression($this->cron_config)) {
            $this->addError($attribute_name, 'This is not valid cron expression');

            return false;
        }

        return true;
    }
}
