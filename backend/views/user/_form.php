<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Roles;

/* @var $this yii\web\View */
/* @var $models common\models\Admin */
/* @var $model \backend\models\SignupAdminForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'role_id')->dropDownList(Roles::enumCategory()) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
