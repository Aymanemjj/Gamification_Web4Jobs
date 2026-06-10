<?php

namespace App\Interfaces;

interface SourceEventServiceInterface
{
    public function handleSingle(SourceEventDTOInterface $dto): void;
    /** @param SourceEventDTOInterface[] $events */
    public function handleBatch(array $events): void;
}
