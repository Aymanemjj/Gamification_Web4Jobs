<?php

namespace App\DTOs;

use App\Http\Requests\Web4JobsEventRequest;
use App\Models\MetricKey;
use App\Models\Platform;

readonly class EventDTO
{
    public function __construct(
        public string $happenedAt,
        public string $dedupeKey,
        public int $metricKeyId,
        public int $platformId,
    ) {}

    public static function fromRequest(Web4JobsEventRequest $request): self
    {
        return new self(
            happenedAt: $request->input("happened_at"),
            dedupeKey: $request->input("dedupe_key"),
            metricKeyId: MetricKey::where("name", $request->metric_key)->first()
                ->id,
            platformId: Platform::where("name", $request->source)->first()->id,
        );
    }

    public function toArray(): array
    {
        return [
            "happened_at" => $this->happenedAt,
            "dedub_key" => $this->dedupeKey,
            "metric_key_id" => $this->metricKeyId,
            "platform_id" => $this->platformId,
        ];
    }
}
