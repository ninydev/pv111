<?php

namespace App\Presenters;

use App\Models\UserModel;

class UserPresenter
{

    public function __construct(private UserModel $model)
    {
    }

    public function toArray() : array
    {
        return [
            'name' => $this->model->firstName . " " . $this->model->secondName,
            'email' => $this->model->email
        ];
    }

}
