<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Абоненты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Додати абонента', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'phone',
            'email:email',
            [
                'attribute' => 'status',
                'filter' => User::enumStatus(),
                'options' => [
                    'width' => 170,
                ],
                'content' => function ($model) {
                    if ($model->status == User::STATUS_ACTIVE) return '<span class="label label-danger">' . User::enumStatus($model->status) . '</span>';
                    if ($model->status == User::STATUS_INACTIVE) return '<span class="label label-warning">' . User::enumStatus($model->status) . '</span>';
                    if ($model->status == User::STATUS_DELETED) return '<span class="label label-primary">' . User::enumStatus($model->status) . '</span>';
                },
            ],
            [
                'attribute' => 'created_at',
                'options' => [
                    'width' => 150,
                ],
                'content' => function ($data) {
                    return Yii::$app->formatter->asDate($data->created_at, 'php:d.m.Y');
                }
            ],
//            'created_at:datetime',
            //'updated_at',

            //['class' => 'yii\grid\ActionColumn'],
            [

                'class' => 'yii\grid\ActionColumn',
                'template' => '{score} {update} {delete}',
                'buttons' => [
                    'update' => function ($url, User $model) {
                        return Html::a('<span class="glyphicon glyphicon-plus">Обновить</span>', ['/client/update', 'id' => $model->id], [
                            'title' => 'Update',
                        ]);
                    },
                    'delete' => function ($url, User $model) {
                        if ($model->status !== User::STATUS_DELETED) {
                            return Html::a('<span class="glyphicon glyphicon-plus">Удалить</span>', ['/client/delete', 'id' => $model->id], [
                                'title' => 'Delete',
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Вы уверены что хотите удалить этого абонента?',
                                    'method' => 'post',
                                ],
                            ]);
                        }
                    },
                    'score' => function ($url, User $model) {
                        if ($model->clientMap) {
                            return Html::a('Рахунки', ['/client/score', 'id' => $model->id], [
                                'title' => 'Рахунки',
                            ]);
                        }

                    }
                ],
                'options' => [
                    'width' => 100,
                ],
            ],
        ],
    ]); ?>


</div>
