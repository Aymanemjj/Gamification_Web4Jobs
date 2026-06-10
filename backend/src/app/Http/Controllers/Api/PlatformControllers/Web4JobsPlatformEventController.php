<?php

namespace App\Http\Controllers\Api\PlatformControllers;

use App\Http\Controllers\Controller;
use App\Interfaces\SourceBatchEventRequestInterface;
use App\Interfaces\SourceEventControllerInterface;
use App\Interfaces\SourceSingleEventRequestInterface;
use App\Services\Web4JobsPlatformEventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class Web4JobsPlatformEventController extends Controller implements
    SourceEventControllerInterface
{
    public function __construct(
        private Web4JobsPlatformEventService $web4jobsEventSerivce,
    ) {}

    
    public function handleSingle(SourceSingleEventRequestInterface $request): JsonResponse
    {
	throw new \BadMethodCallException('Not implemented');
    }

    
    public function handleBatch(SourceBatchEventRequestInterface $request): JsonResponse
    {
	throw new \BadMethodCallException('Not implemented');
    }
    
}
