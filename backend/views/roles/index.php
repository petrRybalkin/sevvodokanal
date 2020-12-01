<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Roles;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Roles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            //'access_pages',
            //'access_news',
            //'access_users',
            //'access_abonents',
            'access_one_page',
            [
                'attribute' => 'access_pages',
                'filter' => Roles::statusList(),
                'format' => 'raw',
                'value' => function (Roles $model) {
                    return Html::a($model->getStatusPagesTag(), ['update', 'id' => $model->id]);
                }
            ],
            [
                'attribute' => 'access_news',
                'filter' => Roles::statusList(),
                'format' => 'raw',
                'value' => function (Roles $model) {
                    return Html::a($model->getStatusNewsTag(), ['update', 'id' => $model->id]);
                }
            ],
            [
                'attribute' => 'access_users',
                'filter' => Roles::statusList(),
                'format' => 'raw',
                'value' => function (Roles $model) {
                    return Html::a($model->getStatusUsersTag(), ['update', 'id' => $model->id]);
                }
            ],
            [
                'attribute' => 'access_abonents',
                'filter' => Roles::statusList(),
                'format' => 'raw',
                'value' => function (Roles $model) {
                    return Html::a($model->getStatusAbonentTag(), ['update', 'id' => $model->id]);
                }
            ],

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, Roles $model) {
                        return Html::a('<span class="glyphicon glyphicon-plus">Обновить</span>', ['/roles/update', 'id' => $model->id], [
                            'title' => 'Update',
                        ]);
                    },
                    'delete' => function ($url, Roles $model) {
                        return Html::a('<span class="glyphicon glyphicon-plus">Удалить</span>', ['/roles/delete', 'id' => $model->id], [
                            'title' => 'Delete',
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Вы уверены что хотите удалить эту страницу?',
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
