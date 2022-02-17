<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService
{
  public static function upload($imageFile, $folderName)
  {
    if (is_array($imageFile)) {
      $file = $imageFile['image'];
    } else {
      $file = $imageFile;
    }
    $fileName = uniqid(rand() . '_');
    $extension = $file->extension();
    $fileNameToStore = $fileName . '.' . $extension;
    $resizedImage = Image::make($file)->resize(1920, 1080)->encode();

    Storage::disk('s3')->put('/' . $folderName . '/' . $fileNameToStore, (string)$resizedImage, 'public');

    return $fileNameToStore;
  }
}
