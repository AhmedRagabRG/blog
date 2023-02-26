<?php

namespace App\Helpers;

use App\Http\Requests\SettingsRequest;
use Illuminate\Support\Str;

class Helper
{
    public static function uploadImage(SettingsRequest $request, string $name, string $path)
    {
        if ($request->file($name)) {
            $file = $request->file($name);
            $filename = Str::uuid() . $file->getClientOriginalName();
            $file->move(public_path($path), $filename);
            return $path . $filename;
        }
    }
}
