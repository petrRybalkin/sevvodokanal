<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%legal_entities}}`.
 */
class m201218_104314_create_legal_entities_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%legal_entities_info}}', [
            'id' => $this->primaryKey(),
            'contract_number' => $this->string(5),
            'number' => $this->string(10),
            'verification_date' => $this->date(),
            'previous_readings' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%legal_entities_info}}');
    }
}
