<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthapiController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);
        $data['token'] = $user->createToken('ApiRegister')->plainTextToken;
        $data['name'] = $request->name;
        $data['email'] = $request->email;

        return ApiResponse::send(201, true, 'تم انشاء الحساب بنجاح وتم تسجل الدخول', $data);
    }

    public function login(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $data['token'] = $user->createToken('Apilogin')->plainTextToken;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            return ApiResponse::send(200, true, 'تم تسجل الدخول', $data);
        } else {
            return ApiResponse::send(401, true, ' عفوا تأكد من كلمة المرور او الايميل بشطل صحيح', "");
        }
    }

    public function logout(Request $request)
    {
        //حذف التكون نهائيا من جدول التوكن
        $request->user()->currentAccessToken()->delete();
        return ApiResponse::send(200, true, 'تم تسجيل الرخوج');
    }
}
