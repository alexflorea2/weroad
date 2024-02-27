<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Cache;

class ClearToursCache
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
    public function handle(): void
    {
        Cache::tags(['tours'])->flush();
    }
}
