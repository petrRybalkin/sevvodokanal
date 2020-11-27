<?php

use yii\db\Migration;

/**
 * Class m201126_152115_alter_indication_table
 */
class m201126_152115_alter_indication_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('indications_and_charges', 'water_consumption', $this->integer());
        $this->alterColumn('indications_and_charges', 'watering_consumption', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201126_152115_alter_indication_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201126_152115_alter_indication_table cannot be reverted.\n";

        return false;
    }
    */
}
