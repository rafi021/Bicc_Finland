<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommunityMember;
use Illuminate\Http\RedirectResponse;

class CommunityMemberController extends Controller
{
    public function index()
    {
        $members = CommunityMember::latest('created_at')->paginate(20);
        return view('admin.community.index', compact('members'));
    }

    public function destroy(CommunityMember $member): RedirectResponse
    {   
        $member->delete();
        return redirect()->back()->with('success', 'Member deleted successfully.');
    }
}
