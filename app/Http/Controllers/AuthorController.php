<?php

namespace App\Http\Controllers;

use App\Models\author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = author::where('status', 1)
            ->select('id', 'name', 'image')
            ->get();
        return response()->json(['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'required|string',
                'status' => 'boolean'
            ]);

            // Handle base64 image
            $base64Image = $validatedData['image'];
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $data = substr($base64Image, strpos($base64Image, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, gif

                if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                    throw new \Exception('Invalid image type');
                }

                $data = base64_decode($data);
                if ($data === false) {
                    throw new \Exception('Failed to decode image');
                }

                $imageName = 'author_' . time() . '.' . $type;
                Storage::disk('public')->put('authors/' . $imageName, $data);

                $author = author::create([
                    'name' => $validatedData['name'],
                    'image' => 'storage/authors/' . $imageName
                ]);

                return response()->json([
                    'success' => true,
                    'data' => $author,
                    'message' => 'Author added successfully'
                ]);
            } else {
                throw new \Exception('Invalid image format');
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding author: ' . $e->getMessage()
            ], 500);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\author  $author
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        try {
            $author = author::findOrFail($id);
            $author->status = !$author->status;
            $author->save();

            return response()->json([
                'success' => true,
                'message' => 'Author status updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating author status: ' . $e->getMessage()
            ], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $author = author::findOrFail($id);
            // Delete the associated image file
            if ($author->image) {
                $imagePath = str_replace('storage/', '', $author->image);
                Storage::disk('public')->delete($imagePath);
            }
            $author->delete();

            return response()->json([
                'success' => true,
                'message' => 'Author deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting author: ' . $e->getMessage()
            ], 500);
        }
    }

    // public function getActiveAuthors()
    // {
    //     try {
    //         $authors = author::where('status', 1)
    //             ->select('id', 'name', 'image')
    //             ->get();
    //         return response()->json([
    //             'success' => true,
    //             'authors' => $authors
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Error fetching active authors: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

}
