<?php
/** @var \common\models\ScoreMetering $number */

/** @var \common\models\WaterMetering $vodomer */

use frontend\models\IndicationForm;
use yii\bootstrap\ActiveForm;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\validators\Validator;

$this->title = 'Передача показань - Особистий кабінет';
$this->params['breadcrumbs'][] = $this->title;

$vodomers = \common\models\WaterMetering::getWaterMeteringInAccNum($number->account_number);

if ($vodomers): ?>
    <!--    Розділ “Передача показань”:-->

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div>
            <dl>
                <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Номер реєстраційного акту:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $number->act_number ?: '-' ?></dd>
                </div>
                <?php

                if ($vodomers->water_metering_first):
                        $ind = $vodomers->indication[ array_key_last($vodomers->indication) ];
                $d = new Datetime($ind->month_year .'01');
                    ?>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">Номер засобу обліку води №1:</dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomers->water_metering_first ?></dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">Тип засобу(ів) обліку води:</dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomers->type_first ?></dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">- попередні показання засоба обліку
                            води:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1">
                            <?= $ind && $ind->current_readings_first > 0
                                ?  $ind->current_readings_first
                                :  $vodomers->previous_readings_first ?></dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">- строк наступної повірки засоба
                            обліку:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1">
                            <?= Yii::$app->formatter->asDate($vodomers->verification_date, 'php:d.m.Y'); ?></dd>
                    </div>
                <?php endif; ?>
                <?php if ($vodomers->water_metering_second):
                    $ind = $vodomers->indication[ array_key_last($vodomers->indication) ];
                    $d = new Datetime($ind->month_year .'01');
                    ?>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">Номер засобу обліку води №2":</dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomers->water_metering_second ?></dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">Тип засобу(ів) обліку води:</dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomers->type_second ?></dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">- попередні показання засоба обліку
                            води:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1">
                            <?= $ind && $ind->current_readings_second > 0
                                ?  $ind->current_readings_second
                                :  $vodomers->previous_readings_second ?></dd>
                            </dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">- строк наступної повірки засоба
                            обліку:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1">
                            <?= Yii::$app->formatter->asDate( $vodomers->verification_date , 'php:d.m.Y')?></dd>
                    </div>
                <?php endif; ?>
                <?php if ($vodomers->watering_number):
                    $ind = $vodomers->indication[ array_key_last($vodomers->indication) ];
                    $d = new Datetime($ind->month_year .'01');
                    ?>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">Номер засобу обліку води для
                            поливу:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomers->watering_number ?></dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">Тип засобу(ів) обліку води:</dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomers->type_watering ?></dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">- попередні показання засоба обліку
                            води:
                        </dt>
