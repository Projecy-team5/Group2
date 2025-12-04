<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scholarship;
use App\Models\ScholarshipImage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ScholarshipController extends Controller
{
    /**
     * Show the form for creating a new scholarship.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['name', 'country', 'status', 'start_date', 'end_date']);

        $scholarships = Scholarship::query()
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('scholarship_name', 'like', '%' . $request->name . '%');
            })
            ->when($request->filled('country'), function ($query) use ($request) {
                $query->where('country', 'like', '%' . $request->country . '%');
            })
            ->when($request->filled('status') && $request->status !== 'all', function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('start_date') && $request->filled('end_date'), function ($query) use ($request) {
                try {
                    $start = Carbon::parse($request->start_date)->startOfDay();
                    $end = Carbon::parse($request->end_date)->endOfDay();
                    $query->whereBetween('application_deadline', [$start, $end]);
                } catch (\Exception $e) {
                    // Ignore invalid date formats to avoid crashing the page
                }
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.scholarships.index', compact('scholarships', 'filters'));
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
        'scholarship_name'         => 'required|string|max:255',
        'award_amount'             => 'required|numeric|min:0',
        'country'                  => 'required|string|max:255',
        'status'                   => 'required|in:active,inactive,closed',
        'eligibility_criteria'     => 'required|string',
        'application_description'  => 'required|string',
        'application_requirements' => 'required|array|min:1',
        'application_requirements.*' => 'required|string',
        'application_deadline'     => 'required|date',

        'gallery_images'           => 'nullable|array',
        'gallery_images.*'         => 'image|mimes:jpeg,jpg,png|max:2048',

        'remove_gallery_images'    => 'nullable|array',
        'remove_gallery_images.*'  => 'integer|exists:scholarship_images,id',
    ]);

    // Update text fields
    $scholarship->update($validated);

    // Remove selected images
    if ($request->filled('remove_gallery_images')) {
        ScholarshipImage::whereIn('id', $request->remove_gallery_images)
            ->where('scholarship_id', $scholarship->id)
            ->delete();
    }

    // Add new images (max 10 total)
    if ($request->hasFile('gallery_images')) {
        $current = $scholarship->images()->count();
        $removed = $request->filled('remove_gallery_images') ? count($request->remove_gallery_images) : 0;
        $allowed = 10 - ($current - $removed);

        if (count($request->file('gallery_images')) > $allowed) {
            return back()->withErrors(['gallery_images' => "You can only have max 10 images. Remove some first."]);
        }

        foreach ($request->file('gallery_images') as $image) {
            $path = $image->store('scholarship_gallery', 'public');
            ScholarshipImage::create([
                'scholarship_id' => $scholarship->id,
                'image_path'     => $path,
            ]);
        }
    }
    return redirect()
        ->route('admin.scholarships.index')
        ->with('success', 'Your update has been successful.');
}
}
