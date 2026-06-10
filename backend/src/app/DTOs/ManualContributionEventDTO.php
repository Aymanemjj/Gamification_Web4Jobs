<?php

namespace App\DTOs;

use App\Interfaces\SourceEventDTOInterface;

class ManualContributionEventDTO implements SourceEventDTOInterface
{
    public string $source;
    public string $event_type;
    public string $dedupe_key;
    
    public string $external_user_id;
    public string $learner_email;
    
    public string $metric_key;
    public float $value;
    public ?float $previous_value = null;
    
    public string $happened_at;
    
    public array $metadata;
    
    public static function fromRequest(array $data): static
    {
        throw new \BadMethodCallException('Not implemented');
    }
    
    public function toArray(): array
    {
        throw new \BadMethodCallException('Not implemented');
    }
    
    public function getDedupeKey(): string
    {
        return $this->dedupe_key;
    }
    
    public function getMetricKey(): string
    {
        return $this->metric_key;
    }
    
    public function getExternalUserId(): string
    {
        return $this->external_user_id;
    }
    
    public function getLearnerEmail(): string
    {
        return $this->learner_email;
    }
    
    public function getSource(): string
    {
        return $this->source;
    }
    
    public function getEventType(): string
    {
        return $this->event_type;
    }
    
    public function getValue(): float
    {
        return $this->value;
    }
    
    public function getPreviousValue(): ?float
    {
        return $this->previous_value;
    }
    
    public function getHappenedAt(): string
    {
        return $this->happened_at;
    }
    
    public function getMetadata(): array
    {
        return $this->metadata;
    }
}
