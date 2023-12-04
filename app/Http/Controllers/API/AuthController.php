<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use App\Http\Helpers\ValidatorMessageHelper;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email'    => 'required|email',
                'password' => 'required',
            ], ValidatorMessageHelper::validator());

            //response error validasi
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            //get "email" dan "password" dari input
            $credentials = $request->only('email', 'password');

            //check jika "email" dan "password" tidak sesuai
            if (!$token = auth()->guard('ppdb')->attempt($credentials)) {

                //response login "failed"
                return response()->json(['success' => false,
                    'message' => 'Email or Password is incorrect'
                ], 401);
            }

            //response login "success" dengan generate "Token"
            return response()->json(['success' => true,
                'user'    => auth()->guard('ppdb')->user(),
                'token'   => $token
            ], 200);
        } catch (\Exception $e) {
            return NotificationStatus::notifError(
                false,
                $e->getMessage(),
                null,
                500
            );
        }
    }

    public function getMe(Request $request)
    {
        //response data "user" yang sedang login
        return response()->json([
            'success' => true,
            'user'    => auth()->guard('ppdb')->user()
        ], 200);

    }

    public function refreshToken(Request $request)
    {
        //refresh "token"
        $refreshToken = JWTAuth::refresh(JWTAuth::getToken());

        //set user dengan "token" baru
        $user = JWTAuth::setToken($refreshToken)->toUser();

        //set header "Authorization" dengan type Bearer + "token" baru
        $request->headers->set('Authorization', 'Bearer ' . $refreshToken);

        return response()->json([
            'success' => true,
            'user'    => $user,
            'token'   => $refreshToken,
        ], 200);
    }
    public function logout(Request $request)
    {
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'success' => true,
        ], 200);

    }
}
