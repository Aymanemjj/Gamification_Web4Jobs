<?php

namespace App\Services;

use App\Models\Center;
use App\Models\UserStats;

class CenterService
{
    public function addToCenter($id, $data)
    {
        $userStats = UserStats::where('user_id', $data['user_id'])->first();
        if ($userStats) {
            $userStats->center_id = $id;
            $userStats->save();
        }else{
            UserStats::create([
                'user_id' => $data['user_id'],
                'center_id' => $id,
            ]);
        }
    }

    public function removeFromCenter($id, $data)
    {
        $userStats = UserStats::where('user_id', $data['user_id'])->first();
        if ($userStats) {
            $userStats->center_id = null;
            $userStats->save();
        }
    }

    public function getCenterUsers($id)
    {
        return UserStats::where('center_id', $id)->get();
    }

    public function getCenters()
    {
        return Center::all();
    }

    public function getCenterById($id)
    {
        return Center::find($id);
    }

    public function getCenterByName(String $name)
    {
        return Center::where('name', $name)->first();
    }

    public function createCenter($data)
    {
        return Center::create($data);
    }

    public function updateCenter($id, $data)
    {
        $center = Center::find($id);
        if ($center) {
            $center->update($data);
            return $center;
        }
        return null;
    }

    public function deleteCenter($id)
    {
        $center = Center::find($id);
        if ($center) {
            $center->delete();
            return true;
        }
        return false;
    }
    
}
