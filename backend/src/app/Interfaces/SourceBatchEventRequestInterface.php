<?php

namespace App\Interfaces;

interface SourceBatchEventRequestInterface
{
    public function toDTOCollection(): array;
}
