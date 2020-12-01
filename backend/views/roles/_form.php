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

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'access_pages')->checkbox() ?>
    <?= $form->field($model, 'access_news')->checkbox() ?>
    <?= $form->field($model, 'access_users')->checkbox() ?>
    <?= $form->field($model, 'access_abonents')->checkbox() ?>

    <?php
    $test = Page::getPages();
    //\yii\helpers\VarDumper::dump($test, 10, 10);
    foreach (Page::getPages() as $page){
        echo $page['id'];
        //echo '<br>';
        //echo $page['title'];
        echo '<br>';
        //$form->field($model, 'img')->radioList($items = ['Не показывать', 'В левой колонке', 'В правой колонке']);
        echo $form->field($model, 'access_one_page')->radio(['label' => $page['title'], 'value' => $page['id']]);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
