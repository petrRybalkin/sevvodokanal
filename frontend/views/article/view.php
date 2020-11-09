<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">
    <img src="<?=  $model->getImageFileUrl('img');?>" alt="" >
                <!--Title-->
                <div class="font-sans">
                    <h2 class="font-sans break-normal text-gray-900 pt-6 pb-2 text-xl"><?= Html::encode($this->title) ?></h2>
                    <hr class="border-b border-gray-400">
                </div>
                <!--Post Content-->
                <!--Lead Para-->
                <?= $model->description ?>

</div>

<a href="<?= $model->getUploadedFileUrl('pdf') ?>">
    <span class="pl-2"><?= $model->pdf ?></span>
</a>




