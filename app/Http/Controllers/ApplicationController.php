<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Scholarship;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // Store a new application
    public function store(Request $request, Scholarship $scholarship)
    {
        $request->validate([
            'motivation_essay' => 'required|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        Application::create([
            'user_id' => Auth::id(),
            'scholarship_id' => $scholarship->id,
            'motivation_essay' => $request->motivation_essay,
            'resume' => $resumePath,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('success', 'Application submitted!');
    }

    // List all applications for admin
    public function index()
    {
        $applications = Application::with(['user', 'scholarship'])->latest()->paginate(20);
        return view('admin.applications.index', compact('applications'));
    }
}
