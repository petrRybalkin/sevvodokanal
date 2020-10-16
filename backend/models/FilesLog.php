<?php

namespace backend\models;

use common\models\Admin;
use common\models\User;
use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "files_log".
 *
 * @property int $id
 * @property int|null $admin_id
 * @property int|null $file
 * @property int|null $action
 * @property string|null $message
 * @property string|null $created_at
 *
 * @property User $admin
 */
class FilesLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['admin_id', 'action'], 'integer'],
            [['message'], 'string'],
            [['file','action'], 'safe'],
            [['created_at'], 'default', 'value' => date('Y-m-d') ],
//            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['admin_id' => 'id']],
            [['admin_id'], 'default', 'value' => \Yii::$app->user->getId()],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_id' => 'Админ',
            'file' => 'File',
            'action' => 'Action',
            'message' => 'Действие',
            'created_at' => 'Дата',
        ];
    }

    /**
     * Gets query for [[Admin]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Admin::className(), ['id' => 'admin_id']);
    }

    public static function addFileAction( $action_id, $message)
    {
        $adminLog = new FilesLog();
        $adminLog->setAttributes([
            'action' => $action_id,
            'message' => $message
        ]);
        if(!$adminLog->save(false)){
            print_r($adminLog->getErrors());exit;
        }
        return true;
    }
}
