<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\BusStandard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BusStandardController extends Controller
{
    public function index()
    {
        try {
            $standards = BusStandard::all();
            return response()->json([
                'success' => true,
                'standards' => $standards
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching standards: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error fetching standards'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string'
            ]);

            $standard = BusStandard::create($validated);

            return response()->json([
                'success' => true,
                'data' => $standard,
                'message' => 'Standard added successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Standard creation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to add standard'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $standard = BusStandard::findOrFail($id);
            $standard->delete();

            return response()->json([
                'success' => true,
                'message' => 'Standard deleted successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Standard deletion failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete standard'
            ], 500);
        }
    }
}
