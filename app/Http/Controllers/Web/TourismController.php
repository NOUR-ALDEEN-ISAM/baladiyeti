<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tourism;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourismController extends Controller
{
    // عرض قائمة المتاحف والمعالم
    public function index()
    {
        // تحميل البيانات مع العلاقات
        $tourisms = Tourism::with('location')->get();

        return view('tourism.index', compact('tourisms'));
    }
    

    // عرض تفاصيل متحف أو معلم محدد
    public function show($id)
{
    $tourism = Tourism::with('location')->findOrFail($id);
    return view('tourism.show', compact('tourism'));
}

    // عرض نموذج إضافة معلم جديد
    public function create()
    {
        // جلب قائمة المواقع من قاعدة البيانات
        $locations = Location::all();
        return view('tourism.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location_id' => 'required|exists:locations,id',
            'location' => 'required|string|max:255', // تغيير هذا الحقل ليكون مطلوبًا
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $tourism = new Tourism();
        $tourism->name = $request->name;
        $tourism->description = $request->description;
        $tourism->location_id = $request->location_id;
        $tourism->location = $request->location; // تأكد من تقديم هذا الحقل إذا كان مطلوباً
    
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/tourisms');
            $tourism->photo = Storage::url($path);
        }
    
        $tourism->save();
    
        return redirect()->route('tourism.index')->with('success', 'تمت إضافة المعلم بنجاح');
    }
    
    
}
