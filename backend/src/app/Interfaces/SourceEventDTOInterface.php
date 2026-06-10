<?php

namespace App\Interfaces;

interface SourceEventDTOInterface
{
    public static function fromRequest(array $data): static;
    public function toArray(): array;
    public function getDedupeKey(): string;
    public function getMetricKey(): string;
    public function getExternalUserId(): string;
    public function getLearnerEmail(): string;
    public function getSource(): string;
    public function getEventType(): string;
    public function getValue(): float;
    public function getPreviousValue(): ?float;
    public function getHappenedAt(): string;
    public function getMetadata(): array;
}
