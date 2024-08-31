<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\CreateBlogRequest;
use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        $user = auth()->user();
        $data = Blog::orderByDesc("created_at")->paginate(20);
        return view("dashboard.pages.blogs.index", compact("data"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('create posts')) {
            abort(403, 'Unauthorized action.');
        }
        $allTags = Tag::all();
        return view('dashboard.pages.blogs.create', compact('allTags'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBlogRequest $request)
    {
        if (!auth()->user()->can('create posts')) {
            abort(403, 'Unauthorized action.');
        }

        DB::beginTransaction();
        try {
            if ($request->hasFile('file_path')) {
                $file = $request->file('file_path');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'blog_' . uniqid() . '.' . $extension;
                $filePath = $file->storeAs('public/files', $fileName);
            } else {
                $filePath = null;
            }
            $blog = Blog::create([
                'title' => $request->input('title'),
                'status' => $request->input('status'),
                'user_id' => auth()->id(),
                'file_path' => $filePath,
                'body' => $request->input('body'),
            ]);
            $tags = array_map('trim', $request->input('tags', []));
            $tagIds = [];
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
            $blog->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('blogs.index')->with('message', 'Blog created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating blog: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create blog']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if (!auth()->user()->can('update posts')) {
            abort(403, 'Unauthorized action.');
        }

        $allTags = Tag::all();
        $blogTags = $blog->tags->pluck('name')->toArray();

        return view('dashboard.pages.blogs.edit', compact('blog', 'allTags', 'blogTags'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CreateBlogRequest $request, Blog $blog)
    {
        if (!auth()->user()->can('update posts')) {
            abort(403, 'Unauthorized action.');
        }

        DB::beginTransaction();
        try {
            $filePath = $blog->file_path;
            if ($request->hasFile('file_path')) {
                if ($filePath) {
                    Storage::delete($filePath);
                }
                $file = $request->file('file_path');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'blog_' . uniqid() . '.' . $extension;
                $filePath = $file->storeAs('public/files', $fileName);
            }
            $blog->update([
                'title' => $request->input('title'),
                'status' => $request->input('status'),
                'file_path' => $filePath,
                'body' => $request->input('body'),
            ]);
            $tags = $request->input('tags', []);
            $tagIds = [];
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
            $blog->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('blogs.index')->with('message', 'Blog updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating blog: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to update blog']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        DB::beginTransaction();
        try {
            if ($blog->file_path) {
                Storage::delete($blog->file_path);
            }
            $blog->delete();
            DB::commit();
            return redirect()->route('blogs.index')->with('message', 'Blog deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting blog: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to delete blog']);
        }
    }

    public function show(Blog $blog)
    {
        return view("dashboard.pages.blogs.show", compact("blog"));
    }
}
