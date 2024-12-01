<?php

namespace App\Helpers;

use Exception;

class ImageHelper
{
    /**
     * Upload and resize an image.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @param string $fileName
     * @param int|null $width
     * @param int|null $height
     * @return string
     * @throws Exception
     */
    public static function uploadAndResize($file, $directory, $fileName, $width = null, $height = null)
    {
        $destinationPath = public_path($directory);

        // Ensure the directory exists
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $image = null;

        // Determine image creation method based on file extension
        switch ($extension) {
            case 'jpeg':
            case 'jpg':
                $image = @imagecreatefromjpeg($file->getRealPath());
                break;
            case 'png':
                $image = @imagecreatefrompng($file->getRealPath());
                break;
            case 'gif':
                $image = @imagecreatefromgif($file->getRealPath());
                break;
            default:
                throw new Exception('Unsupported image type');
        }

        if (!$image) {
            throw new Exception('Failed to create an image resource. The file may be corrupted.');
        }

        // Resize the image if width is specified
        if ($width) {
            $oldWidth = imagesx($image);
            $oldHeight = imagesy($image);
            $aspectRatio = $oldWidth / $oldHeight;

            if (!$height) {
                $height = (int) ($width / $aspectRatio);
            }

            $newImage = imagecreatetruecolor($width, $height);

            // Preserve transparency for PNG and GIF
            if (in_array($extension, ['png', 'gif'])) {
                imagealphablending($newImage, false);
                imagesavealpha($newImage, true);
            }

            imagecopyresampled($newImage, $image, 0, 0, 0, 0, $width, $height, $oldWidth, $oldHeight);
            imagedestroy($image);
            $image = $newImage;
        }

        // Save the image with original quality
        $filePath = $destinationPath . '/' . $fileName;
        switch ($extension) {
            case 'jpeg':
            case 'jpg':
                imagejpeg($image, $filePath, 90); // Adjust quality if needed
                break;
            case 'png':
                imagepng($image, $filePath);
                break;
            case 'gif':
                imagegif($image, $filePath);
                break;
        }

        imagedestroy($image);

        return $fileName;
    }
}
