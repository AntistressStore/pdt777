<?php

namespace App\Jobs;

use App\Services\HouseDbUpdateService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class HouseDbUpdateJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected array $elements)
    {
        //
    }

    /**
     * Execute the job. DI in handle method. Laravel inject it automatic.
     */
    public function handle(HouseDbUpdateService $service): void
    {
        $service->insert($this->elements);
    }
}
