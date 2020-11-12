<?php

use yii\db\Migration;

/**
 * Class m201112_132203_add_fix_i_c_table_tarif
 */
class m201112_132203_add_fix_i_c_table_tarif extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('indications_and_charges', 'total_tariff', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201112_132203_add_fix_i_c_table_tarif cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201112_132203_add_fix_i_c_table_tarif cannot be reverted.\n";

        return false;
    }
    */
}
