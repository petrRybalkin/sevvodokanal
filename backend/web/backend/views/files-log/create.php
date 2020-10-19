<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FilesLog */

$this->title = 'Create Files Log';
$this->params['breadcrumbs'][] = ['label' => 'Files Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
