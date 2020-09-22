<?php

use yii\db\Migration;

/**
 * Class m200921_114154_create_table_dbf_files
 */
class m200921_114154_create_table_dbf_files extends Migration
{


    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%score_metering}}', [
            'id' => $this->primaryKey(),
            'account_number' => $this->char(13),
            'act_number' => $this->integer(5),
            'name_of_the_tenant' => $this->string(),
            'address' => $this->string(),
            'norm' => $this->string(),
            'type_of_housing' => $this->string(),
            'registered_persons' => $this->integer(6),
            'tariff_for_water' => $this->float(),
            'tariff_for_stocks' => $this->float(),
            'total_tariff' => $this->float(),
        ]);



        $this->createTable('{{%payment}}', [
            'id' => $this->primaryKey(),
            'account_number' => $this->char(13),
            'sum' => $this->float(),
            'payment_date' => $this->date(),
            'pr' => $this->char(10)
        ]);

        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'num_contract' => $this->integer(13),
            'accounting_number' => $this->integer(),
            'verification_date' => $this->date(),
            'previous_readings' => $this->float()
        ]);



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%score_metering}}');
        $this->dropTable('{{%payment}}');
        $this->dropTable('{{%company}}');


    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200921_114154_create_table_dbf_files cannot be reverted.\n";

        return false;
    }
    */
}
