<?php

namespace api\models;

use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class Tickets extends \common\models\Tickets
{

    public function uploadImage(UploadedFile $image, $currentImage = null)
    {
        if (!is_null($currentImage))
            $this->deleteImage($currentImage);
        $this->image = $image;

        return $this->saveImage();
    }


    private function getUploadPath(): string
    {
        return Yii::$app->params['uploadPath'];
    }


    /**
     * @return string
     */
    public function generateFileName(): string
    {
        do {
            $name = substr(md5(microtime() . rand(0, 1000)), 0, 20);
            $file = strtolower($name .'.'. $this->image->extension);
        } while (file_exists($file));
        return $file;
    }

    public function deleteImage($currentImage)
    {
        if ($currentImage && $this->fileExists($currentImage)) {
            unlink($this->getUploadPath() . $currentImage);
        }
    }

    /**
     * @param $currentFile
     * @return bool
     */
    public function fileExists($currentFile): bool
    {
        $file = $currentFile ? $this->getUploadPath() . $currentFile : null;
        return file_exists($file);
    }

    /**
     * @return string
     */
    public function saveImage(): string
    {
        $filename = $this->generateFilename();
        $this->image->saveAs($this->getUploadPath() . $filename);
        return $this->getUploadPath() . $filename;
    }

}