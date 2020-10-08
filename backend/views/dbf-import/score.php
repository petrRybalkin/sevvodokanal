<?php
/* @var $this yii\web\View */

/* @var  $dataProvider */

/* @var DbfImport $model */

use common\models\DbfImport;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['action' => '/backend/dbf-import/upload', 'options' => ['enctype' => 'multipart/form-data']]) ?>

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
        'regn',
        'fp',
        'adres',
        'norma',
        'type',
        'kol',
        'tarif',
        'tarifst',
        'sumtarif'
    ]
]); ?>

<button onclick="$.get('dbf-import/save?fileName=<?= $model->fileName ?>&class=ScoreDBF&action=<?= Yii::$app->controller->action->id ?>')">Сохранить в базу данных</button>
