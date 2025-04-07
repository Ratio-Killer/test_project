<?php

namespace App\Traits\Image;

use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait  ImageTrait
{

    /**
     * @param UploadedFile $sourceImage
     * @return UploadedFile
     */
    private function processImage(UploadedFile $sourceImage): UploadedFile
    {
        $image = (new ImageManager(Driver::class))->read($sourceImage);
        $image->coverDown(70, 70, 'center');
        $directory = public_path('images/users/');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $fileName = 'processed_' . uniqid() . '.jpg';
        $image->save($directory . $fileName, 99);

        return new UploadedFile($directory . $fileName, $fileName, 'image/jpeg', null, true);
    }
}
