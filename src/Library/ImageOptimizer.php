<?php

namespace App\Library;

class ImageOptimizer
{
    private const MAX_WIDTH = 100;
    private const MAX_HEIGHT = 100;

    /**
     * Resizing base64 encoded image using GD library
     *
     * @param string $base64string
     * @param int $width
     * @param int $height
     * @return bool|string
     */
    public static function resizeBase64(string $base64string, $width = self::MAX_WIDTH, $height = self::MAX_HEIGHT)
    {
        /*Initiate the GD image*/
        $data = base64_decode($base64string);
        $gdImage = imagecreatefromstring($data);
        if(!$gdImage){
            return false;
        }

        /*Adapt required width & height according to the source ratio*/
        $sourceWidth = imagesx($gdImage);
        $sourceHeight = imagesy($gdImage);


        $ratio = $sourceWidth / $sourceHeight;
        if ($width / $height > $ratio) {
            $width = $height * $ratio;
        } else {
            $height = $width / $ratio;
        }

        $gdResizedImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($gdResizedImage, $gdImage, 0, 0, 0, 0, $width, $height, $sourceWidth, $sourceHeight);

        ob_start();
        imagejpeg($gdResizedImage);
        $resizedData = ob_get_contents();
        ob_end_clean();

        return base64_encode($resizedData);

    }
}
