<?php

namespace App\Http\Controllers;

use App\Http\Resources\SectionResource;
use App\Http\Trait\MobileResponse;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    use MobileResponse;

    // تحديث قسم
    public function update(Request $request, $id)
    {
        // العثور على القسم باستخدام معرّف
        $section = Section::find($id);
        if (!$section) {
            return $this->fail("Section with ID $id not found.");
        }

        // تحديث القسم
        $section->update([
            'name' => $request->name,
            'manager' => $request->manager
        ]);

        return $this->success(new SectionResource($section));
    }

    // حذف قسم
    public function delete($id)
    {
        $section = Section::find($id);
        if ($section) {
            $section->delete();
            return $this->success("Section with ID $id deleted successfully.");
        } else {
            return $this->fail("Section with ID $id not found.");
        }
    }

    // إحضار قسم بواسطة معرّف
    public function one2($id)
    {
        $section = Section::find($id);
        if (!$section) {
            return $this->fail("Section with ID $id not found.");
        }

        return $this->success(new SectionResource($section));
    }

    // إحضار قسم بناءً على معرّف من الطلب
    public function one(Request $request)
    {
        $id = $request->id;
        $section = Section::find($id);
        if (!$section) {
            return $this->fail("Section with ID $id not found.");
        }

        return $this->success(new SectionResource($section));
    }

    // إحضار كل الأقسام
    public function all()
    {
        $sections = Section::all();
        return $this->success(SectionResource::collection($sections));
    }

    // إضافة قسم جديد
    public function add(Request $request)
    {
        // تحقق من المدخلات المطلوبة
        $request->validate([
            'name' => 'required|string|max:255',
            'manager' => 'required|string|max:255'
        ]);

        // إنشاء القسم الجديد
        $section = Section::create([
            'name' => $request->name,
            'manager' => $request->manager
        ]);

        return $this->success(new SectionResource($section));
    }
}
