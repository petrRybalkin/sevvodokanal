<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = 'Редактирование: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="page-update">
    <?php if(Yii::$app->user->identity->roleOption->access_pages == 1 || Yii::$app->user->identity->roleOption->access_one_page == $model->id){ ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
<?php } else {?>
        <h1 class="danger"> У Вас нет прав на редактирование этой страницу!</h1>
        <?= Html::a('< Назад', ['index'], ['class' => 'btn btn-primary']) ?>
    <?php } ?>
</div>
