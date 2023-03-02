<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable, SoftDeletes;
    public $translatedAttributes = ['title', 'content'];
    protected $fillable = [ 'id', 'img', 'parent', 'created_at', 'updated_at', 'deleted_at'];

    public function parents()
    {
        return $this->belongsTo(Category::class, 'parent');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent');
    }

    public static function checkSettings()
    {
        $categories = self::all();

        if (count($categories) < 1) {
            $data = [
                'id' => 1
            ];

            foreach (LaravelLocalization::getSupportedLocales() as $key => $value) {
                $data["$key"]['title'] = null;
            }

            self::create($data);
        }

        return self::first();
    }
}
