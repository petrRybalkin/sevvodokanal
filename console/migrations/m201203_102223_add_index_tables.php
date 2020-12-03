<?php

use yii\db\Migration;

/**
 * Class m201203_102223_add_index_tables
 */
class m201203_102223_add_index_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createIndex(
            'idx-account_number',
            'payment',
            ['account_number','payment_date']
        );

        $this->createIndex(
            'idx-account_number',
            'company',
            'account_number'
        );
        $this->createIndex(
            'idx-account_number',
            'score_metering',
          'account_number'
        );
        $this->createIndex(
            'idx-account_number',
            'water_metering',
          'account_number'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-account_number',
            'payment'
        );
        $this->dropIndex(
            'idx-account_number',
            'company'
        );
        $this->dropIndex(
            'idx-account_number',
            'score_metering'
        );
        $this->dropIndex(
            'idx-account_number',
            'water_metering'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201203_102223_add_index_tables cannot be reverted.\n";

        return false;
    }
    */
}
