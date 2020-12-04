<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%water}}`.
 */
class m201203_134950_add_column_to_water_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('water_metering', 'in_site', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('water_metering', 'in_site');
    }
}
