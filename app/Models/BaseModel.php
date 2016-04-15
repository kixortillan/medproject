<?php

namespace App\Models;

abstract class BaseModel {

    /**
     * 
     * @return string
     */
    public static function getModelName() {
        return strtolower(str_plural(snake_case(last(explode("\\", static::class)))));
    }

}
