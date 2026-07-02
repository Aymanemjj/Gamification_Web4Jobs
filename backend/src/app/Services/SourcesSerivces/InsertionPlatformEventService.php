<?php

namespace App\Services\SourcesServices;

use App\DTOs\EventDTO;
use App\Interfaces\SourceEventDTOInterface;
use App\Interfaces\SourceEventServiceInterface;
use App\Jobs\CalculatePoints;
use App\Models\Events\BasicEvent;
use App\Services\EventService;

class InsertionPlatformEventService implements SourceEventServiceInterface
{
    
    public function __construct(private EventService $eventService) {}
    
    public function handleSingle(SourceEventDTOInterface $dto): BasicEvent {
        $eventDto = EventDTO::make($dto->toArray());
        $event = $this->eventService->createEvent($eventDto);    
        CalculatePoints::dispatch($dto);
        return $event;
        
    }
}
