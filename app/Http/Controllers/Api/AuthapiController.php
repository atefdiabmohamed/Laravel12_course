<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
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
}
