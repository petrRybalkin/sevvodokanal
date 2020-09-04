<?php

use yii\db\Migration;

/**
 * Class m200831_062417_add_column_role_id
 */
class m200831_062417_add_column_role_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'role_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'role_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200831_062417_add_column_role_id cannot be reverted.\n";

        return false;
    }
    */
}
