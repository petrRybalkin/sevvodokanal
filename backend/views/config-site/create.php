<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ConfigSite */

$this->title = 'Create Config Site';
$this->params['breadcrumbs'][] = ['label' => 'Config Sites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-site-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
