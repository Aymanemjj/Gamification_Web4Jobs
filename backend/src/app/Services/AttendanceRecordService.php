<?php

namespace App\Services;

class AttendanceRecordService
{
    public function getAllAttendanceRecords()
    {
        $attendanceRecords = \App\Models\AttendanceRecord::all();
        return $attendanceRecords;
    }

    public function createAttendanceRecord($data)
    {
        $attendanceRecord = \App\Models\AttendanceRecord::create($data);
        return $attendanceRecord;
    }

    public function getAttendanceRecordById($id)
    {
        $attendanceRecord = \App\Models\AttendanceRecord::find($id);
        return $attendanceRecord;
    }

    public function updateAttendanceRecord($id, $data)
    {
        $attendanceRecord = \App\Models\AttendanceRecord::find($id);
        $attendanceRecord->update($data);
        return $attendanceRecord;
    }

    public function deleteAttendanceRecord($id)
    {
        $attendanceRecord = \App\Models\AttendanceRecord::find($id);
        $attendanceRecord->delete();
        return $attendanceRecord;
    }
}
