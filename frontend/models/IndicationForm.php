<?php

namespace frontend\models;

use common\models\IndicationsAndCharges;
use common\models\WaterMetering;
use Yii;
use yii\base\Model;

/**
 * IndicationForm is the model behind the contact form.
 */
class IndicationForm extends Model
{
    public $number1;
    public $number2;
    public $number3;
    public $meter1;
    public $meter2;
    public $meter3;
    public $acc;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number1', 'number2', 'number3', 'meter1', 'meter2', 'meter3'], 'integer'],
            [['meter1'], 'validationMeterFirst'],
            [['meter2'], 'validationMeterSecond'],
            [['meter3'], 'validationMeterWatering'],
            [['acc'], 'safe']
        ];
    }


    public function validationMeterFirst($attribute, $params)
    {
        $acc = WaterMetering::find()->where(['water_metering_first' => $this->number1])->one();
        if ($acc->previous_readings_first > (int)$this->$attribute) {
            $this->addError('meter1', 'Попереднi показання бiльше нiж теперiшнi.');
        }
    }

    public function validationMeterSecond($attribute, $params)
    {
        $acc = WaterMetering::find()->where(['water_metering_second' => $this->number1])->one();
        if ($acc->previous_readings_first > (int)$this->$attribute) {
            $this->addError('meter2', 'Попереднi показання бiльше нiж теперiшнi.');
        }
    }

    public function validationMeterWatering($attribute, $params)
    {
        $acc = WaterMetering::find()->where(['watering_number' => $this->number1])->one();
        if ($acc->previous_readings_first > (int)$this->$attribute) {
            $this->addError('meter3', 'Попереднi показання бiльше нiж теперiшнi.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'number1' => 'Номер засобу обліку води №1 (якщо є)',
            'number2' => 'Номер засобу обліку води №2 (якщо є)',
            'number3' => 'Номер засобу обліку води №3 (якщо є) ',
            'meter1' => 'Попередні показання засоба обліку води №1 (якщо є) ',
            'meter2' => 'Попередні показання засоба обліку води №2 (якщо є) ',
            'meter3' => 'Попередні показання засоба обліку води №3 (якщо є)',
        ];
    }
}
