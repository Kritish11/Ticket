<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'status' => 'required|in:active,inactive' // Add status validation
            ]);

            $imagePath = $request->file('image')->store('banner-ads', 'public');

            $banner = Banner::create([
                'title' => $validated['title'],
                'image' => $imagePath,
                'status' => $validated['status'] // Use the provided status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Banner added successfully',
                'banner' => $banner
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding banner: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Banner $banner)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'status' => 'required|in:active,inactive'
            ]);

            if ($request->hasFile('image')) {
                // Delete old image
                Storage::disk('public')->delete($banner->image);
                // Store new image
                $validated['image'] = $request->file('image')->store('banner-ads', 'public');
            }

            $banner->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Banner updated successfully',
                'banner' => $banner
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating banner: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Banner $banner)
    {
        try {
            // Delete the image file
            Storage::disk('public')->delete($banner->image);
            // Delete the banner record
            $banner->delete();

            return response()->json([
                'success' => true,
                'message' => 'Banner deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting banner: ' . $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        try {
            $banners = Banner::latest()->get();
            return response()->json([
                'success' => true,
                'banners' => $banners
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching banners: ' . $e->getMessage()
            ], 500);
        }
    }
}
