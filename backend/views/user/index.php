<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Admin;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Администраторы';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if(!Yii::$app->user->isGuest) { ?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить админа', ['create'], ['class' => 'btn btn-success']) ?>
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
            'email:email',
            [
                'attribute' => 'status',
                'content' => function ($data) {
                    return $data->statusLabel;
                }
            ],
//            'role_id',
//            [
//                'attribute' => 'role_id',
//                'content' => function ($data) {
//                    return  \yii\helpers\ArrayHelper::getValue(\backend\models\Roles::enumCategory(), $data->role_id,'-');
//                }
//            ],
            [
                'attribute' => 'created_at',
                'content' => function ($data) {
                    return Yii::$app->formatter->asDate($data->created_at, 'php:d.m.Y H:i');
                }
            ],
            [
                'attribute' => 'updated_at',
                'content' => function ($data) {
                    return Yii::$app->formatter->asDate($data->updated_at, 'php:d.m.Y H:i');
                }
            ],
//            'created_at',
//            'updated_at',
            //'verification_token',

            //['class' => 'yii\grid\ActionColumn'],
            [

                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, Admin $model) {
                        return Html::a('<span class="glyphicon glyphicon-plus">Обновить</span>', ['/user/update', 'id' => $model->id], [
                            'title' => 'Update',
                        ]);
                    },
                    'delete' => function ($url, Admin $model) {
                        return Html::a('<span class="glyphicon glyphicon-plus">Удалить</span>', ['/user/delete', 'id' => $model->id], [
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
<?php } ?>
