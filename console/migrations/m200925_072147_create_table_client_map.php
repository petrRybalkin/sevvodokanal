<?php

use yii\db\Migration;

/**
 * Class m200925_072147_create_table_client_map
 */
class m200925_072147_create_table_client_map extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%client_map}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer(),
            'score_id' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropTable('{{%client_map}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200925_072147_create_table_client_map cannot be reverted.\n";

        return false;
    }
    */
}
