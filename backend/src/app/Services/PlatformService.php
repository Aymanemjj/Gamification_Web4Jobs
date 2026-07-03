<?php

namespace App\Services;

use App\Http\Controllers\EventController;
use App\Http\Controllers\LearnerController;
use App\Http\Requests\Web4JobsEventRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\DTOs\EventDTO;

class PlatformService
{
    public function __construct(private EventService $eventService) {}

    public function managePlatformRequest(Web4JobsEventRequest $request)
    {
        $request->validated();
        $learner = LearnerController::find($request);
        $event = $this->eventService->createEvent(
            EventDTO::fromRequest($request),
        );
    }
}
