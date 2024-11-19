<?php

namespace Database\Factories;

use Faker\Provider\Base;

class ImageProvider extends Base
{
    protected static $images_names = [
        'gj.jpg',
        'gj2.png',
        'gj3.jpg',
        'gj4.jpg',
        'gordon1.jpg',
        'gordon2.jpg',
        'gordon3.jpg',
    ];

    public function image_name()
    {
        return static::randomElement(static::$images_names);
    }
}
