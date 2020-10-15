<?php

use yii\db\Migration;

/**
 * Class m201015_174500_add_sort_sidebar_column
 */
class m201015_174500_add_sort_sidebar_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%page}}', 'sort_sidebar', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%page}}', 'sort_sidebar');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201015_174500_add_sort_sidebar_column cannot be reverted.\n";

        return false;
    }
    */
}
