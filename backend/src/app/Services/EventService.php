<?php

namespace App\Services;

use App\DTOs\EventDTO;
use App\Interfaces\SourceEventDTOInterface;
use App\Models\Events\BasicEvent;
use Illuminate\Database\Eloquent\Collection;

class EventService
{
    public function createEvent(EventDTO $dto): BasicEvent
    {
        return BasicEvent::create($dto->toArray());
    }

    public function isDuplicate(SourceEventDTOInterface $dto): bool
    {
        return BasicEvent::where('dedupe_key', $dto->dedupe_key)->exists();
    }

    public function showAll(): Collection
    {
        return BasicEvent::with(['platform', 'metricKey', 'eventType', 'learner'])->get();
    }

    public function showSpecificEvent(BasicEvent $event): BasicEvent
    {
        return $event->load(['platform', 'metricKey', 'eventType', 'learner']);
    }

    public function getByLearner(int $learnerId): Collection
    {
        return BasicEvent::with(['metricKey', 'eventType'])
            ->where('learner_id', $learnerId)
            ->orderByDesc('happened_at')
            ->get();
    }

    public function getByMetricKey(string $metricKey): Collection
    {
        return BasicEvent::with(['learner', 'platform'])
            ->whereHas('metricKey', fn ($q) => $q->where('name', $metricKey))
            ->orderByDesc('happened_at')
            ->get();
    }

    public function updateStatus(BasicEvent $event, string $status): BasicEvent
    {
        $event->update(['status' => $status]);
        return $event->fresh();
    }

    public function delete(BasicEvent $event): bool
    {
        return $event->delete();
    }
}