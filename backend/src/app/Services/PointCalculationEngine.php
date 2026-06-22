<?php

namespace App\Services;

use App\Interfaces\SourceEventDTOInterface;
use App\Models\MetricKey;
use App\Models\ScoreTransaction;

class PointCalculationEngine
{
    public static function calculate(SourceEventDTOInterface $dto)
    {
        $data = $dto->toArray();
        $self = new self();
        $points = $self->getPoints($dto);
        ScoreTransaction::create([
            "attributed_points"=> $points,
            "learner_id"=>$dto->learner->id,
        ]);

        BadgeService::reCheck($dto->learner);
    }

    private function getPoints(SourceEventDTOInterface $dto){
        switch($dto->metricKey->rules->unit){
            case "percentage":
                return floor(($dto->currentValue - $dto->previousValue) / $dto->metricKey->rules->guide->per) * $dto->metricKey->rules->guide->amount;
                break;
            case "per_event":
                return $dto->metricKey->rules->guide->amount;
                break;
            case "daily":
                return $dto->metricKey->rules->guide->amount;
                break;
        }
    }
}
