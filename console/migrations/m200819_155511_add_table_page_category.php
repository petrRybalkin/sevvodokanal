<?php

use yii\db\Migration;

/**
 * Class m200819_155511_add_table_page_category
 */
class m200819_155511_add_table_page_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ], $tableOptions);

        //$this->addForeignKey('fk_page_category_id', 'category', 'id', 'page', 'parent_page');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //$this->dropForeignKey('fk_page_category_id', 'category');
        $this->dropTable('category');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200819_155511_add_table_page_category cannot be reverted.\n";

        return false;
    }
    */
}
