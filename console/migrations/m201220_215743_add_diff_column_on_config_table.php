<?php

use yii\db\Migration;

/**
 * Class m201220_215743_add_diff_column_on_config_table
 */
class m201220_215743_add_diff_column_on_config_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('config_site', 'name_header', $this->string());
        $this->addColumn('config_site', 'name_footer', $this->string());
        $this->addColumn('config_site', 'address', $this->string());
        $this->addColumn('config_site', 'phone_priem', $this->string());
        $this->addColumn('config_site', 'phone_disp', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('config_site', 'name_footer');
        $this->dropColumn('config_site', 'address');
        $this->dropColumn('config_site', 'phone_priem');
        $this->dropColumn('config_site', 'phone_disp');
        $this->dropColumn('config_site', 'name_header');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201220_215743_add_diff_column_on_config_table cannot be reverted.\n";

        return false;
    }
    */
}
