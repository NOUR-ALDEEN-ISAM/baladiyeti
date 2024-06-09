<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Trait\MobileResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // تأكد من وجود هذا السطر

class UserController extends Controller
{
    use MobileResponse;

    // تحديث بيانات المستخدم
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->fail("User Not Found");
        }

        $url = $user->photo;
        if ($request->hasFile('photo')) {
            $url = $this->upload($request->file('photo'), 'users');
        }

        $user->update([
            'name' => $request->name ?? $user->name,
            'photo' => $url,
        ]);

        return $this->success(new UserResource($user));
    }

    // حذف المستخدم
    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return $this->success("User deleted successfully.");
        } else {
            return $this->fail("User not found.");
        }
    }

    // إحضار مستخدم بواسطة معرّف
    public function one2($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->fail("User not found.");
        }

        return $this->success(new UserResource($user));
    }

    // إحضار مستخدم بناءً على معرّف من الطلب
    public function one(Request $request)
    {
        $id_num = $request->id_num;
        $user = User::where('id_num', $id_num)->first();
    
        if (!$user) {
            return $this->fail("User not found.");
        }
    
        return $this->success(new UserResource($user));
    }

    // تسجيل مستخدم جديد
    public function reg(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id_num' => 'required|string|unique:users',
            'type' => 'required|string',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'photo' => 'required|image',
            'password' => 'required|string|min:6'
        ]);

        $url = $this->upload($request->file('photo'), 'users');

        $user = User::create([
            'name' => $request->name,
            'id_num' => $request->id_num,
            'type' => $request->type,
            'address' => $request->address,
            'phone' => $request->phone,
            'photo' => $url,
            'password' => bcrypt($request->password)
        ]);

        return $this->success(new UserResource($user));
    }

    // تسجيل الدخول
    public function login(Request $request)
    {
        $credentials = [
            'id_num' => $request->id_num,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return $this->success(new UserResource($user));
        } else {
            return $this->fail("Invalid ID number or password.");
        }
    }

    // تسجيل الخروج
    public function logout()
    {
        // التحقق من تسجيل دخول المستخدم
        if (Auth::check()) {
            Auth::logout();
            return $this->success("User logged out successfully.");
        } else {
            return $this->fail("No user is currently logged in.");
        }
    }

    // إحضار كل المستخدمين
    public function all()
    {
        $users = User::all();
        return $this->success(UserResource::collection($users));
    }

    // تغيير كلمة المرور
    public function changePassword(Request $request)
    {
        $request->validate([
            'id_num' => 'required|string',
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6',
        ]);

        Log::info('Attempting to find user with id_num: ' . $request->id_num);

        $user = User::where('id_num', $request->id_num)->first();

        if (!$user) {
            Log::error('User not found with id_num: ' . $request->id_num);
            return $this->fail('User not found.');
        }

        if (!Hash::check($request->old_password, $user->password)) {
            Log::error('Old password is incorrect for user with id_num: ' . $request->id_num);
            return $this->fail('Old password is incorrect.');
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        Log::info('Password changed successfully for user with id_num: ' . $request->id_num);

        return $this->success('Password changed successfully.');
    }

    // رفع الصور إلى مكان محدد
    private function upload($file, $directory)
    {
        $path = Storage::disk('public')->put($directory, $file);
        return Storage::url($path);
    }
}

