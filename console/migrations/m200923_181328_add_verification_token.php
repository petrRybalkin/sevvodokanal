<?php

namespace yii\queue\db\migrations;

use yii\db\Migration;

/**
 * Class m200923_181328_add_verification_token
 */
class m200923_181328_add_verification_token extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%client}}', 'verification_token', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%client}}', 'verification_token');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M200923181328AddVerificationToken cannot be reverted.\n";

        return false;
    }
    */
}
