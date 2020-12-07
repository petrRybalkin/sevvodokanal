<?php

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\Category;
use common\models\Page;

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


    <?= $form->field($model, 'short_description')->widget(Widget::className(),
        ['settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'source' => true,



        ]]) ?>

    <?= $form->field($model, 'description')->textarea(['id'=>'editor']);?>

    <?php
    if (!$model->isNewRecord):
        ?>
        <img src="<?= $model->getThumbFileUrl('img', 'thumb', ''); ?>" alt="">
        <a href="<?= \yii\helpers\Url::to(['page/del-photo', 'id' => $model->id])?>">Удалить картинку</a>
    <?php endif; ?>

    <?= $form->field($model, 'img')->fileInput(['multiple' => false]) ?>

    <?= $form->field($model, 'seoTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seoDescription')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
