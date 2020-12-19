<?php


namespace common\models;


use yii\base\Model;

class LegalNumContractForm extends Model
{
    public $num_contract;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num_contract'], 'required'],
            [['num_contract'], 'exist', 'targetClass' => Company::class,
                'targetAttribute' => 'num_contract',
                'message' => 'Немає такого номеру договору 
                - швидше за все, Ви вводите некоректно номер договору.'],
        ];

    }
}