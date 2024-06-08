<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class UserController extends Controller
{
    // عرض نموذج البحث عن المستخدم
    public function search()
    {
        return view('user.search');
    }

    // معالجة طلب البحث وعرض نموذج تعديل كلمة المرور
    public function find(Request $request)
    {
        $request->validate([
            'id_num' => 'required|string|max:20',
        ]);

        Log::info('Attempting to find user with id_num: ' . $request->id_num);

        $user = User::where('id_num', $request->id_num)->first();

        if (!$user) {
            Log::error('User not found with id_num: ' . $request->id_num);
            return redirect()->back()->withErrors(['id_num' => 'المستخدم غير موجود.']);
        }

        return view('user.edit', compact('user'));
    }

    // دالة لمعالجة تغيير كلمة المرور
    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'id' => 'required|integer',
                'new_password' => 'required|string|min:4|confirmed',
            ]);

            $user = User::find($request->id);

            if (!$user) {
                return response()->json(['status' => false, 'message' => 'User not found']);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            Log::info('Password changed successfully for user with id: ' . $request->id);

            return response()->json(['status' => true, 'message' => 'Password changed successfully']);
        } catch (Exception $e) {
            Log::error('Error changing password: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'An error occurred while changing the password']);
        }
    }
}
