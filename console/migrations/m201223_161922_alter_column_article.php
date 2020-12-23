<?php

use yii\db\Migration;

/**
 * Class m201223_161922_alter_column_article
 */
class m201223_161922_alter_column_article extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('article', 'create_utime', $this->dateTime());
        $this->alterColumn('article', 'update_utime', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201223_161922_alter_column_article cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201223_161922_alter_column_article cannot be reverted.\n";

        return false;
    }
    */
}
