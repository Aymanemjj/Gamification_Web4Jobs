<?php

namespace App\Http\Controllers\Api\PlatformControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequests\InsertionPlatformSingleEventRequest;
use App\Interfaces\SourceBatchEventRequestInterface;
use App\Interfaces\SourceEventControllerInterface;
use App\Interfaces\SourceSingleEventRequestInterface;
use App\Services\EventService;
use App\Services\InsertionPlatformEventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class InsertionPlatformEventController extends Controller implements
    SourceEventControllerInterface
{
    // private InsertionPlatformEventService $insertionPlatformEventService;
    // public function __construct(){
    //     $this->insertionPlatformEventService = new InsertionPlatformEventService(new EventService());
    // }

    
    public function handleSingle(InsertionPlatformSingleEventRequest $request): JsonResponse
    {
        try{
            $dto = $request->toDTO();
            $insertionPlatformEventService = new InsertionPlatformEventService(new EventService());
            $event = $insertionPlatformEventService->handleSingle($dto);

            return response()->json([
                'success' => true,
                'message' => 'Insertion platform event received successfully',
                'data' => [
                    'event_id'  => $event->id,
                    'user_id' => $event->user_id,
                    'status'    => 'queued_for_scoring',
                ],
            ], 201);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'An error occurred',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function handleBatch(SourceBatchEventRequestInterface $request): JsonResponse
        {   
            try {
                $dtos = $request->toDTOCollection(); 
                
                $results = [];
                $insertionPlatformEventService = new InsertionPlatformEventService(new EventService());
                foreach ($dtos as $dto) {
                    $results[] = $insertionPlatformEventService->handleSingle($dto);
                }
    
                return response()->json([
                    'success' => true,
                    'message' => 'Batch of Insertion platform events processed successfully',
                    'count'   => count($results),
                ], 201);
    
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'An error occurred during batch processing',
                    'error'   => $e->getMessage(),
                ], 500);
            }
        }
}
