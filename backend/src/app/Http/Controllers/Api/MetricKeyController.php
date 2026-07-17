<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\MetricKeyResource;
use App\Services\MetricKeyService;
use App\Requests\StoreMetricKeyRequest;
use App\Requests\UpdateMetricKeyRequest;

class MetricKeyController extends Controller
{
    public function __construct(private MetricKeyService $metric_key_service) {}

    public function getAllMetricKeys()
    {
        try {
            $metric_keys = $this->metric_key_service->getAllMetricKeys();
            return response()->json([
                "success" => true,
                "message" => "Metric keys retrieved successfully",
                "data" => MetricKeyResource::collection($metric_keys),
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error retrieving metric keys",
                    "error" => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function getMetricKeyById($id)
    {
        try {
            $metric_key = $this->metric_key_service->getMetricKeyById($id);
            return response()->json([
                "success" => true,
                "message" => "Metric key retrieved successfully",
                "data" => new MetricKeyResource($metric_key),
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error retrieving metric key",
                    "error" => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function createMetricKey(StoreMetricKeyRequest $request)
    {
        try {
            $metric_key = $this->metric_key_service->createMetricKey(
                $request->validated(),
            );
            return response()->json([
                "success" => true,
                "message" => "Metric key created successfully",
                "data" => new MetricKeyResource($metric_key),
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error creating metric key",
                    "error" => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function updateMetricKey(UpdateMetricKeyRequest $request, $id)
    {
        try {
            $metric_key = $this->metric_key_service->updateMetricKey(
                $id,
                $request->validated(),
            );
            return response()->json([
                "success" => true,
                "message" => "Metric key updated successfully",
                "data" => new MetricKeyResource($metric_key),
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error updating metric key",
                    "error" => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function deleteMetricKey($id)
    {
        try {
            $this->metric_key_service->deleteMetricKey($id);
            return response()->json([
                "success" => true,
                "message" => "Metric key deleted successfully",
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error deleting metric key",
                    "error" => $e->getMessage(),
                ],
                500,
            );
        }
    }
}
