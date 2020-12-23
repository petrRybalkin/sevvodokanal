<?php

use yii\db\Migration;

/**
 * Class m201223_035750_add_roles_table_column_settings
 */
class m201223_035750_add_roles_table_column_settings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('roles', 'access_settings', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('roles', 'access_settings');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201223_035750_add_roles_table_column_settings cannot be reverted.\n";

        return false;
    }
    */
}
