<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pdf_files}}`.
 */
class m201207_102857_create_pdf_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pdf_files}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'path' => $this->string(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pdf_files}}');
    }
}
