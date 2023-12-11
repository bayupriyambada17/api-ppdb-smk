<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileHelper
{
    public static function validateAndStoreFile(Request $request, $fieldName, $allowedMimes, $maxSize, $folder)
    {
        $rules = [
            $fieldName => "required|file|mimes:$allowedMimes|max:$maxSize",
        ];

        // Tambahkan validasi khusus untuk menangani file yang tidak dikirimkan
        if ($request->hasFile($fieldName)) {
            $validator = Validator::make($request->all(), $rules);
        } else {
            $validator = Validator::make($request->all(), [
                $fieldName => 'nullable', // Validasi untuk file yang tidak dikirimkan
            ]);
        }

        if ($validator->fails()) {
            return $validator->errors();
        }

        // Jika file dikirim, lakukan validasi dan penyimpanan
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $hashedName = $file->hashName();

            self::storeFileInFolder($file, $folder);

            return $hashedName;
        }

        return null; // Return null untuk file yang tidak dikirimkan
    }

    private static function storeFileInFolder($file, $folder)
    {
        $storagePath = 'public/' . $folder;

        Storage::putFileAs($storagePath, $file, $file->hashName());
    }
}
