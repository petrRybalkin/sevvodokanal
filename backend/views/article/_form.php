<?php

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
    <?= $form->field($model, 'description')->textarea(['id'=>'editor']);?>

<!--    --><?//= $form->field($model, 'description')->widget(Widget::className(), [
//        'settings' => [
//            'lang' => 'ru',
//            'minHeight' => 200,
//            'source' => true,
//            'imageDelete' => Url::to(['/article/image-delete']),
//            'imageManagerJson' => Url::to(['/article/images-get']),
//            'imageUpload' => Url::to(['/article/image-upload']),
//            'fileUpload' => Url::to(['/article/file-upload']),
//            'fileDelete' => Url::to(['/article/file-delete']),
//            'fileManagerJson' => Url::to(['/article/files-get']),
//            'plugins' => [
//                'clips',
//                'table',
//                'fontsize',
//                'fontcolor',
//                'fontfamily',
//                'fontcolor',
//                'video',
//            ],
//        ],
//        'plugins' => [
//            'imagemanager' => 'vova07\imperavi\bundles\ImageManagerAsset',
//            'filemanager' => 'vova07\imperavi\bundles\FileManagerAsset',
//        ],
//
//
//    ]) ?>



    <?php
    if (!$model->isNewRecord):
        ?>
        <img src="<?= $model->getThumbFileUrl('img', 'thumb', ''); ?>" alt="">
        <a href="<?= \yii\helpers\Url::to(['article/del-photo', 'id' => $model->id])?>">Удалить картинку</a>
    <?php endif; ?>
    <?= $form->field($model, 'img')->fileInput(['multiple' => false]) ?>

    <?= $form->field($model, 'seoTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seoDescription')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
