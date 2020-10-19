<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FilesLog */

$this->title = 'Update Files Log: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Files Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="files-log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
