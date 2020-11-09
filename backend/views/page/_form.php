<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    #page-footer label{display:block}
</style>
<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'active')->checkbox() ?>



    <div class="row">
        <div class="col-md-4 col-sm-12">
            <?= $form->field($model, 'main_menu')->checkbox() ?>

        </div>
        <div class="col-md-8 col-sm-12">
            <?= $form->field($model, 'parent_page')->dropDownList(Category::enumCategory()); ?>
            <?= $form->field($model, 'sort_main_menu')->textInput()->label('Приоритет (0 - выше(левее), 0< - ниже(правее))') ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <?= $form->field($model, 'sidebar')->checkbox() ?>
        </div>
        <div class="col-md-8 col-sm-12">
            <?= $form->field($model, 'sort_sidebar')->textInput()->label('Приоритет (0 - выше, 0< - ниже)') ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <?= $form->field($model, 'footer')->radioList($items=['Не показывать','В левой колонке','В правой колонке']) ?>
        </div>
        <div class="col-md-8 col-sm-12">
            <?= $form->field($model, 'sort_footer')->textInput()->label('Приоритет (0 - выше, 0< - ниже)') ?>
        </div>
    </div>
    <hr>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_description')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'basic', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]);?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(),[
    'editorOptions' => [
    'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
    'inline' => false, //по умолчанию false
    ],
    ]);?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seoTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seoDescription')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
