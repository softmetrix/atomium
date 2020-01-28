<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m200128_085719_rollback_job.
 */
class m200128_085719_rollback_job extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pje_job', 'rollback_job_id', Schema::TYPE_INTEGER);
        $this->addForeignKey('pje_job_fk1', 'pje_job', 'rollback_job_id', 'pje_job', 'id', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200128_085719_rollback_job cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200128_085719_rollback_job cannot be reverted.\n";

        return false;
    }
    */
}
