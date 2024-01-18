<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UserUploadPhotoListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        Log::debug('UserUploadPhotoListener Constructor:', [date('H:i:s') . '.' . microtime(true)]);

    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Log::debug('UserUploadPhotoListener handle start:', [date('H:i:s') . '.' . microtime(true)]);

        sleep(10);

        Log::debug('UserUploadPhotoListener handle finish:', [date('H:i:s') . '.' . microtime(true)]);
        // info ("UserUploadPhotoListener" , [json_encode($event)]);
        // info ("UserUploadPhotoListener -> model" , [json_encode($event->model)]);
    }
}
