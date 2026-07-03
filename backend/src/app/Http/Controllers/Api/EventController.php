<?php

namespace App\Http\Controllers\Api;

use App\DTOs\EventDTO;
use App\Services\EventService;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function getAllEvents()
    {
        try {
            return $this->eventService->showAll();
        } catch (Exception $exception) {
        }
    }

    public function getEventById($id)
    {
        try {
            return $this->eventService->showSpecificEvent($id);
        } catch (Exception $exception) {
        }
    }

    public function updateStatus($id, EventDTO $data)
    {
        try {
            return $this->eventService->updateStatus($id, $data);
        } catch (Exception $exception) {
        }
    }

    public function deleteEvent($id)
    {
        try {
            return $this->eventService->delete($id);
        } catch (Exception $exception) {
        }
    }
    
}
