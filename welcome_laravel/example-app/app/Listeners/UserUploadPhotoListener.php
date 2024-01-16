<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserUploadPhotoListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        info ("UserUploadPhotoListener" , [json_encode($event)]);
        info ("UserUploadPhotoListener -> model" , [json_encode($event->model)]);
    }
}
