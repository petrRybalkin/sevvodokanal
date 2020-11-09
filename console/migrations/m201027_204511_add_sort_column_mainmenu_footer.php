<?php

use yii\db\Migration;

/**
 * Class m201027_204511_add_sort_column_mainmenu_footer
 */
class m201027_204511_add_sort_column_mainmenu_footer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%page}}', 'sort_main_menu', $this->integer()->defaultValue(0));
        $this->addColumn('{{%page}}', 'sort_footer', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%page}}', 'sort_main_menu');
        $this->dropColumn('{{%page}}', 'sort_footer');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201027_204511_add_sort_column_mainmenu_footer cannot be reverted.\n";

        return false;
    }
    */
}
