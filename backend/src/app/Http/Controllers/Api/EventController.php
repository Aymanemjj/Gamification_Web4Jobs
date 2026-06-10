<?php

namespace App\Http\Controllers;

use App\DTOs\EventDTO;
use App\Services\EventService;
use Exception;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(private EventService $eventService) {}

    public function store(EventDTO $data)
    {
        try {
            return $this->eventService->createEvent($data);
        } catch (Exception $exception) {
        }
    }
}
