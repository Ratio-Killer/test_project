<?php

namespace App\Contracts\Helpers;
use App\Services\AbzApiService;

interface ApiHelperContract
{
    /**
     * @param AbzApiService $abzApiService
     */
    public function __construct(AbzApiService $abzApiService);
}
