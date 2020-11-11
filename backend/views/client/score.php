<?php


use common\models\User;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>
    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Oсобовi рахунки абонента:</h3>
    </div>

<?= /** @var \common\models\ScoreMetering $model */

GridView::widget([
        'dataProvider' => $model,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'account_number',
            [
                'label' => 'Статус',
                'attribute' => 'act_number',
                'content' => function ($data) {
                    return "Активный";
                }
            ],
            [
                'label' => 'ФИО',
                'attribute' => 'name_of_the_tenant',
                'content' => function ($data) {
                    return $data->name_of_the_tenant;
                }
            ],
            [
                'label' => 'Адрес',
                'attribute' => 'address',
                'content' => function ($data) {
                    return $data->address;
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return \yii\helpers\Html::a('Удалить', ['/client/delete-number', 'id' => Yii::$app->request->get('id'), 'score_id' => $model->id],
                            ['title' => 'Delete',
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Вы уверены что хотите удалить этот номер счета?',
                                    'method' => 'post',
                                ]
                            ]);
                    },
                ],],

        ]]
); ?>