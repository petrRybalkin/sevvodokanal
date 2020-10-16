<?php

use yii\db\Migration;

/**
 * Class m201014_105412_create_log_tables
 */
class m201014_105412_create_log_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%admin_log}}', [
            'id' => $this->primaryKey(),
            'admin_id' => $this->integer(),
            'action' => $this->integer(),
            'message' => $this->text(),
            'created_at' => $this->dateTime()

        ]);
        $this->createTable('{{%files_log}}', [
            'id' => $this->primaryKey(),
            'admin_id' => $this->integer(),
            'file' => $this->integer(),
            'action' => $this->integer(),
            'message' => $this->text(),
            'created_at' => $this->dateTime()
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('{{%admin_log}}');
       $this->dropTable('{{%files_log}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201014_105412_create_log_tables cannot be reverted.\n";

        return false;
    }
    */
}
