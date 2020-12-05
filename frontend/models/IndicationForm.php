<?php

namespace frontend\models;

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
            [['number1'], 'exist', 'targetClass' => WaterMetering::class,
                'targetAttribute' => 'water_metering_first',
                'message' => 'Немає такого номеру засобу обліку води №1 
                - швидше за все, Ви вводите некоректно номер засобу обліку води №1 .'],
            [['number2'], 'exist', 'targetClass' => WaterMetering::class,
                'targetAttribute' => ['number2' => 'water_metering_second'],
                'message' => 'Немає такого номеру засобу обліку води №2
                - швидше за все, Ви вводите некоректно номер засобу обліку води №2 .'],
            [['number3'], 'exist', 'targetClass' => WaterMetering::class,
                'targetAttribute' => ['number3' => 'watering_number'],
                'message' => 'Немає такого номеру засобу обліку води №3
                - швидше за все, Ви вводите некоректно номер засобу обліку води №3 .'],
            [['number1', 'number2', 'number3', 'meter1', 'meter2', 'meter3'], 'integer'],
            [['meter1'], 'validationMeterFirst'],
            [['meter2'], 'validationMeterSecond'],
            [['meter3'], 'validationMeterWatering'],
            [['acc'], 'safe']
        ];
    }


    public function validationMeterFirst($attribute, $params)
    {
        if (!$acc = WaterMetering::find()->where(['water_metering_first' => $this->number1])->one()) {
            $this->addError('meter1', 'Заповнiть номер засобу обліку води №1.');
        } else {

            if ($acc->number_medium_cubes > 0 &&
                (int)$this->$attribute < ($acc->number_medium_cubes - 10)
            ) {
                $this->addError('meter1', 'Переданi показання меньше середнiх кубiв.');
            }

            if ((int)$this->$attribute < $acc->previous_readings_first
            ) {
                $this->addError('meter1', 'Переданi показання меньше попереднiх.');
            }

            if (
                (int)$this->$attribute >= ($acc->previous_readings_first + 200)
            ) {
                $this->addError('meter1', 'Переданi показання бiльше попереднiх.');
            }
        }

    }

    public function validationMeterSecond($attribute, $params)
    {
        if (!$acc = WaterMetering::find()->where(['water_metering_second' => $this->number2])->one()) {
            $this->addError('meter2', 'Заповнiть номер засобу обліку води №2.');
        }else{

            if ((int)$this->$attribute < $acc->previous_readings_second
            ) {
                $this->addError('meter2', 'Переданi показання меньше попереднiх.');
            }

            if (
                (int)$this->$attribute >= ($acc->previous_readings_second + 200)
            ) {
                $this->addError('meter2', 'Переданi показання бiльше попереднiх.');
            }



        }
    }

    public function validationMeterWatering($attribute, $params)
    {
        if (!$acc = WaterMetering::find()->where(['watering_number' => $this->number3])->one()) {
            $this->addError('meter3', 'Заповнiть номер засобу обліку води №3.');
        }else{

            if ((int)$this->$attribute < $acc->previous_watering_readings
            ) {
                $this->addError('meter3', 'Переданi показання меньше попереднiх.');
            }

            if (
                (int)$this->$attribute >= ($acc->previous_watering_readings + 200)
            ) {
                $this->addError('meter3', 'Переданi показання бiльше попереднiх.');
            }

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
