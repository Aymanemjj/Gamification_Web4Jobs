<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AdminService;

class AdminController extends Controller
{
    public function __construct(private AdminService $admin_service)
    {
        
    }

    public function basicStats(Request $request)
    {
        
    }
}
