<?php

namespace App\Http\Controllers\Api\PlatformControllers;

use App\Http\Controllers\Controller;
use App\Interfaces\SourceBatchEventRequestInterface;
use App\Interfaces\SourceEventControllerInterface;
use App\Services\AttendanceCenterEventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Interfaces\SourceSingleEventRequestInterface;

class AttendanceCenterEventController extends Controller implements
    SourceEventControllerInterface
{
    public function __construct(private AttendanceCenterEventService $attendanceCenterEventService){}



    
    public function handleSingle(SourceSingleEventRequestInterface $request): JsonResponse
    {
	throw new \BadMethodCallException('Not implemented');
    }

    
    public function handleBatch(SourceBatchEventRequestInterface $request): JsonResponse
    {
	throw new \BadMethodCallException('Not implemented');
    }
    
}
