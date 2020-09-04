<?php

use yii\db\Migration;

/**
 * Class m200817_180756_add_table_article_create_update_time_column
 */
class m200817_180756_add_table_article_create_update_time_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('article', 'create_utime', $this->timestamp());
        $this->addColumn('article', 'update_utime', $this->timestamp());
        $this->addColumn('page', 'create_utime', $this->timestamp());
        $this->addColumn('page', 'update_utime', $this->timestamp());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('article', 'create_utime');
        $this->dropColumn('article', 'update_utime');
        $this->dropColumn('page', 'create_utime');
        $this->dropColumn('page', 'update_utime');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200817_180756_add_table_article_create_update_time_column cannot be reverted.\n";

        return false;
    }
    */
}
