<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\BusStandard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BusStandardController extends Controller
{
    public function getStandards()
    {
        $standards = BusStandard::all();
        return response()->json([
            'success' => true,
            'standards' => $standards
        ]);
    }

    public function addStandard(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
            ]);

            $standard = BusStandard::create($validatedData);

            return response()->json([
                'success' => true,
                'data' => $standard,
                'message' => 'Standard added successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Standard creation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error adding standard: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteStandard($id)
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
                'message' => 'Error deleting standard: ' . $e->getMessage()
            ], 500);
        }
    }
}
