<?php
/** @var \common\models\ScoreMetering $number */

/** @var \common\models\WaterMetering $vodomer */


use frontend\models\IndicationForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$vodomers = \common\models\WaterMetering::getWaterMeteringInAccNum($number->account_number);
if ($vodomers):
    ?>
    Розділ “Передача показань”:
    1. Номер реєстраційного акту. <?= $number->act_number ?: '-' ?>
    <?php foreach ($vodomers as $vodomer) : ?>
    <?php if ($vodomer->water_metering_first):
        ?>
        <p><?= "Номер засобу обліку води №1 $vodomer->water_metering_first" ?> </p>
        <p><?= "Тип засобу(ів) обліку води. $vodomer->type_first" ?> </p>
        <p>- попередні показання засоба обліку води <?= $vodomer->previous_readings_first ?>
        </p>
        <p>- строк наступної повірки засоба обліку <?= $vodomer->verification_date ?></p>

    <?php endif; ?>
    <?php
    if ($vodomer->water_metering_second):
        ?>
        <p>  <?= $vodomer->water_metering_second ? "Номер засобу обліку води №2" : '' ?> </p>
        <p><?= "Тип засобу(ів) обліку води. $vodomer->type_second" ?> </p>
        <p>- попередні показання засоба обліку води <?= $vodomer->previous_readings_second ?>
        </p>
        <p>- строк наступної повірки засоба обліку <?= $vodomer->verification_date ?></p>
    <?php endif; ?>
    <?php
    if ($vodomer->watering_number):
        ?>
        <p> <?= $vodomer->watering_number ? "Номер засобу обліку води для поливу" : '' ?></p>
        <p><?= "Тип засобу(ів) обліку води. $vodomer->type_watering" ?> </p>
        <p>- попередні показання засоба обліку води <?= $vodomer->previous_watering_readings ?>
        </p>
        <p>- строк наступної повірки засоба обліку <?= $vodomer->verification_date ?></p>
    <?php endif; ?>

<?php endforeach;


    ?>

    <p>5. Дата попередніх
        показань. <?= $vodomer->date_previous_readings ? Yii::$app->formatter->asDate($vodomer->date_previous_readings, 'php: d.m.Y') : '' ?></p>
    <p>7. Кількість засобів обліку води, які обліковуються на особовому рахунку споживача.
        <?= ($vodomer->water_metering_first ? 1 : 0) + ($vodomer->water_metering_second ? 1 : 0) + ($vodomer->watering_number ? 1 : 0) ?></p>


<?php
endif; ?>


<h4>Передача показань</h4>

<?php
$form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'action' => '/profile/meter'
]);

$model = new IndicationForm();
?>

<?= $form->field($model, 'number1')->textInput(['type' => 'number']) ?>
<?= $form->field($model, 'meter1')->textInput(['type' => 'number']) ?>
<?= $form->field($model, 'number2')->textInput(['type' => 'number']) ?>
<?= $form->field($model, 'meter2')->textInput(['type' => 'number']) ?>
<?= $form->field($model, 'number3')->textInput(['type' => 'number']) ?>
<?= $form->field($model, 'meter3')->textInput(['type' => 'number']) ?>
<?= $form->field($model, 'acc')->hiddenInput(['value' => $number->account_number])->label(false) ?>

<div class="form-group">
    <?= Html::submitButton('Передати', ['class' => 'btn btn-primary', 'name' => 'add-meter-button', 'value' => 1]) ?>
</div>

<?php ActiveForm::end();


?>

