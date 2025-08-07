<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    public function index(Request $request)
        {
            $query = Opportunity::query();
            if ($request->has('search')) {
                $query->where('title', 'like', '%' . $request->search . '%');
            }
            if ($request->has('category')) {
                $query->where('category_id', $request->category);
            }
            $opportunities = $query->get();
            return view('opportunities.index', compact('opportunities'));
        }
}


