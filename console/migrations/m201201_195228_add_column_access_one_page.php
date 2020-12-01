<?php

use yii\db\Migration;

/**
 * Class m201201_195228_add_column_access_one_page
 */
class m201201_195228_add_column_access_one_page extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('roles', 'access_one_page', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('roles', 'access_one_page');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201201_195228_add_column_access_one_page cannot be reverted.\n";

        return false;
    }
    */
}
