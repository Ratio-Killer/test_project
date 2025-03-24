<?php

namespace App\Traits\Image;

use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait  ImageTrait
{

    /**
     * @param UploadedFile $source_image
     * @return UploadedFile
     */
    private function processImage(UploadedFile $source_image): UploadedFile
    {
        $image = (new ImageManager(Driver::class))->read($source_image);
        $image->coverDown(70, 70, 'center');
        $directory = storage_path('app/public/images/');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $fileName = 'processed_' . uniqid() . '.jpg';
        $image->save($directory . $fileName, 99);

        return new UploadedFile($directory . $fileName, $fileName, 'image/jpeg', null, true);
    }
}
