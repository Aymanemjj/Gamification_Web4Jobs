<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;

interface SourceEventControllerInterface
{
    public function handleSingle(SourceSingleEventRequestInterface $request): JsonResponse;
    public function handleBatch(SourceBatchEventRequestInterface $request): JsonResponse;
}
