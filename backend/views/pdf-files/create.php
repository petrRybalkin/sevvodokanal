<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PdfFiles */

$this->title = 'Добавить файл';
$this->params['breadcrumbs'][] = ['label' => 'Файлы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pdf-files-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
