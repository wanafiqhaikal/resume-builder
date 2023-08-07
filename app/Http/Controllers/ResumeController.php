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
        // dd($request);
        // Find the specific Resume by its primary key
        $resume = Resume::findOrFail($id);

        // Update or Create Education
        if ($request->has('education')) {
            foreach ($request->input('education') as $educationData) {
                if (!empty($educationData['id'])) {
                    $education = Education::findOrFail($educationData['id']);
                    $education->update([
                        'institution' => $educationData['institution'],
                        'degree' => $educationData['degree'],
                    ]);
                } else {
                    $education = new Education([
                        'institution' => $educationData['institution'],
                        'degree' => $educationData['degree'],
                    ]);
                    $resume->educations()->save($education);
                }
            }
        }

        // Update or Create Experience
        if ($request->has('experience')) {
            foreach ($request->input('experience') as $experienceData) {
                if (!empty($experienceData['id'])) {
                    $experience = WorkExperience::findOrFail($experienceData['id']);
                    $experience->update([
                        'company' => $experienceData['company'],
                        'position' => $experienceData['position'],
                    ]);
                } else {
                    $experience = new WorkExperience([
                        'company' => $experienceData['company'],
                        'position' => $experienceData['position'],
                    ]);
                    $resume->workExperiences()->save($experience);
                }
            }
        }

        // Delete Education records
        if ($request->has('deleted_education_ids')) {
            foreach ($request->input('deleted_education_ids') as $deletedEducationId) {
                if (!in_array($deletedEducationId, array_column($request->input('education'), 'id'))) {
                    Education::where('id', $deletedEducationId)->delete();
                }
            }
        }

        // Delete Experience records
        if ($request->has('deleted_experience_ids')) {
            foreach ($request->input('deleted_experience_ids') as $deletedExperienceId) {
                if (!in_array($deletedExperienceId, array_column($request->input('experience'), 'id'))) {
                    WorkExperience::where('id', $deletedExperienceId)->delete();
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
