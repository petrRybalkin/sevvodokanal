<?php

use yii\db\Migration;

/**
 * Class m201214_120444_alter_column_to_indic_table
 */
class m201214_120444_alter_column_to_indic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('indications_and_charges', 'water_consumption', $this->float());
        $this->alterColumn('indications_and_charges', 'watering_consumption', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201214_120444_alter_column_to_indic_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201214_120444_alter_column_to_indic_table cannot be reverted.\n";

        return false;
    }
    */
}
