<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Article;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить новую', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'short_description:ntext',
            //'description:ntext',
            //'img',
            //'seoTitle',
            //'seoDescription',
            [
                'attribute' => 'active',
                'filter' => Article::statusList(),
                'format' => 'raw',
                'value' => function (Article $model) {
                    return Html::a($model->getStatusTag(), ['update', 'id' => $model->id]);
                }
            ],
            'create_utime',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                //'template' => '{update} {delete}',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, Article $model) {
                        return Html::a('<span class="glyphicon glyphicon-plus">Обновить</span>', ['/article/update', 'id' => $model->id], [
                            'title' => 'Update',
                        ]);
                    },
                    'delete' => function ($url, Article $model) {
                        return Html::a('<span class="glyphicon glyphicon-plus">Удалить</span>', ['/article/delete', 'id' => $model->id], [
                            'title' => 'Delete',
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Вы уверены что хотите удалить эту новость?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ],
                'options' => [
                    'width' => 100,
                ],
            ],
        ],
    ]); ?>


</div>
