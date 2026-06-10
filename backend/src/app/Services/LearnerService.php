<?php

namespace App\Services;

use App\Models\Learner;

use function PHPUnit\Framework\throwException;

class LearnerService
{
    private function findALearnerByEmail(string $email)
    {
        return Learner::where("email", $email);
    }

    private function findALearnerById(int $id)
    {
        return Learner::find($id);
    }

    public function findALearner($data)
    {
        if ($data->id) {
            return $this->findALearnerById($data->id);
        } elseif ($data->email) {
            return $this->findALearnerByEmail($data->email);
        } else {
            return false;
        }
    }
}
