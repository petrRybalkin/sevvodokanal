<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%indications_and_charges}}`.
 */
class m200925_124705_create_indications_and_charges_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%indications_and_charges}}', [
            'id' => $this->primaryKey(),
            'account_number' => $this->char(13),
            'month_year' => $this->integer(6),
            'privilege' => $this->char(2),
            'count' => $this->integer(2),
            'debt_begin_month' => $this->integer(10),
            'previous_readings_first' => $this->integer(6),
            'current_readings_first' => $this->integer(6),
            'previous_readings_second' => $this->integer(6),
            'current_readings_second' => $this->integer(6),
            'previous_readings_watering' => $this->integer(6),
            'current_readings_watering' => $this->integer(6),
            'water_consumption' => $this->integer(10),
            'watering_consumption' => $this->integer(10),
            'total_tariff' => $this->integer(10),
            'accruals' => $this->integer(10),
            'privilege_unpaid' => $this->integer(10),
            'correction' => $this->integer(10),
            'debt_end_month' => $this->integer(10),
            'medium_cubes' => $this->char(1),
            'synchronization' => $this->integer(1)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%indications_and_charges}}');
    }
}
