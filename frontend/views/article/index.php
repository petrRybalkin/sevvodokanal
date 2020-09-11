<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use common\models\ArticleSearch;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новини';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <div class="font-sans">
        <h2 class="font-sans break-normal text-gray-900 pt-6 pb-2 text-xl"><?= Html::encode($this->title) ?></h2>
        <hr class="border-b border-gray-400">
    </div>
    <?php if (!isset($mainNew)): ?>
        <p>Поки новин немає.</p>
    <?php endif; ?>
    <?php if (isset($mainNew)): ?>
        <!--Post Content-->
        <!--Lead Para-->
        <?php //if (isset($news)): ?>
            <?php //foreach ($news as $new): ?>

                <?php Pjax::begin([
                    'timeout' => 10000,
                ]); ?>

                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_item-article',
                    'summary' => false,
                    'itemOptions' => [
                        'class' => 'item',
                    ],
                    'pager' => [
                        'pagination' => $dataProvider->pagination,
                        'nextPageLabel' => Yii::t('app', '<span class="icon icon-arrow-right"></span>'),
                        'prevPageLabel' => Yii::t('app', '<span class="icon icon-arrow-left"></span>'),
                    ]
                ])?>

                <?php Pjax::end(); ?>
            <? //endforeach; ?>
        <?php //endif; ?>
    <?php endif; ?>




</div>
