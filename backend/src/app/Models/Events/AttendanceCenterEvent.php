<?php

namespace App\Models\Events;

use App\Interfaces\EventsInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class AttendanceCenterEvent implements EventsInterface
{
    public string $source = "attendance_center";
    public string $event_type;
    public string $dedupe_key;

    public string $external_user_id;
    public string $learner_email;

    public string $metric_key;
    public float $value;
    public ?float $previous_value = null;

    public string $entity_type;
    public string $entity_id;

    public string $center_id;

    public Carbon $happened_at;

    public array $metadata;
}
