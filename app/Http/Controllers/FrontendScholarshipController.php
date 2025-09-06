<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;

class FrontendScholarshipController extends Controller
{
    /**
     * Display a listing of scholarships for frontend
     */
        public function index()
    {
        $scholarships = Scholarship::where('status', 'active')
            ->orderBy('application_deadline', 'asc')
            ->paginate(12);

        return view('frontend.scholarships', compact('scholarships'));
    }

    /**
     * Display the specified scholarship for frontend
     */
    public function show(Scholarship $scholarship)
    {
        return view('frontend.scholarship-detail', compact('scholarship'));
    }
}
