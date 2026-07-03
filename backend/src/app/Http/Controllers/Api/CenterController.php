<?php

namespace App\Http\Controllers;

use App\Services\CenterService;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CenterController extends Controller
{

    public function __construct(private CenterService $centerService)
    {

    }

    public function index(Request $request)
    {
        try{
            $centers = $this->centerService->getCenters();
            return response()->json($centers);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(Request $request, $id)
    {
        try{
            $center = $this->centerService->getCenterById($id);
            return response()->json($center);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showByName(Request $request, String $name)
    {
        try{
            $center = $this->centerService->getCenterByName($name);
            return response()->json($center);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try{
            $center = $this->centerService->createCenter($request->all());
            return response()->json($center);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $center = $this->centerService->updateCenter($id, $request->all());
            return response()->json($center);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        try{
            $this->centerService->deleteCenter($id);
            return response()->json(['message' => 'Center deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function addToCenter(Request $request, $id)
    {
        try{
            $this->centerService->addToCenter($id, $request->all());
            return response()->json(['message' => 'User added to center successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function removeFromCenter(Request $request, $id)
    {
        try{
            $this->centerService->removeFromCenter($id, $request->all());
            return response()->json(['message' => 'User removed from center successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getCenterUsers(Request $request, $id)
    {
        try{
            $users = $this->centerService->getCenterUsers($id);
            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    
}
