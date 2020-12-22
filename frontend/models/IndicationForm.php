<?php

namespace frontend\models;

use common\models\IndicationsAndCharges;
use common\models\WaterMetering;
use DateTime;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

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
            [['acc'], 'safe'],
            [['meter1'], 'required', 'when' => function ($model) {
                return $model->number1 !== null;
            }, 'whenClient' => "function (attribute, value) {
        return $('#indicationform-number1') !== undefined;
    }", 'message' => 'Заповнiть показання усiх засобiв облiку води'],
            [['meter2'], 'required', 'when' => function ($model) {
                return $model->number2 !== null;
            }, 'whenClient' => "function (attribute, value) {
        return $('#indicationform-number2') !== undefined;
    }", 'message' => 'Заповнiть показання усiх засобiв облiку води'],
            [['meter3'], 'required', 'when' => function ($model) {
                return $model->number3 !== null;
            }, 'whenClient' => "function (attribute, value) {
        return $('#indicationform-number3') !== undefined;
    }", 'message' => 'Заповнiть показання усiх засобiв облiку води']

        ];
    }


    public function validationMeterFirst($attribute, $params)
    {
        if (!$acc = WaterMetering::find()->where(['water_metering_first' => $this->number1])->one()) {
            $this->addError('meter1', 'Заповнiть номер засобу обліку води №1.');
        } else {
            $dThis = new DateTime('first day of this month');
            $indicationThisMonth = IndicationsAndCharges::find()
                ->where(['account_number' => $acc->account_number])
                ->andWhere(['month_year' => $dThis->format('Ym')])
                ->orderBy(['id' => SORT_DESC])
                ->one();


            /** @var IndicationsAndCharges $indicationThisMonth */
            if ($indicationThisMonth && $indicationThisMonth->current_readings_first > 0) {

                if ((int)$this->$attribute < $indicationThisMonth->current_readings_first) {
                    if ($acc->number_medium_cubes > 0) {
                        if ((int)$this->$attribute < ($indicationThisMonth->current_readings_first - $acc->number_medium_cubes)) {
                            $this->addError('meter1', 'Переданi показання меньше нарахованих середнiх кубiв.');
                        }
                    } else {
                        $this->addError('meter1', 'Переданi показання меньше переданих ранiше.');
                    }
                }
                if ((int)$this->$attribute >= ($indicationThisMonth->current_readings_first + 200)
                ) {
                    $r = ($indicationThisMonth->current_readings_first + 200) - (int)$this->$attribute;
                    $this->addError('meter1', "Переданi показання бiльше попереднiх на $r кубiв.");
                }
            } else {
                //выбрать из нач тек мес строку, и дописать условие и (int)$this->$attribute < нач показ -> тек показ
                if ((int)$this->$attribute < $acc->previous_readings_first) {
                    if ($acc->number_medium_cubes > 0) {
                        if ((int)$this->$attribute < ($acc->previous_readings_first - $acc->number_medium_cubes)) {
                            $this->addError('meter1', 'Переданi показання меньше нарахованих середнiх кубiв.');
                        }
                    } else {
                        $this->addError('meter1', 'Переданi показання меньше переданих ранiше.');
                    }
                    if ((int)$this->$attribute >= ($acc->previous_readings_first + 200)
                    ) {
                        $r = ($acc->previous_readings_first + 200) - (int)$this->$attribute;
                        $this->addError('meter1', "Переданi показання бiльше попереднiх на $r кубiв.");
                    }
                }

            }


        }

    }

    public function validationMeterSecond($attribute, $params)
    {
        if (!$acc = WaterMetering::find()->where(['water_metering_second' => $this->number2])->one()) {
            $this->addError('meter2', 'Заповнiть номер засобу обліку води №2.');
        } else {
            $dThis = new DateTime('first day of this month');
            $indicationThisMonth = IndicationsAndCharges::find()
                ->where(['account_number' => $acc->account_number])
                ->andWhere(['month_year' => $dThis->format('Ym')])
                ->orderBy(['id' => SORT_DESC])
                ->one();

            /** @var IndicationsAndCharges $indicationThisMonth */
            if ($indicationThisMonth && $indicationThisMonth->current_readings_second > 0) {
                if ((int)$this->$attribute < $indicationThisMonth->current_readings_second
                ) {
                    $this->addError('meter2', 'Переданi показання меньше попереднiх.');
                }


                if ((int)$this->$attribute >= ($indicationThisMonth->current_readings_second + 200)
                ) {
                    $r = ($indicationThisMonth->current_readings_second + 200) - (int)$this->$attribute;
                    $this->addError('meter2', "Переданi показання бiльше попереднiх на $r кубiв.");
                }
            } else {
                if ((int)$this->$attribute < $acc->previous_readings_second
                ) {
                    $this->addError('meter2', 'Переданi показання меньше попереднiх.');
                }


                if ((int)$this->$attribute >= ($acc->previous_readings_second + 200)
                ) {
                    $r = ($acc->previous_readings_second + 200) - (int)$this->$attribute;
                    $this->addError('meter2', "Переданi показання бiльше попереднiх на $r кубiв.");
                }
            }


        }
    }

    public function validationMeterWatering($attribute, $params)
    {
        if (!$acc = WaterMetering::find()->where(['watering_number' => $this->number3])->one()) {
            $this->addError('meter3', 'Заповнiть номер засобу обліку води №3.');
        } else {
            $dThis = new DateTime('first day of this month');
            $indicationThisMonth = IndicationsAndCharges::find()
                ->where(['account_number' => $acc->account_number])
                ->andWhere(['month_year' => $dThis->format('Ym')])
                ->orderBy(['id' => SORT_DESC])
                ->one();

            /** @var IndicationsAndCharges $indicationThisMonth */
            if ($indicationThisMonth && $indicationThisMonth->current_readings_watering > 0) {
                if ((int)$this->$attribute < $indicationThisMonth->current_readings_watering
                ) {
                    $this->addError('meter3', 'Переданi показання меньше попереднiх.');
                }

                if ((int)$this->$attribute >= ($indicationThisMonth->current_readings_watering + 200)
                ) {
                    $r = ($indicationThisMonth->current_readings_watering + 200) - (int)$this->$attribute;
                    $this->addError('meter3', "Переданi показання бiльше попереднiх на $r кубiв.");
                }

            }else{
                if ((int)$this->$attribute < $acc->previous_watering_readings
                ) {
                    $this->addError('meter3', 'Переданi показання меньше попереднiх.');
                }

                if ((int)$this->$attribute >= ($acc->previous_watering_readings + 200)
                ) {
                    $r = ($acc->previous_watering_readings + 200) - (int)$this->$attribute;
                    $this->addError('meter3', "Переданi показання бiльше попереднiх на $r кубiв.");
                }
            }


        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'number1' => 'Номер засобу обліку води №1',
            'number2' => 'Номер засобу обліку води №2 ',
            'number3' => 'Номер засобу обліку води №3  ',
            'meter1' => 'Показники лiчильника №1  ',
            'meter2' => 'Показники лiчильника №2  ',
            'meter3' => 'Показники лiчильника №3 ',
        ];
    }
}