<!--                        если в табл нач показ тек показ 0 то вывожу из водомеров, если не 0 то вывожу из нач показ.-->
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1">
                            <?= $ind  && $ind->previous_readings_watering > 0
                                ? $ind->previous_readings_watering
                                : $vodomers->previous_watering_readings ?></dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">- строк наступної повірки засоба
                            обліку:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1">
                            <?= Yii::$app->formatter->asDate($vodomers->verification_date, 'php:d.m.Y') ?></dd>
                    </div>
                <?php endif; ?>

                <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Дата попередніх показань:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1">
                        <?= $vodomers->date_previous_readings
                            ? Yii::$app->formatter->asDate($vodomers->date_previous_readings, 'php: d.m.Y')
                            : '' ?></dd>
                </div>


                <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Кількість засобів обліку води, які
                        обліковуються на особовому рахунку споживача:
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= ($vodomers->water_metering_first ? 1 : 0) + ($vodomers->water_metering_second ? 1 : 0) + ($vodomers->watering_number ? 1 : 0) ?></dd>
                </div>
            </dl>
        </div>
    </div>
    <br>

    <?php

    if(strtotime(Yii::$app->formatter->asDate($vodomers->date_previous_readings,'php:Ym')) !== strtotime(date('Ym')) || $vodomers->in_site == 0):  ?>
    <div class="min-h-screen flex justify-center bg-gray-50 py-2 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div>
                <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">Передача показань
                    лічильника</h2>
            </div>
            <?php $form = ActiveForm::begin([
                'id' => 'water-metering-form',
                'class' => 'mt-8',
                'enableAjaxValidation' => true,
                'action' => '/profile/meter'
            ]);

            ?>
            <div class="rounded-md shadow-sm">
                <?php
                if (ArrayHelper::getValue($vodomers, 'water_metering_first') !== null):

                $r = [['meter1'], 'required'];
                    ArrayHelper::merge($model->rules(),$r)
                    ?>
                    <div>
                        <?= $form->field($model, 'number1')
                            ->textInput(['value' => $vodomers['water_metering_first'] ? $vodomers['water_metering_first'] : '',
                                'type' => 'number','disabled' => true,
                                'class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border 
                                border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none 
                                focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5','required' =>'required'])
                            ->label('Номер засобу обліку води №1 ', ['class' => 'block text-grey-darker text-sm font-bold mb-2'])
                        ?>
                    </div>

                    <div>
                        <?= $form->field($model, 'meter1')
                            ->textInput(['type' => 'number',
                                'class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border 
                                border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md 
                                 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                            ->label('Показники лiчильника №1', ['class' => 'block text-grey-darker text-sm font-bold mb-2'])
                        ?>
                        <?= $form->field($model, 'number1')
                            ->hiddenInput(['value'=>$vodomers['water_metering_first']
                                ? $vodomers['water_metering_first']
                                : ''])
                        ->label(false)?>
                    </div>
                <?php endif;
                if (ArrayHelper::getValue($vodomers, 'water_metering_second') !== null):
                    ?>

                    <div>
                        <?= $form->field($model, 'number2')
                            ->textInput(['value' => $vodomers['water_metering_second'] ? $vodomers['water_metering_second'] : '','disabled' => true, 'type' => 'number', 'class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                            ->label('Номер засобу обліку води №2', ['class' => 'block text-grey-darker text-sm font-bold mb-2'])
                        ?>
                    </div>

                    <div>
                        <?= $form->field($model, 'meter2')
                            ->textInput(['type' => 'number',
                                'class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                            ->label('Показники лiчильника №2', ['class' => 'block text-grey-darker text-sm font-bold mb-2'])
                        ?>
                        <?= $form->field($model, 'number2')
                            ->hiddenInput(['value'=>$vodomers['water_metering_second']
                                ? $vodomers['water_metering_second']
                                : ''])
                            ->label(false)?>
                    </div>
                <?php endif;
                if (ArrayHelper::getValue($vodomers, 'watering_number') !== null):
                    ?>
                    <div>
                        <?= $form->field($model, 'number3')
                            ->textInput(['value' => $vodomers['watering_number'] ? $vodomers['watering_number'] : '', 'disabled' => true,'type' => 'number', 'class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                            ->label('Номер засобу обліку води №3', ['class' => 'block text-grey-darker text-sm font-bold mb-2'])
                        ?>
                    </div>

                    <div>
                        <?= $form->field($model, 'meter3')
                            ->textInput(['type' => 'number', 'class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                            ->label('Показники лiчильника №3', ['class' => 'block text-grey-darker text-sm font-bold mb-2'])
                        ?>
                        <?= $form->field($model, 'number3')
                            ->hiddenInput(['value'=>$vodomers['watering_number']
                                ? $vodomers['watering_number']
                                : ''])
                            ->label(false)?>
                    </div>
                <?php endif; ?>
                <?= $form->field($model, 'acc')->hiddenInput(['value' => $number->account_number])->label(false) ?>
            </div>

            <div class="mt-6">
                <button type="submit" name="add-meter-button" value="1"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                    Передати
                </button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php else: ?>
        <p style="color: red">
            Передати показники засобiв облiку води можна тiльки 1 раз на мiсяць.
        </p>
    <?php endif; ?>

<?php else: ?>
    <p style="color: red">
        На цьому рахунку засоби обліку води відсутні
    </p>
<?php endif; ?>
