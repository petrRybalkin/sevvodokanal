<?php

use yii\db\Migration;

/**
 * Class m200916_163007_add_footer_visible_page
 */
class m200916_163007_add_footer_visible_page extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('page', 'footer', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('page', 'footer');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200916_163007_add_footer_visible_page cannot be reverted.\n";

        return false;
    }
    */
}
