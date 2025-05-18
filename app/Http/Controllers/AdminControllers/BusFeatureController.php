<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\BusFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BusFeatureController extends Controller
{
    public function getFeatures()
    {
        $features = BusFeature::all();
        return response()->json([
            'features' => $features,
            'standards' => []
        ]);
    }

    public function addFeature(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
            ]);

            $feature = BusFeature::create($validatedData);

            return response()->json([
                'success' => true,
                'data' => $feature,
                'message' => 'Feature added successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Feature creation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error adding feature: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteFeature($id)
    {
        try {
            $feature = BusFeature::findOrFail($id);
            $feature->delete();

            return response()->json([
                'success' => true,
                'message' => 'Feature deleted successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Feature deletion failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error deleting feature: ' . $e->getMessage()
            ], 500);
        }
    }
}
