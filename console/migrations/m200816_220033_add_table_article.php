<?php

use yii\db\Migration;

/**
 * Class m200816_220033_add_table_article
 */
class m200816_220033_add_table_article extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'short_description' => $this->text(),
            'description' => $this->text(),
            'img' => $this->string(),
            'seoTitle' => $this->string(),
            'seoDescription' => $this->string(),
            'active' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200816_220033_add_table_article cannot be reverted.\n";

        return false;
    }
    */
}
