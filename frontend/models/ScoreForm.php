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
//            [['act_number'], 'required', 'message' => 'Заповнiть Номер акту або Суму'],
            [['account_number'], 'string', 'max' => 13],

            [['act_number','sum'], 'my_required', 'skipOnEmpty' => false, 'skipOnError' => false, 'message' => 'Треба заповнити хоча б одне з полів "Номер акту" або "Сума"'],
            [['sum'], 'string', 'max' => 255],
//            [[ 'sum'], 'my_required'],
            [['account_number'], 'exist', 'targetClass' => ScoreMetering::class,
                'targetAttribute' => ['account_number' => 'account_number'], 'message' => 'Немає такого особового рахунку 
                - швидше за все, Ви вводите некоректно номер особового рахунку.'],

            [['act_number'], 'exist', 'targetClass' => ScoreMetering::class,
                'targetAttribute' => ['act_number' => 'act_number'],
                'message' => '"Немає такого номера акта» - швидше за все, Ви вводите некоректно номер акта.']
//            [['act_number'], 'required', 'when' => function ($model) {
//                return $model->sum == '';
//            }, 'whenClient' => "function (attribute, value) {
//        return $('#scoremetering-sum').val() == '';
//    }"],
//            [['sum'], 'required', 'when' => function ($model) {
//                return $model->act_number == '';
//            }, 'whenClient' => "function (attribute, value) {
//        return $('#scoremetering-act_number').val() == '';
//    }"],



//
//            [['act_number', 'sum'], 'required', 'when' => function ($model) {
//                $validate = empty($model->act_number) && empty($model->sum);
//                if ($validate) { return false; }
//                return true;
//            }, 'whenClient' => "function (attribute, value) {
//                return $('#scoremetering-act_number').val() == '' && $('#scoremetering-sum').val() == '';
//    }", 'message' => ' Треба заповнити хоча б одне з полів "Номер акту" або "Сума"'],
        ];
    }


    public function my_required($attribute_name, $params)
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
            'sum'     => 'Сума',
            'account_number'  => 'Особовий рахунок',
            'act_number'     => 'Номер акту',
        ];
    }
}
