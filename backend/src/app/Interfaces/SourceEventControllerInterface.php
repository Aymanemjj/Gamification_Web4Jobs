<?php

namespace App\Interfaces;

use App\Http\Requests\EventRequests\InsertionPlatformSingleEventRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\EventRequests\InsertionPlatformBatchEventRequest;

interface SourceEventControllerInterface
{
    public function handleSingle(InsertionPlatformSingleEventRequest $request): JsonResponse;
    public function handleBatch(InsertionPlatformBatchEventRequest $request);
}
