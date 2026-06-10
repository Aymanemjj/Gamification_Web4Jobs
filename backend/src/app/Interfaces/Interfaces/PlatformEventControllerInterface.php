<?php

namespace App\Interfaces\Interfaces;

use Illuminate\Http\JsonResponse;

interface PlatformEventControllerInterface
{
    public function handleSingle(): JsonResponse;
    public function handleBatch(): JsonResponse;
}
