<?php


use frontend\widgets\SidebarProfileWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url; ?>



    <p>В одному особистому кабінеті можливе додавання до п`яти особових рахунків.
        Кожен особовий рахунок може містити до трьох лічильників. </p>

    <p>
        Вашi особовi рахунки:
    </p>

<?php
/** @var \common\models\ScoreMetering $item */
foreach ($clientScore as $item):
    ?>
    <a href="<?= Url::to(['/profile/account-number', 'id' => $item->id])?>"><b>особовий рахунок:  </b><?= $item->account_number ?></a>
<?php endforeach; ?>


    <h3> Додати особовий рахунок</h3>
    <div>
        Як вводити дані? Що робити якщо я не знаю номер особового рахунку?
        Для уточнення правильного номера особового рахунку звертайтеся до відділу збуту КОМУНАЛЬНОГО ПІДПРИЄМСТВА
        "СЄВЄРОДОНЕЦЬКВОДОКАНАЛ".
        Копійки в сумі оплати вводяться через кому без слів "грн" і т.ін. наприклад 65,54
    </div>

<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
]); ?>

<?= $form->field($model, 'account_number')->textInput(['type' => 'number', 'autofocus' => true]) ?>
<?= $form->field($model, 'act_number')->textInput(['type' => 'number']) ?>
<?= $form->field($model, 'sum')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Додати', ['class' => 'btn btn-primary', 'name' => 'add-score-button', 'value' => 1]) ?>
    </div>

<?php ActiveForm::end(); ?>