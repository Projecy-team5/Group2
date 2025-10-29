<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scholarship;
use App\Models\ScholarshipImage;
use Illuminate\Support\Facades\Log;

class ScholarshipController extends Controller
{
    /**
     * Show the form for creating a new scholarship.
     */
    public function index()
    {
        $scholarships = Scholarship::paginate(10);
        return view('admin.scholarships.index', compact('scholarships'));
    }
    public function create()
    {
        return view('admin.scholarships.create');
    }
    public function show(Scholarship $scholarship)
    {
        return view('admin.scholarships.show', compact('scholarship'));

    }
    // Show edit form
    public function edit(Scholarship $scholarship)
    {
        return view('admin.scholarships.edit', compact('scholarship'));
    }

    /**
     * Store a newly created scholarship in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming request data
        $validatedData = $request->validate([
            'scholarship_name' => 'required|string|max:255',
            'eligibility_criteria' => 'required|string',
            'award_amount' => 'required|string|max:255',
            'application_description' => 'required|string',
            'country' => 'required|string|max:255',
            'application_requirements' => 'required|array',
            'application_deadline' => 'required|date|after:today',
            'status' => 'required|in:active,inactive,closed',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Debug: Check uploaded files - uncomment below to see what is being uploaded
        // dd($request->file('gallery_images'));

        // We'll check the number of uploaded files for this new scholarship
        $uploadedCount = $request->hasFile('gallery_images') ? count($request->file('gallery_images')) : 0;
        if ($uploadedCount > 10) {
            return back()->withInput()->withErrors(['gallery_images' => 'You may upload up to 10 images only!']);
        }

        // 2. Create a new scholarship instance with the validated data
        $scholarship = new Scholarship;
        $scholarship->scholarship_name = $validatedData['scholarship_name'];
        $scholarship->eligibility_criteria = $validatedData['eligibility_criteria'];
        $scholarship->award_amount = $validatedData['award_amount'];
        $scholarship->application_description = $validatedData['application_description'];
        $scholarship->country = $validatedData['country'];
        $scholarship->application_requirements = $validatedData['application_requirements'];
        $scholarship->application_deadline = $validatedData['application_deadline'];
        $scholarship->status = $validatedData['status'];

        // 3. Save the scholarship to the database
        $scholarship->save();

        // 4. Save gallery images if present
        if ($request->hasFile('gallery_images')) {
            Log::info('Gallery images are present.');
            foreach ($request->file('gallery_images') as $image) {
                Log::info('Processing image: ' . $image->getClientOriginalName());
                try {
                    $path = $image->store('scholarship_gallery', 'public');
                    Log::info('Image path: ' . $path);
                    $scholarshipImage = ScholarshipImage::create([
                        'scholarship_id' => $scholarship->id,
                        'image_path' => $path,
                    ]);
                    Log::info('Scholarship ID: ' . $scholarship->id);
                } catch (\Exception $e) {
                    Log::error('Error uploading image: ' . $e->getMessage());
                }
                Log::info('Image processing complete.');
            }
        }

        // 5. Redirect the user to the index page with a success message
        return redirect()->route('admin.scholarships.index')->with('success', 'Scholarship created successfully!');
    }
    public function destroy(Scholarship $scholarship)
    {
        $scholarship->delete();
        return redirect()->route('admin.scholarships.index')->with('success', 'Scholarship deleted successfully.');
    }
    public function update(Request $request, Scholarship $scholarship)
    {
        $validated = $request->validate([
            'scholarship_name' => 'required|string|max:255',
            'award_amount' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'eligibility_criteria' => 'required|string',
            'application_description' => 'required|string',
            'application_requirements' => 'required|array|min:1',
            'application_deadline' => 'required|date|after:today',
            'status' => 'required|in:active,inactive,closed',
        ]);

        $scholarship->update($validated);

        return redirect()->route('admin.scholarships.index')->with('success', 'Scholarship updated successfully.');
    }
}
