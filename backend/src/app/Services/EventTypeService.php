<?php

namespace App\Services;

use App\Models\EventType;

class EventTypeService
{
    public function createEventType(array $data): EventType
    {
        $eventType = new EventType();
        $eventType->name = $data['name'];
        $eventType->save();
        return $eventType;
    }

    public function updateEventType(int $id, array $data): EventType
    {
        $eventType = EventType::findOrFail($id);
        $eventType->name = $data['name'];
        $eventType->save();
        return $eventType;
    }

    public function deleteEventType(int $id): void
    {
        $eventType = EventType::findOrFail($id);
        $eventType->delete();
    }
}
