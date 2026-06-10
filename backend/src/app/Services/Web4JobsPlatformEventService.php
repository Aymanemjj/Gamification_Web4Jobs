<?php

namespace App\Services;

use App\Interfaces\SourceEventDTOInterface;
use App\Interfaces\SourceEventServiceInterface;


class Web4JobsPlatformEventService implements SourceEventServiceInterface
{
    
    public function handleSingle(SourceEventDTOInterface $dto): void
    {
	throw new \BadMethodCallException('Not implemented');
    }

    
    public function handleBatch(array $events): void
    {
	throw new \BadMethodCallException('Not implemented');
    }
}
