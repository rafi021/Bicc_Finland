<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryCategoryRequest;
use Illuminate\Support\Str;

class GalleryCategoryController extends Controller
{
    public function index()
    {
        $categories = GalleryCategory::latest()->paginate(10);
        return view('admin.gallery_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.gallery_categories.create');
    }

    public function show(GalleryCategory $galleryCategory)
    {
        return view('admin.gallery_categories.show', compact('galleryCategory'));
    }

    public function store(GalleryCategoryRequest $request)
    {
        GalleryCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.gallery-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(GalleryCategory $galleryCategory)
    {
        return view('admin.gallery_categories.edit', compact('galleryCategory'));
    }

    public function update(GalleryCategoryRequest $request, GalleryCategory $galleryCategory)
    {
        $galleryCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.gallery-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(GalleryCategory $galleryCategory)
    {
        $galleryCategory->delete();
        return redirect()->route('admin.gallery-categories.index')->with('success', 'Category deleted successfully.');
    }
}
