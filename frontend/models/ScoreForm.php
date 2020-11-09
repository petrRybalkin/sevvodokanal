<?php

namespace frontend\models;

use common\models\ScoreMetering;
use Yii;
use yii\base\Model;

/**
 * ScoreForm is the model behind the contact form.
 */
class ScoreForm extends Model
{
    public $act_number;
    public $sum;
    public $account_number;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_number'], 'required', 'message' => 'Заповнiть номер рахунку'],
            [['account_number'], 'string', 'max' => 13],
            [['account_number'], 'exist', 'targetClass' => ScoreMetering::class,
                'targetAttribute' => ['account_number' => 'account_number'], 'message' => 'Немає такого особового рахунку 
                - швидше за все, Ви вводите некоректно номер особового рахунку.'],

            [['act_number'], 'exist', 'targetClass' => ScoreMetering::class,
                'targetAttribute' => ['act_number' => 'act_number'],
                'message' => '"Немає такого номера акта» - швидше за все, Ви вводите некоректно номер акта.'],
            [['act_number', 'sum'], 'validateActSum', 'skipOnEmpty' => false, 'skipOnError' => false,
                'message' => 'Треба заповнити хоча б одне з полів "Номер акту" або "Сума"'],

            [['sum'], 'string', 'max' => 255],

        ];
    }


    public function validateActSum($attribute_name, $params)
    {
        if (empty($this->act_number)
            && empty($this->sum)
        ) {
            $this->addError($attribute_name, Yii::t('app', 'Треба заповнити хоча б одне з полів "Номер акту" або "Сума"'));

            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sum' => 'Сума',
            'account_number' => 'Особовий рахунок',
            'act_number' => 'Номер акту',
        ];
    }
}
