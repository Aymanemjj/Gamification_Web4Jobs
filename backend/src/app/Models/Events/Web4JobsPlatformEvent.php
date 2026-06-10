<?php

namespace App\Models\Events;

use App\Interfaces\EventsInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Platform;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\MetricKey;
use Illuminate\Support\Carbon;

class Web4JobsEvent implements EventsInterface
{
    public string $source = "web4jobs_progress";
    public string $event_type;
    public string $dedupe_key;

    public string $external_user_id;
    public string $learner_email;

    public string $metric_key;
    public float|int $value;
    public float|int $previous_value;

    public string $entity_type;
    public string $entity_id;

    public Carbon $happened_at;

    public array $metadata;

    public function resolve(): void
    {
        return;
    }
}
