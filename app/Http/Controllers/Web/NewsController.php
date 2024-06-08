<?php

namespace App\Http\Controllers\Web;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    // عرض جميع الأخبار
    public function index()
    {
        $news = News::all();
        return view('news.index', ['news' => $news]);
    }

    // عرض صفحة إضافة خبر جديد
    public function create()
    {
        return view('news.create');
    }

    // حفظ خبر جديد
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
            'photo' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->upload($request->file('photo'), 'news');
        }

        News::create($data);

        return redirect()->route('news.index')->with('success', 'تم إضافة الخبر بنجاح');
    }

    // عرض تفاصيل خبر معين
    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('news.show', ['news' => $news]);
    }

    // عرض صفحة تعديل خبر
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('news.edit', ['news' => $news]);
    }

    // تحديث خبر معين
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
            'photo' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $news = News::findOrFail($id);

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->upload($request->file('photo'), 'news');
        }

        $news->update($data);

        return redirect()->route('news.index')->with('success', 'تم تحديث الخبر بنجاح');
    }

    // حذف خبر معين
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('news.index')->with('success', 'تم حذف الخبر بنجاح');
    }

    // رفع الصور إلى مكان محدد
    private function upload($file, $directory)
    {
        $path = Storage::disk('public')->put($directory, $file);
        return Storage::url($path);
    }
}
