<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class Uploader
{
    //Subir archivo
    public static function uploadFile(string $key, string $path): string {
        $fileName = self::generateFileName($key);
        request()->file($key)->storeAs($path, $fileName);
        return $fileName;
    }

    //Eliminar archivo
    public static function removeFile(string $path, string $fileName): string {
        Storage::delete(sprintf('%s/%s', $path, $fileName));
    }

    //Metodo para crear el nombre del archivo con la extension.
    protected static function generateFileName(string $key): string {
        $extension = request()->file($key)->getClientOriginalExtension();
        return sprintf('$s-%s.%s', auth()->id(), now()->timestamp, $extension);
    }
}
