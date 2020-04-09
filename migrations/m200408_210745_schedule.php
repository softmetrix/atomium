<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m200408_210745_schedule.
 */
class m200408_210745_schedule extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pje_schedule', [
            'id' => Schema::TYPE_PK,
            'job_id' => Schema::TYPE_INTEGER.' NOT NULL',
            'cron_config' => Schema::TYPE_STRING.' NOT NULL',
        ]);
        $this->createIndex(
            'schedule-job-idx',
            'pje_schedule',
            'job_id'
        );
        $this->addForeignKey(
            'schedule-job-fk',
            'pje_schedule',
            'job_id',
            'pje_job',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200408_210745_schedule cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200408_210745_schedule cannot be reverted.\n";

        return false;
    }
    */
}
