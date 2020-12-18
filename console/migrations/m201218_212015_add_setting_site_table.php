<?php

use yii\db\Migration;

/**
 * Class m201218_212015_add_setting_site_table
 */
class m201218_212015_add_setting_site_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%config_site}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->defaultValue(NULL),
            'title' => $this->text()->defaultValue(NULL),
            'value' => $this->text()->defaultValue(NULL),
            'action' => $this->integer()->defaultValue(1),

        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%config_site}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201218_212015_add_setting_site_table cannot be reverted.\n";

        return false;
    }
    */
}
