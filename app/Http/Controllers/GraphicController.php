<?php

namespace App\Http\Controllers;

use App\Models\Graphic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GraphicController extends Controller
{
    public function index()
    {
        try {
            $graphics = Graphic::orderBy('created_at', 'desc')->get();
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
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'required|string',
                'page' => 'nullable|string',
                'status' => 'required|boolean'
            ]);

            // Handle base64 image
            if (preg_match('/^data:image\/(\w+);base64,/', $validatedData['image'], $type)) {
                $data = substr($validatedData['image'], strpos($validatedData['image'], ',') + 1);
                $type = strtolower($type[1]);

                if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                    throw new \Exception('Invalid image type');
                }

                $data = base64_decode($data);
                if ($data === false) {
                    throw new \Exception('Failed to decode image');
                }

                $imageName = 'graphic_' . time() . '.' . $type;
                Storage::disk('public')->put('graphics/' . $imageName, $data);
                $validatedData['image'] = 'graphics/' . $imageName;
            }

            $graphic = Graphic::create($validatedData);

            return response()->json([
                'success' => true,
                'graphic' => $graphic,
                'message' => 'Graphic added successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding graphic: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'nullable|string',
                'page' => 'nullable|string',
                'status' => 'required|boolean'
            ]);

            $graphic = Graphic::findOrFail($id);

            if (!empty($validatedData['image']) && preg_match('/^data:image\/(\w+);base64,/', $validatedData['image'])) {
                // Delete old image
                if ($graphic->image) {
                    Storage::disk('public')->delete($graphic->image);
                }

                // Handle new image
                $data = substr($validatedData['image'], strpos($validatedData['image'], ',') + 1);
                $type = strtolower(preg_replace('/^data:image\/(\w+);base64,/', '', $validatedData['image']));

                $data = base64_decode($data);
                $imageName = 'graphic_' . time() . '.' . $type;
                Storage::disk('public')->put('graphics/' . $imageName, $data);
                $validatedData['image'] = 'graphics/' . $imageName;
            }

            $graphic->update($validatedData);

            return response()->json([
                'success' => true,
                'graphic' => $graphic,
                'message' => 'Graphic updated successfully'
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

            // Delete image file
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
