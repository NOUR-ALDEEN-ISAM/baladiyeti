<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // عرض قائمة المواقع
    public function index()
    {
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }

    // عرض نموذج إضافة موقع جديد
    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Location::create($request->all());

        return response()->json(['success' => true]);
    }

    // عرض تفاصيل موقع محدد
    public function show($id)
    {
        $location = Location::findOrFail($id);
        return view('locations.show', compact('location'));
    }

    // عرض نموذج تعديل موقع محدد
    public function edit($id)
    {
        $location = Location::findOrFail($id);
        return view('locations.edit', compact('location'));
    }

    // تحديث موقع محدد في قاعدة البيانات
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $location = Location::findOrFail($id);
        $location->update($request->all());

        return redirect()->route('locations.index')->with('success', 'تم تحديث الموقع بنجاح');
    }

    // حذف موقع محدد من قاعدة البيانات
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('locations.index')->with('success', 'تم حذف الموقع بنجاح');
    }

    // تخصيص موقع كموقع خاص
    public function makeSpecial($id)
    {
        $location = Location::findOrFail($id);
        $location->is_special = true;
        $location->save();

        return redirect()->route('locations.index')->with('success', 'تم تعيين الموقع كموقع خاص بنجاح');
    }
}
