<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Resume;
use App\Models\WorkExperience;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index()
    {
        $resumes = Resume::all();

        return view('resumes.index', compact('resumes'));
    }

    public function create()
    {
        return view('resumes.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        // Validate the form data
        $request->validate([
            'username' => [
                'required',
                'regex:/^[a-zA-Z0-9._]+$/',
                'unique:resumes,username',
            ],
            'institution' => 'required|array',
            'institution.*' => 'required|string',
            'degree' => 'required|array',
            'degree.*' => 'required|string',
            'company' => 'required|array',
            'company.*' => 'required|string',
            'position' => 'required|array',
            'position.*' => 'required|string',
        ]);

        // Save Username
        $resume = new Resume();
        $resume->username = $request->input('username');
        $resume->save();

        // Save Education
        $educationData = array_combine($request->input('institution'), $request->input('degree'));
        foreach ($educationData as $institution => $degree) {
            $education = new Education();
            $education->resume_id = $resume->id;
            $education->institution = $institution;
            $education->degree = $degree;
            $education->save();
        }

        // Save Experience
        $experienceData = array_combine($request->input('company'), $request->input('position'));
        foreach ($experienceData as $company => $position) {
            $experience = new WorkExperience();
            $experience->resume_id = $resume->id;
            $experience->company = $company;
            $experience->position = $position;
            $experience->save();
        }

        return redirect()->route('resumes.index')->with('success', 'Data saved successfully!');
    }

    public function show($username)
    {
        $resumes = Resume::where('username', $username)
                    ->with('educations', 'workExperiences')
                    ->firstOrFail();

        $educations = $resumes->educations;
        $experiences = $resumes->workExperiences;

        return view('resumes.show', compact('resumes', 'educations', 'experiences'));
    }

    public function edit($username)
    {
        $resumes = Resume::where('username', $username)
                    ->with('educations', 'workExperiences')
                    ->firstOrFail();
        $educations = $resumes->educations;
        $experiences = $resumes->workExperiences;

        return view('resumes.edit', compact('resumes', 'educations', 'experiences'));
    }

    public function update(Request $request, $id)
    {
        // Find the specific Resume by its primary key
        $resume = Resume::findOrFail($id);

        // Update or Create Education
        if ($request->has('education')) {
            foreach ($request->input('education') as $educationData) {
                // dd(empty($educationData['id']));
                if (!empty($educationData['id'])) {
                    $education = Education::firstOrNew(['id' => $educationData['id']]);
                    $education->resume_id = $resume->id;
                    $education->institution = $educationData['institution'];
                    $education->degree = $educationData['degree'];
                    $education->save();
                } else {
                    $education = new Education();
                    $education->resume_id = $resume->id;
                    $education->institution = $educationData['institution'];
                    $education->degree = $educationData['degree'];
                    $education->save();
                }
            }
        }

        // Update or Create Experience
        if ($request->has('experience')) {
            foreach ($request->input('experience') as $experienceData) {
                if (!empty($experienceData['id'])) {
                    $experience = WorkExperience::firstOrNew(['id' => $experienceData['id']]);
                    $experience->resume_id = $resume->id;
                    $experience->company = $experienceData['company'];
                    $experience->position = $experienceData['position'];
                    $experience->save();
                } else {
                    $experience = new WorkExperience();
                    $experience->resume_id = $resume->id;
                    $experience->company = $experienceData['company'];
                    $experience->position = $experienceData['position'];
                    $experience->save();
                }
            }
        }

        return redirect()->route('resumes.index')->with('success', 'Resume updated successfully.');
    }

    public function destroy($id)
    {
        $resume = Resume::findOrFail($id);
        $resume->delete();

        return redirect('/resumes')->with('success', 'Resume deleted successfully.');
    }
}
