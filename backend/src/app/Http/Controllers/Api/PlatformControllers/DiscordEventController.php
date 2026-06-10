<?php

namespace App\Http\Controllers\Api\PlatformControllers;

use App\Http\Controllers\Controller;
use App\Interfaces\SourceBatchEventRequestInterface;
use App\Interfaces\SourceEventControllerInterface;
use App\Interfaces\SourceSingleEventRequestInterface;
use App\Services\DiscordEventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class DiscordEventController extends Controller implements
    SourceEventControllerInterface
{
    public function __construct(private DiscordEventService $discrodEventService){}

    
    public function handleSingle(SourceSingleEventRequestInterface $request): JsonResponse
    {
	throw new \BadMethodCallException('Not implemented');
    }

    
    public function handleBatch(SourceBatchEventRequestInterface $request): JsonResponse
    {
	throw new \BadMethodCallException('Not implemented');
    }
}
