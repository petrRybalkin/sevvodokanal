<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-view">
    <?php if(Yii::$app->user->identity->roleOption->access_pages == 1 || Yii::$app->user->identity->roleOption->access_one_page == $model->id){ ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'short_description:ntext',
            'description:ntext',
            'img',
            'seoTitle',
            'seoDescription',
        ],
    ]) ?>
    <?php } else {?>
        <h1 class="danger"> У Вас нет прав на редактирование этой страницу!</h1>
        <?= Html::a('< Назад', ['index'], ['class' => 'btn btn-primary']) ?>
    <?php } ?>
</div>
