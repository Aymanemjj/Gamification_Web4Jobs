<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EventTypeService;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    public function __construct(private EventTypeService $eventTypeService) {}

    public function getAllEventTypes()
    {
        try {
            $eventTypes = $this->eventTypeService->getAllEventTypes();
            return response()->json($eventTypes);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getEventTypeByName($name)
    {
        try {
            $eventType = $this->eventTypeService->getEventTypeByName($name);
            return response()->json($eventType);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createEventType(StoreEventTypeRequest $request)
    {
        try {
            $data = $request->validated();
            $eventType = $this->eventTypeService->createEventType($data);
            return response()->json($eventType);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateEventType($id, UpdateEventTypeRequest $request)
    {
        try {
            $data = $request->validated();
            $eventType = $this->eventTypeService->updateEventType($id, $data);
            return response()->json($eventType);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteEventType($id)
    {
        try {
            $this->eventTypeService->deleteEventType($id);
            return response()->json(['message' => 'Event type deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}
