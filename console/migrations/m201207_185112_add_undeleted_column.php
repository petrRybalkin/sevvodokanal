<?php

use yii\db\Migration;

/**
 * Class m201207_185112_add_undeleted_column
 */
class m201207_185112_add_undeleted_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('page', 'deletable', $this->boolean()->defaultValue(true));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('page', 'deletable');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201207_185112_add_undeleted_column cannot be reverted.\n";

        return false;
    }
    */
}
