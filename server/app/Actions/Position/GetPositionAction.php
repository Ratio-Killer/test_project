<?php

namespace App\Actions\Position;

use App\Contracts\Actions\Position\GetPositionActionContract;
use App\Http\Resources\PositionResource;
use App\Models\Position;

class GetPositionAction implements GetPositionActionContract
{

    /**
     * @return array
     */
    public function __invoke(): array
    {
        return PositionResource::collection(
            Position::all()
        )->resolve();
    }
}
