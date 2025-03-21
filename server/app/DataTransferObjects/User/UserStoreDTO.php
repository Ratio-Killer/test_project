<?php

namespace App\DataTransferObjects\User;



use Spatie\DataTransferObject\DataTransferObject;

class UserStoreDTO extends DataTransferObject{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $phone;

    /**
     * @var int
     */
    public int $position_id;

//    /**
//     * @var string
//     */
    public  $photo;

}
