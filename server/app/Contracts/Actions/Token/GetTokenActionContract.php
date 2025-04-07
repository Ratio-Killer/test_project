<?php

namespace App\Contracts\Actions\Token;

interface GetTokenActionContract
{

    /**
     * @return array
     */
    public function __invoke(): array;
}
