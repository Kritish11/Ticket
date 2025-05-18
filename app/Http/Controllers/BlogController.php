<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $blogs = Blog::with('author')->get()->map(function ($blog) {
                return [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'subtitle' => $blog->subtitle,
                    'featured_image' => $blog->featured_image,
                    'content' => $blog->content,  // Add this line
                    'author_id' => $blog->author_id,
                    'author_name' => $blog->author->name,
                    'author_image' => $blog->author->image,
                    'created_at' => $blog->created_at,
                    'status' => $blog->status
                ];
            });

            $activeAuthors = author::where('status', 1)->get();

            return response()->json([
                'success' => true,
                'blogs' => $blogs,
                'activeAuthors' => $activeAuthors
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching data: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'featured_image' => 'required|string',
                'content' => 'required|string',
                'author_id' => 'required|exists:authors,id',
                'status' => 'boolean'
            ]);

            // Handle base64 image
            $base64Image = $validatedData['featured_image'];
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

                $imageName = 'blog_' . time() . '.' . $type;
                Storage::disk('public')->put('blogs/' . $imageName, $data);

                $blog = blog::create([
                    'title' => $validatedData['title'],
                    'subtitle' => $validatedData['subtitle'],
                    'featured_image' => Storage::url('blogs/' . $imageName),
                    'content' => $validatedData['content'],
                    'author_id' => $validatedData['author_id'],
                    'status' => $validatedData['status'] ?? false
                ]);

                return response()->json([
                    'success' => true,
                    'blog' => $blog
                ], 201);
            } else {
                throw new \Exception('Invalid base64 image data');
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 422);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $blog = Blog::findOrFail($id);

            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'content' => 'required|string',
                'author_id' => 'required|exists:authors,id',
                'status' => 'boolean',
                'featured_image' => 'nullable|string'
            ]);

            // Handle new image if provided
            if (!empty($validatedData['featured_image']) && $validatedData['featured_image'] !== $blog->featured_image) {
                if (preg_match('/^data:image\/(\w+);base64,/', $validatedData['featured_image'], $type)) {
                    // Delete old image
                    $oldPath = str_replace('storage/', '', $blog->featured_image);
                    Storage::disk('public')->delete($oldPath);

                    // Save new image
                    $data = substr($validatedData['featured_image'], strpos($validatedData['featured_image'], ',') + 1);
                    $type = strtolower($type[1]);
                    $data = base64_decode($data);
                    $imageName = 'blog_' . time() . '.' . $type;
                    Storage::disk('public')->put('blogs/' . $imageName, $data);
                    $validatedData['featured_image'] = Storage::url('blogs/' . $imageName);
                }
            } else {
                unset($validatedData['featured_image']);
            }

            $blog->update($validatedData);

            return response()->json([
                'success' => true,
                'blog' => $blog,
                'message' => 'Blog updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 422);
        }
    }

    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);

            // Delete featured image
            if ($blog->featured_image) {
                $imagePath = str_replace('storage/', '', $blog->featured_image);
                Storage::disk('public')->delete($imagePath);
            }

            $blog->delete();

            return response()->json([
                'success' => true,
                'message' => 'Blog deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error deleting blog: ' . $e->getMessage()
            ], 422);
        }
    }
}
