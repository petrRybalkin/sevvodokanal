<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%config_site}}`.
 */
class m210112_195223_add_column_to_config_site_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('config_site', 'action_legal', $this->integer());
        $this->addColumn('config_site', 'schedule', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('config_site', 'action_legal');
        $this->dropColumn('config_site', 'schedule');
    }
}
