<?php

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
        ],]); ?>

    <?= $form->field($model, 'active')->checkbox() ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_description')->widget(CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'basic', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]); ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
  'editorOptions' => ElFinder::ckeditorOptions('elfinder',[/* Some CKEditor Options */]),
]); ?>

    <?php
    if (!$model->isNewRecord):
        ?>
        <img src="<?= $model->getThumbFileUrl('img', 'thumb', ''); ?>" alt="">
        <a href="<?= \yii\helpers\Url::to(['article/del-photo', 'id' => $model->id])?>">Удалить картинку</a>
    <?php endif; ?>
    <?= $form->field($model, 'img')->fileInput(['multiple' => false]) ?>
<!--    --><?php
//    if (!$model->isNewRecord):
//        ?>
<!--        <a href="--><?//= $model->getUploadedFileUrl('pdf') ?><!--">-->
<!--            <span class="pl-2">--><?//= $model->pdf ?><!--</span>-->
<!--        </a>-->
<!--    --><?php //endif; ?>
<!--    --><?//= $form->field($model, 'pdf')->fileInput(['multiple' => false]) ?>

    <?= $form->field($model, 'seoTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seoDescription')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
