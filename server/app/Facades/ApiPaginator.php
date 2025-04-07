<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ApiPaginator extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'ApiPaginator';
    }
}
