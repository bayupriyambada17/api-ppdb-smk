<?php

namespace App\Http\Helpers;

class UploadHelper
{
    public static function fileUpload($file, $directory, $filenamePrefix = '', $disk = 'public')
    {
        $filename = $filenamePrefix . str_replace(" ", "", $file->getClientOriginalName());
        $filePath = $file->storeAs($directory, $filename, $disk);

        return $filePath;
    }
}
