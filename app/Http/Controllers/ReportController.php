<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReportResource;
use App\Http\Trait\MobileResponse;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    use MobileResponse;

    // تحديث تقرير
    public function update(Request $request, $id)
    {
        $report = Report::find($id);
        if (!$report) {
            return $this->fail("Report with ID $id not found.");
        }

        // تحميل الصورة وتحديث التقرير
        $file = $request->file('photo_1');
        $url = $file ? $this->uploadFile($file, 'Reports') : $report->photo_1;

        $report->update([
            'text_1' => $request->text_1 ?? $report->text_1,
            'photo_1' => $url,
            'location' => $request->location ?? $report->location,
            'seen' => $request->seen ?? $report->seen,
            'report_date' => $request->report_date ?? $report->report_date, // إضافة تاريخ التقرير
        ]);

        return $this->success(new ReportResource($report));
    }

    // حذف تقرير
    public function delete($id)
    {
        $report = Report::find($id);
        if ($report) {
            $report->delete();
            return $this->success("Report with ID $id deleted successfully.");
        } else {
            return $this->fail("Report with ID $id not found.");
        }
    }

    // إحضار تقرير بواسطة معرّف محدد
    public function one2($id)
    {
        $report = Report::find($id);
        if (!$report) {
            return $this->fail("Report with ID $id not found.");
        }

        return $this->success(new ReportResource($report));
    }

    // إحضار تقرير بناءً على طلب معرّف في الطلب
    public function one(Request $request)
    {
        $id = $request->id;
        $report = Report::find($id);
        if (!$report) {
            return $this->fail("Report with ID $id not found.");
        }

        return $this->success(new ReportResource($report));
    }

    // إحضار جميع التقارير
    public function all()
    {
        $reports = Report::all();
        return $this->success(ReportResource::collection($reports));
    }

    // إضافة تقرير جديد
    public function add(Request $request)
    {
        // التحقق من المدخلات المطلوبة
        $request->validate([
            'id_num' => 'required|integer',
            'seen' => 'required|string',
            'section_id' => 'required|integer',
            'location' => 'required|string',
            'text_1' => 'required|string',
            'photo_1' => 'required|file|image|max:2048', // مثال: حجم أقصى 2 ميغابايت
            'report_date' => 'required|date', // إضافة التحقق من التاريخ
        ]);

        // تحميل الصورة
        $url1 = $this->uploadFile($request->file('photo_1'), 'Reports');

        // إنشاء التقرير
        $report = Report::create([
            'id_num' => $request->id_num,
            'seen' => $request->seen,
            'section_id' => $request->section_id,
            'location' => $request->location,
            'text_1' => $request->text_1,
            'photo_1' => $url1,
            'report_date' => $request->report_date, // إضافة تاريخ التقرير
        ]);

        return $this->success(new ReportResource($report));
    }

    // دالة لتحميل الملفات
    private function uploadFile($file, $directory)
    {
        $path = Storage::disk('public')->put($directory, $file);
        return Storage::url($path);
    }
}
