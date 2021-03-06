<?php

use backend\models\FilesLog;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FilesLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Лог загрузки файлов';
$this->params['breadcrumbs'][] = $this->title;


$dataProvider->pagination->pageSize = 100;
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
                'value' => function (FilesLog $model) {
                    return $model->admin ? $model->admin->username : '';
                }
            ],
//            'file',
//            'action',
            [
                'attribute' => 'message',
                'format' => 'raw',
                'value' => function (FilesLog $model) {
                    return \yii\helpers\StringHelper::truncate($model->message, 500, '...');
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function (FilesLog $model) {
                    $dateTime = new DateTime($model->created_at);
                    return $dateTime->format('d.m.Y H:i:s');
                }
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('Просмотр', ['/files-log/view', 'id' => $model->id], [
                            'title' => 'view',
                        ]);
                    },
                ],
            ]]
    ]); ?>

</div>
