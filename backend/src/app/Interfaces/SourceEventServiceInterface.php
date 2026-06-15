<?php

namespace App\Interfaces;

use App\DTOs\EventDTO;
use App\Models\Events\BasicEvent;

interface SourceEventServiceInterface
{
    public function handleSingle(SourceEventDTOInterface $dto): BasicEvent;
    /** @param SourceEventDTOInterface[] $events */
    public function handleBatch(array $events): void;
    public function process(SourceEventDTOInterface $dto):void;
}
