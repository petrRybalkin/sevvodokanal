<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
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
                'content' => function ($data) {
                    return $data->statusLabel;
                }
            ],
            [
                'attribute' => 'created_at',
                'content' => function ($data) {
                    return Yii::$app->formatter->asDate($data->created_at, 'php:d.m.Y H:i');
                }
            ],
//            'created_at:datetime',
            //'updated_at',

            //['class' => 'yii\grid\ActionColumn'],
            [

                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
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

                    }
                ],
                'options' => [
                    'width' => 100,
                ],
            ],
        ],
    ]); ?>


</div>
