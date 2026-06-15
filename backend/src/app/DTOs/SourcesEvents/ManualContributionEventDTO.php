<?php

namespace App\DTOs;

use App\Interfaces\SourceEventDTOInterface;

class ManualContributionEventDTO implements SourceEventDTOInterface
{
    public string $source;
    public string $event_type;
    public string $dedupe_key;
BasicEvent

➜ git status
On branch dev
Your branch is ahead of 'origin/dev' by 1 commit.
  (use "git push" to publish your local commits)

Changes not staged for commit:
  (use "git add/rm <file>..." to update what will be committed)
  (use "git restore <file>..." to discard changes in working directory)
	deleted:    app/DTOs/AttendanceCenterEventDTO.php
	deleted:    app/DTOs/CertificationPlatformEventDTO.php
	deleted:    app/DTOs/DiscordEventDTO.php
	modified:   app/DTOs/EventDTO.php
	deleted:    app/DTOs/InsertionPlatformEventDTO.php
	deleted:    app/DTOs/ManualContributionEventDTO.php
	deleted:    app/DTOs/Web4JobsPlatformEventDTO.php
	modified:   app/Http/Controllers/Api/PlatformControllers/Web4JobsPlatformEventController.php
	modified:   app/Http/Requests/EventRequests/Web4JobsPlatformSingleEventRequest.php
	modified:   app/Interfaces/SourceEventDTOInterface.php
	modified:   app/Interfaces/SourceEventServiceInterface.php
	modified:   app/Models/Events/BasicEvent.php
	deleted:    app/Services/AttendanceCenterEventService.php
	modified:   app/Services/BadgeService.php
	deleted:    app/Services/CertificationPlatformEventService.php
	deleted:    app/Services/DiscordEventService.php
	modified:   app/Services/EventService.php
	deleted:    app/Services/InsertionPlatformEventService.php
	deleted:    app/Services/ManualContributionEventService.php
	deleted:    app/Services/Web4JobsPlatformEventService.php
	modified:   database/migrations/2026_06_11_132352_create_event_type_table.php

Untracked files:
  (use "git add <file>..." to include in what will be committed)
	../.idea/
	app/DTOs/SourcesEvents/
	app/Interfaces/BasicDtoInterface.php
	app/Jobs/
	app/Services/LeaderBoardService.php
	app/Services/PointCalculationEngine.php
	app/Services/SourcesSerivces/
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
