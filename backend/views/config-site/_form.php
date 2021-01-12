<?php

use backend\assets\AppAsset;
use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ConfigSite */
/* @var $form yii\widgets\ActiveForm */

AppAsset::register($this);

?>

<div class="config-site-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'action')->dropDownList($items=['Отключено','Включено']); ?>
    <?= $form->field($model, 'action_legal')->dropDownList($items=['Отключено','Включено']); ?>
    <?= $form->field($model,'name_header')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model,'name_footer')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model,'address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model,'phone_priem')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model,'phone_disp')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model,'schedule')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'plugins' => [
                'clips',
                'fullscreen',
            ],
            'clips' => [
                ['Lorem ipsum...', 'Lorem...'],
                ['red', '<span class="label-red">red</span>'],
                ['green', '<span class="label-green">green</span>'],
                ['blue', '<span class="label-blue">blue</span>'],
            ],
        ],
    ]);?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
