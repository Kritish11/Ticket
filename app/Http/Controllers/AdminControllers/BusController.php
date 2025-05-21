<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\BusStandard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::with(['standard'])->latest()->get();
        $standards = BusStandard::all();
        $features = \App\Models\BusFeature::all(); // Add this line
        return view('AdminViews.buses', compact('buses', 'standards', 'features'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'standard_id' => 'required|exists:bus_standards,id',
            'number_plate' => 'required|string|unique:buses',
            'seats' => 'required|integer|min:1',
            'driver_name' => 'required|string',
            'driver_license' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'driver_bill_book' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'images' => 'required|array|size:6',
            'images.*' => 'required|image|mimes:png',
            'features' => 'required|json'
        ]);

        try {
            // Handle driver documents first
            $licensePath = $request->file('driver_license')->store('driver-docs', 'public');
            $billBookPath = $request->file('driver_bill_book')->store('driver-docs', 'public');

            // Handle image uploads
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('bus-images', 'public');
                $images[] = $path;
            }

            $bus = Bus::create([
                'name' => $validated['name'],
                'standard_id' => $validated['standard_id'],
                'number_plate' => $validated['number_plate'],
                'seats' => $validated['seats'],
                'driver_name' => $validated['driver_name'],
                'driver_license' => $licensePath,
                'driver_bill_book' => $billBookPath,
                'images' => $images,
                'features' => json_decode($validated['features'], true)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Bus added successfully',
                'bus' => $bus
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding bus: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(Bus $bus)
    {
        return view('admin.buses.edit', compact('bus'));
    }

    public function update(Request $request, Bus $bus)
    {
        try {
            // Log incoming request data
            \Log::info('Update Request Data:', $request->all());

            $updateData = [
                'name' => $request->input('name'),
                'standard_id' => $request->input('standard_id'),
                'number_plate' => $request->input('number_plate'),
                'seats' => $request->input('seats'),
                'driver_name' => $request->input('driver_name'),
                'features' => json_decode($request->input('features'), true)
            ];

            // Handle driver license
            if ($request->hasFile('driver_license')) {
                Storage::disk('public')->delete($bus->driver_license);
                $updateData['driver_license'] = $request->file('driver_license')->store('driver-docs', 'public');
            }

            // Handle bill book
            if ($request->hasFile('driver_bill_book')) {
                Storage::disk('public')->delete($bus->driver_bill_book);
                $updateData['driver_bill_book'] = $request->file('driver_bill_book')->store('driver-docs', 'public');
            }

            // Handle images
            if ($request->hasFile('images')) {
                foreach ($bus->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
                $images = [];
                foreach ($request->file('images') as $image) {
                    $images[] = $image->store('bus-images', 'public');
                }
                $updateData['images'] = $images;
            }

            // Log update data before saving
            \Log::info('Update Data:', $updateData);

            $bus->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'Bus updated successfully',
                'bus' => $bus->fresh()
            ]);
        } catch (\Exception $e) {
            \Log::error('Update Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating bus: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Bus $bus)
    {
        try {
            // Delete images
            foreach ($bus->images as $image) {
                Storage::disk('public')->delete($image);
            }

            // Delete driver documents
            Storage::disk('public')->delete($bus->driver_license);
            Storage::disk('public')->delete($bus->driver_bill_book);

            $bus->delete();

            return response()->json([
                'success' => true,
                'message' => 'Bus deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting bus: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getBusDetails($id)
    {
        try {
            $bus = Bus::with(['standard'])->findOrFail($id);
            return response()->json([
                'success' => true,
                'bus' => $bus
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching bus details: ' . $e->getMessage()
            ], 500);
        }
    }
}
