<?php

namespace App\Contracts\Actions\Position;

interface GetPositionActionContract
{
    /**
     * @return array
     */
    public function __invoke(): array;
}
