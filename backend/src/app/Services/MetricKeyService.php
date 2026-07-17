<?php

namespace App\Services;

class MetricKeyService
{
    public function createMetricKey($data)
    {
        return \App\Models\MetricKey::create($data);
    }

    public function updateMetricKey($id, $data)
    {
        return \App\Models\MetricKey::findOrFail($id)->update($data);
    }

    public function deleteMetricKey($id)
    {
        return \App\Models\MetricKey::findOrFail($id)->delete();
    }

    public function getMetricKey($id)
    {
        return \App\Models\MetricKey::findOrFail($id);
    }

    public function getAllMetricKeys()
    {
        return \App\Models\MetricKey::all();
    }
    
}
