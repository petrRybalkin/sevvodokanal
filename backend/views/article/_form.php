<?php

use backend\assets\AppAsset;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
AppAsset::register($this);
?>
<div class="article-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
        ],]); ?>

    <?= $form->field($model, 'active')->checkbox() ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_description')->widget(Widget::className(),
        ['settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'source' => true,


        ]]) ?>
    <div style="color: #9e0505">
        <p>
            1. Cогласно рекомендации Google по улучшению скорости загрузки страниц размер вставляемого изображения не
            должен
            превышать 100 кб.
        </p

        <p> 2. Прикрепления файлов (pdf, doc,docx):</p>
        <p> - загрузите файл в разделе <a href="<?= Url::to(['pdf-files/index']) ?>">Файлы</a> ,</p>
        <p> - скопируйте путь файла из поля Путь,</p>
        <p> - напишите название файла, которое будет выводиться в тексте новости, выделите его,</p>
        <p> - создайте ссылку (нажав на скрепку) в поле ниже,</p>
        <p> - вставьте скопированую ссылку в поле создания ссылки, нажать Сохранить (галочку).</p>
    </div>
    <?= $form->field($model, 'description')->textarea(['id' => 'editor']); ?>


    <?php
    if (!$model->isNewRecord):
        ?>
        <img src="<?= $model->getThumbFileUrl('img', 'thumb', ''); ?>" alt="">
        <a href="<?= \yii\helpers\Url::to(['article/del-photo', 'id' => $model->id]) ?>">Удалить картинку</a>
    <?php endif; ?>
    <?= $form->field($model, 'img')->fileInput(['multiple' => false]) ?>

    <?= $form->field($model, 'seoTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seoDescription')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
