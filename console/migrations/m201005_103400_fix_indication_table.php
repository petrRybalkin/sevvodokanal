<?php

use yii\db\Migration;

/**
 * Class m201005_103400_fix_indication_table
 */
class m201005_103400_fix_indication_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('indications_and_charges', 'debt_begin_month', $this->float());
        $this->alterColumn('indications_and_charges', 'water_consumption', $this->float());
        $this->alterColumn('indications_and_charges', 'watering_consumption', $this->float());
        $this->alterColumn('indications_and_charges', 'accruals', $this->float());
        $this->alterColumn('indications_and_charges', 'privilege_unpaid', $this->float());
        $this->alterColumn('indications_and_charges', 'debt_end_month', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201005_103400_fix_indication_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201005_103400_fix_indication_table cannot be reverted.\n";

        return false;
    }
    */
}
