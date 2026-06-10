<?php

namespace App\Http\Controllers\PlatformControllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Services\PlatformService;
use App\Http\Requests\Web4JobsEventRequest;

class PlatformController extends Controller
{
    public function __construct(private PlatformService $platformService) {}

    public function managePlatformRequest(Web4JobsEventRequest $request)
    {
        try {
            return $this->platformService->managePlatformRequest($request);
        } catch (Exception $exception) {
        }
    }
}
