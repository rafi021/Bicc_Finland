<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    public function index()
    {
        $requests = ServiceRequest::with('service')->latest()->paginate(20);
        return view('admin.service_requests.index', compact('requests'));
    }

    public function destroy(ServiceRequest $serviceRequest)
    {
        $serviceRequest->delete();
        return redirect()->route('admin.service-requests.index')->with('success', 'Request deleted successfully.');
    }
}
