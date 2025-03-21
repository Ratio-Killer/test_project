<?php

namespace App\Helpers;

use App\Contracts\Helpers\ApiHelperContract;
use App\Services\AbzApiService;

class ApiHelper implements ApiHelperContract
{

    /**
     * @param AbzApiService $abzApiService
     */
    public function __construct(AbzApiService $abzApiService)
    {
        $this->abz_api_service = $abzApiService;
    }
}
