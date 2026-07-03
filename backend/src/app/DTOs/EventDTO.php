<?php

namespace App\DTOs;

use App\Http\Requests\Web4JobsEventRequest;
use App\Interfaces\BasicDtoInterface;
use App\Models\EventType;
use App\Models\User;
use App\Models\MetricKey;
use App\Models\Platform;

readonly class EventDTO implements BasicDtoInterface
{
    public function __construct(
        public string $happenedAt,
        public string $dedupeKey,
        public EventType $eventType,
        public MetricKey $metricKey,
        public Platform $platform,
        public User $user,
    ) {}

    public static function make(array $data): self
    {
        return new self(
            happenedAt: $data['happened_at'],
            dedupeKey: $data['dedupe_key'],
            eventType: EventType::where('type', $data['event_type'])->firstOrFail(),
            metricKey: MetricKey::where('name', $data['metric_key'])->firstOrFail(),
            platform: Platform::where('name', $data['platform'])->firstOrFail(),
            user: User::where('email', $data['learner_email'])->firstOrFail(),
        );
    }

    public static function collection(array $data): array
    {
        return array_map(fn($item) => self::make($item), $data);
    }

    public function toArray(): array
    {
        return [
            'happened_at'   => $this->happenedAt,
            'dedupe_key'    => $this->dedupeKey,
            'event_type_id' => $this->eventType->id,
            'metric_key_id' => $this->metricKey->id,
            'platform_id'   => $this->platform->id,
            'user_id'    => $this->user->id,
        ];
    }
}
