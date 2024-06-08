<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Http\Trait\MobileResponse;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use MobileResponse;

    // تحديث مراجعة
    public function update(Request $request, $id)
    {
        $review = Review::find($id);
        if (!$review) {
            return $this->fail("Review with ID $id not found.");
        }

        // تحديث المراجعة مع القيم الجديدة
        $review->update([
            'review' => $request->review
        ]);

        return $this->success(new ReviewResource($review));
    }

    // حذف مراجعة
    public function delete($id)
    {
        $review = Review::find($id);
        if ($review) {
            $review->delete();
            return $this->success("Review with ID $id deleted successfully.");
        } else {
            return $this->fail("Review with ID $id not found.");
        }
    }

    // إحضار مراجعة بواسطة معرّف
    public function one2($id)
    {
        $review = Review::find($id);
        if (!$review) {
            return $this->fail("Review with ID $id not found.");
        }

        return $this->success(new ReviewResource($review));
    }

    // إحضار مراجعة بناءً على طلب المعرف في الطلب
    public function one(Request $request)
    {
        $id = $request->id;
        $review = Review::find($id);
        if (!$review) {
            return $this->fail("Review with ID $id not found.");
        }

        return $this->success(new ReviewResource($review));
    }

    // إحضار كل المراجعات
    public function all()
    {
        $reviews = Review::all();
        return $this->success(ReviewResource::collection($reviews));
    }

    // إضافة مراجعة جديدة
    public function add(Request $request)
    {
        // التحقق من المدخلات المطلوبة
        $request->validate([
            'user_id' => 'required|integer',
            'rate' => 'required|numeric|between:0,5',
            'comment' => 'required|string|max:255',
            'tourism_id' => 'required|integer'
        ]);

        // إنشاء المراجعة الجديدة
        $review = Review::create([
            'user_id' => $request->user_id,
            'rate' => $request->rate,
            'comment' => $request->comment,
            'tourism_id' => $request->tourism_id
        ]);

        return $this->success(new ReviewResource($review));
    }
}
