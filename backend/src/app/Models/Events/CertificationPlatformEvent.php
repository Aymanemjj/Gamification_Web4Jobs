<?php

namespace App\Models\Events;

use App\Interfaces\SourceEventModelInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class CertificationPlatformEvent implements SourceEventModelInterface
{
    public string $source = "certification_platform";
    public string $event_type;
    public string $dedupe_key;

    public string $external_user_id;
    public string $learner_email;

    public string $metric_key;
    public float $value;
    public float $previous_value;

    public string $entity_type;
    public string $entity_id;

    public string $certification_id;
    public string $block_id;

    public Carbon $happened_at;

    public array $metadata;



    
    public function resolve(): void
    {
	throw new \BadMethodCallException('Not implemented');
    }

    
    public function validate(): bool
    {
	throw new \BadMethodCallException('Not implemented');
    }

    
    public function getType(): string
    {
	throw new \BadMethodCallException('Not implemented');
    }
    
    
    public function getPayload(): array
    {
	throw new \BadMethodCallException('Not implemented');
    }
}
