<?php

namespace App\Jobs;

use App\DTOs\EventDTO;
use App\Interfaces\SourceEventDTOInterface;
use App\Interfaces\SourceEventServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Log;

class CalculatePoints implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;
    public array $backoff = [10, 30, 60];
    public int $timeout = 60;

    /**
     * Create a new job instance.
     */
    public function __construct(public readonly SourceEventDTOInterface $dto)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(SourceEventServiceInterface $service): void
    {
        $service->process($this->dto);
    }

    public function failed(\Throwable $e): void
    {
        Log::error('ProcessPlatformEvent failed', [
            'event_key'  => $this->dto->metricKey,
            'user_id'    => $this->dto->userId,
            'error'      => $e->getMessage(),
        ]);
    }
}
