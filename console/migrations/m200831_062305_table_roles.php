<?php

use yii\db\Migration;

/**
 * Class m200831_062305_table_roles
 */
class m200831_062305_table_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('roles', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'access_pages' => $this->integer(),
            'access_news' => $this->integer(),
            'access_users' => $this->integer(),
            'access_abonents' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('roles');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200831_062305_table_roles cannot be reverted.\n";

        return false;
    }
    */
}
