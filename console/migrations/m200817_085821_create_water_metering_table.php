<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%water_metering}}`.
 */
class m200817_085821_create_water_metering_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%water_metering}}', [
            'id' => $this->primaryKey(),
            'account_number' => $this->char(13),
            'act_number' => $this->integer(5),
            'water_metering_first' => $this->char(10),
            'water_metering_second' => $this->char(10),
            'watering_number' => $this->char(10),
            'previous_readings_first' => $this->integer(6),
            'previous_readings_second' => $this->integer(6),
            'previous_watering_readings' => $this->integer(6),
            'date_previous_readings' => $this->date(),
            'type_first' => $this->char(10),
            'type_second' => $this->char(10),
            'type_watering' => $this->char(10),
            'verification_date' => $this->date(),
            'medium_cubes' => $this->char(),
            'number_medium_cubes' => $this->integer(8)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%water_metering}}');
    }
}
