<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Page;

/* @var $this yii\web\View */
/* @var $model backend\models\Roles */
/* @var $form yii\widgets\ActiveForm */
/* @var $pages \common\models\Page */
?>

<div class="roles-form">
<style>#roles-access_one_page label{display:block}</style>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'access_pages')->checkbox() ?>
    <?= $form->field($model, 'access_news')->checkbox() ?>
    <?= $form->field($model, 'access_users')->checkbox() ?>
    <?= $form->field($model, 'access_abonents')->checkbox() ?>

    <h2>Права на редактирование определенной страницы:</h2>
    <?= $form->field($model, 'access_one_page')->radioList(Page::getPages()); ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
