<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Page;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить новую', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'create_utime',
            'short_description:html',
            [
                'label' => 'Есть в меню',
                'attribute' => 'main_menu',
                'filter' => Page::statusMenuList(),
                'format' => 'raw',
                'value' => function (Page $model) {
                    return Html::a($model->getStatusMenuTag(), ['update', 'id' => $model->id]);
                }
            ],
            [
                'label' => 'Есть в сайдбаре',
                'attribute' => 'sidebar',
                'filter' => Page::statusSidebarList(),
                'format' => 'raw',
                'value' => function (Page $model) {
                    return Html::a($model->getStatusSidebarTag(), ['update', 'id' => $model->id]);
                }
            ],
            [
                'attribute' => 'active',
                'filter' => Page::statusList(),
                'format' => 'raw',
                'value' => function (Page $model) {
                    return Html::a($model->getStatusTag(), ['update', 'id' => $model->id]);
                }
            ],


            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, Page $model) {
                        return Html::a('<span class="glyphicon glyphicon-plus">Обновить</span>', ['/page/update', 'id' => $model->id], [
                            'title' => 'Update',
                        ]);
                    },
                    'delete' => function ($url, Page $model) {
                        return Html::a('<span class="glyphicon glyphicon-plus">Удалить</span>', ['/page/delete', 'id' => $model->id], [
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

    <?php Pjax::end(); ?>

</div>
