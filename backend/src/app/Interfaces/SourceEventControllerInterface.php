<?php

namespace App\Interfaces;

use App\Http\Requests\EventRequests\InsertionPlatformSingleEventRequest;
use Illuminate\Http\JsonResponse;

interface SourceEventControllerInterface
{
    public function handleSingle(InsertionPlatformSingleEventRequest $request): JsonResponse;
    public function handleBatch(SourceBatchEventRequestInterface $request);
}
