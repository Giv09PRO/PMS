<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Fee::where('status', 'pending')->get();
        return view('fees.index', compact('fees'));
    }

    public function create()
    {
        return view('fees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'student_id' => 'required|exists:students,id',
            // Other validations...
        ]);

        Fee::create($request->all());
        return redirect()->route('fees.index')->with('success', 'Fee created successfully.');
    }

    public function edit(Fee $fee)
    {
        return view('fees.edit', compact('fee'));
    }

    public function update(Request $request, Fee $fee)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'status' => 'required|string',
            // Other validations...
        ]);

        $fee->update($request->all());
        return redirect()->route('fees.index')->with('success', 'Fee updated successfully.');
    }

    public function destroy(Fee $fee)
    {
        $fee->delete();
        return redirect()->route('fees.index')->with('success', 'Fee deleted successfully.');
    }
}
