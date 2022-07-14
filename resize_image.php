<?php

function resizeImage($sourceImage, $targetImage, $maxWidth, $maxHeight, $quality = 100)
{
    // Obtain image from given source file.
    if (!$image = @imagecreatefromjpeg($sourceImage)){
        return false;
    }
    
    list($origWidth, $origHeight) = getimagesize($sourceImage);

    if ($maxWidth == 0){
        $maxWidth  = $origWidth;
    }

    if ($maxHeight == 0){
        $maxHeight = $origHeight;
    }

    $widthRatio = $maxWidth / $origWidth;
    $heightRatio = $maxHeight / $origHeight;
    $ratio = min($widthRatio, $heightRatio);

    $newWidth  = (int)$origWidth  * $ratio;
    $newHeight = (int)$origHeight * $ratio;

    $newImage = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
    imagejpeg($newImage, $targetImage, $quality);

    imagedestroy($image);
    imagedestroy($newImage);

    return true;
}
resizeImage('sample.jpeg', 'resized.jpg', 400, 400);
?>
 