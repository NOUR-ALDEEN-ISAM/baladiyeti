<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Trait\MobileResponse;

class ProjectController extends Controller
{
    // Trait usage for mobile response
    use MobileResponse;

    // Update a project
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return $this->fail("Project with ID $id not found.");
        }

        $url = $project->photo;
        if ($request->hasFile('photo')) {
            $url = $this->upload($request->file('photo'), 'projects');
        }

        $project->update([
            'name' => $request->name ?? $project->name,
            'description' => $request->description ?? $project->description,
            'start_date' => $request->start_date ?? $project->start_date,
            'end_date' => $request->end_date ?? $project->end_date,
            'status' => $request->status ?? $project->status,
            'photo' => $url,
        ]);

        return $this->success(new ProjectResource($project));
    }

    // Delete a project
    public function delete($id)
    {
        $project = Project::find($id);
        if ($project) {
            $project->delete();
            return $this->success("Project with ID $id deleted successfully.");
        } else {
            return $this->fail("Project with ID $id not found.");
        }
    }

    // Fetch a project by ID
    public function one2($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return $this->fail("Project with ID $id not found.");
        }

        return $this->success(new ProjectResource($project));
    }

    // Fetch a project based on request ID
    public function one(Request $request)
    {
        $id = $request->id;
        $project = Project::find($id);
        if (!$project) {
            return $this->fail("Project with ID $id not found.");
        }

        return $this->success(new ProjectResource($project));
    }

    // Fetch all projects
    public function all()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    // Add a new project
    public function add(Request $request)
    {
        // Validate required inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|string|in:planned,ongoing,completed,on-hold,canceled',
            'photo' => 'nullable|image|max:2048'
        ], [
            'name.required' => 'اسم المشروع مطلوب.',
            'description.required' => 'وصف المشروع مطلوب.',
            'start_date.required' => 'تاريخ البدء مطلوب.',
            'end_date.required' => 'تاريخ الانتهاء مطلوب.',
            'end_date.after' => 'تاريخ الانتهاء يجب أن يكون بعد تاريخ البدء.',
            'status.in' => 'الحالة يجب أن تكون واحدة من: مخطط، قيد التنفيذ، مكتمل، متوقف، ملغى.',
            'photo.image' => 'الصورة يجب أن تكون من نوع صورة.',
            'photo.max' => 'الصورة يجب أن لا تتجاوز 2 ميجابايت.'
        ]);
    
        $data = $request->only([
            'name',
            'description',
            'start_date',
            'end_date',
            'status'
        ]);
    
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->upload($request->file('photo'), 'projects');
        } else {
            $data['photo'] = null; // Set to null if no photo is provided
        }
    
        $project = Project::create($data);
    
        return redirect()->route('projects.all')->with('success', 'Project added successfully.');
    }

    // Upload photos to a specific location
    private function upload($file, $directory)
    {
        $path = Storage::disk('public')->put($directory, $file);
        return Storage::url($path);
    }
}
