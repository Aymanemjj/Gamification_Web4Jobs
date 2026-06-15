<?php

namespace App\Http\Controllers\Api\PlatformControllers;

use App\DTOs\Web4JobsPlatformEventDTO;
use App\Http\Controllers\Controller;
use App\Interfaces\SourceBatchEventRequestInterface;
use App\Interfaces\SourceEventControllerInterface;
use App\Interfaces\SourceSingleEventRequestInterface;
use App\Jobs\CalculatePoints;
use App\Services\EventService;
use App\Services\SourcesServices\Web4JobsPlatformEventService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class Web4JobsPlatformEventController extends Controller implements
    SourceEventControllerInterface
{
    public function __construct(
        private Web4JobsPlatformEventService $web4jobsEventService,
    ) {}


    public function handleSingle(SourceSingleEventRequestInterface $request): JsonResponse
    {
        try{
            $dto = $request->toDTO();

            $event = $this->web4jobsEventService->handleSingle($dto);

            return response()->json([
                'success' => true,
                'message' => 'Web4Jobs event received successfully',
                'data' => [
                    'event_id'  => $event->id,
                    'learner_id' => $event->learner_id,
                    'status'    => 'queued_for_scoring',
                ],
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occurred',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }


    public function handleBatch(SourceBatchEventRequestInterface $request): JsonResponse
    {
	throw new \BadMethodCallException('Not implemented');
    }

}
