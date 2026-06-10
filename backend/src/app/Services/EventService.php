<?php

namespace App\Services;

use App\DTOs\EventDTO;
use App\Http\Requests\PlatformEventRequest;
use App\Models\Events\BasicEvent;
use App\Models\Learner;
use Illuminate\Http\Request;

class EventService 
{
    public function createEvent(EventDTO $data)
    {
        BasicEvent::create($data->toArray());
    }
}
