<?php

namespace App\Events;

use App\Models\Photo;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserUploadPhotoEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public Photo $model;

    /**
     * Create a new event instance.
     * Событие должно получить ВСЕ ТО ЧТО ЕМУ НУЖНО - и ничего более или менее
     */
    public function __construct(
        // $model
        public Photo $model
    )
    {
        $this->model = $model;
        //
    }

}
