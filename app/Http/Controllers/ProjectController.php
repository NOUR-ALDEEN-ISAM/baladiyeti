<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Http\Trait\MobileResponse;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    use MobileResponse;

    // تحديث مشروع
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

    // حذف مشروع
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

    // إحضار مشروع بواسطة معرّف محدد
    public function one2($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return $this->fail("Project with ID $id not found.");
        }

        return $this->success(new ProjectResource($project));
    }

    // إحضار مشروع بناءً على طلب معرّف في الطلب
    public function one(Request $request)
    {
        $id = $request->id;
        $project = Project::find($id);
        if (!$project) {
            return $this->fail("Project with ID $id not found.");
        }

        return $this->success(new ProjectResource($project));
    }

    // إحضار جميع المشاريع
    public function all()
    {
        $projects = Project::all();
        return $this->success(ProjectResource::collection($projects));
    }

    // إضافة مشروع جديد
    public function add(Request $request)
    {
        // التحقق من المدخلات المطلوبة
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|string',
            'photo' => 'nullable|image'
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

        return $this->success(new ProjectResource($project));
    }

    // رفع الصور إلى مكان محدد
    private function upload($file, $directory)
    {
        $path = Storage::disk('public')->put($directory, $file);
        return Storage::url($path);
    }
}
