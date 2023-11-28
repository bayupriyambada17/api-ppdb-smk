<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileHelper
{
    // public static function validateAndStoreFile(Request $request, $fieldName, $allowedMimes, $maxSize, $storagePath, $pesertaName)
    // {
    //     $validator = Validator::make($request->all(), [
    //         $fieldName => "required|file|mimes:$allowedMimes|max:$maxSize",
    //     ]);

    //     if ($validator->fails()) {
    //         return $validator->errors();
    //     }

    //     $file = $request->file($fieldName);
    //     $extension = $file->getClientOriginalExtension();
    //     $fileName = time() . '_' . $pesertaName . '-' . $fieldName . '.' . $extension;
    //     $filePath = $file->storeAs($storagePath, $fileName);

    //     return $filePath;
    // }

    // public static function validateAndStoreDokumen(Request $request, $fieldName, $allowedMimes, $maxSize)
    // {
    //     $validator = Validator::make($request->all(), [
    //         $fieldName => "required|file|mimes:$allowedMimes|max:$maxSize",
    //     ]);

    //     if ($validator->fails()) {
    //         return $validator->errors();
    //     }

    //     $file = $request->file($fieldName);
    //     $hashedName = $file->hashName();

    //     return $hashedName;
    // }

    // public static function storeFileInFolder($file, $folder)
    // {
    //     $storagePath = 'dokumen/' . $folder;

    //     return Storage::putFileAs($storagePath, $file, $file->hashName());
    // }
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
