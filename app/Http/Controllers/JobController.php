<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobResource;
use App\Http\Trait\MobileResponse;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    use MobileResponse;

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        $job->update([
            'job' => $request->job
        ]);
        return $this->success(new JobResource($job));
    }

    public function delete($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return $this->success("Job with ID $id deleted successfully.");
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);
        return $this->success(new JobResource($job));
    }

    public function find(Request $request)
    {
        $job = Job::findOrFail($request->id);
        return $this->success(new JobResource($job));
    }

    public function all()
    {
        $jobs = Job::all();
        return $this->success(JobResource::collection($jobs));
    }

    public function add(Request $request)
    {
        $job = Job::create([
            'name' => $request->name,
            'skills' => $request->skills,
            'status' => $request->status,
            'section_id' => $request->section_id,
            'user_id' => $request->user_id,

        ]);

        return $this->success(new JobResource($job));
    }
}
