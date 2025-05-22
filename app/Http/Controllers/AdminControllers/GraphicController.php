<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Graphic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GraphicController extends Controller
{
    public function index()
    {
        try {
            $graphics = Graphic::latest()->get()->map(function($graphic) {
                return [
                    'id' => $graphic->id,
                    'title' => $graphic->title,
                    'image' => $graphic->image,
                    'status' => $graphic->status ? 'Active' : 'Inactive',
                    'created_at' => $graphic->created_at
                ];
            });

            return response()->json([
                'success' => true,
                'graphics' => $graphics
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching graphics: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'status' => 'required|boolean'
            ]);

            $imagePath = $request->file('image')->store('graphic-ads', 'public');

            $graphic = Graphic::create([
                'title' => $validated['title'],
                'image' => $imagePath,
                'status' => $validated['status']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Graphic added successfully',
                'graphic' => $graphic
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding graphic: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Graphic $graphic)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'status' => 'required|boolean'
            ]);

            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($graphic->image);
                $validated['image'] = $request->file('image')->store('graphic-ads', 'public');
            }

            $graphic->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Graphic updated successfully',
                'graphic' => $graphic
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating graphic: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $graphic = Graphic::findOrFail($id);

            // Delete the image file if it exists
            if ($graphic->image) {
                Storage::disk('public')->delete($graphic->image);
            }

            $graphic->delete();

            return response()->json([
                'success' => true,
                'message' => 'Graphic deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting graphic: ' . $e->getMessage()
            ], 500);
        }
    }
}
