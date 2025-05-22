<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\BusFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BusFeatureController extends Controller
{
    public function index()
    {
        try {
            $features = BusFeature::all();
            return response()->json([
                'success' => true,
                'features' => $features
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching features: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error fetching features'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:bus_features,name',
                'description' => 'required|string'
            ]);

            $feature = BusFeature::create($validated);

            return response()->json([
                'success' => true,
                'data' => $feature,
                'message' => 'Feature added successfully'
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->errors()['name'][0] ?? 'Validation failed'
            ], 422);
        } catch (\Exception $e) {
            Log::error('Feature creation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Internal server error'
            ], 500);
        }
    }

    public function destroy($id)
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
                'message' => 'Failed to delete feature'
            ], 500);
        }
    }
}
