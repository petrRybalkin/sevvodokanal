<?php

use yii\db\Migration;

/**
 * Class m200911_143230_add_category_content
 */
class m200911_143230_add_category_content extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('category', [
            'title' => 'Нет',
        ]);
        $this->insert('category', [
            'title' => 'Iнформацiя',
        ]);
        $this->insert('category', [
            'title' => 'Про пiдприемство',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('category', [
            'title' => 'dostavka-i-oplata',
        ]);
        $this->delete('category', [
            'title' => 'Iнформацiя',
        ]);
        $this->delete('category', [
            'title' => 'Про пiдприемство',
        ]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200911_143230_add_category_content cannot be reverted.\n";

        return false;
    }
    */
}
