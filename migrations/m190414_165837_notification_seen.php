<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190414_165837_notification_seen
 */
class m190414_165837_notification_seen extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pje_notification', 'seen', Schema::TYPE_BOOLEAN . ' default 0');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190414_165837_notification_seen cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190414_165837_notification_seen cannot be reverted.\n";

        return false;
    }
    */
}
