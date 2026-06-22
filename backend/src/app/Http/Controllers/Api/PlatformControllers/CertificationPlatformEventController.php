<?php

namespace App\Http\Controllers\Api\PlatformControllers;

use App\Http\Controllers\Controller;
use App\Interfaces\SourceBatchEventRequestInterface;
use App\Interfaces\SourceEventControllerInterface;
use App\Interfaces\SourceSingleEventRequestInterface;
use App\Services\CertificationPlatformEventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class CertificationPlatformEventController extends Controller implements
    SourceEventControllerInterface
{
    public function __construct(private CertificationPlatformEventService $certificationPlatformEventService){}

    

    public function handleSingle(SourceSingleEventRequestInterface $request): JsonResponse
       {
           try{
               $dto = $request->toDTO();
   
               $event = $this->certificationPlatformEventService->handleSingle($dto);
   
               return response()->json([
                   'success' => true,
                   'message' => 'Certification platform event received successfully',
                   'data' => [
                       'event_id'  => $event->id,
                       'learner_id' => $event->learner_id,
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
                   foreach ($dtos as $dto) {
                       $results[] = $this->certificationPlatformEventService->handleSingle($dto);
                   }
       
                   return response()->json([
                       'success' => true,
                       'message' => 'Batch of Certification platform events processed successfully',
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
