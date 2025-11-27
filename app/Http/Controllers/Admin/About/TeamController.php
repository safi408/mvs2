<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    //
    public function AboutTeam(){
        $team = TeamMember::first();
        return view('admin.about.aboutteam', compact('team'));
    }

    public function update(Request $request)
{
  

    $request->validate([
        'name_1' => 'required|string|max:255',
        'destination_1' => 'required|string|max:255',
        'facebook_1' => 'nullable|url|max:255',
        'image_1' => 'nullable|image|max:2048',

        'name_2' => 'required|string|max:255',
        'destination_2' => 'required|string|max:255',
        'facebook_2' => 'nullable|url|max:255',
        'image_2' => 'nullable|image|max:2048',

        'name_3' => 'required|string|max:255',
        'destination_3' => 'required|string|max:255',
        'facebook_3' => 'nullable|url|max:255',
        'image_3' => 'nullable|image|max:2048',

        'name_4' => 'required|string|max:255',
        'destination_4' => 'required|string|max:255',
        'facebook_4' => 'nullable|url|max:255',
        'image_4' => 'nullable|image|max:2048',
    ]);



  $teamMembers = TeamMember::first() ?? new TeamMember();

    // Member 1
    $teamMembers->name_1 = $request->name_1;
    $teamMembers->destination_1 = $request->destination_1;
    $teamMembers->facebook_1 = $request->facebook_1;
    if ($request->hasFile('image_1')) {
        if ($teamMembers->image_1 && Storage::disk('public')->exists($teamMembers->image_1)) {
            Storage::disk('public')->delete($teamMembers->image_1);
        }
        $teamMembers->image_1 = $request->file('image_1')->store('team_members', 'public');
    }

    // Member 2
    $teamMembers->name_2 = $request->name_2;
    $teamMembers->destination_2 = $request->destination_2;
    $teamMembers->facebook_2 = $request->facebook_2;
    if ($request->hasFile('image_2')) {
        if ($teamMembers->image_2 && Storage::disk('public')->exists($teamMembers->image_2)) {
            Storage::disk('public')->delete($teamMembers->image_2);
        }
        $teamMembers->image_2 = $request->file('image_2')->store('team_members', 'public');
    }

    // Member 3
    $teamMembers->name_3 = $request->name_3;
    $teamMembers->destination_3 = $request->destination_3;
    $teamMembers->facebook_3 = $request->facebook_3;
    if ($request->hasFile('image_3')) {
        if ($teamMembers->image_3 && Storage::disk('public')->exists($teamMembers->image_3)) {
            Storage::disk('public')->delete($teamMembers->image_3);
        }
        $teamMembers->image_3 = $request->file('image_3')->store('team_members', 'public');
    }

    // Member 4
    $teamMembers->name_4 = $request->name_4;
    $teamMembers->destination_4 = $request->destination_4;
    $teamMembers->facebook_4 = $request->facebook_4;
    if ($request->hasFile('image_4')) {
        if ($teamMembers->image_4 && Storage::disk('public')->exists($teamMembers->image_4)) {
            Storage::disk('public')->delete($teamMembers->image_4);
        }
        $teamMembers->image_4 = $request->file('image_4')->store('team_members', 'public');
    }

    $teamMembers->save();

    return redirect()->back()->with('success', 'Team Members updated successfully!');
}

}
