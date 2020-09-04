<?php

use yii\db\Migration;

/**
 * Class m200727_095942_add_table_page
 */
class m200727_095942_add_table_page extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('page', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'short_description' => $this->text(),
            'description' => $this->text(),
            'img' => $this->string(),
            'seoTitle' => $this->string(),
            'seoDescription' => $this->string(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('page');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200727_095942_add_table_page cannot be reverted.\n";

        return false;
    }
    */
}
