<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ConfigSite */

$this->title = 'Обновить настройки сайта: ' . $model->name_header;
$this->params['breadcrumbs'][] = ['label' => 'Конфигурация', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_header];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="config-site-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
