<?php

use yii\db\Migration;

/**
 * Class m210216_082455_add_phone_abon
 */
class m210216_082455_add_phone_abon extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('config_site', 'phone_abon', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('config_site', 'phone_abon');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210216_082455_add_phone_abon cannot be reverted.\n";

        return false;
    }
    */
}
