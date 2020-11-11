<?php
/* @var $this yii\web\View */

/* @var  $dataProvider */

/* @var DbfImport $model */

use common\models\DbfImport;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

?>
<h3> <strong>Загрузить платежи .DBF</strong></h3>
<?php $form = ActiveForm::begin(['action' => 'upload', 'options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'dbfFile')->fileInput(['accept' => '.dbf'])->label('Выберите файл для загрузки') ?>
<?= $form->field($model, 'code')->dropDownList(DbfImport::codeList())->label('Выберите кодировку файла загрузки') ?>
<input type="hidden" name="action" value="<?= Yii::$app->controller->action->id?>">
<button>Загрузить</button>

<?php ActiveForm::end() ?>

<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'emptyText' => 'Загрузите данные для отображения',
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
    'summary' => false,
    'columns' => [
        'lic_schet',
        'summa',
        'datp',
        'pr',
    ]
]); ?>

<button onclick="$.get('save?fileName=<?= $model->fileName ?>&class=PaymentDBF&action=<?= Yii::$app->controller->action->id ?>')">Сохранить в базу данных</button>
