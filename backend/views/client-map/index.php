<?php

use common\models\ClientMap;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ClientMapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Счета';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-map-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--    <p>-->
    <!--        --><? //= Html::a('Create Client Map', ['create'], ['class' => 'btn btn-success']) ?>
    <!--    </p>-->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'client_id',
                'format' => 'raw',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Начните вводить емейл клиента...'
                ],
                'value' => function (ClientMap $model) {
                    if (!$model->client) {
                        return '-';
                    }

                    return "<p>" . $model->client->username . "</p>" .
                        "<p>" . $model->client->email . "</p>" .
                        "<p>" . \common\models\User::enumStatus($model->client->status) . "</p>";
                }
            ],
            [
                'attribute' => 'score_id',
                'format' => 'raw',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Начните вводить счет клиента...'
                ],
                'value' => function (ClientMap $model) {

                    $scores = $model->getClientScores($model->client_id);

                    $return = '';
                    foreach ($scores as $item) {
                        $return .= "<p>" . $item->account_number . "</p>";
                    }
                    return $return;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
