<?php

use yii\db\Migration;

/**
 * Class m201220_194654_add_column_to_company
 */
class m201220_194654_add_column_to_company extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('company', 'sinh', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('company', 'sinh');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201220_194654_add_column_to_company cannot be reverted.\n";

        return false;
    }
    */
}
