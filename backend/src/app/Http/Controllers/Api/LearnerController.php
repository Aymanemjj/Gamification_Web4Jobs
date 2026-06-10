<?php

namespace App\Http\Controllers;

use App\Services\LearnerService;
use Exception;
use Illuminate\Http\Request;

class LearnerController extends Controller
{
    public function __construct(private LearnerService $learnerService) {}

    public static function find($data)
    {
        try {
            return $this->learnerService->findALearner($data);
        } catch (Exception $exception) {
        }
    }
}
