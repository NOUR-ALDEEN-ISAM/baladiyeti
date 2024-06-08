<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // عرض قائمة المواقع
    public function index()
    {
        $locations = Location::all();
        return response()->json($locations, 200);
    }

    // تخزين موقع جديد في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $location = Location::create($request->all());

        return response()->json(['message' => 'تمت إضافة الموقع بنجاح', 'data' => $location], 201);
    }

    // عرض تفاصيل موقع محدد
    public function show($id)
    {
        $location = Location::findOrFail($id);
        return response()->json($location, 200);
    }

    // تحديث موقع محدد في قاعدة البيانات
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $location = Location::findOrFail($id);
        $location->update($request->all());

        return response()->json(['message' => 'تم تحديث الموقع بنجاح', 'data' => $location], 200);
    }

    // حذف موقع محدد من قاعدة البيانات
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return response()->json(['message' => 'تم حذف الموقع بنجاح'], 200);
    }

    // تخصيص موقع كموقع خاص
    public function makeSpecial($id)
    {
        $location = Location::findOrFail($id);
        $location->is_special = true;
        $location->save();

        return response()->json(['message' => 'تم تعيين الموقع كموقع خاص بنجاح', 'data' => $location], 200);
    }
}
