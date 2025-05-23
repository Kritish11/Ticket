<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\BusStandard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BusController extends Controller
{
    public function index()
    {
        try {
            $buses = Bus::with('standard')->get();
            return response()->json([
                'success' => true,
                'buses' => $buses
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching buses: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string',
                'standard_id' => 'required|exists:bus_standards,id',
                'number_plate' => 'required|string|unique:buses',
                'seats' => 'required|integer|min:1',
                'driver_name' => 'required|string',
                'driver_license' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'driver_bill_book' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'images.*' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'features' => 'required'
            ]);

            // Handle images
            $images = [];
            if ($request->hasFile('images')) {
                $imageCount = count($request->file('images'));
                if ($imageCount > 6) {
                    throw new \Exception('Maximum 6 images are allowed. You provided ' . $imageCount);
                }

                foreach ($request->file('images') as $image) {
                    // Generate unique filename
                    $filename = uniqid('bus_') . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('bus-images', $filename, 'public');
                    $images[] = $path;
                }
            }

            // Handle file uploads
            $licensePath = $request->file('driver_license')->store('driver-docs', 'public');
            $billBookPath = $request->file('driver_bill_book')->store('driver-docs', 'public');

            // Create bus with JSON features
            $bus = Bus::create([
                'name' => $validated['name'],
                'standard_id' => $validated['standard_id'],
                'number_plate' => $validated['number_plate'],
                'seats' => $validated['seats'],
                'driver_name' => $validated['driver_name'],
                'driver_license' => $licensePath,
                'driver_bill_book' => $billBookPath,
                'images' => $images,
                'features' => json_decode($request->features) // Store features as JSON
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Bus added successfully',
                'bus' => $bus->load('standard')
            ]);

        } catch (\Exception $e) {
            Log::error('Bus creation failed: ' . $e->getMessage());
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

            // Validate new images if provided
            if ($request->hasFile('images')) {
                $request->validate([
                    'images.*' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                ]);
            }

            // Handle new images
            if ($request->hasFile('images')) {
                $imageCount = count($request->file('images'));
                if ($imageCount > 6) {
                    throw new \Exception('Maximum 6 images are allowed. You provided ' . $imageCount);
                }

                // Delete old images
                foreach ($bus->images ?? [] as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }

                $images = [];
                foreach ($request->file('images') as $image) {
                    $filename = uniqid('bus_') . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('bus-images', $filename, 'public');
                    $images[] = $path;
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

    public function getBuses()
    {
        try {
            $buses = Bus::with('standard')->get();
            return response()->json([
                'success' => true,
                'buses' => $buses
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching buses: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getBusesList()
    {
        try {
            Log::info('Fetching buses list'); // Debug log

            $buses = Bus::with(['standard'])
                ->where('status', true)  // Only get active buses
                ->get()
                ->map(function($bus) {
                    Log::info('Processing bus:', ['bus' => $bus->toArray()]); // Debug log

                    return [
                        'id' => $bus->id,
                        'name' => $bus->name,
                        'number_plate' => $bus->number_plate,
                        'type' => $bus->standard->name ?? 'N/A',
                        'seats' => $bus->seats,
                        'display_name' => "{$bus->name} ({$bus->number_plate})"
                    ];
                });

            Log::info('Buses list response:', ['buses' => $buses->toArray()]); // Debug log

            return response()->json([
                'success' => true,
                'buses' => $buses
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching buses: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Error fetching buses'
            ], 500);
        }
    }
}
