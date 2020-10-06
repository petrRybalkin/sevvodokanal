<?php
/** @var \common\models\ScoreMetering $number */
/** @var \common\models\WaterMetering $vodomer */


use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$vodomers = \common\models\WaterMetering::getWaterMeteringInAccNum($number->account_number);
if($vodomers): ?>
Розділ “Передача показань”:<br>
1. Номер реєстраційного акту. <?= $number->act_number ? :'-' ?>
<?php foreach ($vodomers as $vodomer) :?>
  <?php  if($vodomer->water_metering_first):
    ?>
    <p><?=  "Номер засобу обліку води №1 $vodomer->water_metering_first" ?> </p>
    <p><?=  "Тип засобу(ів) обліку води. $vodomer->type_first" ?> </p>
    <p>- попередні показання засоба обліку води <?= $vodomer->previous_readings_first ?>
     </p>
    <p>- строк наступної повірки засоба обліку <?= $vodomer->verification_date ?></p>

    <?php endif; ?>
    <?php if($vodomer->water_metering_second): ?>
        <p>  <?= $vodomer->water_metering_second ? "Номер засобу обліку води №2" : '' ?></p>
        <p><?=  "Тип засобу(ів) обліку води. $vodomer->type_second"  ?> </p>
        <p>- попередні показання засоба обліку води  <?= $vodomer->previous_readings_second ?>
            </p>
        <p>- строк наступної повірки засоба обліку <?= $vodomer->verification_date ?></p>
    <?php endif; ?>
    <?php if($vodomer->watering_number): ?>
        <p> <?= $vodomer->watering_number ? "Номер засобу обліку води для поливу" : '' ?></p>
        <p><?= "Тип засобу(ів) обліку води. $vodomer->type_watering"  ?> </p>
        <p>- попередні показання засоба обліку води  <?= $vodomer->previous_watering_readings ?>
          </p>
        <p>- строк наступної повірки засоба обліку <?= $vodomer->verification_date ?></p>
    <?php endif; ?>

<?php endforeach; ?>

<p>2. Дата попередніх показань.  <?= $vodomer->date_previous_readings ? Yii::$app->formatter->asDate($vodomer->date_previous_readings, 'php: d.m.Y'): '' ?></p>
<p>3. Враховувати кількість засобів обліку води, які обліковуються на особовому рахунку споживача.
    <?= ($vodomer->water_metering_first ? 1: 0) + ($vodomer->water_metering_second ? 1 : 0) + ($vodomer->watering_number ? 1: 0)?></p>
<p>4. Врахувати можливість передачі  показників до підприємства.</p>


<?php endif;?>

<div class="min-h-screen flex justify-left bg-gray-50 py-2 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div>
            <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">Передача показаний счетчика </h2>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'water-metering-form', 'class' => 'mt-8', 'enableAjaxValidation' => true,]); ?>
        <div class="rounded-md shadow-sm">
            <div>
                <?= $form->field($model, 'number')
                    ->textInput(['type'=>'number', 'class'=>'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                    ->label('Номер засобу обліку води', ['class'=>'block text-grey-darker text-sm font-bold mb-2'])
                ?>
            </div>

            <div>
                <?= $form->field($model, 'meter')
                    ->textInput(['type'=>'number', 'class'=>'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                    ->label('Показники лiчильника', ['class'=>'block text-grey-darker text-sm font-bold mb-2'])
                ?>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" name="add-meter-button" value="1" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                Передати
            </button>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

