<?php


namespace common\models;


use yii\base\Model;

class LegalForm extends Model
{
    public $num_contract;
    public $acc_num;
    public $current_readings;
    public $verifyCode;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num_contract'], 'required'],
            [['verifyCode'], 'captcha',  'captchaAction' => 'legal/captcha','message' => 'Невiрний код перевiрки'],
            [['num_contract'], 'exist', 'targetClass' => Company::class,
                'targetAttribute' => 'num_contract',
                'message' => 'Немає такого номеру договору 
                - швидше за все, Ви вводите некоректно номер договору.'],

            [['acc_num',], 'string'],
            [['current_readings'], 'required', 'message' => 'Заповнiть показання засобу облiку води'],

            [['current_readings'], 'validationMeter'],

        ];


    }


    public function validationMeter($attribute, $params)
    {
        if (!$company = Company::find()
            ->where([
                'num_contract' => $this->num_contract,
                'accounting_number' => $this->acc_num
            ])->one()) {
            $this->addError('acc_num', 'Заповнiть номер засобу обліку води .');
        } else {
            if ((int)$this->$attribute < $company->previous_readings) {
                $this->addError('current_readings', "Поточні показання не можуть бути менше попередніх. 
                Попередні показання = $company->previous_readings");
            }

        }


    }
}