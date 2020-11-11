<?php

namespace common\components;


use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yiidreamteam\upload\exceptions\FileUploadException;

/**
 * Class FileUploadBehavior
 */
class FileUploadBehavior extends \yiidreamteam\upload\FileUploadBehavior
{

    /**
     * After save event.
     */
    public function afterSave()
    {
        if ($this->file instanceof UploadedFile !== true) {
            return;
        }

        $path = $this->getUploadedFilePath($this->attribute);

        FileHelper::createDirectory(pathinfo($path, PATHINFO_DIRNAME), 0775, true);

        if (!$this->file->saveAs($path, false)) {
            throw new FileUploadException($this->file->error, 'File saving error.');
        }

        $this->owner->trigger(static::EVENT_AFTER_FILE_SAVE);
    }


}