<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Requests\AboutRequest;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = About::query();

        if ($request->filled('search')) {
            $term = $request->get('search');
            $query->where('title', 'like', "%{$term}%");
        }

        $perPage = (int)($request->get('per_page', 10));
        $items = $query->orderByDesc('created_at')->paginate($perPage)->withQueryString();

        return view('admin.about.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about.create');
    }

    public function show(About $about)
    {
        return view('admin.about.show', compact('about'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutRequest $request)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'about_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload'), $filename);
            $data['image'] = 'upload/' . $filename;
        }

        // Handle video thumbnail upload
        if ($request->hasFile('video_thumbnail')) {
            $file = $request->file('video_thumbnail');
            $filename = 'about_thumb_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload'), $filename);
            $data['video_thumbnail'] = 'upload/' . $filename;
        }

        About::create($data);

        return redirect()->route('admin.about.index')
            ->with('success', 'About section created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutRequest $request, About $about)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'about_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload'), $filename);
            $data['image'] = 'upload/' . $filename;
        }

        // Handle video thumbnail upload
        if ($request->hasFile('video_thumbnail')) {
            $file = $request->file('video_thumbnail');
            $filename = 'about_thumb_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload'), $filename);
            $data['video_thumbnail'] = 'upload/' . $filename;
        }

        $about->update($data);

        return redirect()->route('admin.about.index')
            ->with('success', 'About section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        $about->delete();

        return redirect()->route('admin.about.index')
            ->with('success', 'About section deleted successfully.');
    }
}
