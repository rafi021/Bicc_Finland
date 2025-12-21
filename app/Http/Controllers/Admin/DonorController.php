<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use Illuminate\Http\Request;
use App\Http\Requests\AdminDonorRequest;

class DonorController extends Controller
{
    public function index()
    {
        $donors = Donor::latest()->paginate(20);
        return view('admin.donors.index', compact('donors'));
    }

    public function create()
    {
        return view('admin.donors.create');
    }

    public function show(Donor $donor)
    {
        return view('admin.donors.show', compact('donor'));
    }

    public function store(AdminDonorRequest $request)
    {
        $data = $request->validated();
        $data['is_visible'] = $request->has('is_visible');
        Donor::create($data);
        return redirect()->route('admin.donors.index')->with('success', 'Donor added successfully.');
    }

    public function edit(Donor $donor)
    {
        return view('admin.donors.edit', compact('donor'));
    }

    public function update(AdminDonorRequest $request, Donor $donor)
    {
        $data = $request->validated();
        $data['is_visible'] = $request->has('is_visible');
        $donor->update($data);
        return redirect()->route('admin.donors.index')->with('success', 'Donor updated successfully.');
    }

    public function destroy(Donor $donor)
    {
        $donor->delete();
        return redirect()->route('admin.donors.index')->with('success', 'Donor deleted successfully.');
    }
}
