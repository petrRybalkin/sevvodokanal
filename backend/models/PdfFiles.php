<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pdf_files".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $path
 */
class PdfFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pdf_files';
    }

    public function behaviors()
    {
        return [
            [
                'class' => '\yiidreamteam\upload\FileUploadBehavior',
                'attribute' => 'path',
                'filePath' => '@webroot/uploads/pdf/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/pdf/[[pk]].[[extension]]',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['path'], 'file', 'skipOnEmpty' => false,'extensions' => 'pdf, doc, docx'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'path' => 'Путь',
        ];
    }
}
