<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EventPopupRequest;

class EventPopupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventPopups = \App\Models\EventPopup::latest()->paginate(10);
        return view('admin.event-popups.index', compact('eventPopups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.event-popups.create');
    }

    public function show(string $id)
    {
        $eventPopup = \App\Models\EventPopup::findOrFail($id);
        return view('admin.event-popups.show', compact('eventPopup'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventPopupRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        \App\Models\EventPopup::create($validated);

        return redirect()->route('admin.event-popups.index')
            ->with('success', 'Event popup created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $eventPopup = \App\Models\EventPopup::findOrFail($id);
        return view('admin.event-popups.edit', compact('eventPopup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventPopupRequest $request, string $id)
    {
        $eventPopup = \App\Models\EventPopup::findOrFail($id);

        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        $eventPopup->update($validated);

        return redirect()->route('admin.event-popups.index')
            ->with('success', 'Event popup updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eventPopup = \App\Models\EventPopup::findOrFail($id);
        $eventPopup->delete();

        return redirect()->route('admin.event-popups.index')
            ->with('success', 'Event popup deleted successfully!');
    }
}
