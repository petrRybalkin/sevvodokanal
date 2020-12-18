<?php

use yii\db\Migration;

/**
 * Class m201218_124408_billing
 */
class m201218_124408_billing extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%billing}}', [
            'id' => $this->primaryKey(),
            'billIdentifier' => $this->char(13),
            'payNumber' => $this->string(),
            'payId' => $this->string(),
            'totalSum' => $this->string(),
            'status' => $this->smallInteger(),
            'created_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%billing}}');
    }
}
