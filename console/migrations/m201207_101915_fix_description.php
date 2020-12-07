<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m201207_101915_fix_description
 */
class m201207_101915_fix_description extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('page', 'description', $this->getDb()->getSchema()->createColumnSchemaBuilder('mediumtext'));
        $this->alterColumn('article', 'description', $this->getDb()->getSchema()->createColumnSchemaBuilder('mediumtext'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('page', 'description', $this->text());
        $this->alterColumn('article', 'description', $this->text());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201207_101915_fix_description cannot be reverted.\n";

        return false;
    }
    */
}
