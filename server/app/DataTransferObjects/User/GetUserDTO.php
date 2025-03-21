<?php

namespace App\DataTransferObjects\User;



use Spatie\DataTransferObject\DataTransferObject;

class GetUserDTO extends DataTransferObject
{
    /**
     * @var int|null
     */
    public int|null $page;

    /**
     * @var int|null
     */
    public int|null $count;

}
