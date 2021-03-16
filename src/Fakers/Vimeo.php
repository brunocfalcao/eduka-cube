<?php

namespace Eduka\Cube\Fakers;

use Faker\Provider\Base;

class Vimeo extends Base
{
    protected static $videos = [
        68321891, 51725260, 153375503, 7237585, 44455522,
        217336882, 174828894, 215953710, 49925273,
        173594129, 134427772, 58612209, 7873373, 48271342,
        52821278, 53009943, 53701204, 45380791,
    ];

    /**
     * A random Food Name.
     * @return string
     */
    public function vimeoId()
    {
        return rand(45380791, 53701204);
        //static::randomElement(static::$videos);
    }
}
