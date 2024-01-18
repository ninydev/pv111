<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UserUploadPhotoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        // Log::debug('UserUploadPhotoJob Constructor:', [date('H:i:s') . '.' . microtime(true)]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Log::debug('UserUploadPhotoJob handle start:', [date('H:i:s') . '.' . microtime(true)]);

        sleep(10);

        Log::debug('UserUploadPhotoJob handle finish:', [
            date('H:i:s') . '.' . microtime(true),
            $this->job->uuid()
        ]);
    }
}
