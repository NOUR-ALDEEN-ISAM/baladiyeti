<?php

namespace App\Http\Controllers;

use App\Http\Resources\InformationResource;
use App\Http\Trait\MobileResponse;
use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    use MobileResponse;

    // تحديث معلومة معينة
    public function update(Request $request, $id)
    {
        $information = Information::find($id);
        if (!$information) {
            return $this->fail("Information with ID $id not found.");
        }

        $information->update([
            'information' => $request->information
        ]);

        return $this->success(new InformationResource($information));
    }

    // حذف معلومة معينة
    public function delete($id)
    {
        $information = Information::find($id);
        if ($information) {
            $information->delete();
            return $this->success("Information with ID $id successfully deleted.");
        } else {
            return $this->fail("Information with ID $id not found.");
        }
    }

    // عرض معلومة معينة باستخدام المعرف
    public function one2($id)
    {
        $information = Information::find($id);
        if (!$information) {
            return $this->fail("Information with ID $id not found.");
        }

        return $this->success(new InformationResource($information));
    }

    // عرض معلومة معينة باستخدام معايير مختلفة (Request)
    public function one(Request $request)
    {
        $id = $request->id;
        $information = Information::find($id);
        if (!$information) {
            return $this->fail("Information with ID $id not found.");
        }

        return $this->success(new InformationResource($information));
    }

    // عرض جميع المعلومات
    public function all()
    {
        $informations = Information::all();
        return $this->success(InformationResource::collection($informations));
    }

    // إنشاء أو إضافة معلومة جديدة
    public function store(Request $request)
    {
        // التحقق من صحة المدخلات
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'seen' => 'required|string',
            'message' => 'required|string',
            'response' => 'required|string',
            'employee' => 'required|string',
        ]);

        // إنشاء المعلومة الجديدة
        $information = Information::create($validated);

        return $this->success(new InformationResource($information));
    }
}
