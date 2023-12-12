<?php

namespace App\Models\Traits;

trait HasTimeStampTrait
{
    private $created_at;
    private $updated_at;

    public function setCreatedAt()
    {
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setUpdatedAt()
    {
        $this->updated_at = date('Y-m-d H:i:s');
    }
}
