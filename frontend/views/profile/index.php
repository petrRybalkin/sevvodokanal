<?php


use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>

<p>В одному особистому кабінеті можливе додавання до п`яти особових рахунків.
    Кожен особовий рахунок може містити до трьох лічильників. </p>

  Вашi  особовi рахунки:

<?php


?>

Додати особовий рахунок


<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
]); ?>

<?= $form->field($model, 'account_number')->textInput(['type' => 'number', 'autofocus' => true]) ?>
<?= $form->field($model, 'sum')->textInput(['type' => 'number']) ?>
<?= $form->field($model, 'act_number')->textInput(['type' => 'number']) ?>


    <div class="form-group">
        <?= Html::submitButton('Додати', ['class' => 'btn btn-primary', 'name' => 'add-score-button', 'value' => 1]) ?>
    </div>

<?php ActiveForm::end(); ?>