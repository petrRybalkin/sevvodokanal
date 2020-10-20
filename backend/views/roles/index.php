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
            'access_pages',
            'access_news',
            'access_users',
            'access_abonents',

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
