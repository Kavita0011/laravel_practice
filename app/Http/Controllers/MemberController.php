<?php
namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
// List all members
    public function index()
{
    $members = Member::all();  // Fetch all members from DB
    // dd('hello');
    return view('dashboard.memberslist', compact('members')); // Pass it to the view
}
// show login
// Show form to create member
    public function create()
    {
        return view('dashboard.createmember'); // Return the view for creating a member
    }
    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'name' => 'required|string',
            'medicaid_id' => 'required|unique:members',
            'admission_date' => 'nullable|date',
            'discharge_date' => 'nullable|date|after_or_equal:admission_date',
        ]);

        $member = Member::create($request->all());
        return response()->json($member, 201);
    }

    public function show($id)
    {
        return Member::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string',
            'medicaid_id' => 'sometimes|required|unique:members,medicaid_id,' . $id,
            'admission_date' => 'nullable|date',
            'discharge_date' => 'nullable|date|after_or_equal:admission_date',
        ]);

        $member->update($request->all());
        return response()->json($member);
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return response()->json(['message' => 'Member deleted']);
    }
}
