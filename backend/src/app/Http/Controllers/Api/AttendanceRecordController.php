<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceRecordController extends Controller
{
    public function __construct(private \App\Services\AttendanceRecordService $attendanceRecordService){}


    public function index()
    {
        $attendanceRecords = $this->attendanceRecordService->getAllAttendanceRecords();
        return response()->json($attendanceRecords);
    }

    public function store(Request $request)
    {
        $attendanceRecord = $this->attendanceRecordService->createAttendanceRecord($request->all());
        return response()->json($attendanceRecord, 201);
    }

    public function show($id)
    {
        $attendanceRecord = $this->attendanceRecordService->getAttendanceRecordById($id);
        return response()->json($attendanceRecord);
    }

    public function update(Request $request, $id)
    {
        $attendanceRecord = $this->attendanceRecordService->updateAttendanceRecord($id, $request->all());
        return response()->json($attendanceRecord);
    }

    public function destroy($id)
    {
        $this->attendanceRecordService->deleteAttendanceRecord($id);
        return response()->json(null, 204);
    }
    
}