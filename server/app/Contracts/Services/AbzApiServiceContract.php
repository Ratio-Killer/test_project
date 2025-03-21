<?php

namespace App\Contracts\Services;

interface AbzApiServiceContract
{
    /**
     * @param string $url
     * @param array $routes
     */
    public function __construct(string $url, array $routes);

}
