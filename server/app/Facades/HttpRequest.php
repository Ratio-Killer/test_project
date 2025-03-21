<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class HttpRequest extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'HttpRequest';
    }
}
