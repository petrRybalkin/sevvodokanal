<?php


namespace common\components;


use yii\helpers\FileHelper;

class ImageUploadBehavior extends \yiidreamteam\upload\ImageUploadBehavior
{


    public function getThumbFileUrl($attribute, $profile = 'thumb', $emptyUrl = null)
    {
        if (!$this->owner->{$attribute}) {
            return $emptyUrl;
        }

        $behavior = static::getInstance($this->owner, $attribute);

        if ($behavior->createThumbsOnRequest) {
            $behavior->createThumbs();
        }

        return $behavior->resolveProfilePath($behavior->thumbUrl, $profile);
    }


    /**
     * Creates image thumbnails
     */
    public function createThumbs()
    {
        $path = $this->getUploadedFilePath($this->attribute);

        foreach ($this->thumbs as $profile => $config) {
            $thumbPath = static::getThumbFilePath($this->attribute, $profile);

            if (is_file($path) && !is_file($thumbPath)) {

                // setup image processor function
                if (isset($config['processor']) && is_callable($config['processor'])) {
                    $processor = $config['processor'];
                    unset($config['processor']);
                } else {
                    $processor = function (GD $thumb) use ($config) {
                        $thumb->adaptiveResize($config['width'], $config['height']);
                    };
                }

                $thumb = new GD($path, $config);
                call_user_func($processor, $thumb, $this->attribute);
                FileHelper::createDirectory(pathinfo($thumbPath, PATHINFO_DIRNAME), 0775, true);
                $thumb->save($thumbPath);
            }
        }
    }

    /**
     * After file save event handler.
     */
    public function afterFileSave()
    {
        if ($this->createThumbsOnSave == true) {
            $this->createThumbs();
        }
    }

}