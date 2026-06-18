<?php

namespace App\DTOs\SourcesEvents;

use App\Interfaces\SourceEventDTOInterface;
use App\Models\EventType;
use App\Models\MetricKey;
use App\Models\Platform;
use Illuminate\Support\Carbon;

readonly class CertificationPlatformEventDTO implements SourceEventDTOInterface
{
    public function __construct(
        public Platform   $source,
        public EventType  $event_type,
        public string     $dedupe_key,
        public string     $external_user_id,
        public string     $learner_email,
        public MetricKey  $metric_key,
        public float      $value,
        public ?float     $previous_value,
        public string     $entity_type,
        public string     $entity_id,
        public string     $certification_id,
        public ?string    $block_id,
        public Carbon     $happened_at,
        public array      $metadata,
    ) {}

    public static function make(array $data): static
    {
        return new self(
            source:           Platform::where('name', $data['source'])->firstOrFail(),
            event_type:       EventType::where('type', $data['event_type'])->firstOrFail(),
            dedupe_key:       $data['dedupe_key'],
            external_user_id: $data['external_user_id'],
            learner_email:    $data['learner_email'],
            metric_key:       MetricKey::where('name', $data['metric_key'])->firstOrFail(),
            value:            (float) $data['value'],
            previous_value:   isset($data['previous_value']) ? (float) $data['previous_value'] : null,
            entity_type:      $data['entity_type'],
            entity_id:        $data['entity_id'],
            certification_id: $data['certification_id'],
            block_id:         $data['block_id'] ?? null,
            happened_at:      Carbon::parse($data['happened_at']),
            metadata:         $data['metadata'] ?? [],
        );
    }

    public static function collection(array $data): array
    {
        return array_map(fn ($item) => self::make($item), $data);
    }

    public function toArray(): array
    {
        return [
            'platform_id'       => $this->source->id,
            'event_type_id'     => $this->event_type->id,
            'dedupe_key'        => $this->dedupe_key,
            'external_user_id'  => $this->external_user_id,
            'learner_email'     => $this->learner_email,
            'metric_key_id'     => $this->metric_key->id,
            'value'             => $this->value,
            'previous_value'    => $this->previous_value,
            'entity_type'       => $this->entity_type,
            'entity_id'         => $this->entity_id,
            'certification_id'  => $this->certification_id,
            'block_id'          => $this->block_id,
            'happened_at'       => $this->happened_at->toIso8601String(),
            'metadata'          => $this->metadata,
        ];
    }
}