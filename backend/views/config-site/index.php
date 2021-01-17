<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ConfigSite;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Настройки сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-site-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'name:ntext',
            //'title:ntext',
            //'value:ntext',
            'name_header:ntext',
            'name_footer:ntext',
            'address:ntext',
            'phone_priem:ntext',
            'phone_disp:ntext',
            [
                'attribute' => 'action',
                'filter' => ConfigSite::statusList(),
                'format' => 'raw',
                'value' => function (ConfigSite $model) {
                    return Html::a($model->getStatusTag());
                }
            ],
            [
                'attribute' => 'action_legal',
                'filter' => ConfigSite::statusLegalList(),
                'format' => 'raw',
                'value' => function (ConfigSite $model) {
                    return Html::a($model->getStatusLegalTag());
                }
            ],

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, ConfigSite $model) {
                        if(Yii::$app->user->identity->roleOption->access_settings == 1){
                            return Html::a('<span class="glyphicon glyphicon-plus">Обновить</span>', ['/config-site/update', 'id' => $model->id], [
                                'title' => 'Update',
                            ]);
                        }


                    },
                ],
                'options' => [
                    'width' => 100,
                ],
            ],
        ],
    ]); ?>


</div>
