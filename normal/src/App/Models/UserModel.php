<?php

namespace App\Models;

use App\Models\Traits\HasTimeStampTrait;

class UserModel
{

    use HasTimeStampTrait;

    public function __construct(
        public $firstName,
        public $secondName,
        public $email,
        public $password
    )
    {
        $this->password = md5($this->password);
    }

    public function getDataToFront()
    {
    }

}
