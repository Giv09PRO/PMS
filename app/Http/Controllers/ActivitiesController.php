
<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivitiesController extends Controller
{
    public function index()
    {
        $activities = Activity::latest()->paginate(10);
        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required|max:255',
        ]);

        $activity = Activity::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'location' => $validated['location'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('activities.index')->with('success', 'Activity created successfully');
    }

    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required|max:255',
        ]);

        $activity->update($validated);

        return redirect()->route('activities.index')->with('success', 'Activity updated successfully');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully');
    }
}
