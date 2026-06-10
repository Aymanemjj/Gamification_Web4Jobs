<?php

namespace App\Models\Events;

use App\Interfaces\EventsInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class InsertionPlatformEvent implements EventsInterface
{
    public string $source = "insertion_platform";
    public string $event_type;
    public string $dedupe_key;

    public string $external_user_id;
    public string $learner_email;

    public string $metric_key;
    public float $value;
    public float $previous_value;

    public string $entity_type;
    public string $entity_id;

    public Carbon $happened_at;

    public array $metadata;
}
