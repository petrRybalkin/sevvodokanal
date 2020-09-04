<?php

use yii\db\Migration;

/**
 * Class m200818_134736_add_table_page_visible_mainmenu_and_sidebar_column
 */
class m200818_134736_add_table_page_visible_mainmenu_and_sidebar_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('page', 'main_menu', $this->integer());
        $this->addColumn('page', 'sidebar', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('page', 'main_menu');
        $this->dropColumn('page', 'sidebar');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200818_134736_add_table_page_visible_mainmenu_and_sidebar_column cannot be reverted.\n";

        return false;
    }
    */
}
