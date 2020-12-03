<?php

use yii\db\Migration;

/**
 * Class m201203_083515_add_index_ind_table
 */
class m201203_083515_add_index_ind_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'idx-account_number',
            'indications_and_charges',
            ['account_number','month_year']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-account_number',
            'indications_and_charges'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201203_083515_add_index_ind_table cannot be reverted.\n";

        return false;
    }
    */
}
