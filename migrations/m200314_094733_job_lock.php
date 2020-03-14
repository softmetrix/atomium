<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m200314_094733_job_lock.
 */
class m200314_094733_job_lock extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pje_job', 'lock', Schema::TYPE_BOOLEAN.' not null default 0');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200314_094733_job_lock cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200314_094733_job_lock cannot be reverted.\n";

        return false;
    }
    */
}
