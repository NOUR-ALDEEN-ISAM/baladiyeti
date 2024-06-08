<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\Http\Trait\MobileResponse;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    use MobileResponse;

    // تحديث خبر معين
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
            'photo' => 'nullable|image',
        ]);

        $data = $validator->validated();

        $news = News::findOrFail($id);

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->upload($request->file('photo'), 'news');
        }

        $news->update($data);

        return $this->success(new NewsResource($news));
    }

    // حذف خبر معين
    public function delete($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return $this->success("News with ID $id deleted successfully.");
    }

    // عرض خبر معين
    public function show($id)
    {
        $news = News::findOrFail($id);
        return $this->success(new NewsResource($news));
    }

    // البحث عن خبر بناءً على ID
    public function find(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:news,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $news = News::findOrFail($request->id);
        return $this->success(new NewsResource($news));
    }

    // عرض جميع الأخبار
    public function all()
    {
        $news = News::all();
        return $this->success(NewsResource::collection($news));
    }

    // إضافة خبر جديد
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
            'photo' => 'nullable|image',
        ]);

        $data = $validator->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->upload($request->file('photo'), 'news');
        }

        $news = News::create($data);

        return $this->success(new NewsResource($news));
    }

    // رفع الصور إلى مكان محدد
    private function upload($file, $directory)
    {
        $path = Storage::disk('public')->put($directory, $file);
        return Storage::url($path);
    }
}
