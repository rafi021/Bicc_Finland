<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IslamicClass;
use App\Models\ClassRegistration;
use Illuminate\Http\Request;
use App\Http\Requests\IslamicClassRequest;

class IslamicClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = IslamicClass::latest()->paginate(10);
        return view('admin.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.classes.create');
    }

    public function show(IslamicClass $class)
    {
        return view('admin.classes.show', compact('class'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IslamicClassRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'class_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/classes'), $filename);
            $data['image'] = 'upload/classes/' . $filename;
        }

        IslamicClass::create($data);

        return redirect()->route('admin.classes.index')->with('success', 'Class created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $class = IslamicClass::findOrFail($id);
        return view('admin.classes.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IslamicClassRequest $request, string $id)
    {
        $class = IslamicClass::findOrFail($id);
        
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'class_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/classes'), $filename);
            $data['image'] = 'upload/classes/' . $filename;
        }

        $class->update($data);

        return redirect()->route('admin.classes.index')->with('success', 'Class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $class = IslamicClass::findOrFail($id);
        $class->delete();
        return redirect()->route('admin.classes.index')->with('success', 'Class deleted successfully.');
    }

    /**
     * Display a listing of registrations.
     */
    public function registrations()
    {
        $registrations = ClassRegistration::with('islamicClass')->latest()->paginate(20);
        return view('admin.classes.registrations', compact('registrations'));
    }
}
