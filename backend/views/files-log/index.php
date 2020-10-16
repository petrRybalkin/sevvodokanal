<?php

use backend\models\FilesLog;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FilesLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Лог загрузки файлов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-log-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'admin_id',
//                'format' => 'raw',
                'value' => function (FilesLog $model) {
                    return $model->admin ? $model->admin->username: '';
                }
            ],
//            'file',
//            'action',
            'message:ntext',
            [
                'attribute' => 'created_at',
//                'format' => 'raw',
                'value' => function (FilesLog $model) {
                    return Yii::$app->formatter->asDate($model->created_at, 'php: d.m.Y H:i:s');
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
