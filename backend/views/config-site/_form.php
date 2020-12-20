<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ConfigSite */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-site-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'action')->dropDownList($items=['Отключено','Включено']); ?>
    <?= $form->field($model,'name_header')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model,'name_footer')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model,'address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model,'phone_priem')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model,'phone_disp')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
