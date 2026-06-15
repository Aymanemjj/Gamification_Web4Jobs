<?php

namespace App\Services;

use App\Interfaces\SourceEventDTOInterface;
use App\Interfaces\SourceEventServiceInterface;
use App\Models\Events\BasicEvent;

class InsertionPlatformEventService implements SourceEventServiceInterface
{
    
    public function handleSingle(SourceEventDTOInterface $dto): BasicEvent
    {
	throw new \BadMethodCallException('Not implemented');
    }

    
    public function handleBatch(array $events): void
    {
	throw new \BadMethodCallException('Not implemented');
    }

    public function process(SourceEventDTOInterface $dto): void
    {
        
    }
}
