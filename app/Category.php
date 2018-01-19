<?php

namespace App;

class Category extends BaseModel
{
    /**
     * turn off the timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    public static function getAll()
    {
        return cache()->rememberForever('categories.all', function () {
            return static::latest('name')->get();
        });
    }

    public static function boot()
    {
        static::creating(function () {
            cache()->forget('categories.all');
        });
    }
}
