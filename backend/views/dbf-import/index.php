<?php
/* @var $this yii\web\View */

/* @var  $dataProvider */

/* @var DbfImport $model */

use common\models\DbfImport;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

?>

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
        'regn',
        'nh1',
        'nh2',
        'np',
        'ph1',
        'ph2',
        'pp',
        [
            'attribute' => 'dppp',
            'format' => ['date', 'dd.MM.Y'],
        ],
        'namh1',
        'namh2',
        'namp',
        [
            'attribute' => 'datgos',
            'format' => ['date', 'dd.MM.Y'],
        ],
        'srkub',
        'khvsrn'
    ]
]); ?>

<button onclick="$.get('dbf-import/save?fileName=<?= $model->fileName ?>&class=InfoDBF&action=<?= Yii::$app->controller->action->id ?>')">Сохранить в базу данных</button>
