<?php

use yii\db\Migration;

/**
 * Class m201230_103212_add_to_table_config
 */
class m201230_103212_add_to_table_config extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

 Yii::$app->db->createCommand()->batchInsert('config_site', ['name', 'title', 'value', 'action', 'name_header','name_footer',
     'address','phone_priem','phone_disp'], [
     ['СЄВЄРОДОНЕЦЬКВОДОКАНАЛ','КОМУНАЛЬНЕ ПІДПРИЄМСТВО "СЄВЄРОДОНЕЦЬКВОДОКАНАЛ"','Чиста вода в кожен дiм!',1,'СЄВЄРОДОНЕЦЬКВОДОКАНАЛ',
         'СЄВЄРОДОНЕЦЬКВОДОКАНАЛ','м. Сєвєродонецьк, вул. Богдана Лiщини, 13','Приймальня: 4-01-33','Диспетчерська: 4-32-91'
         ],
 ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201230_103212_add_to_table_config cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201230_103212_add_to_table_config cannot be reverted.\n";

        return false;
    }
    */
}
