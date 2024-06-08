<?php
namespace App\Http\Controllers;

use App\Http\Resources\TourismResource;
use App\Http\Trait\MobileResponse;
use App\Models\Tourism;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourismController extends Controller
{
    use MobileResponse;

    // تحديث وجهة سياحية
    public function update(Request $request, $id)
    {
        // العثور على وجهة باستخدام معرّف
        $tourism = Tourism::find($id);
        if (!$tourism) {
            return $this->fail("Tourism destination with ID $id not found.");
        }

        // تحميل الصورة إن وجدت
        $url = null;
        if ($request->hasFile('photo')) {
            $url = $this->upload($request->file('photo'), 'Tourisms');
        }

        // تحديث وجهة السياحة
        $tourism->update([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'photo' => $url ?? $tourism->photo,
            'location_id' => $request->location_id // Add this line
        ]);

        return $this->success(new TourismResource($tourism));
    }

    // حذف وجهة سياحية
    public function delete($id)
    {
        $tourism = Tourism::find($id);
        if ($tourism) {
            $tourism->delete();
            return $this->success("Tourism destination with ID $id deleted successfully.");
        } else {
            return $this->fail("Tourism destination with ID $id not found.");
        }
    }

    // إحضار وجهة سياحية بواسطة معرّف
    public function one2($id)
    {
        $tourism = Tourism::find($id);
        if (!$tourism) {
            return $this->fail("Tourism destination with ID $id not found.");
        }

        return $this->success(new TourismResource($tourism));
    }

    // إحضار وجهة سياحية بناءً على معرّف من الطلب
    public function one(Request $request)
    {
        $id = $request->id;
        $tourism = Tourism::find($id);
        if (!$tourism) {
            return $this->fail("Tourism destination with ID $id not found.");
        }

        return $this->success(new TourismResource($tourism));
    }

    // إحضار كل الوجهات السياحية
    public function all()
    {
        $tourisms = Tourism::all();
        return $this->success(TourismResource::collection($tourisms));
    }

    // إضافة وجهة سياحية جديدة
    public function add(Request $request)
    {
        // تحقق من المدخلات المطلوبة
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'photo' => 'required|image',
            'location_id' => 'required|exists:locations,id' // Add validation for location_id
        ]);

        // تحميل الصورة
        $path = Storage::disk('public')->put('Tourisms', $request->file('photo'));
        $url = Storage::url($path);

        // إنشاء الوجهة الجديدة
        $tourism = Tourism::create([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'photo' => $url,
            'location_id' => $request->location_id // Add this line
        ]);

        return $this->success(new TourismResource($tourism));
    }
}
