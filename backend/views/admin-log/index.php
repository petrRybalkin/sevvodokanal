<?php

use backend\models\AdminLog;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Лог Администратора';
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->setTimeZone('Europe/Kiev');
?>
<div class="admin-log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'admin_id',
//                'format' => 'raw',
                'value' => function (AdminLog $model) {
                    return $model->admin ? $model->admin->username: '';
                }
            ],
//            'action',
            'message',
            [
                'attribute' => 'created_at',
//                'format' => 'raw',
                'value' => function (AdminLog $model) {
                    return Yii::$app->formatter->asDate($model->created_at . ' -2 hours', 'php: d.m.Y H:i:s');
                }
            ],


//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
