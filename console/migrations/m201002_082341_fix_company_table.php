<?php

use yii\db\Migration;

/**
 * Class m201002_082341_fix_company_table
 */
class m201002_082341_fix_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->alterColumn('company', 'num_contract', $this->string());
      $this->alterColumn('company', 'accounting_number', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201002_082341_fix_company_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201002_082341_fix_company_table cannot be reverted.\n";

        return false;
    }
    */
}
