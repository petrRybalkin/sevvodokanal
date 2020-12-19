<?php


namespace common\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

class LegalForm extends Model
{
    public $num_contract;
    public $acc_num_0;
    public $acc_num_1;
    public $acc_num_2;
    public $acc_num_3;
    public $acc_num_4;
    public $acc_num_5;
    public $acc_num_6;
    public $acc_num_7;
    public $acc_num_8;
    public $acc_num_9;
    public $previous_readings_0;
    public $previous_readings_1;
    public $previous_readings_2;
    public $previous_readings_3;
    public $previous_readings_4;
    public $previous_readings_5;
    public $previous_readings_6;
    public $previous_readings_7;
    public $previous_readings_8;
    public $previous_readings_9;
    public $verifyCode;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num_contract'], 'required'],
            ['verifyCode', 'captcha'],
            [['num_contract'], 'exist', 'targetClass' => Company::class,
                'targetAttribute' => 'num_contract',
                'message' => 'Немає такого номеру договору 
                - швидше за все, Ви вводите некоректно номер договору.'],
            [['acc_num_0',], 'integer'],
            [['acc_num_1',], 'integer'],
            [['acc_num_2',], 'integer'],
            [['acc_num_3',], 'integer'],
            [['acc_num_4',], 'integer'],
            [['acc_num_5',], 'integer'],
            [['acc_num_6',], 'integer'],
            [['acc_num_7',], 'integer'],
            [['acc_num_8',], 'integer'],
            [['acc_num_9',], 'integer'],
            [['previous_readings_0'], 'validationMeter', 'params' => ['acc' => 'acc_num_0','field' => 'previous_readings_0']],
            [['previous_readings_1'], 'validationMeter', 'params' => ['acc' => 'acc_num_1','field' => 'previous_readings_1']],
            [['previous_readings_2'], 'validationMeter', 'params' => ['acc' => 'acc_num_2','field' => 'previous_readings_2']],
            [['previous_readings_3'], 'validationMeter', 'params' => ['acc' => 'acc_num_3','field' => 'previous_readings_3']],
            [['previous_readings_4'], 'validationMeter', 'params' => ['acc' => 'acc_num_4','field' => 'previous_readings_4']],
            [['previous_readings_5'], 'validationMeter', 'params' => ['acc' => 'acc_num_5','field' => 'previous_readings_5']],
            [['previous_readings_6'], 'validationMeter', 'params' => ['acc' => 'acc_num_6','field' => 'previous_readings_6']],
            [['previous_readings_7'], 'validationMeter', 'params' => ['acc' => 'acc_num_7','field' => 'previous_readings_7']],
            [['previous_readings_8'], 'validationMeter', 'params' => ['acc' => 'acc_num_8','field' => 'previous_readings_8']],
            [['previous_readings_9'], 'validationMeter', 'params' => ['acc' => 'acc_num_9','field' => 'previous_readings_9']],
            [['previous_readings_0', 'previous_readings_1', 'previous_readings_2', 'previous_readings_3',
                'previous_readings_4', 'previous_readings_5', 'previous_readings_6', 'previous_readings_7',
                'previous_readings_8', 'previous_readings_9'], 'number'],

            [['previous_readings_0'], 'required', 'when' => function ($model) {
                return $model->acc_num_0 !== null;
            }, 'whenClient' => "function (attribute, value) {
        return $('#legalform-acc_num_0') !== undefined;
    }", 'message' => 'Поточні показання не можуть залишатися пустими.'],

            [['previous_readings_1'], 'required', 'when' => function ($model) {
                return $model->acc_num_1 !== null;
            }, 'whenClient' => "function (attribute, value) {
        return $('#legalform-acc_num_1') !== undefined;
    }", 'message' => 'Поточні показання не можуть залишатися пустими.'],


            [['previous_readings_2'], 'required', 'when' => function ($model) {
                return $model->acc_num_2 !== null;
            }, 'whenClient' => "function (attribute, value) {
        return $('#legalform-acc_num_2') !== undefined;
    }", 'message' => 'Поточні показання не можуть залишатися пустими.'],


            [['previous_readings_3'], 'required', 'when' => function ($model) {
                return $model->acc_num_3 !== null;
            }, 'whenClient' => "function (attribute, value) {
        return $('#legalform-acc_num_3') !== undefined;
    }", 'message' => 'Поточні показання не можуть залишатися пустими.'],


            [['previous_readings_4'], 'required', 'when' => function ($model) {
                return $model->acc_num_4 !== null;
            }, 'whenClient' => "function (attribute, value) {
        return $('#legalform-acc_num_4') !== undefined;
    }", 'message' => 'Поточні показання не можуть залишатися пустими.'],


            [['previous_readings_5'], 'required', 'when' => function ($model) {
                return $model->acc_num_5 !== null;
            }, 'whenClient' => "function (attribute, value) {
        return $('#legalform-acc_num_5') !== undefined;
    }", 'message' => 'Поточні показання не можуть залишатися пустими.'],


            [['previous_readings_6'], 'required', 'when' => function ($model) {
                return $model->acc_num_6 !== null;
            }, 'whenClient' => "function (attribute, value) {
        return $('#legalform-acc_num_6') !== undefined;
    }", 'message' => 'Поточні показання не можуть залишатися пустими.'],


            [['previous_readings_7'], 'required', 'when' => function ($model) {
                return $model->acc_num_7 !== null;
            }, 'whenClient' => "function (attribute, value) {
        return $('#legalform-acc_num_7') !== undefined;
    }", 'message' => 'Поточні показання не можуть залишатися пустими.'],


            [['previous_readings_8'], 'required', 'when' => function ($model) {
                return $model->acc_num_8 !== null;
            }, 'whenClient' => "function (attribute, value) {
        return $('#legalform-acc_num_8') !== undefined;
    }", 'message' => 'Поточні показання не можуть залишатися пустими.'],


            [['previous_readings_9'], 'required', 'when' => function ($model) {
                return $model->acc_num_9 !== null;
            }, 'whenClient' => "function (attribute, value) {
        return $('#legalform-acc_num_9') !== undefined;
    }", 'message' => 'Поточні показання не можуть залишатися пустими.'],

        ];


    }


    public function validationMeter($attribute, $params)
    {
        $acc = ArrayHelper::getValue($params, 'acc');
        $field = ArrayHelper::getValue($params, 'field');
        if (!$company = Company::find()
            ->where([
                'num_contract' => $this->num_contract,
                'accounting_number' => $this->$acc
            ])->one()) {
            $this->addError($acc, 'Заповнiть номер засобу обліку води .');
        } else {
            if ((int)$this->$attribute < $company->previous_readings) {
                $this->addError($field, "Поточні показання не можуть залишатися пустими або бути менше попередніх. 
                Попередні показання = $company->previous_readings");
            }

        }


    }
}