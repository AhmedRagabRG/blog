<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Setting extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    public $translatedAttributes = ['title', 'content', 'address'];
    protected $fillable = ['id', 'logo', 'favicon', 'facebook', 'twitter', 'instagram', 'phone', 'email', 'created_at', 'updated_at', 'deleted_at'];

    public static function checkSettings()
    {
        $settings = self::all();

        if (count($settings) < 1) {
            $data = [
                'id' => 1
            ];

            foreach (LaravelLocalization::getSupportedLocales() as $key => $value) {
                $data["$key"]['title'] = "s";
            }

            self::create($data);
        }

        return self::first();
    }
}
