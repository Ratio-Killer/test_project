<?php

namespace App\Actions\Token;

use App\Contracts\Actions\Token\GetTokenActionContract;

class GetTokenAction implements GetTokenActionContract
{

    /**
     * @return array
     */
    public function __invoke(): array
    {
        return [];
    }
}
