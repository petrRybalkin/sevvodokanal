<?php
/** @var \common\models\ScoreMetering $number */
/** @var \common\models\WaterMetering $vodomer */

use frontend\models\IndicationForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Передача показань - Особистий кабінет';
$this->params['breadcrumbs'][] = $this->title;

$vodomers = \common\models\WaterMetering::getWaterMeteringInAccNum($number->account_number);
if ($vodomers): ?>
<!--    Розділ “Передача показань”:-->

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div>
            <dl>
                <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Номер реєстраційного акту:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $number->act_number ?: '-' ?></dd>
                </div>
                <?php foreach ($vodomers as $vodomer) : ?>

                    <?php if ($vodomer->water_metering_first): ?>
                        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">Номер засобу обліку води №1:</dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomer->water_metering_first ?></dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">Тип засобу(ів) обліку води:</dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomer->type_first ?></dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">- попередні показання засоба обліку води:</dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomer->previous_readings_first ?></dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">- строк наступної повірки засоба обліку:</dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomer->verification_date ? Yii::$app->formatter->asDate($vodomer->verification_date, 'php: d.m.Y') : '' ?></dd>
                        </div>
                    <?php endif; ?>
                    <?php if ($vodomer->water_metering_second): ?>
                        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">Номер засобу обліку води №2":</dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomer->water_metering_second ?></dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">Тип засобу(ів) обліку води:</dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomer->type_second ?></dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">- попередні показання засоба обліку води:</dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomer->previous_readings_second ?></dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">- строк наступної повірки засоба обліку:</dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomer->verification_date ? Yii::$app->formatter->asDate($vodomer->verification_date, 'php: d.m.Y') : '' ?></dd>
                        </div>
                    <?php endif; ?>
                    <?php if ($vodomer->watering_number): ?>
                        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">Номер засобу обліку води для поливу:</dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomer->watering_number ?></dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">Тип засобу(ів) обліку води:</dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomer->type_watering ?></dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">- попередні показання засоба обліку води:</dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomer->previous_watering_readings ?></dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">- строк наступної повірки засоба обліку:</dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomer->verification_date ? Yii::$app->formatter->asDate($vodomer->verification_date, 'php: d.m.Y') : '' ?></dd>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Дата попередніх показань:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $vodomer->date_previous_readings ? Yii::$app->formatter->asDate($vodomer->date_previous_readings, 'php: d.m.Y') : '' ?></dd>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Кількість засобів обліку води, які обліковуються на особовому рахунку споживача:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= ($vodomer->water_metering_first ? 1 : 0) + ($vodomer->water_metering_second ? 1 : 0) + ($vodomer->watering_number ? 1 : 0) ?></dd>
                </div>
            </dl>
        </div>
    </div>
    <br>
<?php endif; ?>

<div class="min-h-screen flex justify-left bg-gray-50 py-2 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div>
            <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">Передача показань лічильника</h2>
        </div>
        <?php $form = ActiveForm::begin([
                'id' => 'water-metering-form',
                'class' => 'mt-8',
                'enableAjaxValidation' => true,
                'action' => '/profile/meter'
            ]);

            $model = new IndicationForm();
        ?>
        <div class="rounded-md shadow-sm">
            <div>
                <?= $form->field($model, 'number1')
                    ->textInput(['value'=>$vodomers[0]['water_metering_first'] ? $vodomers[0]['water_metering_first'] : '', 'type'=>'number', 'class'=>'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                    ->label('Номер засобу обліку води №1 ', ['class'=>'block text-grey-darker text-sm font-bold mb-2'])
                ?>
            </div>

            <div>
                <?= $form->field($model, 'meter1')
                    ->textInput(['type'=>'number', 'class'=>'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                    ->label('Показники лiчильника №1', ['class'=>'block text-grey-darker text-sm font-bold mb-2'])
                ?>
            </div>
            <div>
                <?= $form->field($model, 'number2')
                    ->textInput(['value'=>$vodomers[0]['water_metering_second'] ? $vodomers[0]['water_metering_second'] : '', 'type'=>'number', 'class'=>'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                    ->label('Номер засобу обліку води №2', ['class'=>'block text-grey-darker text-sm font-bold mb-2'])
                ?>
            </div>

            <div>
                <?= $form->field($model, 'meter2')
                    ->textInput(['type'=>'number', 'class'=>'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                    ->label('Показники лiчильника №2', ['class'=>'block text-grey-darker text-sm font-bold mb-2'])
                ?>
            </div>
            <div>
                <?= $form->field($model, 'number3')
                    ->textInput(['value'=>$vodomers[0]['watering_number'] ? $vodomers[0]['watering_number'] : '', 'type'=>'number', 'class'=>'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                    ->label('Номер засобу обліку води №3', ['class'=>'block text-grey-darker text-sm font-bold mb-2'])
                ?>
            </div>

            <div>
                <?= $form->field($model, 'meter3')
                    ->textInput(['type'=>'number', 'class'=>'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                    ->label('Показники лiчильника №3', ['class'=>'block text-grey-darker text-sm font-bold mb-2'])
                ?>
            </div>
            <?= $form->field($model, 'acc')->hiddenInput(['value' => $number->account_number])->label(false) ?>
        </div>

        <div class="mt-6">
            <button type="submit" name="add-meter-button" value="1" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                Передати
            </button>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
