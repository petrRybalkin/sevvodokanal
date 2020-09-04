<?php

use yii\db\Migration;

/**
 * Class m200816_225005_update_table_page
 */
class m200816_225005_update_table_page extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('page', 'parent_page', $this->integer());
        $this->addColumn('page', 'active', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('page', 'parent_page');
        $this->dropColumn('page', 'active');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200816_225005_update_table_page cannot be reverted.\n";

        return false;
    }
    */
}
